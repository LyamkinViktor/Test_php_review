<?php

namespace App;

use App\Database\DatabaseConnection;

/**
 * Class Model
 * @package App
 */
abstract class Model
{
    protected static $table = null;

    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $db = new DatabaseConnection();
        $sql = 'SELECT * FROM ' . static::$table;

        return $db->query($sql, static::class);
    }

    /**
     * @param string $field
     * @param string $sort
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function findWithSortAndPagination(
        string $field,
        string $sort,
        int $limit,
        int $offset
        ): array
    {
        $db = new DatabaseConnection();
        $sql = 'SELECT * FROM ' . static::$table .
            ' ORDER BY ' . $field . ' ' . $sort .
            ' LIMIT ' . $limit .
            ' OFFSET ' . $offset;

        return $db->query($sql, static::class);
    }

    /**
     * @return int
     */
    public static function getRowsCount(): int
    {
        $db = new DatabaseConnection();
        $sql = 'SELECT COUNT(*) as count FROM ' . static::$table;
        $res = $db->query($sql, static::class);

        return isset($res[0]) ? intval($res[0]->count) : 0;
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public static function findById($id)
    {
        $db = new DatabaseConnection();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $params = [':id' => $id];
        $record = $db->query($sql, static::class, $params);

        return $record[0] ?? false;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return null === $this->id;
    }

    /**
     * @return bool
     */
    public function insert(): bool
    {
        if (!$this->isNew()) {
            return false;
        }

        $properties = get_object_vars($this);

        $cols = [];
        $binds = [];
        $data = [];

        foreach ($properties as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $cols[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(', ', $cols) . ') 
        VALUES (' . implode(', ', $binds) . ')';

        $db = new DatabaseConnection();
        $this->id = $db->lastInsertId();

        return $db->execute($sql, $data);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        if ($this->isNew()) {
            return false;
        }

        $sql = 'DELETE FROM ' . static::$table . ' WHERE id = :id';
        $data[':id'] = $this->id;
        $db = new DatabaseConnection();

        return $db->execute($sql, $data);
    }
}
