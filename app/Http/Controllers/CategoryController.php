<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'title' => 'Category',
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.index', [
            'title' => 'Category-Create',
            'categories' => Category::all()
        ])->with('createCategory', 'createCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->is_admin === true)
        {
            return redirect('/')->withStatus(__('You are not an Admin dude'));
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
            'image' => 'image|file|max:1024'
        ]);

        if($request->file('image'))
        {
            $validatedData['image'] = $request->file('image')->store('categories-image');
        };

        Category::create($validatedData);

        return redirect('categories')->with('success', 'New category has been added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('dashboard.categories.index', [
            'title' => 'Category-Edit(' . $category->name . ')',
            'categories' => Category::all()
        ])->with('editCategory', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        if(!auth()->user()->is_admin === true)
        {
            return redirect('/')->withStatus(__('You are not an Admin dude'));
        }
        $rules = [
            'name' => 'required|max:255',
        ];

        if($request->slug != $category->slug)
        {
            $rules['slug'] = 'required|unique:categories';
        };

        $validatedData = $request->validate($rules);

        Category::where('id', $category->id)
        ->update($validatedData);

        return redirect('categories')->with('success', 'The category has been updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        if($category){
            if($category->image){
                Storage::delete($category->image);
            };
            $category->post()->delete();
            $category->delete();
    
            return redirect('categories')->with('success', 'The category(' . $category->name . ') has been deleted with its posts!!!');
        } else{
            return redirect('categories')->with('warning', 'No category founded!!!');
        }
    }
}
