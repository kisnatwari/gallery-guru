<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return redirect("/dashboard");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255|min:4',
            'description' => 'required|max:255|min:10',
            'image' => 'required|image|max:2048',
        ]);

        // Get the authenticated user ID
        $user_id = auth()->id();

        // Save the uploaded image file
        $image_path = $request->file('image')->store('public/images');
        $path = str_replace('public/', '', $image_path);

        // Create a new Image model instance with the request data
        $post = new Post([
            'user_id' => $user_id,
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'image_path' => $path,
            'views_count' => 0,
        ]);

        // Save the new Image model instance to the database
        $post->save();

        // Flash a success message to the session
        session()->flash('success', 'Image uploaded successfully!');

        // Redirect back to the previous page
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id as post_id', 'posts.title', 'posts.description', 'posts.image_path', 'posts.views_count', 'posts.user_id', 'users.name', 'users.email', 'users.role')
            ->where('posts.id', $id)
            ->first();

        $comments = Comment::join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.name as user_name')
            ->where('comments.post_id', $id)
            ->get();

        $post['comments'] = $comments;

        Post::where('id', $id)->update(['views_count' => ++$post->views_count]);
        if (Auth::check()) {
            return view('posts.post-view', compact('post'));
        } else {
            return view('guest-post-view', compact('post'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts)
    {
        //
    }
}
