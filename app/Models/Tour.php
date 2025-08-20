<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['travel_id', 'name', 'starting_date', 'ending_date', 'price'];

    public function travel() {
        return $this->belongsTo(Travel::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value / 100,
            set: fn(string $value) => $value * 100,
        );
    }
}
