<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoaiTin extends Controller
{
    public function getList() {
        $loaitin = \App\Models\LoaiTin::all();
        return view('admin.pages.loaitin.list', ['loaitin' => $loaitin]);
    }
    public function getEdit($id) {
        $loaitin = \App\Models\LoaiTin::find($id);
        return view('admin.pages.loaitin.edit', ["loaitin" => $loaitin]);
    }
    public function postEdit(Request $request, $id) {
        $loaitin = \App\Models\LoaiTin::find($id);
        
        $this->validate($request,
            [
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin tối thiểu 3 ký tự',
                'Ten.max' => 'Tên loại tin tối đa 100 ký tự'
            ]
        );
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = convert_name($loaitin->Ten);
        $loaitin->save();

        return redirect('/admin/loaitin/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }
    public function getAdd() {
        return view('admin.pages.loaitin.add');
    }
    public function postAdd(Request $request) {
        $this->validate($request, [
            'Ten' => 'required|min:3|max:40',
        ], [
            'Ten.required' => 'Bạn chưa nhập tên loại tin',
            'Ten.unique' => 'Tên loại tin đã tồn tại',
            'Ten.min' => 'Tên loại tin phải có độ dài từ 3 đến 100 ký tự',
            'Ten.max' => 'Tên loại tin phải có độ dài từ 3 đến 100 ký tự',
        ]);
        $loaitin = new \App\Models\LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = convert_name($request->Ten);
        $loaitin->save();

        return redirect('/admin/loaitin/add')->with('thongbao', 'Thêm thành công');
    }
    public function getDelete($id) {
        $loaitin = \App\Models\LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/list')->with('thongbao', 'Xoá thành công ' . $loaitin->Ten);
    }
}
