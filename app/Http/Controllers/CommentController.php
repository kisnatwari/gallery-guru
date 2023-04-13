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
            'image_id' => 'required|exists:images,id'
        ]);

        // Get the authenticated user ID
        $user_id = auth()->id();

        // Create a new Comment model instance with the request data
        $comment = new Comment([
            'user_id' => $user_id,
            'image_id' => $request->input('image_id'),
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
        //
        die("show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        die("edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        die("update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        die("destroy");
    }
}
