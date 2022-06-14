<?php

namespace App\Models;

use App\Model;
use DateTime;

/**
 * Class Review
 * @package App\Models
 */
class Review extends Model
{
    protected static $table = 'reviews';

    public $name;
    public $text;
    public $created_at;
    public $updated_at;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return DateTime|false
     */
    public function getCreatedAt(): DateTime
    {
        return date_create_from_format('Y-m-d H:i:s', $this->created_at);
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}
