<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $siswa=Siswa::all();
        return view('dashboard.index');
    }

}
