<?php
   class MenuController extends BaseController{

      private $categoryModel;
      private $menuModel;
      private $errors;
      private $data;

      public function __construct()
      {
         $this->LoadModel('MenuModel');
         $this->menuModel= new MenuModel;
         $this->LoadModel('CategoryModel');
         $this->categoryModel= new CategoryModel;
      }
      public function index(){
         $selectColumns=['*'];
         $orders=['column'=>'id','order'=>'asc'];
         $menus=$this->menuModel->getAll($selectColumns,$orders);
         return $this->view('backend.menus.index',[
            'menus'=>$menus
         ]);

      }
      public function create(){
         return $this->view('backend.menus.add');
      }
      public function store(){

         $request = new Request;
         if($request->isPost()){

           $request->rules([
            'name'=>'required|min:6|max:30',
           ]);

           $request->message([
            'name.required'=>'Ten san pham khong duoc de trong',
            'name.min'=>'Ten san pham phai lon hon 6 ky tu',
            'name.max'=>'Ten san pham phai nho hon 30 ky tu',
           ]);
           if($request->validate()){

            $name=$_POST['name'];
            $data=[
               'name'=>$name,
            ];
            $this->menuModel->store($data);

            $this->index();
           }
           else{

            $this->errors=$request->errors();
            $this->data['addData']=$request->getFields();
            return $this->view('backend.menus.add',[
               "errors"=>$this->errors,
               "addData"=>$this->data['addData']
            ]);

           }
         }

      }
      public function edit(){
         if(isset($_GET['id'])){
            $id=$_GET['id'];
            $menu=$this->menuModel->findById($id);

            return $this->view('backend.menus.edit',[
               "menu"=>$menu,
            ]);
         }
      }
      public function update(){

            $request = new Request;
            if($request->isPost()){
   
              $request->rules([
               'name'=>'required|min:6|max:30',
              ]);
   
              $request->message([
               'name.required'=>'Ten san pham khong duoc de trong',
               'name.min'=>'Ten san pham phai lon hon 6 ky tu',
               'name.max'=>'Ten san pham phai nho hon 30 ky tu',
              ]);
              if($request->validate()){
   
               $id=$_GET['id'];
               $name=$_POST['name'];
               $data=[
                  'name'=>$name
               ];
            $this->menuModel->updateData($id,$data);

   
               $this->index();
              }
              else{
   
               $this->errors=$request->errors();
               $this->data['editData']=$request->getFields();
               return $this->view('backend.menus.edit',[
                  "errors"=>$this->errors,
                  "editData"=>$this->data['editData'],
               ]);
   
              }
            }
      }
      public function delete(){
         $id=$_GET['id'];
         $this->categoryModel->destroyAll($id);
         $this->menuModel->destroy($id);
         $this->index();
      }

   }
?>