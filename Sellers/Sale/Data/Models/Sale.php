<?php

namespace Sellers\Sale\Data\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $attributes = [
        'commission' => 850,
    ];

    protected $casts = [
        'amount'     => 'integer',
        'commission' => 'integer',
    ];

    protected $fillable = [
        'id',
        'amount',
        'owner_id',
    ];

    protected $table = 'sales';

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
