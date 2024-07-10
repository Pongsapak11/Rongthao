<?php

namespace App\Controllers;

use App\Controllers\Template;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function Index($categoryId)
    {
        $productModel = new ProductModel();
        $products = $productModel->where('category_id', $categoryId)->findAll();

        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($categoryId);

        $template = new Template();
        return $template->Render(
            'Category/Index',
            array(
                'title' => 'สินค้าในหมวดหมู่ ' . $category['category_name'],
                'products' => $products,
                'category' => $category,
            )
        );
    }
}
