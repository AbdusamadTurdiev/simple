<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
    	$user = User::where('username', $username)->first();

    	if (!$user) {
    		abort(404);
    	}

        $statuses = $user->statuses()->notReply()->orderBy('created_at', 'desc')->get();

    	return view('profile.index')->with('user', $user)->with('statuses', $statuses);
    }

    public function getEdit()
    {
    	return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'max:50',
            'last_name' => 'max:50',
            'location' => 'max:20',
            'photo' => 'image',
        ]);

        if ($request->hasFile('photo')) {
            if (Auth::user()->avatar()->count()) {
                $avatar = Auth::user()->avatar()->first()->avatar;

                Storage::delete('public/' . $avatar);
            }

            $path = $request->file('photo')->store('avatars', 'public');

            Auth::user()->avatar()->updateOrCreate(
                ['user_id' => Auth::user()->id], ['avatar' => $path]
            );
        }
        
    	Auth::user()->update([
    		'first_name' => $request->input('first_name'),
    		'last_name' => $request->input('last_name'),
    		'location' => $request->input('location'),
    	]);

    	return redirect()
            ->route('profile.index', ['username' => Auth::user()->username]);
    }
}
