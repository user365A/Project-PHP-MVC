<?php 

class BaseModel extends Database{
    protected $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }
 
    public function all($table,$select=['*'],$orderBys=[],$limit){
       
       $columns=implode(',',$select);
       $orderByString=implode(' ',$orderBys);
       if($orderByString && $limit){
        $sql="select $columns from $table order by $orderByString limit $limit";
       }
       else if(!$orderByString && $limit){
        $sql="select $columns from $table limit $limit";
       }
       else if($orderByString && !$limit){
        $sql="select $columns from $table order by $orderByString";
       }
       else{
        $sql="select $columns from $table";
       }
       
       $results=$this->_query($sql);
       $data=[];
       while($row=$results->fetch()){
          array_push($data,$row);
       }
       return $data;
    }
    public function find($table,$id){
        $sql="select * from $table where id=$id limit 1";
        $query=$this->_query($sql);
        return $query->fetch();
    }
    public function getId($sql){
        $query=$this->_query($sql); 
        $result=$query->fetch();
        return $result['id'];
    }
    public function getByQuery($sql){
        $results=$this->_query($sql);
        return $results->fetch();
    }
    public function getByQuery_fetch($sql){

        $results=$this->_query($sql);
        $data=[];
        while($row=$results->fetch()){
           array_push($data,$row);
        }
        return $data;
    }
    public function create($table,$data=[]){
        $columns=implode(',',array_keys($data)) ;
        $newValues=array_map(function($value){
              return "'".$value."'";
        },array_values($data));
        $values=implode(',',$newValues);

        if($table=="detail_checkout"){
            $sql = "insert into $table($columns) values($values)";
        }
        else{
            $sql = "insert into $table(id,$columns) values(null,$values)";
        }

        $this->_query($sql);
    }
    public function update($table,$id,$data=[]){
        $dataSets=[];
        foreach ($data as $key => $value) {
            array_push($dataSets,"$key='".$value."'");
        }
        $dataSetsString=implode(',',$dataSets);
        $sql="update $table set $dataSetsString where id=$id";
        $this->_query($sql);
    }

    public function delete($table,$id){
        $sql="delete from $table where id=$id";
        $this->_query($sql);
    }

    public function handleByQuery($sql){
        $this->_query($sql);
    }

    private function _query($sql){
        return $this->connect->query($sql);
    }

}

?>