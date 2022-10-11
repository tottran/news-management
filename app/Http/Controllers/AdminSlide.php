<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Http\Controllers;

class AdminSlide extends Controller
{
    public function getList() {
        $slide = \App\Models\Slide::all();
        return view('admin.pages.slide.list', ['slide' => $slide]);
    }
    public function getEdit($id) {
        $slide = \App\Models\Slide::find($id);
        return view('admin.pages.slide.edit', ["slide" => $slide]);
    }
    public function postEdit(Request $request, $id) {
        $this->validate($request, 
        // loi
        [
            "Ten"=>"required|min:1",
            "Link"=>"required",
            "NoiDung"=>"required",
        ], 
        // thong bao
        [
            "Ten.required" => "Bạn chưa nhập Tên",
            "Ten.min" => "Tên tối thiểu 1 ký tự",
            "Link.required" => "Bạn chưa nhập Link",
            "NoiDung.required" => "Bạn chưa nhập Nội Dung",
        ]
        );
        $slide = \App\Models\Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->Link = $request->Link;
        $slide->NoiDung = $request->NoiDung;

        if($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/slide/edit')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/slide/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/slide', $Hinh);
            \Storage::delete('public/upload/slide/'.$slide->Hinh);
            $slide->Hinh = $Hinh;
        }

        $slide->save();

        return redirect('/admin/slide/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }
    public function getAdd() {
        return view('admin.pages.slide.add');
    }
    public function postAdd(Request $request) {
        $this->validate($request, 
        // loi
        [
            "Ten"=>"required|min:1|unique:Slide,Ten",
            "Link"=>"required",
            "NoiDung"=>"required",
        ], 
        // thong bao
        [
            "Ten.required" => "Bạn chưa nhập Tên",
            "Ten.min" => "Tên tối thiểu 1 ký tự",
            "Ten.unique" => "Tên này đã tồn tại",
            "Link.required" => "Bạn chưa nhập Link",
            "NoiDung.required" => "Bạn chưa nhập Nội Dung",
        ]
        );

        $slide = new \App\Models\Slide;
        $slide->Ten = $request->Ten;
        $slide->Link = $request->Link;
        $slide->NoiDung = $request->NoiDung;

        if($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/slide/add')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/slide/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/slide', $Hinh);
            $slide->Hinh = $Hinh;
        } else {
            $slide->Hinh = "";
        }

        $slide->save();

        return redirect('/admin/slide/add')->with('thongbao', 'Thêm thành công');
    }
    public function getDelete($id) {
        $slide = \App\Models\Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/list')->with('thongbao', 'Xoá thành công ' . $slide->Ten);
    }
}
