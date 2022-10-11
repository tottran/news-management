<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Http\Controllers;

class AdminTinTuc extends Controller
{
    public function getList() {
        $tintuc = \App\Models\TinTuc::orderBy('id', 'DESC')->get();
        return view('admin.pages.tintuc.list', ['tintuc'=>$tintuc]);
    }
    public function getAdd() {
        $theloai = \App\Models\TheLoai::all();
        $loaitin = \App\Models\LoaiTin::all();
        return view('admin.pages.tintuc.add', ['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postAdd(Request $request) {
        $this->validate($request,
        // loi
        [
            "LoaiTin"=>"required",
            "TieuDe"=>"required|min:3|unique:TinTuc,TieuDe",
            "TomTat"=>"required",
            "NoiDung"=>"required",
        ],
        // thong bao
        [
            "LoaiTin.required" => "Bạn chưa chọn Loại Tin",
            "TieuDe.required" => "Bạn chưa nhập Tiêu Đề",
            "TieuDe.min" => "Tiêu Đề tối thiểu 3 ký tự",
            "TieuDe.unique" => "Tiêu Đề này đã tồn tại",
            "TomTat.required" => "Bạn chưa nhập Tóm Tắt",
            "NoiDung.required" => "Bạn chưa nhập Nội Dung",
        ]
        );

        $tintuc = new \App\Models\TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = $request->TieuDeKhongDau;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        $tintuc->NoiBat = $request->NoiBat == 'on' ? 1 : 0;

        if($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/tintuc/add')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/tintuc/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc', $Hinh);
            $tintuc->Hinh = $Hinh;
        } else {
            $tintuc->Hinh = "";
        }

        $tintuc->save();
        return redirect('/admin/tintuc/add')->with('thongbao', 'Đã thêm');
    }
    public function getEdit($id) {
        $theloai = \App\Models\TheLoai::all();
        $loaitin = \App\Models\LoaiTin::all();
        $tintuc = \App\Models\TinTuc::find($id);
        return view('admin.pages.tintuc.edit', ['tintuc' => $tintuc, 'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postEdit(Request $request, $id) {
        $this->validate($request,
        // loi
        [
            "LoaiTin"=>"required",
            "TieuDe"=>"required|min:3",
            "TomTat"=>"required",
            "NoiDung"=>"required",
        ],
        // thong bao
        [
            "LoaiTin.required" => "Bạn chưa chọn Loại Tin",
            "TieuDe.required" => "Bạn chưa nhập Tiêu Đề",
            "TieuDe.min" => "Tiêu Đề tối thiểu 3 ký tự",
            "TomTat.required" => "Bạn chưa nhập Tóm Tắt",
            "NoiDung.required" => "Bạn chưa nhập Nội Dung",
        ]
        );
        $tintuc = \App\Models\TinTuc::find($id);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = $request->TieuDeKhongDau;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $noiBat = $request->NoiBat == 'on' ? 1 : 0;
        $tintuc->NoiBat = $noiBat;

        if($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/tintuc/add')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/tintuc/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/tintuc', $Hinh);
            \Storage::delete('upload/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();
        return redirect('/admin/tintuc/edit/'.$id)->with('thongbao', 'Đã cập nhật');
    }
    public function getDelete($id) {
        $tintuc = \App\Models\TinTuc::find($id);
        $tintuc->delete();
        return redirect('/admin/tintuc/list/')->with('thongbao', 'Đã xoá '. $tintuc->TieuDe);
    }
}
