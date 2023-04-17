<?php

class DetailCheckoutModel extends BaseModel
{
    const TABLE = 'detail_checkout';

    public function getAll($select = ['*'], $orderBys = [], $limit = '')
    {
        return $this->all(self::TABLE, $select, $orderBys, $limit);
    }
    public function findById($id)
    {
        return $this->find(self::TABLE, $id);
    }

    public function store($data)
    {
        $this->create(self::TABLE, $data);
    }
}
