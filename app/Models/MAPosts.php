<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MAPosts extends CoreModel
{
    protected $table = 'ma_posts';

    protected $fillable = ['id', 'user_id', 'title', 'text'];

    protected  $with = ['user'];

    public function user()
    {
        return $this->hasOne(MAUsers::class, 'id','user_id' );
    }

}
