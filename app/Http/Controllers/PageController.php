<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function reservation()
    {
        return view('reservation');
    }

    public function profile()
    {
        return view('profile');
    }

    public function about()
    {
        return view('about');
    }

    public function history()
    {
        return view('history');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function adminRooms()
    {
        return view('admin.rooms');
    }

    public function adminUsers()
    {
        return view('admin.users');
    }

    public function adminReservations()
    {
        return view('admin.reservations');
    }

    public function adminHistory()
    {
        return view('admin.history');
    }

    public function adminAddRoom()
    {
        return view('admin.add-room');
    }

    public function adminEditRoom($id)
    {
        return view('admin.edit-room', compact('id'));
    }

    public function adminAddUser()
    {
        return view('admin.add-user');
    }

    public function adminEditUser($id)
    {
        return view('admin.edit-user', compact('id'));
    }
}
