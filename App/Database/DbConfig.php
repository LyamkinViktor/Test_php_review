<?php

namespace App\Database;

/**
 * Class DbConfig
 * @package App\Database
 */
class DbConfig
{
    protected static $instance;
    public $data = [];

    /**
     * DbConfig constructor.
     */
    protected function __construct()
    {
        $this->data = require __DIR__ . '/config_data.php';
    }

    /**
     * @return DbConfig
     */
    public static function getInstance(): DbConfig
    {
        if (null == self::$instance) {
            return self::$instance = new self;
        }

        return self::$instance;
    }
}
