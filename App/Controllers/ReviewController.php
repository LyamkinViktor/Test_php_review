<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    const ROWS_PER_PAGE = 2;

    /**
     * Review action
     */
    protected function action()
    {
        if (count($_POST) > 0) {
            $this->createReview($_POST);
        }

        $paginate = $_GET['paginate'] ? intval(htmlspecialchars(trim($_GET['paginate']))) :  1;
        $offset = ($paginate - 1) * self::ROWS_PER_PAGE;
        $reviewsCount = Review::getRowsCount();
        $totalPages = ceil($reviewsCount / self::ROWS_PER_PAGE);

        $sort = isset($_GET['sort']) && strtolower($_GET['sort']) == 'asc' ? 'ASC' : 'DESC';
        $sortBy = $sort == 'ASC' ? 'desc' : 'asc';

        $columns = array_keys(get_class_vars(Review::class));
        $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : 'created_at';

        $reviews = Review::findWithSortAndPagination(
            $column,
            $sort,
            self::ROWS_PER_PAGE,
            $offset
        );
        $loginController = new LoginController();
        $user = $loginController->getCurrentUser();
        $this->view->reviews = $reviews;
        $this->view->display(
            __DIR__ . '/../../templates/review.php',
            [
                'sort' => $sortBy,
                'column' => $column,
                'paginate' => $paginate,
                'totalPages' => $totalPages,
                'user' => $user,
                'reviewsCount' => $reviewsCount
            ]
        );
    }

    /**
     * @param array $reviewData
     * @return void
     */
    protected function createReview(array $reviewData)
    {
        if (count($reviewData) > 0) {
            $date = new \DateTime();
            $review = new Review();
            $review->name = trim($reviewData['author']) ?? '';
            $review->text = trim($reviewData['text']) ?? '';
            $review->created_at = $date->format('Y-m-d H:i:s');
            $res = $review->insert();
            if ($res == true) {
                header('Location: /');
                exit;
            }
        }
    }
}
