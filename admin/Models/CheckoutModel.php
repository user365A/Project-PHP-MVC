<?php

class CheckoutModel extends BaseModel{
    const TABLE= 'checkouts';

    public function getAll($select=['*'],$orderBys=[],$limit=''){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }
    public function findById($id){
        return $this->find(self::TABLE,$id);
      }
    public function getDetailCheckout($checkout_id){
        $select="select a.name, a.price, b.color, b.size, b.quantity, b.total, a.image, a.des
         from products a inner join detail_checkout b on a.id=b.product_id where b.checkout_id=$checkout_id";
        return $this->getByQuery_fetch($select);
    }

    public function getCustomerInfo($checkout_id){
      $select="select a.name, a.email, a.address, a.phone  from customers a 
      inner join checkouts b on a.id=b.customer_id where b.id=$checkout_id";
      return $this->getByQuery($select);
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