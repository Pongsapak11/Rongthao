<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

use App\Controllers\Template;

class Product extends BaseController
{
    // หน้ารายการสินค้า
    public function Index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $products = $productModel->findAll();

        $CategoryModel = new CategoryModel();
        $Category = $CategoryModel->findAll();

        return (new Template())->Render(
            'Product/Index',
            array(
                'title' => 'รายการสินค้า',
                'products' => $products,
                'Category' => $Category
            )
        );
    }


    // หน้าฟอร์มในการกรอกเพิ่มสินค้า
    public function Create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $CategoryModel = new CategoryModel();
        $categories = $CategoryModel->findAll();

        return (new Template())->Render(
            'Product/Create',
            array(
                'title' => 'เพิ่มสินค้า',
                'categories' => $categories
            )
        );
    }



    // หน้า submit ฟอร์มเพิ่มสินค้า
    public function SubmitCreate()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $image = $this->request->getFile('image');
        $category = $this->request->getPost('category');

        $message = array();

        if (empty($name))
            $message[] = 'ชื่อสินค้า';

        if (!empty($message)) {
            return (new Template())->Render(
                'Product/SubmitCreate',
                array(
                    'title' => 'เพิ่มสินค้า',
                    'error' => true,
                    'message' => 'กรอกข้อมูล ' . join(', ', $message) . ' ให้ครบถ้วน'
                )
            );
        }

        $insertData = array(
            'product_name' => $name,
            'product_detail' => $description,
            'product_price' => $price,
            'category_id' => $category
        );

        if ($image->isValid() && !$image->hasMoved()) {
            $validationRule = array(
                'image' => array(
                    'label' => 'ไฟล์รูปภาพ',
                    'rules' => array(
                        'uploaded[image]',
                        'is_image[image]',
                        'mime_in[image, image/jpg,image/jpeg,image/png,image/gif,image/webp]',
                        'max_size[image, 10485760]' // 10 MB
                    )
                )
            );
            if (!$this->validateData([], $validationRule)) {
                return (new Template())->Render(
                    'Product/SubmitCreate',
                    array(
                        'title' => 'เพิ่มสินค้า',
                        'error' => false,
                        'message' => $this->validator->getErrors()
                    )
                );
            }

            $newName = $image->getRandomName();
            $image->move('uploads', $newName);
            $insertData['image'] = 'uploads/' . $newName;
        }

        $productModel = new ProductModel();
        $insert = $productModel->insert($insertData);
        if ($insert) {
            return (new Template())->Render(
                'Product/SubmitCreate',
                array(
                    'title' => 'เพิ่มสินค้า',
                    'error' => false,
                    'message' => 'เพิ่มสินค้าเรียบร้อยแล้ว'
                )
            );
        }

        return (new Template())->Render(
            'Product/SubmitCreate',
            array(
                'title' => 'เพิ่มสินค้า',
                'error' => true,
                'message' => 'เพิ่มสินค้าไม่สำเร็จ'
            )
        );
    }


    // หน้าฟอร์มในการแก้ไขสินค้า
    public function Update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (empty($id)) {
            return redirect()->to('/product');
        }

        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $rowProduct = $productModel->find($id);

        if (empty($rowProduct)) {
            return redirect()->to('/product');
        }

        // สมมติว่า $rowProduct มีฟิลด์ category_id ที่บ่งบอกถึง ID ของหมวดหมู่
        $rowcategory = $categoryModel->findAll();

        return (new Template())->Render(
            'Product/Update',
            array(
                'title' => 'แก้ไขสินค้า',
                'rowProduct' => $rowProduct,
                'rowcategory' => $rowcategory
            )
        );
    }


    // หน้า submit ฟอร์มแก้ไขสินค้า
    public function SubmitUpdate()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $category = $this->request->getPost('category');
        $image = $this->request->getFile('image');

        $productModel = new ProductModel();
        $rowProduct = $productModel->find($id);
        if (empty($rowProduct)) {
            return (new Template())->Render(
                'Product/SubmitUpdate',
                array(
                    'title' => 'แก้ไขสินค้า',
                    'error' => true,
                    'message' => 'ไม่พบสินค้าที่ต้องการแก้ไข',
                    'id' => $id
                )
            );
        }

        $message = array();

        if (empty($name))
            $message[] = 'ชื่อสินค้า';

        if (!empty($message)) {
            return (new Template())->Render(
                'Product/SubmitUpdate',
                array(
                    'title' => 'แก้ไขสินค้า',
                    'error' => true,
                    'message' => 'กรอกข้อมูล ' . join(', ', $message) . ' ให้ครบถ้วน',
                    'id' => $id
                )
            );
        }

        $updateData = array(
            'product_name' => $name,
            'product_detail' => $description,
            'product_price' => $price,
            'category_id' => $category
        );

        if ($image->isValid() && !$image->hasMoved()) {
            $validationRule = array(
                'image' => array(
                    'label' => 'ไฟล์รูปภาพ',
                    'rules' => array(
                        'uploaded[image]',
                        'is_image[image]',
                        'mime_in[image, image/jpg,image/jpeg,image/png,image/gif,image/webp]',
                        'max_size[image, 10485760]' // 10 MB
                    )
                )
            );
            if (!$this->validateData([], $validationRule)) {
                return (new Template())->Render(
                    'Product/SubmitCreate',
                    array(
                        'title' => 'เพิ่มสินค้า',
                        'error' => false,
                        'message' => $this->validator->getErrors()
                    )
                );
            }

            $newName = $image->getRandomName();
            $image->move('uploads', $newName);
            $updateData['image'] = 'uploads/' . $newName;

            if ($rowProduct['image'] != '' && file_exists($rowProduct['image'])) {
                unlink($rowProduct['image']);
            }
        }

        $update = $productModel->update($id, $updateData);
        if ($update) {
            return (new Template())->Render(
                'Product/SubmitUpdate',
                array(
                    'title' => 'แก้ไขสินค้า',
                    'error' => false,
                    'message' => 'แก้ไขสินค้าเรียบร้อยแล้ว'
                )
            );
        }

        return (new Template())->Render(
            'Product/SubmitUpdate',
            array(
                'title' => 'แก้ไขสินค้า',
                'error' => true,
                'message' => 'แก้ไขสินค้าไม่สำเร็จ',
                'id' => $id
            )
        );
    }


    // หน้าลบสินค้า
    public function Delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();
        $rowProduct = $productModel->find($id);
        if (empty($rowProduct)) {
            return (new Template())->Render(
                'Product/Delete',
                array(
                    'title' => 'ลบสินค้า',
                    'error' => true,
                    'message' => 'ไม่พบสินค้าที่ต้องการลบ'
                )
            );
        }

        if ($rowProduct['image'] != '' && file_exists($rowProduct['image'])) {
            unlink($rowProduct['image']);
        }

        $delete = $productModel->delete($id);
        if ($delete) {
            return (new Template())->Render(
                'Product/Delete',
                array(
                    'title' => 'ลบสินค้า',
                    'error' => false,
                    'message' => 'ลบสินค้าเรียบร้อยแล้ว'
                )
            );
        }

        return (new Template())->Render(
            'Product/Delete',
            array(
                'title' => 'ลบสินค้า',
                'error' => true,
                'message' => 'ลบสินค้าไม่สำเร็จ'
            )
        );
    }
}