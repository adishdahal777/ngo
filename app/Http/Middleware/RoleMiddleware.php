<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $user = Auth::user();
        $viewAs = session('view_as', $user->role_id);

        $roles = array_map('intval', $roles);

        if (in_array($user->role_id, $roles) || in_array($viewAs, $roles)) {
            if (in_array(1, $roles) && $viewAs === 1) {
                $hasNgo = $user->isNgo() && $user->ngo;
                $ownsNgo = $user->isPeople() && $user->ownedNgos()->where('id', session('view_as_ngo_id'))->exists();
                if (!$hasNgo && !$ownsNgo) {
                    return redirect()->route('people.feed')->with('error', 'You do not have permission to view as an NGO.');
                }
            }
            return $next($request);
        }

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Unauthorized access.');
        } elseif ($user->isNgo()) {
            return redirect()->route('common.feed')->with('error', 'Unauthorized access.');
        } else {
            return redirect()->route('common.feed')->with('error', 'Unauthorized access.');
        }
    }
}
