<?php

namespace App\Http\Controllers;

use App\Helpers\User;
use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Services\PostsService;
use Illuminate\Support\Facades\Auth;

class CommunityPostController extends Controller
{

    public function index(Community $community)
    {
//        $posts = $community->posts()->latest('id')->paginate(10);
    }

    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    public function store(StorePostRequest $request, Community $community, PostsService $postsService)
    {
        $post = $community->posts()->create($request->validated() + [
                'user_id' => Auth::id(),
            ]);

        if ($request->has('image')) {
            $extenstion = $request->image->extension();
            $inputName = 'image';
            $postsService->storeImage($post, $extenstion, $inputName);
        }

        return redirect()->route('communities.show', $community);
    }

    public function show(Community $community, Post $post)
    {
        return view('posts.show', compact('community', 'post'));
    }

    public function edit(Community $community, Post $post)
    {
        User::checkAuthorized($post->user_id);

        return view('posts.edit', compact('community', 'post'));
    }

    public function update(StorePostRequest $request, Community $community, Post $post, PostsService $postsService)
    {
        User::checkAuthorized($post->user_id);

        $post->update($request->validated() + ['user_id' => Auth::id()]);
        $postsService->updateImage($request, $post);

        return redirect()->route('communities.posts.show', [$community, $post])->with('success', 'Pomyślnie zaktualizowano społeczność');
    }

    public function destroy(Community $community, Post $post)
    {
        $post->delete();

        return redirect()->route('communities.show', [$community]);
    }
}
