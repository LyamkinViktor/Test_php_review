<?php

namespace App;

use Exception;

/**
 * Class Controller
 * @package App
 */
abstract class Controller
{
    protected $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @return bool
     */
    protected function access(): bool
    {
        return true;
    }

    /**
     * @throws Exception
     */
    public function dispatch()
    {
        if ($this->access()) {
            $this->action();
        } else {
            header('Location: /?controller=LoginController');
            exit;
        }
    }

    /**
     * @return mixed
     */
    abstract protected function action();
}
