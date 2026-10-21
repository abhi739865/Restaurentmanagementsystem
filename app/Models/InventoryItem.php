<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'quantity',
        'minimum_stock',
        'cost_per_unit',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:3',
            'minimum_stock' => 'decimal:3',
            'cost_per_unit' => 'decimal:2',
        ];
    }

    public function getIsLowStockAttribute(): bool
    {
        return (float) $this->quantity <= (float) $this->minimum_stock;
    }
}
