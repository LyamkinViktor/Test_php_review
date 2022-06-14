<?php

namespace App\Controllers;

use App\Controller;
use Exception;

/**
 * Class AdminController
 * @package App\Controllers
 */
class AdminController extends Controller
{
    /**
     * @return bool
     */
    protected function access(): bool
    {
        $loginController = new LoginController();
        return null != $loginController->getCurrentUser();
    }

    /**
     * @throws Exception
     */
    protected function action()
    {
        $this->view->display(__DIR__ . '/../../templates/admin.php');
        $review = new ReviewController();
        $review->dispatch();
    }
}
