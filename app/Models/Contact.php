<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @package App\Modes
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $contact
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\User $user
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * Available contact types
     *
     * @var array<string, string>
     */
    public const TYPE = [
        'email' => 'email',
        'phone' => 'phone',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'contact',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Get user contacts
     *
     * @param int $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getContactsByUser(int $id): LengthAwarePaginator
    {
        return static::query()
            ->where(['user_id' => $id])
            ->latest()
            ->paginate();
    }

    /**
     * Find contact by given id
     *
     * @param int $id
     * @return self|\Illuminate\Database\Eloquent\Model
     */
    public static function findById(int $id): self | Model
    {
        return static::query()->findOrFail($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
