<?php

class CustomerModel extends BaseModel{
    const TABLE= 'customers';

    public function createCustomer($data){
        $this->create(self::TABLE,$data);
    }

    public function updatecData($id,$data)
    {
        $this->update(self::TABLE,$id,$data);
    }
    
    public function getUserLogin($username,$password){
        $table=self::TABLE;
        $query="select * from $table where username='$username' and password='$password'";
        return $this->getByQuery($query);
      }

    public function destroy($id){
        $this->delete($id,self::TABLE);
    }
}
    
?>