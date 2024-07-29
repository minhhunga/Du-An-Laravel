<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'cmt';
    protected $fillable = ['cmt', 'id_blog', 'id_user', 'avatar', 'name'];
}
