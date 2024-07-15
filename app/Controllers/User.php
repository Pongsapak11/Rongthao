<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\Template;

class User extends BaseController
{
    // หน้ารายการผู้ใช้
    public function Index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $users = $userModel->findAll();

        return (new Template())->Render(
            'User/Index',
            array(
                'title' => 'รายการผู้ใช้งาน',
                'users' => $users
            )
        );
    }


    // หน้าฟอร์มในการกรอกเพิ่มผู้ใช้
    public function Create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return (new Template())->Render(
            'User/Create',
            array(
                'title' => 'เพิ่มผู้ใช้งาน'
            )
        );
    }


    // หน้า submit ฟอร์มเพิ่มผู้ใช้งาน
    public function SubmitCreate()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phoneNumber = $this->request->getPost('phoneNumber');
        $role = $this->request->getPost('role');

        $message = array();

        if (empty($username))
            $message[] = 'ชื่อผู้ใช้งาน';
        if (empty($password))
            $message[] = 'รหัสผ่าน';
        if (empty($name))
            $message[] = 'ชื่อ นามสกุล';

        if (!empty($message)) {
            return (new Template())->Render(
                'User/SubmitCreate',
                array(
                    'title' => 'เพิ่มผู้ใช้งาน',
                    'error' => true,
                    'message' => 'กรอกข้อมูล ' . join(', ', $message) . ' ให้ครบถ้วน'
                )
            );
        }

        $userModel = new UserModel();
        if ($userModel->where('username', $username)->countAllResults() > 0) {
            return (new Template())->Render(
                'User/SubmitCreate',
                array(
                    'title' => 'เพิ่มผู้ใช้งาน',
                    'error' => true,
                    'message' => 'มีผู้ใช้งาน ' . $username . ' อยู่ในระบบแล้ว'
                )
            );
        }

        $insert = $userModel->insert(
            array(
                'username' => $username,
                'password' => $password,
                'name' => $name,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'role' => $role
            )
        );
        if ($insert) {
            return (new Template())->Render(
                'User/SubmitCreate',
                array(
                    'title' => 'เพิ่มผู้ใช้งาน',
                    'error' => false,
                    'message' => 'เพิ่มผู้ใช้งานเรียบร้อยแล้ว'
                )
            );
        }

        return (new Template())->Render(
            'User/SubmitCreate',
            array(
                'title' => 'เพิ่มผู้ใช้งาน',
                'error' => true,
                'message' => 'เพิ่มผู้ใช้งานไม่สำเร็จ'
            )
        );
    }


    // หน้าฟอร์มในการแก้ไขผู้ใช้งาน
    public function Update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (empty($id)) {
            return redirect()->to('/user');
        }

        $rowUser = (new UserModel())->find($id);

        if (empty($rowUser)) {
            return redirect()->to('/user');
        }

        return (new Template())->Render(
            'User/Update',
            array(
                'title' => 'แก้ไขผู้ใช้งาน',
                'rowUser' => $rowUser
            )
        );
    }


    // หน้า submit ฟอร์มแก้ไขผู้ใช้งาน
    public function SubmitUpdate()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phoneNumber = $this->request->getPost('phoneNumber');
        $role = $this->request->getPost('role');

        $userModel = new UserModel();
        $rowUser = $userModel->find($id);
        if (empty($rowUser)) {
            return (new Template())->Render(
                'User/SubmitUpdate',
                array(
                    'title' => 'แก้ไขผู้ใช้งาน',
                    'error' => true,
                    'message' => 'ไม่พบผู้ใช้งานที่ต้องการแก้ไข',
                    'id' => $id
                )
            );
        }

        $message = array();

        if (empty($username))
            $message[] = 'ชื่อผู้ใช้งาน';
        if (empty($name))
            $message[] = 'ชื่อ นามสกุล';

        if (!empty($message)) {
            return (new Template())->Render(
                'User/SubmitUpdate',
                array(
                    'title' => 'แก้ไขผู้ใช้งาน',
                    'error' => true,
                    'message' => 'กรอกข้อมูล ' . join(', ', $message) . ' ให้ครบถ้วน',
                    'id' => $id
                )
            );
        }

        if (
            $userModel->where(
                array(
                    'username' => $username,
                    'user_id !=' => $id
                )
            )->countAllResults() > 0
        ) {
            return (new Template())->Render(
                'User/SubmitUpdate',
                array(
                    'title' => 'แก้ไขผู้ใช้งาน',
                    'error' => true,
                    'message' => 'มีผู้ใช้งาน ' . $username . ' อยู่ในระบบแล้ว',
                    'id' => $id
                )
            );
        }

        $update = $userModel->update(
            $id,
            array(
                'username' => $username,
                'name' => $name,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'role' => $role
            )
        );
        if ($update) {
            return (new Template())->Render(
                'User/SubmitUpdate',
                array(
                    'title' => 'แก้ไขผู้ใช้งาน',
                    'error' => false,
                    'message' => 'แก้ไขผู้ใช้งานเรียบร้อยแล้ว'
                )
            );
        }

        return (new Template())->Render(
            'User/SubmitUpdate',
            array(
                'title' => 'แก้ไขผู้ใช้งาน',
                'error' => true,
                'message' => 'แก้ไขผู้ใช้งานไม่สำเร็จ',
                'id' => $id
            )
        );
    }


    // หน้าลบผู้ใช้งาน
    public function Delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $rowUser = $userModel->find($id);
        if (empty($rowUser)) {
            return (new Template())->Render(
                'User/Delete',
                array(
                    'title' => 'ลบผู้ใช้งาน',
                    'error' => true,
                    'message' => 'ไม่พบผู้ใช้งานที่ต้องการลบ'
                )
            );
        }

        $delete = $userModel->delete($id);
        if ($delete) {
            return (new Template())->Render(
                'User/Delete',
                array(
                    'title' => 'ลบผู้ใช้งาน',
                    'error' => false,
                    'message' => 'ลบผู้ใช้งานเรียบร้อยแล้ว'
                )
            );
        }

        return (new Template())->Render(
            'User/Delete',
            array(
                'title' => 'ลบผู้ใช้งาน',
                'error' => true,
                'message' => 'ลบผู้ใช้งานไม่สำเร็จ'
            )
        );
    }
}