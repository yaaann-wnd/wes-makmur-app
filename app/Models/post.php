<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $guarded = ['id'];

    public function kategori(){
        return $this->belongsTo(kategori::class);
    }
}
