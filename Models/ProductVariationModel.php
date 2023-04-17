<?php 

class ProductVariationModel extends BaseModel{
    const TABLE= 'product_variation';

    public function getAll($select=['*'],$orderBys=[],$limit=""){
        return $this->all(self::TABLE,$select,$orderBys,$limit);
    }

    public function getSizeById($product_id){
        $table=self::TABLE;
        $select="select DISTINCT size from $table where product_id=$product_id";
         return $this->getByQuery_fetch($select);
    }

    public function getColorById($product_id){
        $table=self::TABLE;
        $select="select DISTINCT color from $table where product_id=$product_id";
         return $this->getByQuery_fetch($select);
    }

    public function getTotalQuantity($product_id){
        $table=self::TABLE;
        $select="select sum(quantity)  from $table where product_id=$product_id";
         return $this->getByQuery($select);
    }

    public function getQuantityVariation($size,$color,$product_id){
        $table=self::TABLE;
        $select="select quantity from $table where product_id=$product_id and size='$size' and color='$color'";
         return $this->getByQuery($select);
    }
  
}

?>