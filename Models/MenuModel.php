<?php

class MenuModel extends BaseModel{
    const TABLE= 'menus';

    public function getAll($select=['*'],$orderBys=[],$limit=15){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }
    public function findById($id){
        return $this->find(self::TABLE,$id);
      }

}