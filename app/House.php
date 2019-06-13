<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'bedrooms',
        'storeys', 'garages', 'bathrooms'
    ];

    /**
     * @param Builder $query
     * @param string $column
     * @param $value
     * @return Builder
     */
    public function scopeWhereEqualAndNotEmpty($query, string $column, $value)
    {
        if (!empty($value)) {
            return $query->where($column, '=', $value);
        }

        return $query;
    }
}
