<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiztype',
        'creater_id',
        'name',
        'description',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function getByLimit(int $limit_count = 10)
    {
        // 降順に並べ、最大１０の件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }

}
