<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens as PassportHasApiTokens;

class Customer extends Model
{
    use PassportHasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $appends = ['image_url'];

    protected $guarded = [];

    public function getImageUrlAttribute()
    {
        if (!empty($this->image_url)) {
            $image_url = asset('uploads/customers/' . rawurlencode($this->image_url));
        } else {
            $image_url = null;
        }
        return $image_url;
    }

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
}
