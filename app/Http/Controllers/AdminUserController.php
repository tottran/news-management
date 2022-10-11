<?php

namespace App\Http\Controllers;

// thư viện cho lớp đăng nhập:
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Http\Controllers;

class AdminUserController extends Controller
{
    // auth:
    public function getLoginCms() {
        return view('admin.login');
    }
    public function getLogoutCms() {
        Auth::logout();
        return view('admin.login');
    }
    public function postLoginCms(Request $request) {
        $this->validate($request, 
        // loi
        [
            "email"=>"required|min:3",
            "email"=>"required",
        ], 
        // thong bao
        [
            "email.required" => "Bạn chưa nhập Tên",
            "email.min" => "Tên tối thiểu 3 ký tự",
            "password.required" => "Bạn chưa nhập password",
        ]
        );
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('admin');
        } else {
            return redirect('login')->with('thongbao', 'Đăng nhập không thành công!');
        }
    }

    // ql user:
    public function getList() {
        $users = \App\Models\User::all();
        return view('admin.pages.user.list', ['users' => $users]);
    }
    public function getEdit($id) {
        $user = \App\Models\User::find($id);
        return view('admin.pages.user.edit', ['user' => $user]);
    }
    public function postEdit(Request $request, $id) {
        $this->validate($request, 
        // loi
        [
            "name"=>"required|min:3",
            "email"=>"required",
            "level"=>"required",
        ], 
        // thong bao
        [
            "name.required" => "Bạn chưa nhập Tên",
            "email.min" => "Tên tối thiểu 3 ký tự",
            "level.required" => "Bạn chưa chọn level",
        ]
        );
        $user = \App\Models\User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level != -1 ? $request->level : $user->level;
        // $user->password = bcrypt($user->password);

        // avatar
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/user/edit')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/user/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/user', $Hinh);
            \Storage::delete('public/upload/user/'.$user->avatar);
            $user->avatar = $Hinh;
        }

        // cover
        if($request->hasFile('cover')) {
            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/user/edit')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/user/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/user', $Hinh);
            \Storage::delete('public/upload/user/'.$user->cover);
            $user->cover = $Hinh;
        }

        $user->save();

        return redirect('/admin/user/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }
    public function getAdd() {
        return view('admin.pages.user.add');
    }
    public function postAdd(Request $request) {
        $this->validate($request, 
        // loi
        [
            "name"=>"required|min:3",
            "email"=>"required|min:3|unique:users,email",
            "level"=>"required",
        ], 
        // thong bao
        [
            "name.required" => "Bạn chưa nhập Tên",
            "name.min" => "Tên tối thiểu 3 ký tự",
            "email.required" => "Bạn chưa nhập email",
            "email.min" => "Email tối thiểu 3 ký tự",
            "email.unique" => "Email này đã tồn tại",
        ]
        );

        $user = new \App\Models\User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level != -1 ? $request->level : 0;
        $user->password = bcrypt($request->password || '');

        // avatar
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/user/add')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/user/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/user', $Hinh);
            $user->avatar = $Hinh;
        } else {
            $user->avatar = "";
        }
        // cover
        if($request->hasFile('cover')) {
            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png' && $extension != 'gif' && $extension != 'svg') {
                return redirect('/admin/user/add')->with('loi', 'Bạn chỉ được thêm hình có đuôi jpg, jpeg, png, gif, svg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = Str::random(4)."_".$name;
            while(file_exists('upload/user/'.$Hinh)) {
                $Hinh = Str::random(4)."_".$name;
            }
            $file->move('upload/user', $Hinh);
            $user->cover = $Hinh;
        } else {
            $user->cover = "";
        }

        $user->save();

        return redirect('/admin/user/add')->with('thongbao', 'Thêm thành công');
    }
    public function getDelete($id) {
        $user = \App\Models\User::find($id);
        $user->delete();
        return redirect('admin/user/list')->with('thongbao', 'Xoá thành công ' . $user->name);
    }
}
