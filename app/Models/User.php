<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Conversation;
use App\Models\Content;
use App\Models\Reseller;
use App\Models\Account;
use App\Models\Bot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
   

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
        'mailchimp' => 'array'
    ];

    // protected $appends = ['referral_link'];

    /**
     * Get the user's referral link.
     *
     * @return string
     */
    public function generateReferralLink()
    {
         $referral_link = route('register', ['ref' => $this->username]);
        // return $this->referral_link = $referral_link;
        return  $referral_link;

    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
    public function resellers()
    {
        return $this->hasMany(Reseller::class);
    }
    public function contents()
    {

        return $this->hasMany(Content::class);
    }
    public function account()
    {

        return $this->hasOne(Account::class);
    }
    public function bots()
    {

        return $this->hasMany(Bot::class);
    }

    // public function generateReferralLink()
    // {
    //     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    //     $randomString = '';

    //     // Generate a random string of specified length
    //     for ($i = 0; $i < 10; $i++) {
    //         $randomString .= $characters[rand(0, strlen($characters) - 1)];
    //     }

    //     // Generate the URL using the named route
    //     $url = route('register'); // Replace with your actual named route

    //     // Combine user's ID with the random string and the URL
    //     return $url . '?ref=' . $this->id . $randomString;
    // }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }
    protected function createdAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('F j, Y, g:i A'));
    }
}
