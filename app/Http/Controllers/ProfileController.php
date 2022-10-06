<?php

namespace App\Http\Controllers;

use Gate;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('dashboard.profile.edit', [
            'title' => 'Profile'
        ]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if(!auth()->user()->email_verified_at)
        {
            return back()->withStatus(__('You must verify email first!'));
        }

        $rules = [
            'name' => 'nullable|max:255',
            'username' => 'nullable|max:255',
            'image' => 'image|file'
        ];

        $validatedData = $request->validate($rules);
    
        if($validatedData['name'] == ''){
            if($request['oldName'] == '' || $request['oldName'] !== auth()->user()->name){
                $validatedData['name'] = auth()->user()->name;
            } else{
                $validatedData['name'] = $request['oldName'];
            }
        }

        if($validatedData['username'] == ''){
            if($request['oldUsername'] == '' || $request['oldUsernmae'] !== auth()->user()->username){
                $validatedData['username'] = auth()->user()->username;
            } else{
                $validatedData['username'] = $request['oldUsername'];
            }
        }

        if($request->file('image'))
        {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            };
            $validatedData['image'] = $request->file('image')->store('picture-profile');
        };

        auth()->user()->update($validatedData);

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request)
    {
        if(!auth()->user()->email_verified_at)
        {
            return back()->withStatus(__('You must verify email first!'));
        }

        $rules = [
            'old_password' => ['required', 'min:6', 'max:255'],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6', 'same:password'],
        ];

        $validatedData = $request->validate($rules);

        if(!Hash::check($validatedData['old_password'], auth()->user()->password))
        {
            return back()->withPasswordStatus(__('confirm your password first!'));
        }

        auth()->user()->update(['password' => Hash::make($validatedData['password'])]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
