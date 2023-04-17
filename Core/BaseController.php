<?php
   class BaseController{
 
    const VIEW_FOLDER_NAME="Views";
    const MODEL_FOLDER_NAME="Models";
      public function __construct()
      {
        session_start();
      }
      protected function view($Viewpath,array $data=[]){    
        
        foreach ($data as $key => $value) {
            $$key=$value;
        }
        require (self::VIEW_FOLDER_NAME.'/'. str_replace('.','/',$Viewpath).'.php');

      }
      protected function LoadModel($Modelpath){
        require (self::MODEL_FOLDER_NAME.'/'. str_replace('.','/',$Modelpath).'.php');
      }

   }
?>