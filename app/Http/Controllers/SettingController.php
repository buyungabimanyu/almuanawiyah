<?php

namespace App\Http\Controllers;

use App\Models\FontAwesome;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.setting.index',[
            'title' => 'Setting',
            'setting' => Setting::where('parent_id', 1)->where('active', true)->first(),
            'footers' => Setting::where('parent_id', 2)->where('active', true)->get(),
            'switch' => ''
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'nullable|max:255',
            'image' => 'image|file|max:2048'
        ]);

        $validatedData['parent_id'] = 1;

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('main');
        } else {
            $validatedData['image'] = null;
        }

        if($request->file('icon')){
            $validatedData['icon'] = $request->file('icon')->store('main');
        } else {
            $validatedData['icon'] = null;
        }

        Setting::create($validatedData);

        return redirect('/setting')->with('success', 'Setting Berasil diperbarui!');
    }

    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'body' => 'nullable|max:255',
            'image' => 'nullable|image|file|max:2048'
        ]);

        $validatedData['parent_id'] = 1;
        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            };
            $validatedData['image'] = $request->file('image')->store('main');
        } else {
            $validatedData['image'] = $setting->image;
        }

        if($request->file('icon')){
            if($request->oldIcon){
                Storage::delete($request->oldIcon);
            };
            $validatedData['icon'] = $request->file('icon')->store('main');
        } else {
            $validatedData['icon'] = $setting->icon;
        }

        $setting->update(['active' => false]);
        Setting::create($validatedData);

        return redirect('/setting')->with('success', 'Setting Berasil diperbarui!');
    }

    public function createFooter()
    {
        $icon = FontAwesome::where('parent_id', 1)->get();
        $data = array();
        foreach($icon as $x){
            $p['text'] = $x['body'];
            $p['value'] = $x['id'];
            $p['selected'] = $x['body'];
            $p['imageSrc'] = asset($x['image']);
            $data[] = $p;
        }
        $icons = json_encode($data);
        return view('dashboard.setting.index',[
            'title' => 'Setting',
            'setting' => Setting::where('parent_id', 1)->where('active', true)->first(),
            'footers' => Setting::where('parent_id', 2)->where('active', true)->get(),
            'switch' => 'create',
            'data' => '',
            'icons' => $icons
        ]);
    }

    public function storeFooter(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:7|max:255',
            'icon' => 'required'
        ]);
        $data['parent_id'] = 2;
        $data['body'] = $validatedData['name'];
        $data['icon'] = $validatedData['icon'];

        Setting::create($data);

        return redirect('/setting')->with('success', 'Footer Berasil ditambah!');
    }
    
    public function editFooter(Setting $setting)
    {
        $icon = FontAwesome::where('parent_id', 1)->get();
        $data = array();
        foreach($icon as $x){
            $p['text'] = $x['body'];
            $p['value'] = $x['id'];
            $p['selected'] = $x['body'];
            $p['imageSrc'] = asset($x['image']);
            $data[] = $p;
        }
        $icons = json_encode($data);
        return view('dashboard.setting.index',[
            'title' => 'Setting',
            'setting' => Setting::where('parent_id', 1)->where('active', true)->first(),
            'footers' => Setting::where('parent_id', 2)->where('active', true)->get(),
            'switch' => 'edit',
            'data' => $setting,
            'icons' => $icons
        ]);
    }

    public function updateFooter(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:7|max:255',
            'icon' => 'required'
        ]);

        if( $validatedData['name'] == $request['oldName'] ){
            $data['body'] = $setting->body;
        } else {
            $data['body'] = $validatedData['name'];
        }
        if($validatedData['icon'] == $setting->icon){
            $data['icon'] = $setting->icon;
        } else {
            $data['icon'] = $validatedData['icon'];
        }

        $setting->update($data);

        return redirect('/setting')->with('success', 'Footer Berasil diperbarui!');
    }
    
    public function destroyFooter(Setting $setting)
    {
        $setting->delete();
        return redirect('/setting')->with('success', 'Footer telah dihapus!');
    }
}
