<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        // return response()->json('MASUK');

        $data = [
            'page' => 'manage-user'
        ];

        return view('pages.admin.manage-user.index', $data);
    }
}
