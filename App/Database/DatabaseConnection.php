<?php

namespace App\Database;

/**
 * Class DatabaseConnection
 * @package App\Database
 */
class DatabaseConnection
{
    protected $dbh;

    /**
     * DatabaseConnection constructor.
     */
    public function __construct()
    {
        $config = DbConfig::getInstance();
        $this->dbh = new \PDO('mysql:host=' . $config->data['db']['host'] . ';
        dbname=' . $config->data['db']['dbName'], $config->data['db']['user'], $config->data['db']['pwd']);
    }

    /**
     * @param string $sql
     * @param string $class
     * @param array $params
     * @return array
     */
    public function query(string $sql, string $class, array $params = []): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * @param string $query
     * @param array $params
     * @return bool
     */
    public function execute(string $query, array $params=[]): bool
    {
        $sth = $this->dbh->prepare($query);
        $res = $sth->execute($params);

        return true == $res;
    }

    /**
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->dbh->lastInsertId();
    }
}
