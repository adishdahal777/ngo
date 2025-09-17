<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostHasLikes;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('common.feed.index', compact('posts'));
    }

    public function like(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);
        $user = auth()->user();

        // Check if user already liked the post
        if (PostHasLikes::where('user_id', $user->id)->where('post_id', $request->post_id)->exists()) {
            return response()->json(['message' => 'You already liked this post'], 400);
        }

        // Like the post
        PostHasLikes::create([
            'post_id' => $request->post_id,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Liked the post successfully',
        ], 201);
    }
}
