<?php

namespace App\Models\Utils;

trait UserFilterTrait
{
    public $user_id;

    public function get(array $conditions)
    {
        $conditions['user_id'] = $this->user_id;
        return parent::get($conditions);
    }

    public function all(array $conditions = [])
    {
        $conditions['user_id'] = $this->user_id;
        return parent::all($conditions);
    }

    public function create(array $data)
    {
        $data['user_id'] = $this->user_id;
        return parent::create($data);
    }

    public function update(array $conditions, array $data)
    {
        unset($data['user_id']);
        $conditions['user_id'] = $this->user_id;
        return parent::update($conditions, $data);
    }

    public function delete(array $conditions)
    {
        $conditions['user_id'] = $this->user_id;
        return parent::delete($conditions);
    }
}
