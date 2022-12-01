<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function index()
    {
        return view('dashboard.information.index', [
            'title' => 'Information',
            'active' => 'information',
            'switch' => Information::select('body')->where('parent_id', 1)->first(),
            'datainfo' => Information::where('parent_id', 2)->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'image|file|max:2048',
            'ppdb' => 'nullable'
        ]);

        if($request->file('body'))
        {
            $validatedData['body'] = $request->file('body')->store('information-image');
        };

        $validatedData['parent_id'] = 2;

        Information::create($validatedData);

        return redirect('/information')->with('success', 'New Information has been added!!!');
    }

    public function destroy(Information $information)
    {
        if($information->body){
            Storage::delete($information->body);
        };
        Information::destroy($information->id);
        return redirect('/information')->with('success', 'The Information has been Removed!!!');
    }

    public function switch(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'nullable|max:255'
        ]);

        $validatedData['parent_id'] = 1;

        Information::where('parent_id', $validatedData['parent_id'])->update(['body' => $validatedData['body']]);

        return redirect('/information');
    }
}
