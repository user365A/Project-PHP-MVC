<?php
   class ProductController extends BaseController{

      private $categoryModel;
      private $productModel;
      private $menuModel;
      private $productVariationModel;
      private $data;

      public function __construct()
      {
         $this->LoadModel('MenuModel');
         $this->menuModel= new MenuModel;
         $this->LoadModel('ProductModel');
         $this->productModel= new ProductModel;
         $this->LoadModel('CategoryModel');
         $this->categoryModel= new CategoryModel;
         $this->LoadModel('ProductVariationModel');
         $this->productVariationModel= new ProductVariationModel;
         $this->loadData();
      }
      public function index(){
         // ['id,name,price'],['column'=>'id','order'=>'desc']
         $selectColumns=['*'];
         $orders=['column'=>'id','order'=>'desc'];
         $products=$this->productModel->getAll($selectColumns,$orders);
         return $this->view('frontend.products.index',[
            'products'=>$products
         ]);

      }

      public function show(){

         $limit=8;
         $startProduct = 0;
         $pages=0;
         $currentPage=0;
         $allProducts=null;

         if(isset($_GET['page'])){
            
            $currentPage = $_GET['page'];
            
            $startProduct= $currentPage*8;
            
         }

         if(isset($_GET['menuId'])){
            $id=$_GET['menuId'];
            if(isset($_GET['order'])&&isset($_GET['sortBy'])){
               $products=$this->productModel->getByMenuId($id,['column'=>$_GET['sortBy'],'order'=>$_GET['order']],$startProduct,$limit);
               
            }
            else{

               $products=$this->productModel->getByMenuId($id,[],$startProduct,$limit);        
            }

            $allProducts=$this->productModel->getByMenuId($id,[],'','');
            $pages=ceil(count($allProducts)/$limit);

            return $this->view('frontend.products.productsCategory',[
             "menus"=>$this->data['menus'],
             "categories"=>$this->data['categories'],
             "products"=>$products,
             "pages"=>$pages,
             "currentPage"=>$currentPage
          ]);
         }
         $products=$this->productModel->getAll(['*'],['column'=>'id','order'=>'desc'],$startProduct,$limit);
         $allProducts=$this->productModel->getAll(['*'],['column'=>'id','order'=>'desc']);
         $pages=ceil(count($allProducts)/$limit);

         return $this->view('frontend.products.productsCategory',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
            "products"=>$products,
            "pages"=>$pages,
            "currentPage"=>$currentPage
         ]);

      }
      public function showPromotion(){
         $limit=8;
         $startProduct = 0;
         $currentPage=0;
         $allProducts=$this->productModel->getPromotion('',$limit);
         $pages=ceil(count($allProducts)/$limit);
         if(isset($_GET['page'])){
            
            $currentPage = $_GET['page'];
            
            $startProduct= $currentPage*8;
            
         }
         $products=$this->productModel->getPromotion($startProduct,$limit);

         return $this->view('frontend.products.productsCategory',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
            "products"=>$products,
            "pages"=>$pages,
            "currentPage"=>$currentPage
         ]);
      }
      public function showDetailProduct(){
         if(isset($_GET['id'])){
            $id=$_GET['id'];

            $total_quantity=$this->productVariationModel->getTotalQuantity($id);
            $sizeProduct=$this->productVariationModel->getSizeById($id);
            $colorProduct=$this->productVariationModel->getColorById($id);
            $product=$this->productModel->findById($id);
            $comments=$this->productModel->getCommentById($id);
            return $this->view('frontend.products.detailProduct',[
               "menus"=>$this->data['menus'],
               "categories"=>$this->data['categories'],
               "product"=>$product,
               "comments"=>$comments,
               "colors"=>$colorProduct,
               "sizes"=>$sizeProduct,
               "total_quantity"=>$total_quantity[0]
               
            ]);
         }

      }
      public function search(){

         if($_SERVER['REQUEST_METHOD']=='POST')
         {
            if($_POST['searchtext']!=''){
               $searchText=$_POST['searchtext'];
               $products=$this->productModel->getByName($searchText);
            
               return $this->view('frontend.products.productsCategory',[
                  "menus"=>$this->data['menus'],
                  "categories"=>$this->data['categories'],
                  "products"=>$products,
               ]);
            }
            return $this->view('frontend.home.index',[
               "menus"=>$this->data['menus'],
               "categories"=>$this->data['categories'],
            ]);
         }

      }
      public function store(){
         $data=[
            'name'=>'sua bo',
            'price'=>'20000',
            'image'=>'suabo.jpg',
            'category_id'=>3
         ];
         $this->productModel->store($data);
      }
      public function update(){
         $id=$_GET['id'];
         $data=[
            'name'=>'sua dau nanh',
            'price'=>'15000',
            'image'=>'suadaunanh.jpg',
            'category_id'=>3
         ];
         $this->productModel->updateData($id,$data);
      }
      public function delete(){
         $id=$_GET['id'];
         $this->productModel->destroy($id);
      }

      public function loadData(){
         $menus=$this->menuModel->getAll();
         $categories=$this->categoryModel->getAll(['*'],[],30);
         $this->data['menus']=$menus;
         $this->data['categories']=$categories;
      }
   }
?>