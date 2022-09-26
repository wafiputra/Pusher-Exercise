<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $notification = DB::select('select users.id, users.name, users.email, COUNT(messages.status) as unread from users left join messages on users.id = messages.from AND messages.status = 0 where users.id = ' . Auth::id() . ' group by users.id, users.name, users.email');
        return view('home', compact('notification', $notification));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $notification = DB::select('select users.id, users.name, users.email, COUNT(messages.status) as unread from users left join messages on users.id = messages.from AND messages.status = 0 where users.id = ' . Auth::id() . ' group by users.id, users.name, users.email');
        return view('admin.home', compact('notification', $notification));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome()
    {
        $notification = DB::select('select users.id, users.name, users.email, COUNT(messages.status) as unread from users left join messages on users.id = messages.from AND messages.status = 0 where users.id = ' . Auth::id() . ' group by users.id, users.name, users.email');
        return view('manager.home', compact('notification', $notification));
    }
}
