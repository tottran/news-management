<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    use HasFactory;
    protected $table = "LoaiTin";

    // muốn biết loại tin này thuộc thể loại nào:
    public function theloai() {
        return $this->belongsTo('App\Models\TheLoai', 'idTheLoai', 'id');
    }

    // muốn biết loại tin này có bao nhiêu tin:
    public function tintuc () {
        return $this->hasMany('App\Models\TinTuc', 'idLoaiTin', 'id');
    }
}
