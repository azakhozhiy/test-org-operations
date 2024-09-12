<?php

namespace App\Models;

use App\Cast\DecimalCast;
use Decimal\Decimal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property-read int $seller_id
 * @property-read int $buyer_id
 * @property Decimal $amount
 *
 * @property-read Org $buyer
 * @see Operation::buyer()
 *
 * @property-read Org $seller
 * @see Operation::seller()
 */
class Operation extends Model
{
    protected $table = 'operations';

    protected $casts = [
        'sum' => DecimalCast::class
    ];

    public $timestamps = false;

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Org::class, 'buyer_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Org::class, 'seller_id');
    }
}
