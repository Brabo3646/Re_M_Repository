<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_number',
        'question',
        'answer',
        'hidden',
    ];
    
    public function deck(){
        return $this->belongsTo(Deck::class);  
    }
}
