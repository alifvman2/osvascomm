<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string|null $no_telp
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property bool $active
 * @property string|null $foto
 * @property string|null $remember_token
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User|null $user
 * @property Collection|Cart[] $carts
 * @property Collection|Product[] $products
 * @property Collection|Transaction[] $transactions
 * @property Collection|TransactionDetail[] $transaction_details
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use SoftDeletes, HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'active' => 'bool',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'no_telp',
		'email',
		'email_verified_at',
		'password',
		'role',
		'active',
		'foto',
		'remember_token',
		'created_by',
		'updated_by',
		'deleted_by'
	];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'updated_by');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

	public function transaction_details()
	{
		return $this->hasMany(TransactionDetail::class);
	}

	public function users()
	{
		return $this->hasMany(User::class, 'updated_by');
	}
}
