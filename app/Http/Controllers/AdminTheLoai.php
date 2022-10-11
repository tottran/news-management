<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTheLoai extends Controller
{
    public function getList() {
        $theloai = \App\Models\TheLoai::all();
        return view('admin.pages.theloai.list', ['theloai' => $theloai]);
    }
    public function getEdit($id) {
        $theloai = \App\Models\TheLoai::find($id);
        return view('admin.pages.theloai.edit', ["theloai" => $theloai]);
    }
    public function postEdit(Request $request, $id) {
        $theloai = \App\Models\TheLoai::find($id);
        
        $this->validate($request,
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại tối thiểu 3 ký tự',
                'Ten.max' => 'Tên thể loại tối đa 100 ký tự'
            ]
        );
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = convert_name($theloai->Ten);
        $theloai->save();

        return redirect('/admin/theloai/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }
    public function getAdd() {
        return view('admin.pages.theloai.add');
    }
    public function postAdd(Request $request) {
        $this->validate($request, [
            'Ten' => 'required|min:3|max:40',
        ], [
            'Ten.required' => 'Bạn chưa nhập tên thể loại',
            'Ten.unique' => 'Tên thể loại đã tồn tại',
            'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
            'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
        ]);
        $theloai = new \App\Models\TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = convert_name($request->Ten);
        $theloai->save();

        return redirect('/admin/theloai/add')->with('thongbao', 'Thêm thành công');
    }
    public function getDelete($id) {
        $theloai = \App\Models\TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/list')->with('thongbao', 'Xoá thành công ' . $theloai->Ten);
    }
}
