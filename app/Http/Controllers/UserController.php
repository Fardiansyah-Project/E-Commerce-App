<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::paginate(9);

        return view('admin.users.index', compact('data'));
    }

    public function create()
    {
        return view('admin.users.create');
    }
}
