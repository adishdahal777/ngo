<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('ngo.notifications.index', compact('notifications'));
    }
}
