<?php

namespace App\Controllers;

use App\Controllers\Template;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Showdetail extends BaseController
{
    public function Index($product_id, $category_id)
    {
        $productModel = new ProductModel();
        $products = $productModel->where('product_id', $product_id)->findAll();

        $categoryModel = new CategoryModel();
        $categorys = $categoryModel->where('category_id', $category_id)->find();
        if (empty($products)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ไม่พบสินค้า');
        }

        helper('number');
        $template = new Template();
        return $template->Render(
            'Showdetail/Index',
            array(
                'title' => 'หน้าสินค้า',
                'products' => $products,
                'categorys' => $categorys
            )
        );
    }
}
