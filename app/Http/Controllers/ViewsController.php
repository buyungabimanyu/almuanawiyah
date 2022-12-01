<?php

namespace App\Http\Controllers;

use App\Models\FontAwesome;
use App\Models\{Views, Courses};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewsController extends Controller
{
    public function index()
    {
        return view('dashboard.views.index',[
            'title' => 'ViewsController',
            'courses' => Courses::all(),
            'alasan' => Views::where('parent_id', 5)->where('children_id', 3)->where('active', true)->get()
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

        return redirect('/views')->with('success', 'Main Header Berasil ditambah!');
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

        return redirect('/views')->with('success', 'Main Header Berasil ditambah!');
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


        return redirect('/views')->with('success', 'Home View Berasil diUbah!');
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
            
            Views::where('parent_id', $dataTitle['parent_id'])->where('children_id', $dataTitle['children_id'])->update(['active' => false]);
            Views::create($dataTitle);
        }
        
        if($validatedData['body'] !== $request['oldBody']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
            
            Views::where('parent_id', $dataBody['parent_id'])->where('children_id', $dataBody['children_id'])->update(['active' => false]);
            Views::create($dataBody);
        }

        return redirect('/views')->with('success', 'Home View Berasil diUbah!');
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

        return redirect('/views')->with('success', 'About View Berasil diUbah!');
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

        return redirect('/views')->with('success', 'About View Berasil diUbah!');
    }

    public function CoursesView()
    {
        return view('dashboard.views.courses', [
            'title' => 'Views Courses',
            'coursesTitle' => Views::select('body')->where('parent_id', 4)->where('children_id', 1)->where('active', true)->first(),
            'coursesBody' => Views::select('body')->where('parent_id', 4)->where('children_id', 2)->where('active', true)->first(),
        ]);
    }

    public function CoursesStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255'
        ]);

        $parent_id = 4; 

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


        return redirect('/views')->with('success', 'Courses View Berasil diUbah!');
    }

    public function CoursesUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255'
        ]);

        
        $parent_id = 4; 

        if($validatedData['title'] !== $request['oldTitle']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;
            
            Views::where('parent_id', $dataTitle['parent_id'])->where('children_id', $dataTitle['children_id'])->update(['active' => false]);
            Views::create($dataTitle);
        }
        
        if($validatedData['body'] !== $request['oldBody']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
            
            Views::where('parent_id', $dataBody['parent_id'])->where('children_id', $dataBody['children_id'])->update(['active' => false]);
            Views::create($dataBody);
        }

        return redirect('/views')->with('success', 'Courses View Berasil diUbah!');
    }
    
    public function WhyView()
    {
        return view('dashboard.views.why', [
            'title' => 'Views Footer',
            'whyTitle' => Views::select('body')->where('parent_id', 5)->where('children_id', 1)->where('active', true)->first(),
            'whyBody' => Views::select('body')->where('parent_id', 5)->where('children_id', 2)->where('active', true)->first(),
            'alasan' => Views::where('parent_id', 5)->where('children_id', 3)->where('active', true)->get(),
            'switch' => ''
        ]);
    }
    
    public function WhyStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255'
        ]);

        $parent_id = 5; 

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


        return redirect('/views')->with('success', 'Why View Berasil diUbah!');
    }

    public function WhyUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255'
        ]);

        
        $parent_id = 5; 

        if($validatedData['title'] !== $request['oldTitle']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;
            
            Views::where('parent_id', $dataTitle['parent_id'])->where('children_id', $dataTitle['children_id'])->update(['active' => false]);
            Views::create($dataTitle);
        }
        
        if($validatedData['body'] !== $request['oldBody']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
            
            Views::where('parent_id', $dataBody['parent_id'])->where('children_id', $dataBody['children_id'])->update(['active' => false]);
            Views::create($dataBody);
        }

        return redirect('/views')->with('success', 'Why View Berasil diUbah!');
    }

    public function alasanView()
    {
        return view('dashboard.views.why', [
            'title' => 'Views Footer',
            'whyTitle' => Views::select('body')->where('parent_id', 5)->where('children_id', 1)->where('active', true)->first(),
            'whyBody' => Views::select('body')->where('parent_id', 5)->where('children_id', 2)->where('active', true)->first(),
            'alasan' => Views::where('parent_id', 5)->where('children_id', 3)->where('active', true)->get(),
            'switch' => 'alasan'
        ]);
    }

    public function alasanCreate()
    {
        $icon = FontAwesome::where('parent_id', 2)->get();
        $data = array();
        foreach($icon as $x){
            $p['text'] = $x['body'];
            $p['value'] = $x['id'];
            $p['selected'] = $x['body'];
            $p['imageSrc'] = asset($x['image']);
            $data[] = $p;
        }
        $icons = json_encode($data);
        return view('dashboard.views.why', [
            'title' => 'Views Footer',
            'whyTitle' => Views::select('body')->where('parent_id', 5)->where('children_id', 1)->where('active', true)->first(),
            'whyBody' => Views::select('body')->where('parent_id', 5)->where('children_id', 2)->where('active', true)->first(),
            'alasan' => Views::where('parent_id', 5)->where('children_id', 3)->where('active', true)->get(),
            'switch' => 'create',
            'data' => '',
            'icons' => $icons
        ]);
    }

    public function alasanStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:255',
            'icon' => 'required' 
        ]);
        $data = [];
        $data['title'] = $validatedData['title'];
        $data['body'] = $validatedData['body'];
        $data['image'] = $validatedData['icon'];
        $data['parent_id'] = 5;
        $data['children_id'] = 3;
        
        Views::create($data);

        return redirect('/views')->with('success', 'Alasan Berasil ditambahkan!!!');
    }

    public function alasanEdit(Views $views)
    {
        $icon = FontAwesome::where('parent_id', 2)->get();
        $data = array();
        foreach($icon as $x){
            $p['text'] = $x['body'];
            $p['value'] = $x['id'];
            $p['selected'] = $x['body'];
            $p['imageSrc'] = asset($x['image']);
            $data[] = $p;
        }
        $icons = json_encode($data);
        return view('dashboard.views.why', [
            'title' => 'Views Footer',
            'whyTitle' => Views::select('body')->where('parent_id', 5)->where('children_id', 1)->where('active', true)->first(),
            'whyBody' => Views::select('body')->where('parent_id', 5)->where('children_id', 2)->where('active', true)->first(),
            'alasan' => Views::where('parent_id', 5)->where('children_id', 3)->where('active', true)->get(),
            'switch' => 'edit',
            'data' => $views,
            'icons' => $icons
        ]);
    }

    public function alasanUpdate(Request $request, Views $views)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:5|max:255',
            'icon' => 'required' 
        ]);

        $data = [];

        if($validatedData['title'] == $request->oldTitle){
            $data['title'] = $views->title;
        } else {
            $data['title'] = $validatedData['title'];
        }

        if($validatedData['body'] == $request->oldBody){
            $data['body'] = $views->body;
        } else {
            $data['body'] = $validatedData['body'];
        }

        if($validatedData['icon'] == $request->oldIcon){
            $data['image'] = $views->title;
        } else {
            $data['image'] = $validatedData['icon'];
        }

        $views->update($data);

        return redirect('/views')->with('success', 'Alasan Berasil diubah!!!');
    }
    
    public function alasanDestroy(Views $views)
    {
        $views->delete();

        return redirect('/views')->with('success', 'Alasan Berasil dihapus!!!');
    }
    
    public function VideoView()
    {
        return view('dashboard.views.video', [
            'title' => 'Views Footer',
            'videoTitle' => Views::select('body')->where('parent_id', 6)->where('children_id', 1)->where('active', true)->first(),
            'videoBody' => Views::select('body')->where('parent_id', 6)->where('children_id', 2)->where('active', true)->first(),
            'videoText' => Views::select('body')->where('parent_id', 6)->where('children_id', 3)->where('active', true)->first(),
            'videoPlay' => Views::select('body')->where('parent_id', 6)->where('children_id', 4)->where('active', true)->first()
        ]);
    }
    
    public function videoStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'text' => 'nullable|max:255',
            'link' => 'nullable|min:7'
        ]);

        $parent_id = 6; 

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

        if($validatedData['text']){
            $dataText['body'] = $validatedData['text'];
            $dataText['parent_id'] = $parent_id;
            $dataText['children_id'] = 3;
    
            Views::create($dataText);
        }

        if($validatedData['link']){
            $dataLink['body'] = $validatedData['link'];
            $dataLink['parent_id'] = $parent_id;
            $dataLink['children_id'] = 4;
    
            Views::create($dataLink);
        }


        return redirect('/views')->with('success', 'Video View Berasil diUbah!');
    }

    public function videoUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'text' => 'nullable|max:255',
            'link' => 'nullable|min:7'
        ]);

        
        $parent_id = 6; 

        if($validatedData['title'] !== $request['oldTitle']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;
            
            Views::where('parent_id', $dataTitle['parent_id'])->where('children_id', $dataTitle['children_id'])->update(['active' => false]);
            Views::create($dataTitle);
        }
        
        if($validatedData['body'] !== $request['oldBody']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
            
            Views::where('parent_id', $dataBody['parent_id'])->where('children_id', $dataBody['children_id'])->update(['active' => false]);
            Views::create($dataBody);
        }

        if($validatedData['text'] !== $request['oldText']){
            $dataText['body'] = $validatedData['text'];
            $dataText['parent_id'] = $parent_id;
            $dataText['children_id'] = 3;
            
            Views::where('parent_id', $dataText['parent_id'])->where('children_id', $dataText['children_id'])->update(['active' => false]);
            Views::create($dataText);
        }
        
        if($validatedData['link'] !== $request['oldLink']){
            $dataLink['body'] = $validatedData['link'];
            $dataLink['parent_id'] = $parent_id;
            $dataLink['children_id'] = 4;
            
            Views::where('parent_id', $dataLink['parent_id'])->where('children_id', $dataLink['children_id'])->update(['active' => false]);
            Views::create($dataLink);
        }

        return redirect('/views')->with('success', 'Video View Berasil diUbah!');
    }

    public function ContactView()
    {
        return view('dashboard.views.contact', [
            'title' => 'Views Contact',
            'contactTitle' => Views::select('body')->where('parent_id', 7)->where('children_id', 1)->where('active', true)->first(),
            'body' => Views::select('body')->where('parent_id', 7)->where('children_id', 2)->where('active', true)->first(),
            'email' => Views::select('body')->where('parent_id', 7)->where('children_id', 3)->where('active', true)->first(),
            'phone' => Views::select('body')->where('parent_id', 7)->where('children_id', 4)->where('active', true)->first(),
            'address' => Views::select('body')->where('parent_id', 7)->where('children_id', 5)->where('active', true)->first()
        ]);
    }
        
    public function ContactStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required|min:5|max:255'
        ]);

        $parent_id = 7; 

        if($validatedData['title']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;
    
            Views::create($dataTitle);
        }

        if($validatedData['body'] !== ''){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
    
            Views::create($dataBody);
        }

        if($validatedData['email']){
            $dataEmail['body'] = $validatedData['email'];
            $dataEmail['parent_id'] = $parent_id;
            $dataEmail['children_id'] = 3;
    
            Views::create($dataEmail);
        }



        if($validatedData['phone']){
            $dataPhone['body'] = $validatedData['phone'];
            $dataPhone['parent_id'] = $parent_id;
            $dataPhone['children_id'] = 4;
    
            Views::create($dataPhone);
        }

        if($validatedData['address']){
            $dataAddress['body'] = $validatedData['address'];
            $dataAddress['parent_id'] = $parent_id;
            $dataAddress['children_id'] = 5;
    
            Views::create($dataAddress);
        }


        return redirect('/views')->with('success', 'Contact View Berasil diUbah!');
    }

    public function ContactUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'address' => 'required|min:5|max:255'
        ]);

        
        $parent_id = 7; 

        if($validatedData['title'] !== $request['oldTitle']){
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;
            
            Views::where('parent_id', $dataTitle['parent_id'])->where('children_id', $dataTitle['children_id'])->update(['active' => false]);
            Views::create($dataTitle);
        }
        
        if($validatedData['body'] !== $request['oldBody']){
            $dataBody['body'] = $validatedData['body'];
            $dataBody['parent_id'] = $parent_id;
            $dataBody['children_id'] = 2;
            
            Views::where('parent_id', $dataBody['parent_id'])->where('children_id', $dataBody['children_id'])->update(['active' => false]);
            Views::create($dataBody);
        }

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            };
            $dataImage['image'] = $request->file('image')->store('main');
            $dataImage['parent_id'] = $parent_id;
            $dataImage['children_id'] = 3;
            
            Views::where('parent_id', $dataImage['parent_id'])->where('children_id', $dataImage['children_id'])->update(['active' => false]);
            Views::create($dataImage);
        }
        
        if($validatedData['phone'] !== $request['oldPhone']){
            $dataPhone['body'] = $validatedData['phone'];
            $dataPhone['parent_id'] = $parent_id;
            $dataPhone['children_id'] = 4;
            
            Views::where('parent_id', $dataPhone['parent_id'])->where('children_id', $dataPhone['children_id'])->update(['active' => false]);
            Views::create($dataPhone);
        }

        return redirect('/views')->with('success', 'Contact View Berasil diUbah!');
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

        return redirect('/views')->with('success', 'Blog Tittle Berasil diUbah!');
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

        return redirect('/views')->with('success', 'Blog Tittle Berasil diUbah!');
    }

    public function ppdbView()
    {
        return view('dashboard.views.ppdb', [
            'title' => 'Views PPDB',
            'ppdbTitle' => Views::select('body')->where('parent_id', 9)->where('children_id', 1)->where('active', true)->first(),
            'ppdbBody' => Views::select('body')->where('parent_id', 9)->where('children_id', 2)->where('active', true)->first(),
            'image' => Views::select('body')->where('parent_id', 9)->where('children_id', 3)->where('active', true)->first()
        ]);
    }

    public function ppdbStore(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'image' => 'nullable|image|file|max:2048'
        ]);


        $parent_id = 9;
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

        return redirect('/views')->with('success', 'PPDB View Berasil diUbah!');
    }

    public function ppdbUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:5|max:255',
            'body' => 'nullable|max:255',
            'image' => 'nullable|image|file|max:2048'
        ]);

        $parent_id = 9;
        if($validatedData['title'] !== $request['oldTitle']){
            Views::where('parent_id', $parent_id)->where('children_id', 1)->update(['active' => false]);
            $dataTitle['body'] = $validatedData['title'];
            $dataTitle['parent_id'] = $parent_id;
            $dataTitle['children_id'] = 1;

            Views::create($dataTitle);
        }
        if($validatedData['body'] !== $request['oldBody']){
            Views::where('parent_id', $parent_id)->where('children_id', 2)->update(['active' => false]);    
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
            Views::where('parent_id', $parent_id)->where('children_id', $image['children_id'])->update(['active' => false]);
            Views::create($image);
        }

        return redirect('/views')->with('success', 'PPDB View Berasil diUbah!');
    }

}
