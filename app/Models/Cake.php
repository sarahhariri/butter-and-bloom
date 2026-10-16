<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable( 'name',
        'tagline',
        'description',
        'image',
        'sort_order',
        'is_active',
        'is_featured',
        'flavour_id',)]
class Cake extends Model
{
        protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function flavour()
{
    return $this->belongsTo(Flavour::class);
}
}
