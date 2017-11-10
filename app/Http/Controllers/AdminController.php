<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Status;
use App\Like;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $deletedUsers = User::onlyTrashed()->get();
        $statuses = Status::all();
        $messages = Message::all();
        $likes = Like::all();

        return view('admin.index')
            ->with('users', $users)
            ->with('deletedUsers', $deletedUsers)
            ->with('statuses', $statuses)
            ->with('messages', $messages)
            ->with('likes', $likes);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->back();
        }

        $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
        ->orWhere('username', 'LIKE', "%{$query}%")
        ->get();

        return view('admin.search_results')->with('users', $users);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        
        $user->delete();

        return redirect()->back();
    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->where('id', $id)->restore();

        return redirect()->back();
    }
}
