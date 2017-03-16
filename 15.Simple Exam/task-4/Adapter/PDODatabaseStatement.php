<?php


namespace Adapter;


class PDODatabaseStatement implements DatabaseStatementInterface
{
    private $statement;

    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function execute(array $params = [])
    {
        return $this->statement->execute($params);
    }

    public function fetchRow()
    {
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchObject($className)
    {
        return $this->statement->fetchObject($className);
    }
}