<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_name',
        'description',
        'member_count',
    ];
    public function members()
    {
        return $this->belongsToMany(Avatar::class)
            ->wherePivot('invite_user_id', 0)
            ->withPivot('admin');
    }
    public function allmembers()
    {
        return $this->belongsToMany(Avatar::class);
    }
    public function inviteuser()
    {
        return $this->belongsToMany(Avatar::class)
            ->wherePivot($this->user_id, '=','invite_user_id' );
    }
    public function decks()
    {
        return $this->belongsToMany(Deck::class);
    }
}
