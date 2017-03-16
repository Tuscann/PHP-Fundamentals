<?php


namespace Adapter;


interface DatabaseStatementInterface
{
    public function execute(array $params = []);

    public function fetchRow();

    public function fetchAll();

    public function fetchObject($className);
}