<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avater extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'avater_name',
        'avater_ID',
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
}
