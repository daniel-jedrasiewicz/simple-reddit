<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $post->load('community');

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment
        ]);

        return redirect()->route('communities.posts.show', [$post->community, $post]);
    }

//    /**
//     * Display the specified resource.
//     */
//    public function show(string $id)
//    {
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(string $id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(Request $request, string $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(string $id)
//    {
//        //
//    }
}
