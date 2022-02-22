<?php

namespace Services;

class Work
{
    private $pdo;

    public function __construct()
    {
        $workOptions = (require __DIR__ . '/../settings.php')['work'];
        $this->pdo = new \PDO(
            'mysql:host=' . $workOptions['host'] . ';name=' . $workOptions['name'],
            $workOptions['user'],
            $workOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, $params =[], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result)
        {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}