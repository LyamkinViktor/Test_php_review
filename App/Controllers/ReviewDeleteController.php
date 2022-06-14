<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Review;

/**
 * Class ReviewDeleteController
 * @package App\Controllers
 */
class ReviewDeleteController extends Controller
{
    /**
     * Review delete controller.
     */
    protected function action()
    {
        if (count($_POST) > 0 && isset($_POST['delete'])) {
            /** @var Review $review */
            $review = Review::findById(intval(trim($_POST['delete'])));
            if ($review instanceof Review) {
                $review->delete();
            }
        }
        header('Location: /?controller=AdminController');
        exit;
    }
}
