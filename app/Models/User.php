<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $update_at
 * @property \Illuminate\Support\Collection $contacts
 * @property \Illuminate\Support\Collection $emails
 * @property \Illuminate\Support\Collection $phones
 */
class User extends Authenticatable
{
    use Notifiable,
        HasFactory,
        HasApiTokens;

    /**
     * The table associated with the model.
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, mixed>
     */
    protected $casts = [];

    /**
     * Get paginated users
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getAllPaginated(): LengthAwarePaginator
    {
        return static::query()->latest()->paginate();
    }

    /**
     * @param int $id
     * @return self|\Illuminate\Database\Eloquent\Model
     */
    public static function findById(int $id): self | Model
    {
        return static::query()->findOrFail($id);
    }

    /**
     * @param string $key
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function search(string $key): LengthAwarePaginator
    {
        return static::query()
            ->with('contacts')
            ->where('name', 'LIKE', '%' . $key . '%')
            ->paginate();
    }

    /**
     * Add a new user contact
     *
     * @param array $data
     * @return void
     */
    public function addContact(array $data)
    {
        $this->contacts()->create($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Contact::class)
            ->where(['type' => Contact::TYPE['email']]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Contact::class)
            ->where(['type' => Contact::TYPE['phone']]);
    }
}
