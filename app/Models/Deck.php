<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;
    protected $fillable = [
        'deck_name',
        'creator_id',
        'description',
        'question_count',
        'new_question_number',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class);  
    }
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}