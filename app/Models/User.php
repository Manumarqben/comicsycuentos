<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthdate',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the admin associated with the user if exists.
     */
    public function admin(): ?HasOne
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * Obtain the user -associated applicant if it exists.
     */
    public function applicant(): ?HasOne
    {
        return $this->hasOne(Applicant::class);
    }

    /**
     * Obtain the user -associated author if it exists.
     */
    public function author(): ?HasOne
    {
        return $this->hasOne(Author::class);
    }

    /**
     * Obtain works related to this user through the 'favorites' table.
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Work::class, 'favorites');
    }

    /**
     * Obtain works related to this user through the 'marker_user_work' table.
     */
    public function works(): BelongsToMany
    {
        return $this->belongsToMany(Work::class, 'marker_user_work');
    }

    /**
     * Obtain markers related to this user through the 'marker_user_work' table.
     */
    public function markers(): BelongsToMany
    {
        return $this->belongsToMany(Marker::class, 'marker_user_work');
    }

    /**
     * Obtain chapters related to this user through the 'likes' table.
     */
    public function votedChapters(): BelongsToMany
    {
        return $this->belongsToMany(Chapter::class, 'likes');
    }
}
