<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        $post = $community->posts()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'post_text' => $request->post_text ?? null,
            'post_url' => $request->post_url ?? null,
        ]);

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')->storeAs('posts/' . $post->id, $image);
            $post->update(['post_image' => $image]);

            $file = Image::make(storage_path('app/public/posts/' . $post->id . '/' . $image));
            $file->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/posts/' . $post->id . '/thumbnail_' . $image));
        }

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
        $post->load('comments.user');
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

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')->storeAs('posts/' . $post->id, $image);
            if ($post->post_image != '' && $post->post_image != $image) {
                unlink(storage_path('app/public/posts/' . $post->id . '/' . $post->post_image));
                unlink(storage_path('app/public/posts/' . $post->id . '/thumbnail_' . $post->post_image));
            }

            $post->update(['post_image' => $image]);
            $file = Image::make(storage_path('app/public/posts/' . $post->id . '/' . $image));
            $file->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/posts/' . $post->id . '/thumbnail_' . $image));
        }

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

    public function vote($post_id, $vote)
    {
        $post = Post::with('community')->findOrFail($post_id);
        if (!PostVote::wherePostId($post_id)->whereUserId(auth()->id())->count()
            && in_array($vote, [-1, 1])
            && $post->user_id != auth()->id()) {

            PostVote::create([
                'post_id' => $post_id,
                'user_id' => auth()->id(),
                'vote' => $vote,
            ]);
        }

        return redirect()->route('communities.show', $post->community);
    }
}
