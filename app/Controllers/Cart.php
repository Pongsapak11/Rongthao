<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CartModel;
use App\Controllers\Template;

class Cart extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');
        $role = $session->get('role');

        if ($role !== 'admin' && $role !== 'user') {
            return redirect()->to('/login')->with('msg', 'You must be an admin or user to access the cart');
        }

        $cartModel = new CartModel();
        $cart = $cartModel->getCartItems($userId);

        $totalPrice = array_sum(array_map(function ($item) {
            return $item['product_price'] * $item['quantity'];
        }, $cart));

        $template = new Template();
        return $template->Render('cart/index', [
            'title' => 'รถเข็นสินค้า',
            'cart' => $cart,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function add($productId)
    {
        $session = session();
        $userId = $session->get('user_id');
        $role = $session->get('role');

        if ($role !== 'admin' && $role !== 'user') {
            return $this->response->setJSON([
                'error' => true,
                'message' => 'คุณต้องเป็นผู้ใช้หรือผู้ดูแลระบบเพื่อเพิ่มสินค้าลงในรถเข็น'
            ]);
        }

        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product) {
            return $this->response->setJSON([
                'error' => true,
                'message' => 'ไม่พบสินค้าที่ต้องการเพิ่มในรถเข็น'
            ]);
        }

        $cartModel = new CartModel();
        $cartItem = $cartModel->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem['quantity']++;
            $cartModel->update($cartItem['cart_id'], $cartItem);
        } else {
            $cartModel->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return $this->response->setJSON([
            'error' => false,
            'message' => 'เพิ่มสินค้าลงในรถเข็นเรียบร้อยแล้ว'
        ]);
    }

    public function remove($productId)
    {
        $session = session();
        $userId = $session->get('user_id');
        $cartModel = new CartModel();
        $cartItem = $cartModel->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartModel->delete($cartItem['cart_id']);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'สินค้าถูกลบออกจากรถเข็นแล้ว'
            ]);
        } else {
            return $this->response->setJSON([
                'error' => true,
                'message' => 'ไม่พบสินค้าที่ต้องการลบ'
            ]);
        }
    }

    public function update_quantity()
    {
        $session = session();
        $userId = $session->get('user_id');
        $input = $this->request->getJSON();

        $cartModel = new CartModel();
        $cartItem = $cartModel->where('user_id', $userId)
            ->where('product_id', $input->id)
            ->first();

        if ($cartItem) {
            if ($input->action === 'increase') {
                $cartItem['quantity']++;
            } elseif ($input->action === 'decrease' && $cartItem['quantity'] > 1) {
                $cartItem['quantity']--;
            }

            $cartModel->update($cartItem['cart_id'], $cartItem);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'อัปเดตจำนวนสินค้าสำเร็จ'
            ]);
        } else {
            return $this->response->setJSON([
                'error' => true,
                'message' => 'ไม่พบสินค้าที่ต้องการอัปเดต'
            ]);
        }
    }
}
