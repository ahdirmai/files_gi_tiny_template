<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = 'trash';
        $data = [
            'page' => $page
        ];
        return view('pages.trash.index', $data);
    }
}
