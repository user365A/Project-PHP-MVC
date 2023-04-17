<?php

class UserModel extends BaseModel{
    const TABLE= 'users';

    public function getAll($select=['*'],$orderBys=[],$limit=''){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }

    public function findById($id){
        return $this->find(self::TABLE,$id);
      }

    public function getAdminLogin($username,$password){
        $table=self::TABLE;
        $query="select * from $table where username='$username' and password='$password'";
        return $this->getByQuery($query);
    }
    public function store($data)
      {
        $this->create(self::TABLE,$data);
      }
    public function updateData($id,$data)
      {
        $this->update(self::TABLE,$id,$data);
      }
    public function destroy($id){
        $this->delete(self::TABLE,$id);
    }

}
