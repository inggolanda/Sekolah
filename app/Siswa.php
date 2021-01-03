<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table='siswa';
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','User_id'];

    public function getAvatar()
    {
        if(!$this->avatar){
            return asset('images/default.jpg');
        }
        return asset('images/'.$this->avatar);
    }

    public function mapel()
    {
        return $this->belongsToMany(mapel::class)->withPivot(['nilai'])->withTimestamps();
    }

    public function rataratanilai()
    {
        
    $total=0;
    $hitung=0;

    foreach ($this->mapel as $mp)
    {
        $total += $mp->pivot->nilai;
        $hitung++;
    }

    return round($total/4);
    }

    public function namalengkap()
    {
        return $this->nama_depan.' '.$this->nama_belakang;
    }

}
