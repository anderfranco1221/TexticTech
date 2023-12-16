<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SavePostRequest;

class PostController 
{
    //
    public function index(){
        $post = Post::get();

        return view('posts.index', ['posts' => $post]);
    }

    public function show(Post $post){

        return view('posts.show', ['post' => $post]);
    }

    public function create(){
        return view('posts.create', ['post' => new Post]);
    }

    public function store(SavePostRequest $request){

        Post::create($request->validated());

        return to_route('post.index')->with('status', 'Post creado!');
    }

    public function edit(Post $post){
        
        return view('posts.edit', ['post'=> $post]);
    }

    public function update(SavePostRequest $request, Post $post){


        $post->update($request->validated());

        $post->save();

        return to_route('post.show', ['post' => $post])->with('status', 'Post update!');
    }

    public function destroy(Post $post){
        $post->delete();

        return to_route('post.index')->with('status', 'Post deleted');
    }
}
