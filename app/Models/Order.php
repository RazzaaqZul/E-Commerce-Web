<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $table= 'orders';
    protected $primaryKey = 'id_order';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'order_date',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_id_user', 'id_user');
    }

    public function orderHasManyProducts() : BelongsToMany 
    {
        return $this->belongsToMany(Product::class, "table_orders_products", "id_order", "id_product")->withPivot('quantity', 'subtotal');
    }
}
