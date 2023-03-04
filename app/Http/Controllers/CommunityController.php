<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communities = Community::where('user_id', Auth::id())->get();

        return view('communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $topics = Topic::all();

        return view('communities.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->validated() + ['user_id' => Auth::id()]);
        $community->topics()->attach($request->topics);

        return redirect()->route('communities.index', $community)->with('success', 'Pomyślnie utworzono społeczność');;
    }
    /**
     * Display the specified resource.
     */
    public function show(Community $community)
    {
        return $community->name;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community)
    {
        if($community->user_id != Auth::id()) abort('404');

        $topics = Topic::all();
        $community->load('topics');

        return view('communities.edit', compact('community','topics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        if($community->user_id != Auth::id()) abort('404');

        $community->update($request->validated());
        $community->topics()->sync($request->topics);

        return redirect()->route('communities.index')->with('success', 'Pomyślnie zaktualizowano społeczność');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        if($community->user_id != Auth::id()) abort('404');
        $community->delete();

        return redirect()->route('communities.index')->with('success', 'Pomyślnie usunięto społeczność');
    }
}
