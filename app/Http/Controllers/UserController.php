<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::paginate(10);

        return view('user.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
