<?php

class CategoryModel extends BaseModel
{
  const TABLE = 'categories';

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

  public function updateData($id, $data)
  {
    $this->update(self::TABLE, $id, $data);
  }

  public function destroy($id)
  {
    $this->delete(self::TABLE, $id);
  }
  
  public function destroyAll($menu_id)
  {
    $table = self::TABLE;
    $query = "delete from $table where menu_id=$menu_id";
    $this->handleByQuery($query);
  }
}
