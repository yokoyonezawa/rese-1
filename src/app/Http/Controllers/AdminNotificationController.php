<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\AnnouncementNotification;

class AdminNotificationController extends Controller
{
    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $message = $request->input('message');

        $users = User::all(); // すべての利用者を対象にする場合

        foreach ($users as $user) {
            $user->notify(new AnnouncementNotification($message));
        }

        return redirect()->back()->with('success', 'お知らせメールを送信しました！');
    }
}
