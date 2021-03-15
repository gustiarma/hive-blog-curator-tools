<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuratorController extends Controller
{
    public function index()
    {
        return view('hivecurator.index');
    }
    public function community($community)
    {
        return view('hivecurator.community', ['community' => $community]);
    }
}
