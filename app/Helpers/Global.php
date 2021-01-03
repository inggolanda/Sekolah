<?php

use App\Guru;
use App\Siswa;


function rangking()
{
    $siswa=Siswa::all();
        $siswa->map(function($s)
        {
            $s->rataratanilai = $s->rataratanilai();
            return $s;
        });
        $siswa= $siswa->sortByDesc('rataratanilai')->take(3);
        return $siswa;
}

function totalsiswa()
{
    return Siswa::count();
}

function totalguru()
{
    return Guru::count();
}