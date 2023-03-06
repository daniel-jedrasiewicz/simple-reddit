<?php

namespace App\Services;


use App\Models\Post;

class PostsService
{

    public function storeImage(Post $post, $extension, $inputName)
    {
        return $post->addMediaFromRequest($inputName)
            ->withCustomProperties(['post_id' => $post->id, 'title' => $post->name])
            ->usingFileName($inputName . '_' . $post->id . '.' . $extension)
            ->setName($inputName)
            ->toMediaCollection('posts', 'public');
    }

    public function updateImage($request, Post $post)
    {
        if ($request->has('image')) {
            if ($post->image) {
                $post->image->delete();
            }
            $extenstionImage = $request->image->extension();
            $inputName = 'image';
            $this->storeImage($post, $extenstionImage, $inputName);
        }
    }
}




