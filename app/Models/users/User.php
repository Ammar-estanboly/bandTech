<?php

namespace App\Models\users;

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
        'username',
        'email',
        'email_verified_at',
        'password',
        'avatar',
        'is_active',
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
        'password' => 'hashed',
    ];

    //hash password before save to db
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    // Getter to generate avatar URL with asset() helper
    public function getAvatarAttribute($value){
        if($value){
            return asset($value);
        }else{
            // Return default avatar URL or path if no avatar is set
            return asset('images/default-avatar.png'); // Example default avatar
        }
    }//getAvatarAttribute


    //handel update avatar case and remove asset link before save to db
    public function setAvatarAttribute($value){
        if(strpos($value,asset('') ) !== false){
            $this->attributes['avatar'] = $this->attributes['avatar'];
        }else{
            $this->attributes['avatar'] = $value;
        }

    }//setAvatarAttribute


}
