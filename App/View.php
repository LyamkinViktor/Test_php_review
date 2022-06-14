<?php

namespace App;

use App\Controllers\LoginController;

/**
 * Class View
 * @package App
 */
class View
{
    protected $data = [];

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name)
    {
        return isset($this->data[$name]);
    }

    /**
     * @param string $template
     * @param array $params
     */
    public function display(string $template, array $params = [])
    {
        $loginController = new LoginController();
        extract($this->data);
        extract($params);
        include $template;
    }
}
