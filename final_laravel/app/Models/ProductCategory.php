<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use Sluggable, HasFactory;

    protected $fillable = ['name', 'slug'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ],
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'sale_target_id')->where('sale_target_type', 'category');
    }
}
