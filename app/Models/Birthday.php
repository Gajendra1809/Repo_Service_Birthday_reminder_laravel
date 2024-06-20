<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Birthday
 *
 * This model represents the Birthday entity, including its relationships and behaviors.
 */
class Birthday extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'birthdays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthdate',
        'phone_no',
        'user_id',
        'uuid_column',
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
     * birthdays relationship with users table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Boot the model.
     * This method is called when the model is bootstrapped.
     * Automatically generates a UUID when creating a new Birthday instance.
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
