<?php
declare(strict_types = 1);

namespace App\Controllers;

class HomeController extends BaseController
{
    /**
     *  This returns a json response of all users and authentication token
     *
     * @return array
     */
    public function indexAction()
    {
        return ['Welcome'];
    }
}
