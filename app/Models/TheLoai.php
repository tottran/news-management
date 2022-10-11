<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    protected $table = "TheLoai";
    
    // liên kết `loaitin` lấy tất cả loại tin thuộc về thể loại
    public function loaitin() {
        return $this->hasMany('App\Models\LoaiTin', 'idTheLoai', 'id');
    }
    
    // giả sử mình muốn biết trong thể loại có bao nhiêu tin tức mình lấy hết tin tức thuộc thể loại này
    public function tintuc() {
        return $this->hasManyThrough('App\Models\TinTuc','App\Models\LoaiTin', 'idTheLoai', 'idLoaiTin', 'id');
    }
}
