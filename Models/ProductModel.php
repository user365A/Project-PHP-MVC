<?php 

class ProductModel extends BaseModel{
    const TABLE= 'products';

    public function getAll($select=['*'],$orderBys=[],$start='',$limit=""){
        $table=self::TABLE;
        $orderByString=implode(' ',$orderBys);
        if($start!=''&& $orderByString)
        {
            $sql=" select * from $table order by $orderByString limit $start,$limit";
            return $this->getByQuery_fetch($sql);
        }
        return $this->all($table,$select,$orderBys,$limit);
    }
    public function findById($id){
        return $this->find(self::TABLE,$id);
    }
    public function getCommentById($id){
        $query = "select a.name, b.content from customers a 
        inner join exposition b on a.id=b.customer_id where b.product_id=$id";
        return $this->getByQuery_fetch($query);
    }
    public function getByCategoryId($categoryId){
        $table=self::TABLE;
        $sql=" select * from $table where category_id=$categoryId limit 8";
        return $this->getByQuery_fetch($sql);
    }
    public function getByName($searchText){
        $table=self::TABLE;
        $sql=" select * from $table where name like '%$searchText%' limit 20";
        return $this->getByQuery_fetch($sql);
    }
    public function getPromotion($start='',$limit=''){
        $table=self::TABLE;
        if($start!='' && $limit!=''){
            $sql=" select * from $table where sale_off > 0 limit $start,$limit";
        }
        else {
            $sql=" select * from $table where sale_off > 0 ";
        }
        return $this->getByQuery_fetch($sql);
    }
    public function getByMenuId($menuId,$orderBys=[],$start='',$limit=''){

        $table=self::TABLE;
        $orderByString=implode(' ',$orderBys);
        if($orderByString && $start!='' && $limit!=''){
            $sql=" select * from $table where menu_id=$menuId order by $orderByString limit $start,$limit";
        }
        else if(!$orderByString && $start!='' && $limit!=''){
            $sql=" select * from $table where menu_id=$menuId limit $start,$limit";
        }
        else if(!$orderByString && $start=='' && $limit!='') {
            $sql=" select * from $table where menu_id=$menuId  limit $limit";
        }
        else {
            $sql=" select * from $table where menu_id=$menuId";
        }
        
        return $this->getByQuery_fetch($sql);
    }

    public function updateQuantityInventory(){
        
    }

}

?>