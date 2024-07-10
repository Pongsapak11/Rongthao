<?php

namespace App\Controllers;

use App\Controllers\Template;

use App\Models\ProductModel;

class Shop extends BaseController
{
    public function Index()
    {
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        helper('number');
        $template = new Template();
        return $template->Render(
            'Shop/Index',
            array(
                'title' => 'สินค้า',
                'products' => $products
            )
        );
    }
}
