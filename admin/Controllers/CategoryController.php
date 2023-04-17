<?php
   class CategoryController extends BaseController{

      private $categoryModel;
      private $menuModel;
      private $data;
      private $errors;
      public function __construct()
      {
         $this->LoadModel('MenuModel');
         $this->menuModel= new MenuModel;
         $this->LoadModel('CategoryModel');
         $this->categoryModel= new CategoryModel;
         $this->loadData();
      }
      public function index(){

         $selectColumns=['*'];
         $orders=['column'=>'id','order'=>'asc'];
         $limit=16;
         $categories=$this->categoryModel->getAll($selectColumns,$orders,$limit);
         return $this->view('backend.categories.index',[
            'categories'=>$categories
         ]);

      }
      public function create(){
         return $this->view('backend.categories.add',[
            "menus"=>$this->data['menus'],
         ]);
      }
      public function store(){

         $request = new Request;
         if($request->isPost()){

           $request->rules([
            'name'=>'required|min:6|max:30',
            'menu_id'=>'required'
           ]);

           $request->message([
            'name.required'=>'Ten san pham khong duoc de trong',
            'name.min'=>'Ten san pham phai lon hon 6 ky tu',
            'name.max'=>'Ten san pham phai nho hon 30 ky tu',
            'menu_id.required'=>'Ten san pham khong duoc de trong',
           ]);
           if($request->validate()){

            $name=$_POST['name'];
            $menu_id=$_POST['menu_id'];
            $data=[
               'name'=>$name,
               'menu_id'=>$menu_id
            ];
            $this->categoryModel->store($data);

            $this->index();
           }
           else{

            $this->errors=$request->errors();
            $this->data['addData']=$request->getFields();
            return $this->view('backend.categories.add',[
               "errors"=>$this->errors,
               "addData"=>$this->data['addData']
            ]);

           }
         }

      }
      public function edit(){
         if(isset($_GET['id'])){
            $id=$_GET['id'];
            $category=$this->categoryModel->findById($id);

            return $this->view('backend.categories.edit',[
               "menus"=>$this->data['menus'],
               "category"=>$category
            ]);
         }
      }
      public function update(){

         $request = new Request;
         if($request->isPost()){

           $request->rules([
            'name'=>'required|min:6|max:30',
            'menu_id'=>'required'
           ]);

           $request->message([
            'name.required'=>'Ten san pham khong duoc de trong',
            'name.min'=>'Ten san pham phai lon hon 6 ky tu',
            'name.max'=>'Ten san pham phai nho hon 30 ky tu',
            'menu_id.required'=>'Ten menu khong duoc de trong',
           ]);
           if($request->validate()){

            $id=$_GET['id'];
            $name=$_POST['name'];
            $menu_id=$_POST['menu_id'];
            $data=[
               'name'=>$name,
               'menu_id'=>$menu_id
            ];
            $this->categoryModel->updateData($id,$data);

            $this->index();
           }
           else{

            $this->errors=$request->errors();
            $this->data['editData']=$request->getFields();
            return $this->view('backend.categories.edit',[
               "menus"=>$this->data['menus'],
               "errors"=>$this->errors,
               "editData"=>$this->data['editData']
            ]);

           }
         }

      }
      public function delete(){
         $id=$_GET['id'];
         $this->categoryModel->destroy($id);
         $this->index();
      }

      public function loadData(){

         $menus=$this->menuModel->getAll();
         $this->data['menus']=$menus;
         
      }

   }
?>