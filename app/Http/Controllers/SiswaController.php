<?php

namespace App\Http\Controllers;


use App\mapel;
use Illuminate\Support\Str;
use App\Siswa;
use App\Imports\SiswaImport;
use App\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Symfony\Contracts\Service\Attribute\Required;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF;
class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_siswa =Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        }else{
            $data_siswa = Siswa::all();
            
        }
        
        return view('siswa.index',compact('data_siswa'));
    }

    //function Create Di tutorail  
    public function store(Request $request)
    {

       $request->validate([
        'namadepan'=>'Required|min:5',
        'namabelakang'=>'Required|min:5',
        'level'=>'Required',
        'email'=>'Required',
        'jeniskelamin'=>'Required',
        'agama'=>'Required',
        'alamat'=>'Required',
        'avatar'=>'Required|min:5',
        ]); 

        //insert user
        $user=new \App\User;
        $user->level = "Siswa";
        $user->name = $request->namadepan;
        $user->email = $request->email;
        $user->password = bcrypt($request->email) ;
        $user->remember_token = Str::random(60);
        $user->save();

                //insert siswa
                //$siswa=Siswa::create($request->all());
                $siswa=new Siswa();
                $request->request->add(['User_id'=> $user->id]);
                $siswa->nama_depan = $request->namadepan;
                $siswa->nama_belakang = $request->namabelakang;
                $siswa->jenis_kelamin = $request->jeniskelamin;
                $siswa->agama = $request->agama;
                $siswa->alamat = $request->alamat;
                $siswa->save();

                if($request->hasFile('avatar')){
                    $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
                    $siswa->avatar = $request->file('avatar')->getClientOriginalName();
                    $siswa->save();
                }
        return redirect('/siswa')->with('status','Data Siswa Berhasil Ditambahkan');    
    }

    //edit
    public function edit($id)
    {
        $Student=Siswa::find($id);
        return view('siswa/edit',compact('Student'));
    }


    //delete
    public function delete($id){
        $deletesiswa= Siswa::find($id);
        $deletesiswa->delete($deletesiswa);

        return redirect('/siswa')->with('hapus','Data berhasil dihapus');

    }

    //update
    public function update(Request $request, $id)
    {
        //dd($request->all());

       $upsiswa = Siswa::find($id);
        $upsiswa->update($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $upsiswa->avatar = $request->file('avatar')->getClientOriginalName();
            $upsiswa->save();
        }
        return redirect('/siswa')->with('Status','Data Berhasil Diupdate');
    }


    public function profile($id)
    {
        $Student = Siswa::find($id);
        $matapelajaran= mapel::all();
        $categories=[];
        $data=[];
        foreach($matapelajaran as $mp){
            if($Student->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[]= $mp->nama;
                $data[]= $Student->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }
        //dd($data);
        return view('siswa.profile',compact('Student','matapelajaran','categories','data'));
    }

    public function addnilai(Request $request,$idsiswa)
    {
        $siswa = Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id',$request->matapelajaran)->exists()){
            return redirect('/siswa/'.$idsiswa.'/profile')->with('tidakada','Data Sudah ada');        
        }
        $siswa->mapel()->attach($request->matapelajaran,['nilai'=>$request->nilai]);
            return redirect('/siswa/'.$idsiswa.'/profile')->with('sukses','Data Nilai Berhasil Ditambahkan');

    }

    public function deletenilai($id,$idmapel){
        $siswa=Siswa::find($id);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('hapus','Data Nilai Berhasil Di Hapus');
    }

    public function exportexcel() 
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function import() 
    {
        Excel::import(new SiswaImport, request()->file('import'));
        
        return redirect('/siswa')->with('success', 'All good!');
    }

    public function exportpdf()
    {
        $data=Siswa::all();
        $pdf = PDF::loadView('export.siswapdf',compact('data'));
        return $pdf->download('Siswa.pdf');

    }
}
