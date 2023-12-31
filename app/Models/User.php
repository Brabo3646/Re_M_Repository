<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function avatar()
    {
    return $this->HasOne(Avatar::class);
    }
    public function follow()
    {
    return $this->belongsToMany(Avatar::class);
    }
    public function deck_exist($id)
    {
    $deck_exist = $this->belongsToMany(Deck::class)
                 ->where('id', '=', $id)
                 ->exists();
    return $deck_exist;
    }
    public function decks()
    {
    return $this->belongsToMany(Deck::class)
                ->wherePivot('crew_offer',false);
    }
    public function offered_decks()
    {
    return $this->belongsToMany(Deck::class)
                ->wherePivot('crew_offer',true);
    }
    public function quiz($id)
    {
    return $this->belongsToMany(Quiz::class)
                ->where('id', '=', $id)
                ->withPivot('correct_count','error_count','latest_correct','latest_error');
    }
    public function quizzes()
    {
    return $this->belongsToMany(Quiz::class)
                ->withPivot('correct_count','error_count','latest_correct','latest_error');
    }
}
