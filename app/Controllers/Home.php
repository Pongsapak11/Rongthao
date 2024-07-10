<?php

namespace App\Controllers;

use App\Controllers\Template;

use App\Models\ProductModel;

class Home extends BaseController
{
    public function Index()
    {

        $productModel = new ProductModel();
        $products = $productModel->findAll();

        $template = new Template();
        return $template->Render(
            'Home/Index',
            array(
                'title' => 'สินค้า',
                'products' => $products
            )
        );
    }
}
