<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 * @property string $name
 *
 * @property-read Collection|Operation[] $purchases
 * @see Org::purchases()
 *
 * @property-read Collection|Operation[] $sales
 * @see Org::sales()
 */
class Org extends Model
{
    protected $table = 'orgs';
    public $timestamps = false;

    public function purchases(): HasMany
    {
        return $this->hasMany(Operation::class, 'buyer_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Operation::class, 'seller_id');
    }
}
