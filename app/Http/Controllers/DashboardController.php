<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $data = DB::table('kategori_jasa')->get();
        $title = "Dashbard";
        return view('index', compact('title'));
    }
}
