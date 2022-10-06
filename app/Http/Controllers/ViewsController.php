<?php

namespace App\Http\Controllers;

use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewsController extends Controller
{
    public function index()
    {
        return view('dashboard.views.index',[
            'title' => 'ViewsController'
        ]);
    }

    public function MainView()
    {
        return view('dashboard.views.main',[
            'title' => 'Views Main Header',
            'main' => Views::where('parent_id' , 1)->where('active', true)->get()
        ]);
    }

    public function MainStore(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|file|max:2048'
        ]);

        $validatedData['image'] = $request->file('image')->store('main');
        $validatedData['parent_id'] = 1;
        $validatedData['children_id'] = 1;

        Views::create($validatedData);

        return redirect('/views/main')->with('success', 'Main Header Berasil ditambah!');
    }

    public function MainUpdate(Request $request, Views $views)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|file|max:2048'
        ]);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            };
            $validatedData['image'] = $request->file('image')->store('main');
        } else {
            $validatedData['image'] = $views->image;
        }        

        $validatedData['parent_id'] = 1;
        $validatedData['children_id'] = 1;

        $views->update(['active' => false]);
        Views::create($validatedData);

        return redirect('/views/main')->with('success', 'Main Header Berasil ditambah!');
    }

    public function HomeView()
    {
        return view('dashboard.views.home', [
            'title' => 'Views Home',
            'homeTitle' => Views::select('body')->where('parent_id', 2)->where('children_id', 1)->where('active', true)->first(),
            'homeBody' => Views::select('body')->where('parent_id', 2)->where('children_id', 2)->where('active', true)->first(),
        ]);
    }

    public function HomeStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255'
        ]);

        $parent_id = 2; 

        if($validatedData['title']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;
    
            Views::create($dataTitle);
        }

        if($validatedData['body']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
    
            Views::create($dataBody);
        }


        return redirect('/views/home')->with('success', 'Home View Berasil diUbah!');
    }

    public function HomeUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255'
        ]);

        
        $parent_id = 2; 

        if($validatedData['title'] !== $request['oldTitle']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;
            
            Views::where('parent_id', 2)->where('children_id', $dataTitle['children_id'])->update(['active' => false]);
            Views::create($dataTitle);
        }
        
        if($validatedData['body'] !== $request['oldBody']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
            
            Views::where('parent_id', 2)->where('children_id', $dataTitle['children_id'])->update(['active' => false]);
            Views::create($dataBody);
        }

        return redirect('/views/home')->with('success', 'Home View Berasil diUbah!');
    }

    public function AboutView()
    {
        return view('dashboard.views.about', [
            'title' => 'Views About',
            'aboutTitle' => Views::select('body')->where('parent_id' , 3)->where('children_id', 1)->where('active', true)->first(),
            'aboutBody' => Views::select('body')->where('parent_id' , 3)->where('children_id', 2)->where('active', true)->first(),
            'image' => Views::select('image')->where('parent_id', 3)->where('children_id', 3)->where('active', true)->first()
        ]);
    }

    public function AboutStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'image' => 'nullable|image|file|max:2048'
        ]);


        $parent_id = 3;
        if($validatedData['title']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;

            Views::create($dataTitle);
        }
        if($validatedData['body']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
    
            Views::create($dataBody);
        }
        if($request->file('image')){
            $image['image'] = $request->file('image')->store('main');
            $image['parent_id'] = $parent_id;
            $image['children_id'] = 3;
            Views::create($image);
        }

        return redirect('/views/about')->with('success', 'About View Berasil diUbah!');
    }

    public function AboutUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'image' => 'nullable|image|file|max:2048'
        ]);

        $parent_id = 3;
        if($validatedData['title'] !== $request['oldTitle']){
            Views::where('parent_id', 3)->where('children_id', 1)->update(['active' => false]);
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;

            Views::create($dataTitle);
        }
        if($validatedData['body'] !== $request['oldBody']){
            Views::where('parent_id', 3)->where('children_id', 2)->update(['active' => false]);    
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
    
            Views::create($dataBody);
        }
        if($request->file('image')){
            $image['image'] = $request->file('image')->store('main');
            $image['parent_id'] = $parent_id;
            $image['children_id'] = 3;
            if($request->oldImage){
                Storage::delete($request->oldImage);
            };
            Views::where('parent_id', 3)->where('children_id', $image['children_id'])->update(['active' => false]);
            Views::create($image);
        }

        return redirect('/views/about')->with('success', 'About View Berasil diUbah!');
    }

    public function CoursesView()
    {
        return view('dashboard.views.courses', [
            'title' => 'Views Courses'
        ]);
    }
    
    public function ContactView()
    {
        return view('dashboard.views.contact', [
            'title' => 'Views Contact'
        ]);
    }

    public function FooterView()
    {
        return view('dashboard.views.footer', [
            'title' => 'Views Footer'
        ]);
    }

    public function BlogView()
    {
        return view('dashboard.views.blog', [
            'title' => 'Blog Title',
            'blog' => Views::where('parent_id', 8)->where('active', true)->get()
        ]);
    }

    public function BlogStore(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'nullable|max:255'
        ]);
        $validatedData['parent_id'] = 8;
        $validatedData['children_id'] = 1;

        Views::create($validatedData);

        return redirect('/views/blog')->with('success', 'Blog Tittle Berasil diUbah!');
    }

    public function BlogUpdate(Request $request, Views $views)
    {
        $validatedData = $request->validate([
            'body' => 'nullable|max:255'
        ]);

        $validatedData['parent_id'] = 8;
        $validatedData['children_id'] = 1;

        $views->update(['active' => false]);
        Views::create($validatedData);

        return redirect('/views/blog')->with('success', 'Blog Tittle Berasil diUbah!');
    }
}
