<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommunitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::where('user_id', auth()->id())->get();
        return view('communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        return view('communities.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommunityRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->validated() + ['user_id' => auth()->id()]);
        $community->topics()->attach($request->topics);

        return redirect()->route('communities.show', $community);

    }

    /**
     * Display the specified resource.
     *
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        $community->load('topics');
        return $community->name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        abort_if($community->user_id != auth()->id(), 403);

        $community->load('topics');
        $topics = Topic::all();

        return view('communities.edit', compact('community', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommunityRequest $request
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        abort_if($community->user_id != auth()->id(), 403);

        $community->update($request->validated());
        $community->topics()->sync($request->topics);

        return redirect()->route('communities.index')->with('message', 'successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        abort_if($community->user_id != auth()->id(), 403);
        $community->delete();

        return redirect()->route('communities.index')->with('message', 'successfully deleted');
    }
}
