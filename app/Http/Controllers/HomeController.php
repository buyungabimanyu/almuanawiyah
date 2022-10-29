<?php

namespace App\Http\Controllers;

use App\Models\{Category, Courses, Post, User, Views};

class HomeController extends Controller
{
    public function index()
    {
        return view('homeviews.home', [
            'title' => 'Home',
            'active' => 'Home',
            'request' => '',
            'courses' => Courses::all(),
            'alasan' => Views::where('parent_id', 5)->where('children_id', 3)->where('active', true)->get()
        ]);
    }

    public function blogposts()
    {
        $title = '';

        if( request('category') ){
            $category = Category::firstWhere('slug', request('category'));
            if($category !== null){
                $title = ' in ' . $category->name;
            } else {
                $title = ' Not Founded in ' . request('category');
            }
        }

        if( request('author') ){
            $author = User::firstWhere( 'username', request('author') );
            if($author !== null){
                $title = ' By. ' . $author->name;
            } else {
                $title = ' Not Founded in ' . request('author');
            }
        }

        return view('homeviews.posts', [
            "title" => Views::blogTitle() . $title,
            "active" => "blogposts",
            'request' => 'blogposts',
            "categories" => Category::all(),
            "posts" => Post::latest()->filter( request( ['search', 'category', 'author'] ) )->paginate(6)->withQueryString()
        ]);
    }

    public function blogpost(Post $post)
    {
        return view('homeviews.post', [
            "title" => $post->title,
            "active" => "blogposts",
            'request' => 'post',
            "categories" => Category::all(),
            "post" => $post
        ]);
    }
}
