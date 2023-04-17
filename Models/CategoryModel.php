<?php

class CategoryModel extends BaseModel{
    const TABLE= 'categories';

    public function getAll($select=['*'],$orderBys=[],$limit=''){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }
    public function getByCategoryId($categoryId){
      $table=self::TABLE;
      $sql=" select * from $table where category_id=$categoryId";
      return $this->getByQuery($sql);
  }
    public function findById($id){
        return $this->find(self::TABLE,$id);
      }

}
