<?php

class DetailCheckoutModel extends BaseModel{
    const TABLE= 'detail_checkout';

    public function getAll($select=['*'],$orderBys=[],$limit=''){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }
    public function findById($id){
        return $this->find(self::TABLE,$id);
      }
    public function store($data)
      {
        $this->create(self::TABLE,$data);
      }
    public function updateData($id,$data)
      {
        $this->update(self::TABLE,$id,$data);
      }
    public function destroyAll($checkout_id){
      $table = self::TABLE;
      $query = "delete from $table where checkout_id=$checkout_id";
      $this->handleByQuery($query);
    }
}