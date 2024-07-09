<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'description',
        'path_image',
        'stock'
    ];
    public function productsAreInManyOrders() : BelongsToMany
    {
        return $this->belongsToMany(Order::class, "table_orders_products", "id_product", "id_order")->withPivot('quantity', 'subtotal');
    }


    public function productsAreInManyCarts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class, "table_carts_products", "id_product", "id_cart")->withPivot('quantity', 'subtotal');
    }
}
