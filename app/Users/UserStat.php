<?php

namespace App\Users;

use App\Events\GetPoints;
use App\Users\User;
use Illuminate\Database\Eloquent\Model;

class UserStat extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','question_id','question_result','category_id','class_id'];
    protected $table = 'user_stats';

    protected $events = [
        'saved' => GetPoints::class,
    ];

    public function user()
    {
        $this->primaryKey = 'user_id';
        return $this->belongsTo(User::class,'id');
    }


    public function checkBeforeInsert(array $data , int $user_id)
    {
        foreach ($data as $items) {
            $status[] = $this->firstOrNew([
                 'user_id'         => $user_id,
                 'question_id'     => $items['question_id'],
                 'question_result' => $items['question_result'],
                 'category_id'     => $items['category_id'],
                 'class_id'        => $items['class_id']
            ]);
        }

        return $status;
    }

}
