<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function Index()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}