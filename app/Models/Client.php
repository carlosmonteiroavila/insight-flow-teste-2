<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    protected $fillable = [
        'company_id', 'name', 'document', 'email', 'phone', 'address'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
