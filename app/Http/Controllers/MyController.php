<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function postForm(Request $req) {
        return "username = " . $req->username;
    }
}
