<?php 

class ProductVariationModel extends BaseModel{
    const TABLE= 'product_variation';

    public function findById($id){
        return $this->find(self::TABLE,$id);
      }

    public function getAllByProductId($id){
        $table=self::TABLE;
        $sql="select * from $table where product_id=$id";
        return $this->getByQuery_fetch($sql);
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

?>