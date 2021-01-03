<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table ='guru';
    protected $fillable=['nama','telpon','alamat','mapel_id'];
    public function mapel()
    {
        return $this->hasMany(mapel::class);
    }
    
}
