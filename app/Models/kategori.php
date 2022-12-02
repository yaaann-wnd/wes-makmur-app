<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $guarded = ['id'];

    public function post(){
        return $this->hasMany(post::class);
    }
    
    public function produk(){
        return $this->hasMany(produk::class);
    }
}
