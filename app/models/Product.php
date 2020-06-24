<?php

namespace App\models;

use App\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(Archive::class);
    }

    public function ratings()
    {
        return $this->hasMany(RatingProduct::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function items_purchases()
    {
        return $this->hasMany(ProductsPerPurchase::class);
    }
}
