<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TransactionDetail
 * 
 * @property int $id
 * @property int $user_id
 * @property int $transaction_id
 * @property int $product_id
 * @property string|null $qty
 * @property float|null $total_price
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Product $product
 * @property Transaction $transaction
 *
 * @package App\Models
 */
class TransactionDetail extends Model
{
	use SoftDeletes;
	protected $table = 'transaction_detail';

	protected $casts = [
		'user_id' => 'int',
		'transaction_id' => 'int',
		'product_id' => 'int',
		'total_price' => 'float',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'user_id',
		'transaction_id',
		'product_id',
		'qty',
		'total_price',
		'created_by',
		'updated_by',
		'deleted_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function transaction()
	{
		return $this->belongsTo(Transaction::class);
	}
}
