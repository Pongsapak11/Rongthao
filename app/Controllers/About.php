<?php

namespace App\Controllers;

use App\Controllers\Template;

class About extends BaseController
{
    public function Shipping()
    {
        $template = new Template();
        return $template->Render('About/Shipping',
            array(
                'title' => 'ข้อมูลจัดส่ง'
            )
        );
    }

    public function Contact()
    {
        $template = new Template();
        return $template->Render('About/Contact',
            array(
                'title' => 'ข้อมูลติดต่อ'
            )
        );
    }
}
