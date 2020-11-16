<?php
namespace Liloy\Application\Config;



class Databaser
{
    private $pdo;
    private $config;
    public function __construct()
    {
        $this->config = require "DbConfig.php";
        $this->pdo = new \PDO("mysql:host={$this->config['host']};
            dbname={$this->config['dbname']}", $this->config['user'],
            $this->config['password']);
    }
    public function select(string $string, array $variables = []): array
    {
        $query = $this->pdo->prepare($string);
        $query->execute($variables);
        return $result = $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function insert(string $string, array $variables = []): bool
    {
        $query = $this->pdo->prepare($string);
        return $query->execute($variables);
    }
}
