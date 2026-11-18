<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'company_id', 'name', 'sku', 'category', 'quantity',
        'minimum_quantity', 'unit_cost', 'sale_price', 'supplier'
    ];

    protected function casts(): array
    {
        return [
            'unit_cost' => 'decimal:2',
            'sale_price' => 'decimal:2',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
}
