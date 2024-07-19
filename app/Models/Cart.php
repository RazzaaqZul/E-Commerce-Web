<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id_cart';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'fk_id_user',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'fk_id_user', 'id_user');
    }

    public function cartHasManyProducts() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, "table_carts_products", "id_cart", "id_product")->withPivot('quantity', 'subtotal');
    }
}
