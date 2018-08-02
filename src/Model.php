<?php

namespace SON\Framework;

use Pimple\Container;
use SON\Framework\QueryBuilder;

abstract class Model
{
    protected $db;
    protected $events;
    protected $queryBuilder;
    protected $table;

    public function __construct(Container $container)
    {
        $this->db = $container['db'];
        $this->events = $container['events'];
        $this->queryBuilder = new QueryBuilder;

        if (!$this->table) {
            $table = explode('\\', \get_called_class());
            $table = array_pop($table);
            $this->table = strtolower($table);
        }
    }

    public function get(array $conditions)
    {
        $query = $this->queryBuilder->select($this->table)
            ->where($conditions)
            ->getData();

        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function all(array $conditions = [])
    {
        $query = $this->queryBuilder->select($this->table)
            ->where($conditions)
            ->getData();

        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $this->events->trigger('creating.' . $this->table, null, $data);

        $data = $this->setData($data);

        $query = $this->queryBuilder->insert($this->table, $data)
            ->getData();

        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        $result = $this->get(['id'=>$this->db->lastInsertId()]);

        $this->events->trigger('created.' . $this->table, null, $result);

        return $result;
    }

    public function update(array $conditions, array $data)
    {
        $this->events->trigger('updating.' . $this->table, null, $data);

        $data = $this->setData($data);

        $query = $this->queryBuilder->update($this->table, $data)
            ->where($conditions)
            ->getData();

        $stmt = $this->db->prepare($query->sql);
        $stmt->execute(array_values($query->bind));

        $result = $this->get($conditions);

        $this->events->trigger('updated.' . $this->table, null, $result);

        return $result;
    }

    public function delete(array $conditions)
    {
        $result = $this->get($conditions);

        $this->events->trigger('deleting.' . $this->table, null, $result);

        $query = $this->queryBuilder->delete($this->table)
            ->where($conditions)
            ->getData();

        $stmt = $this->db->prepare($query->sql);
        $stmt->execute($query->bind);

        $this->events->trigger('deleted.' . $this->table, null, $result);

        return $result;
    }

    protected function setData($data)
    {
        foreach ($data as $field => $value) {
            $method = str_replace('_', '', $field);
            $method = ucwords($method);
            $method = str_replace(' ', '', $method);
            $method = "set{$method}";
            if (method_exists($this, $method)) {
                $data[$field] = $this->$method($value);
            }
        }

        return $data;
    }
}
