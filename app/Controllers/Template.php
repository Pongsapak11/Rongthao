<?php

namespace App\Controllers;

use App\Models\UserModel;

class Template extends BaseController
{
    public function Render($view, $data = []): string
    {
        if (session()->get('logged_in')) {
            $rowUser = (new UserModel())->find(session()->get('user_id'));
            session()->set('role', $rowUser['role']);
            $data['loggedUser'] = $rowUser;
        }

        $data['template'] = array(
            'head' => view('Template/Head', $data),
            'menu' => view('Template/Menu', $data),
            'footer' => view('Template/Footer', $data),
            'content' => view($view, $data)
        );
        return view('Template/Layout', $data);
    }
}
