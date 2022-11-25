<?php

namespace App\Http\Controllers;

use App\Models\BaseFolders;
use App\Models\Content;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = 'dashboard';
        $data = [
            'page' => $page
        ];
        return view('pages.dashboard.index', $data);
    }

    public function innerFolder($slug)
    {
        $name = BaseFolders::where('slug', $slug)->first();
        if (!$name) {
            $name = Content::where('slug', $slug)->first();
        }
        $page = 'dashboard';
        $data = [
            'page' => $page,
            'slug' => $slug,
            'name' => $name->name
        ];
        return view('pages.dashboard.inner-folder.index', $data);
    }
}
