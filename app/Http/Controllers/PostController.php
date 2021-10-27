<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // to go through pagination collection items through can be used
        $posts  = PostResource::collection(auth()->user()->posts()->paginate(20));
        if ($request->wantsJson()) {
            return $posts->additional(['message' => 'Post List'])->response()->setStatusCode(200);
        }
        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }
}