<?php

namespace App\Http\Controllers;

use App\Models\{Category, Post};
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CheckslugController extends Controller
{
    public function __invoke(Request $request)
    {
        if(isset($request->name))
        {
            $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
            return response()->json(['slug' => $slug]);
        } else{
            $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
            return response()->json(['slug' => $slug]);
        }
    }
}
