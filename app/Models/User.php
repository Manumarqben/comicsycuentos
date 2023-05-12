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
     * Get the admin associated with the instance.
     */
    public function admin(): ?HasOne
    {
        return $this->hasOne(Admin::class);
    }

    /**
     * Get the applicant associated with the instance.
     */
    public function applicant(): ?HasOne
    {
        return $this->hasOne(Applicant::class);
    }

    /**
     * Get the author associated with the instance.
     */
    public function author(): ?HasOne
    {
        return $this->hasOne(Author::class);
    }

    /**
     * Get works related to this instance through the 'favorites' table.
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Work::class, 'favorites');
    }

    /**
     * Get works related to this instance through the 'marker_user_work' table.
     */
    public function works(): BelongsToMany
    {
        return $this->belongsToMany(Work::class, 'marker_user_work');
    }

    /**
     * Get markers related to this instance through the 'marker_user_work' table.
     */
    public function markers(): BelongsToMany
    {
        return $this->belongsToMany(Marker::class, 'marker_user_work');
    }

    /**
     * Get works related to this instance through the 'likes' table.
     */
    public function votedChapters(): BelongsToMany
    {
        return $this->belongsToMany(Chapter::class, 'likes');
    }

    /**
     * Get works related to this instance through the 'bookmarks' table.
     */
    public function bookmarks()
    {
        return $this->belongsToMany(Work::class, 'bookmarks');
    }

    /**
     * Get works related to this instance through the 'bookmarks' table.
     */
    public function chapterBookmarks()
    {
        return $this->belongsToMany(Chapter::class, 'bookmarks');
    }

    /**
     * Add or update a user's bookmark for a work if the work and chapter exist and if the chapter belongs to the work.
     */
    public function addBookmark($workId, $chapterId): bool
    {
        $work = Work::where('id', $workId);
        $chapter = Chapter::where('id', $chapterId);

        if ($work->exists() && $chapter->exists()) {
            $chapterBelongsToTheWork = $work->first()->chapters->contains($chapter->first());
            if ($chapterBelongsToTheWork) {
                $this->bookmarks()->sync([$workId => ['chapter_id' => $chapterId]], false);
            }
            return true;
        }
        return false;
    }

    /**
     * Delete a user's bookmark for a work.
     */
    public function deleteBookmark($workId)
    {
        $this->bookmarks()->detach($workId);
    }
}
