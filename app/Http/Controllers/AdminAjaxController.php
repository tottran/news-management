<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;

class AdminAjaxController extends Controller
{
    public function getLoaiTinByIdTheLoai($idTheLoai) {
        $loaitin = LoaiTin::where('idTheLoai', $idTheLoai)->get();
        $options = "<option value=''>Chọn loại tin</option>";
        foreach ($loaitin as $lt) {
            $options = $options . "<option value='".$lt->id."'>".$lt->Ten."</option>";
        }
        echo $options;
    }
}
