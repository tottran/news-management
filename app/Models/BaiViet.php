<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;

    // muốn biết bài viết này thuộc loại tin nào:
    public function loaitin() {
        return $this->belongsTo('App\Models\LoaiTin', 'idLoaiTin', 'id');
    }

    // muốn biết bài viết này thuộc user nào:
    public function user() {
        return $this->belongsTo('App\Models\User', 'idUser', 'id');
    }
}
