<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        die("Index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        die("Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'comment' => 'required|min:3|max:255',
            'post_id' => 'required|exists:posts,id'
        ]);

        // Get the authenticated user ID
        $user_id = auth()->id();

        // Create a new Comment model instance with the request data
        $comment = new Comment([
            'user_id' => $user_id,
            'post_id' => $request->input('post_id'),
            'comment' => $request->input('comment'),
        ]);

        // Save the new Comment model instance to the database
        $comment->save();

        // Flash a success message to the session
        session()->flash('success', 'Comment added successfully!');

        // Redirect back to the previous page
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response(null, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->role == 'admin') {
            Comment::destroy($id);
            return redirect()->back();
        } else abort(403, 'You are not allowed to delete this comment.');
    }
}
