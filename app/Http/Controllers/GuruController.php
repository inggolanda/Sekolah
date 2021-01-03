<?php

namespace App\Http\Controllers;

use App\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_guru =Guru::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_guru = Guru::all();
        }
        return view('Guru.index',compact('data_guru'));
    }

    public function profile($id)
    {
        $guru=Guru::find($id);
        return view('Guru.Profile',compact('guru'));
    }
}
