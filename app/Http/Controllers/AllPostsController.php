<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class AllPostsController extends Controller
{
    public function index()
    {
        return view('dashboard.posts.index', [
            'title' => 'All Posts',
            'posts' => Post::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'title' => 'All Posts-Show(' . $post->title . ')',
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        if(!auth()->check() || !auth()->user()->is_admin){
            return redirect('/')->with('danger', 'You are not admin dude');
        };
        if($post->image){
            Storage::delete($post->image);
        };
        Post::destroy($post->id);

        return redirect('post')->with('success', 'The post has been deleted!!!');
    }
}
