<?php

class CheckoutModel extends BaseModel{
    const TABLE= 'checkouts';

    public function getAll($select=['*'],$orderBys=[],$limit=''){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }
    public function findById($id){
        return $this->find(self::TABLE,$id);
      }
    public function getIdByData($data){
      $customer_id=$data['customer_id'];
      $order_date=$data['order_date'];
      $total=$data['total'];
      $table=self::TABLE;
      $sql="select id from $table where customer_id=$customer_id and order_date='$order_date' and total=$total";
      return $this->getId($sql);
      }

    public function getCheckout($checkout_id){
      $select="select b.id, a.name, a.address, a.phone, b.order_date, b.total from customers a 
      inner join checkouts b on a.id=b.customer_id where b.id=$checkout_id";
      return $this->getByQuery($select);
    }
    public function getDetailCheckout($checkout_id){
      $select="select a.name, a.price, b.color, b.size, b.quantity, b.total, a.image, a.des, a.sale_off
       from products a inner join detail_checkout b on a.id=b.product_id where b.checkout_id=$checkout_id";
       return $this->getByQuery_fetch($select);
    }

    public function store($data)
    {
      $this->create(self::TABLE,$data);
    }

}