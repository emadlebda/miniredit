<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Community $community)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Community $community)
    {
        $community->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'post_text' => $request->post_text ?? null,
            'post_url' => $request->post_url ?? null,
        ]);

        return redirect()->route('communities.show', $community);
    }

    /**
     * Display the specified resource.
     *
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community, Post $post)
    {
        return view('posts.show', compact('community', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community, Post $post)
    {
        abort_if($post->user_id != auth()->id(), 403);

        return view('posts.edit', compact('community', 'post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Community $community, Post $post)
    {
        abort_if($post->user_id != auth()->id(), 403);
        $post->update($request->validated());
        return view('posts.show', compact('community', 'post'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community, Post $post)
    {
        abort_if($post->user_id != auth()->id(), 403);

        $post->delete();

        return redirect()->route('communities.show', $community);
    }
}
