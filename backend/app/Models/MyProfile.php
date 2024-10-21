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

    protected $fillable = [
        // 投稿No
        'post_no',       
        // 名前
        'name',          
        // 投稿内容
        'post_content',  
        // タグ数
        'post_tags_count',
        // 投稿ステータス
        'post_status',   
        'status',        
        // 作成日時
        'created_at',    
        // 更新日時
        'updated_at',    
    ];

    public function tags()
    {
        //hasmanyで一つのmyprofile_postsに対して複数myprofile_posts_tagsを持つリレーションを作成
        return $this->hasMany(MyProfilePostTags::class, 'post_no', 'post_no');
    }
}
