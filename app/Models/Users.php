<?php

namespace App\Models;

use Pimple\Container;

class Users
{
    private $db;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
    }

    public function get($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `users` WHERE id=?');
        $stmt->execute([$id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
