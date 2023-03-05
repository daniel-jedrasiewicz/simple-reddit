<?php

namespace App\Http\Controllers;

use App\Helpers\User;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::where('user_id', Auth::id())->get();

        return view('communities.index', compact('communities'));
    }

    public function create()
    {
        $topics = Topic::all();

        return view('communities.create', compact('topics'));
    }

    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->validated() + ['user_id' => Auth::id()]);
        $community->topics()->attach($request->topics);

        return redirect()->route('communities.index', $community)->with('success', 'Pomyślnie utworzono społeczność');;
    }

    public function show(Community $community)
    {
        $posts = $community->posts()->latest('id')->paginate(10);

        return view('communities.show', compact('community', 'posts'));
    }

    public function edit(Community $community)
    {
        User::checkAuthorized($community->user_id);

        $topics = Topic::all();
        $community->load('topics');

        return view('communities.edit', compact('community','topics'));
    }

    public function update(UpdateCommunityRequest $request, Community $community)
    {
        User::checkAuthorized($community->user_id);

        $community->update($request->validated());
        $community->topics()->sync($request->topics);

        return redirect()->route('communities.index')->with('success', 'Pomyślnie zaktualizowano społeczność');
    }

    public function destroy(Community $community)
    {
        User::checkAuthorized($community->user_id);

        $community->delete();

        return redirect()->route('communities.index')->with('success', 'Pomyślnie usunięto społeczność');
    }
}
