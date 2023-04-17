<?php

class ExpositionModel extends BaseModel{
    const TABLE= 'exposition';
    
    public function store($data){
        $this->create(self::TABLE,$data);
    }

    public function updateData($id,$data)
    {
        $this->update(self::TABLE,$id,$data);
    }
    
    public function destroy($id){
        $this->delete($id,self::TABLE);
    }
}
    
?>