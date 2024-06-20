<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class User
 *
 * This model represents the User entity, including its relationships and behaviors.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'password',
        'uuid_column',
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
        'uuid_column' => 'string',
    ];

    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * users relationship with birthdays table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function birthdays()
    {
        return $this->hasMany(Birthday::class);
    }

    /**
     * Boot the model.
     * This method is called when the model is bootstrapped.
     * Automatically generates a UUID when creating a new model instance.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid_column = Str::uuid(); // Automatically generate UUID
        });
    }
}
