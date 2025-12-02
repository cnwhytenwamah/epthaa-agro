<?php

namespace App\Models;

use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'name', 'slug', 
        'description', 
        'usage_instructions',
        'dosage_info', 
        'safety_info', 
        'price', 
        'stock_quantity', 
        'sku',
        'images', 
        'packaging_info', 
        'is_featured', 
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
