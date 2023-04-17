<?php
   class Request{

    private $__rules=[], $__message=[], $__errors=[], $db;

    function __construct()
    {
      $this->db=new Database;
      
    }
    public function getMethod(){
      return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost(){
      if($this->getMethod()=='post')
      {
         return true;
      }
      return false;
    }

    public function isGet(){
      if($this->getMethod()=='get')
      {
         return true;
      }
      return false;
    }

    public function getFields(){

      $dataFields=[];

      if($this->isGet()){
         if(!empty($_GET)){
            foreach($_GET as $key=>$value){
               if(is_array($value)){
                  $dataFields[$key]=filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
               }else{
                  $dataFields[$key]=filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
               }
            }
         }

      }

      if($this->isPost()){
         if(!empty($_POST)){
            foreach( $_POST as $key=>$value){
               if(is_array($value)){
                  $dataFields[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
               }
               else{
                  $dataFields[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
               }
            }
         }
      }

      return $dataFields;
    }

    public function rules($rules=[]){
       $this->__rules = $rules;
    }

    public function message($message=[]){
       $this->__message=$message;
    }

    public function validate(){
       $this->__rules=array_filter($this->__rules);

       $checkValidate=true;

       if(!empty($this->__rules)){

         $dataField=$this->getFields();

         foreach($this->__rules as $fieldName=>$rule){

            $ruleArray=explode('|',$rule);

            $ruleName=null;
            $ruleValue=null;
            foreach($ruleArray as $ruleItem){
               $rulesItemArr=explode(':',$ruleItem);

               $ruleName=reset($rulesItemArr);
               if(count($rulesItemArr)>1){
                  $ruleValue=end($rulesItemArr);
               }

               if($ruleName=='required'){
                  if(empty(trim($dataField[$fieldName]))){
                     $this->setErrors($fieldName,$ruleName);
                     $checkValidate=false;
                  }
               }

               if($ruleName=='min'){
                  if(strlen(trim($dataField[$fieldName]))<$ruleValue){
                     $this->setErrors($fieldName,$ruleName);
                     $checkValidate=false;
                  }
               }

               if($ruleName=='max'){
                  if(strlen(trim($dataField[$fieldName]))>$ruleValue){
                     $this->setErrors($fieldName,$ruleName);
                     $checkValidate=false;
                  }
               }

               if($ruleName=='email'){
                  if(!filter_var($dataField[$fieldName],FILTER_VALIDATE_EMAIL)){
                     $this->setErrors($fieldName,$ruleName);
                     $checkValidate=false;
                  }
               }

               if($ruleName=='match'){
                  if(trim($dataField[$fieldName])!=trim($dataField[$fieldName][$ruleValue])){
                     $this->setErrors($fieldName,$ruleName);
                     $checkValidate=false;
                  }
               }

               if($ruleName=='unique'){
                  $tableName=null;
                  $columnName=null;
                  if(!empty($rulesItemArr[1]))
                  {
                     $tableName=$rulesItemArr[1];
                  }
                  if(!empty($rulesItemArr[2]))
                  {
                     $columnName=$rulesItemArr[2];

                  }

                  if(!empty($tableName)&&!empty($columnName)){

                     if(count($rulesItemArr)==3)
                     {
                        $checkExist=$this->db->connect()->query("select $columnName from $tableName where $columnName='$dataField[$fieldName]'")->rowCount();
                     }
                     else if(count($rulesItemArr)==4){
                        if(!empty($rulesItemArr[3]) && preg_match('~.+?\=.+?~is',$rulesItemArr[3])){
                           $conditionWhere=$rulesItemArr[3];
                           $conditionWhere=str_replace('=','<>',$conditionWhere);
                           $checkExist=$this->db->connect()->query("select $columnName from $tableName where $conditionWhere and $columnName='$dataField[$fieldName]'")->rowCount();
                        }
                        
                     }
                     
                     if(!empty($checkExist)){
                        $this->setErrors($fieldName,$ruleName);
                        $checkValidate=false;
                     }
                  }
               }
            }
         }
       }

       return $checkValidate;
    }

   //  get error 
    public function errors($fieldName=''){
       if(!empty($this->__errors)){
         if(empty($fieldName))
         {
            $errorsArr=[];
            foreach($this->__errors as $key=>$error ){
               $errorsArr[$key]= reset($error);
            }
            return $errorsArr;
         }
         return reset($this->__errors[$fieldName]);
       }
       return false;
    }

   // set error
   public function setErrors($fieldName,$ruleName){
      $this->__errors[$fieldName][$ruleName] = $this->__message[$fieldName.'.'.$ruleName];
   }

   }
?>