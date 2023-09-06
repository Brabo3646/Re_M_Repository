<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avatar extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'avatar_name',
        'avatar_ID',
        'introduce',
        'searchable',
    ];
    
    public function users()
    // アバターとしてフォローされている人の数を示す
    {
        return $this->belongsToMany(User::class);  
    }
    
    public function master()
    // アバターの持ち主を示す
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function groups()
    // 所属するグループを示す
    {
        return $this->belongsToMany(Group::class)
            ->wherePivot('invite_user_id', 0);
    }
    public function invited_groups()
    
    {
        return $this->belongsToMany(Group::class)
            ->wherePivot('invite_user_id', "!=", 0)
            ->withPivot('invite_user_id');
    }
}
