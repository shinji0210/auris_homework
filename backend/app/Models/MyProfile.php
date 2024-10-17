<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//変更 2024/10/8 タグは可変式で登録
use App\Models\MyProfilePostTags;

class MyProfile extends Model
{
    use HasFactory;

    protected $table = 'myprofile_posts'; // 正しいテーブル名

    public function tags()
    {
        //hasmanyで一つのmyprofile_postsに対して複数myprofile_posts_tagsを持つリレーションを作成
        return $this->hasMany(MyProfilePostTags::class, 'post_no', 'post_no');
    }
}
