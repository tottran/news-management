<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "Comment";

    // muốn biết comment này thuộc tin tức nào:
    public function tintuc() {
        return $this->belongsTo('App\Models\TinTuc', 'idTinTuc', 'id');
    }

    // muốn biết comment này thuộc user nào:
    public function user() {
        return $this->belongsTo('App\Models\User', 'idUser', 'id');
    }
}
