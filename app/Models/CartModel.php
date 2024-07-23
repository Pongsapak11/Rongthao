<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    protected $allowedFields = [
        'user_id',
        'product_id',
        'quantity',
        'created_at'
    ];

    public function getCartItems($userId)
    {
        return $this->select('cart.*, product.product_name, product.product_price, product.image')
            ->join('product', 'product.product_id = cart.product_id')
            ->where('cart.user_id', $userId)
            ->findAll();
    }
}
