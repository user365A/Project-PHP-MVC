<?php

class CustomerModel extends BaseModel{
    const TABLE= 'customers';

    public function createCustomer($data){
        $this->create(self::TABLE,$data);
    }
    
    public function getUserLogin($username,$password){
        $table=self::TABLE;
        $query="select * from $table where username='$username' and password='$password'";
        return $this->getByQuery($query);
      }

}
    
?>