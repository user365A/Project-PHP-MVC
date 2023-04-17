<?php
   class ProductController extends BaseController{

      private $categoryModel;
      private $productModel;
      private $menuModel;
      private $productVariationModel;
      private $data;
      private $errors;

      public function __construct()
      {

         $this->LoadModel('ProductModel');
         $this->productModel= new ProductModel;
         $this->LoadModel('MenuModel');
         $this->menuModel= new MenuModel;
         $this->LoadModel('CategoryModel');
         $this->categoryModel= new CategoryModel;
         $this->LoadModel('ProductVariationModel');
         $this->productVariationModel= new ProductVariationModel;
         $this->loadData();
      }
      public function index(){

         $selectColumns=['*'];
         $orders=['column'=>'id','order'=>'desc'];
         $limit=16;
         $products=$this->productModel->getAll($selectColumns,$orders,$limit);
         return $this->view('backend.products.index',[
            'products'=>$products
         ]);

      }

      public function showVariant(){
         if(isset($_GET['id'])){
            $id=$_GET['id'];
            $variations=$this->productVariationModel->getAllByProductId($id);
            return $this->view('backend.productvariation.index',[
               "variations"=>$variations,
               "product_id"=>$id
            ]);
         }
      }

      public function create(){
         return $this->view('backend.products.add',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
         ]);
      }
      public function store(){

            $request = new Request;
            $this->errors=[];

            if($request->isPost()){


            $request->rules([
               'name'=>'required|min:6|max:30',
               'price'=>'required',
               'category_id'=>'required',
               'menu_id'=>'required',
               'sale_off'=>'required',
               'des'=>'required'

            ]);

            $request->message([
                'name.required'=>'Ten san pham khong duoc de trong',
                'name.min'=>'Ten san pham it nhat phai 6 ky tu',
                'name.max'=>'Ten san pham nhieu nhat 30 ky tu',
                'price.required'=>'Gia san pham khong duoc de trong',
                'category_id.required'=>'Danh muc san pham khong duoc de trong',
                'menu_id.required'=>'Menu san pham khong duoc de trong',
                'sale_off.required'=>'Giam gia san pham khong duoc de trong',
                'des.required'=>'Mieu ta san pham khong duoc de trong',
            ]);

            if($request->validate()){

               $name=$_POST['name'];
               $price=$_POST['price'];
               $image=$_FILES['image']['name'];
               $category_id=$_POST['category_id'];
               $menu_id=$_POST['menu_id'];
               $sale_off=$_POST['sale_off'];
               $des=$_POST['des'];
               $data=[
                  'name'=>$name,
                  'price'=>$price,
                  'image'=>$image,
                  'category_id'=>$category_id,
                  'menu_id'=>$menu_id,
                  'sale_off'=>$sale_off,
                  'des'=>$des
               ];
               $this->productModel->store($data);
               uploadimg();  

               $this->index();
            }
            else{
               $this->errors=$request->errors();
               $this->data['addData']=$request->getFields();
               return $this->view('backend.products.add',[
                  "menus"=>$this->data['menus'],
                  "categories"=>$this->data['categories'],
                  "errors"=>$this->errors,
                  "addData"=>$this->data['addData']
               ]);
            }
            }

      }
      public function edit(){
         if(isset($_GET['id'])){
            $id=$_GET['id'];
            $product=$this->productModel->findById($id);

            return $this->view('backend.products.edit',[
               "menus"=>$this->data['menus'],
               "categories"=>$this->data['categories'],
               "product"=>$product
            ]);
         }
      }
      public function update(){

         $request = new Request;
         $this->errors=[];

         if($request->isPost()){


         $request->rules([
            'name'=>'required|min:6|max:30',
            'price'=>'required',
            'category_id'=>'required',
            'menu_id'=>'required',
            'sale_off'=>'required',
            'des'=>'required'

         ]);

         $request->message([
             'name.required'=>'Ten san pham khong duoc de trong',
             'name.min'=>'Ten san pham it nhat phai 6 ky tu',
             'name.max'=>'Ten san pham nhieu nhat 30 ky tu',
             'price.required'=>'Gia san pham khong duoc de trong',
             'category_id.required'=>'Danh muc san pham khong duoc de trong',
             'menu_id.required'=>'Menu san pham khong duoc de trong',
             'sale_off.required'=>'Giam gia san pham khong duoc de trong',
             'des.required'=>'Mieu ta san pham khong duoc de trong',
         ]);

         if($request->validate()){
            $id=$_GET['id'];
            $currentProduct=$this->productModel->findById($id); 
            $name=$_POST['name'];
            $price=$_POST['price'];
            $image=!empty($_FILES['image']['name'])?$_FILES['image']['name'] : $currentProduct['image'];
            $category_id=$_POST['category_id'];
            $menu_id=$_POST['menu_id'];
            $sale_off=$_POST['sale_off'];
            $des=$_POST['des'];
            $data=[
               'name'=>$name,
               'price'=>$price,
               'image'=>$image,
               'category_id'=>$category_id,
               'menu_id'=>$menu_id,
               'sale_off'=>$sale_off,
               'des'=>$des
            ];
            
            $this->productModel->updateData($id,$data);
            
            // echo $currentProduct;

               if($image!=$currentProduct['image']){
                  uploadimg();
                  if($currentProduct['image']){
                     unlink('../public/assets/image/'.$currentProduct['image']);
                  }
                  
               }

 
            $this->index();
         }else{
            $this->errors=$request->errors();
            $this->data['editData']=$request->getFields();
            return $this->view('backend.products.edit',[
               "menus"=>$this->data['menus'],
               "categories"=>$this->data['categories'],
               "errors"=>$this->errors,
               "editData"=>$this->data['editData']
            ]);
         }
         }
      }
      public function delete(){
         
         $id=$_GET['id'];
         $currentProduct=$this->productModel->findById($id);
         unlink('../public/assets/image/'.$currentProduct['image']);
         $this->productModel->destroy($id);
         $this->productVariationModel->destroy($id);
         $this->index();
      }

      public function loadData(){
         $menus=$this->menuModel->getAll();
         $categories=$this->categoryModel->getAll();
         $this->data['menus']=$menus;
         $this->data['categories']=$categories;

      }

   }
