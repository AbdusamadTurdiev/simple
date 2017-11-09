<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function getReplies($id)
    {
        $status = Status::with('user')->where('id', $id)->first();

        return view('status.reply')->with('status', $status);
    }

    public function vueReplies($id)
    {
        $replies = Status::with('user')->where('parent_id', $id)->get();

        return $replies;
    }

    public function postStatus(Request $request)
    {
    	$request->validate([
            'status' => 'required|max:500',
        ]);

    	$status =  Auth::user()->statuses()->create([
    		'body' => $request->input('status'),
    	]);

    	return redirect()->back()->with('status', $status->load('user'));
    }

    public function deleteStatus($statusId)
    {
        $status = Status::find($statusId);

        $status->delete();
        
        $replies = Status::where('parent_id', $statusId);

        if ($status->replies()) {
            $replies->delete();
        }

        return redirect()->back();
    }

    public function postReply(Request $request, $statusId)
    {
    	$this->validate($request, [
    		"body" => 'required|max:500',
    	]);

    	$status = Status::notReply()->find($statusId);

    	if (!$status) {
    		return redirect()->route('home');
    	}

    	$reply = auth()->user()->statuses()->create([
    		'body' => $request->input("body"),
    	]);

    	$status->replies()->save($reply);

    	return Status::with('user')->where('id', $reply->id)->first();
    }

    public function storeLike($statusId)
    {
        $status = Status::find($statusId);

        $like = $status->likes()->create([]);
        
        Auth::user()->likes()->save($like);
    }

    public function deleteLike($statusId)
    {
        $status = Status::find($statusId);

        $status->likes()->delete();
    }
}
