<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Comment extends Controller
{
    public function getDelete($id, $idTinTuc) {
        $comment = \App\Models\Comment::find($id);
        $comment->delete();
        return redirect('/admin/tintuc/edit/'.$idTinTuc)->with('thongbao', 'Xoá bình luận thành công');
    }
}
