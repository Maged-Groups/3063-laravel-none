<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::with('user')->limit(3)->get();

        $json_posts = PostResource::collection($posts);

        return $json_posts;

    }
    /**
     * Display logged in user posts
     */
    public function my_posts()
    {

        $posts = Post::where('user_id', auth()->user()->id)->with('comments')->get();

        $json_posts = PostResource::collection($posts);

        return $json_posts;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // return dd($request);

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $added = Post::create($data);

        if ($added)
            return $added;

        return 'Cannot post now!!!';
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // return $post->comments;
        // return $post->load('comments', 'user', 'post_status');
        // $post->load(['reactions', 'user']);
        $post->load('comments');


        $post_json = PostResource::make($post);

        return $post_json;

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }


    /**
     * Randomly select n posts from the database.
     */

    public function random()
    {
        // Only this will return all in random order
        // return Post::inRandomOrder()->get();

        // Next methods will return one random post
        // return Post::inRandomOrder()->first();
        // return Post::all()->random();
        // return Post::get()->random();

        // return Post::inRandomOrder()->first()->id;
        return Post::get()->random()->id;
    }
}
