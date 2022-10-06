<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Hash,Storage};

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'title' => 'Users Panel',
            'users' => User::where('username', '!=', auth()->user()->username)->get()
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.index', [
            'title' => 'Users Panel-Create',
            'users' => User::where('is_admin', '==', false)->get()
        ])->with('createUser', '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->is_admin)
        {
            return redirect('/')->withStatus(__('You are not an Admin dude'));
        }
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string']
        ]);

        $validatedData['email_verified_at'] = now();
        $validatedData['is_editor'] = true;
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('users')->with('success', 'New user(' . $validatedData['name'] . ') has been added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.index', [
            'title' => 'Users Panel-Edit(' . $user->name .')',
            'users' => User::where('is_admin', '==', false)->get()
        ])->with('editUser', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(!auth()->user()->is_admin)
        {
            return redirect('/')->withStatus(__('You are not an Admin dude'));
        }
        $validatedData = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string']
        ]);

        if($validatedData['name'] !== ''){
            if($request['oldName'] !== ''){
                $validatedData['name'] = ($request['oldName'] !== $validatedData['name']) ? $validatedData['name'] : $user->name;
            } else {
                $validatedData['name'] = $user->name;
            }
        } else {
            $validatedData['name'] = $user->name;
        }

        $validatedData['password'] = ($validatedData['password'] !== '') ? Hash::make($validatedData['password']) : $user->password;

        User::where('id', $user->id)->update($validatedData);

        return redirect('users')->with('success', 'New user(' . $user->name . ') has been update!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(!auth()->user()->is_admin)
        {
            return redirect('/')->withStatus(__('You are not an Admin dude'));
        }

        if($user)
        {
            if($user->image)
            {
                Storage::delete($user->image);
            };
            $user->post()->delete();
            $user->delete();
    
            return redirect('users')->with('success', 'The user(' . $user->name . ') has been deleted with them posts!!!');
        } else {
            return redirect('users')->with('warning', 'The user(' . $user->name . ') has not founded!!!');
        }
    }

    public function mEditor(User $user)
    {
        if(!auth()->user()->is_admin)
        {
            return redirect('/')->withStatus(__('You are not an Admin dude'));
        }
        User::where('id', $user->id)->update(['is_editor' => true]);
        return redirect('users')->with('success', $user->name . ' is already an editor!!!');
    }

    public function mAdmin(User $user)
    {
        if(!auth()->user()->is_admin)
        {
            return redirect('/')->withStatus(__('You are not an Admin dude'));
        }
        User::where('id', $user->id)->update(['is_admin' => true, 'is_editor' => true]);
        return redirect('users')->with('success', $user->name . ' is already an editor!!!');
    }
}
