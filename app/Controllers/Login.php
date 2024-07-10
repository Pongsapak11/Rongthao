<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Controllers\Template;

class Login extends BaseController
{
    public function Index()
    {
        if (session()->get('logged_in'))
        {
            return redirect()->to('/');
        }

        $template = new Template();
        return $template->Render('Login/Index',
            array(
                'title' => 'เข้าสู่ระบบ'
            )
        );
    }

    public function Check()
    {
        if (session()->get('logged_in'))
        {
            return redirect()->to('/');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $template = new Template();
        if (empty($username) || empty($password))
        {
            return $template->Render('Login/Check',
                array(
                    'title' => 'ตรวจสอบการเข้าสู่ระบบ',
                    'error' => true,
                    'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน'
                )
            );
        }

        $rowUser = (new UserModel())->where(
            array(
                'username' => $username,
                'password' => $password
            )
        )->first();

        if (empty($rowUser))
        {
            return $template->Render('Login/Check',
                array(
                    'title' => 'ตรวจสอบการเข้าสู่ระบบ',
                    'error' => true,
                    'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'
                )
            );
        }

        session()->set('logged_in', true);
        session()->set('user_id', $rowUser['user_id']);

        return $template->Render('Login/Check',
            array(
                'title' => 'ตรวจสอบการเข้าสู่ระบบ',
                'error' => false,
                'message' => 'สวัสดีคุณ ' . $rowUser['name']
            )
        );
    }
}