<?php

namespace App\Controllers;

use App\Controller;
use Exception;

/**
 * Class IndexController
 * @package App\Controllers
 */
class IndexController extends Controller
{
    /**
     * @throws Exception
     */
    protected function action()
    {
        $this->view->display(__DIR__ . '/../../templates/form.php');
        $review = new ReviewController();
        $review->dispatch();
    }
}
