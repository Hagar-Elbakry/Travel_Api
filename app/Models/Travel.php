<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use Sluggable;
    protected $table = 'travels';
    protected  $fillable = ['is_public', 'slug', 'name', 'description', 'number_of_days'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function tours() {
        return $this->hasMany(Tour::class);
    }

    protected function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['number_of_days'] - 1,
        );
    }
}
