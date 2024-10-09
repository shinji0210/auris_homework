<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//変更 2024/10/8 タグは可変式で登録
//myprofile_posts_tagsのモデル作成
class MyProfilePostTags extends Model
{
    use HasFactory;
    
    protected $table = 'myprofile_posts_tags';

    // fillableで処理する列を指定
    protected $fillable = [
        'tag_no',       // これを追加
        'post_no',
        'tag_content',
        'status',
        'created_at',
        'updated_at',
    ];
}
