<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        echo "Hello";
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
        $image = new Image([
            'user_id' => $user_id,
            'title' => $request->input('name'),
            'description' => $request->input('description'),
            'image_path' => $path,
            'views_count' => 0,
        ]);

        // Save the new Image model instance to the database
        $image->save();

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
        $image = Image::join('users', 'images.user_id', '=', 'users.id')
            ->select('images.id as image_id', 'images.title', 'images.description', 'images.image_path', 'images.views_count', 'images.user_id', 'users.name', 'users.email')
            ->where('images.id', $id)
            ->first();

        //$comments = Comment::where('image_id', $id)->get();
        $comments = Comment::join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.name as user_name')
            ->where('comments.image_id', $id)
            ->get();

        $image['comments'] = $comments;

        Image::where('id', $id)->update(['views_count' => ++$image->views_count]);

        return view('images.image-view', compact('image'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::find($id);
        if (auth()->user()->id == $image->user_id) {
            Storage::delete('public/images/' . $image);
            $image->delete();
            session()->flash('success', 'Image deleted successfully');
        } else {
            session()->flash('error', 'Image Failed to be deleted');
        }
        return redirect('/dashboard');
    }
}

/* 
+-----------+---------------------------+------------------------+------------------+-------------------------------------------------------------------------+--------------+
| Method    | URI                       | Name                   | Action           | Middleware                                                              | Resource     |
+-----------+---------------------------+------------------------+------------------+-------------------------------------------------------------------------+--------------+
| GET       | /posts                    | posts.index            | App\Http\Controllers\PostController@index            | web        | posts        |
| GET       | /posts/create             | posts.create           | App\Http\Controllers\PostController@create           | web        | posts        |
| POST      | /posts                    | posts.store            | App\Http\Controllers\PostController@store            | web        | posts        |
| GET       | /posts/{post}             | posts.show             | App\Http\Controllers\PostController@show             | web        | posts        |
| GET       | /posts/{post}/edit        | posts.edit             | App\Http\Controllers\PostController@edit             | web        | posts        |
| PUT/PATCH | /posts/{post}             | posts.update           | App\Http\Controllers\PostController@update           | web        | posts        |
| DELETE    | /posts/{post}             | posts.destroy          | App\Http\Controllers\PostController@destroy          | web        | posts        |
+-----------+---------------------------+------------------------+------------------+-------------------------------------------------------------------------+--------------+
 */