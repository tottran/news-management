<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = "TinTuc";

    // muốn biết tin tức này thuộc loại tin nào:
    public function loaitin() {
        return $this->belongsTo('App\Models\LoaiTin', 'idLoaiTin', 'id');
    }

    // muốn biết tin tức này thuộc thể loại nào:
    // public function theloai() {
    //     return $this->belongsTo('App\Models\TheLoai', 'idTheLoai', 'id');
    // }
    // Không cần viết thêm truy vấn thể loại vì chỉ cần gọi loaitin xong gọi tiếp hàm theloai() trong LoaiTin

    // lấy ra các comments
    public function comment() {
        return $this->hasMany('App\Models\Comment','idTinTuc','id');
    }
}
