<?php

class Database{

    const DB_NAME='mysql:host=localhost;dbname=shopdb';
    const USERNAME='root';
    const PASSWORD='';

    public function connect()
    {
      $connect=new PDO(self::DB_NAME,self::USERNAME,self::PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));  
      return $connect;
    }

}

?>