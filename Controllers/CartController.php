<?php
   class CartController extends BaseController{
      
      private $productModel;
      private $categoryModel;
      private $menuModel;
      private $productVariationModel;
      private $data;

      public function __construct()
      {
         $this->LoadModel('ProductModel');
         $this->productModel=new ProductModel;
         $this->LoadModel('MenuModel');
         $this->menuModel= new MenuModel;
         $this->LoadModel('CategoryModel');
         $this->categoryModel= new CategoryModel;
         $this->LoadModel('ProductVariationModel');
         $this->productVariationModel= new ProductVariationModel;
         $this->loadData();
      }
      public function index(){
         
         return $this->view('frontend.cart.index',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
           ]);
      }

      public function store(){

         if($_SERVER['REQUEST_METHOD']=='POST')
         {
           $product_id=$_POST['product_id'];
           $color=$_POST['color'];
           $quantity=$_POST['quantity'];
           $size=$_POST['size'];
           $product=$this->productModel->findById($product_id);
           $_SESSION['totalCart']=0;

           //kiem tra bien the size va color con hang khong

           $quantityVariation=$this->productVariationModel->getQuantityVariation($size,$color,$product_id);
           if($quantityVariation[0]>0)
           {
            if(empty($_SESSION['cart']) || !array_key_exists($product_id,$_SESSION['cart']))
            {
               
               $product['product_id']=$product_id;
               $product['quantity']=$quantity;
               $product['color']=$color;
               $product['size']=$size;
               $product['total']=$product['quantity'] * ($product['price'] - $product['sale_off']);
               $_SESSION['cart'][$product_id]=$product;
            }
            else{
 
               $_SESSION['cart'][$product_id]['quantity']+=$quantity;
               $total= $_SESSION['cart'][$product_id]['quantity'] * ($_SESSION['cart'][$product_id]['price'] - $_SESSION['cart'][$product_id]['sale_off']);
               $_SESSION['cart'][$product_id]['total']=$total;
            }
 
            foreach($_SESSION['cart'] as $item){
                $_SESSION['totalCart']+=$item['total'];
            }

            return $this->view('frontend.cart.index',[
               "menus"=>$this->data['menus'],
               "categories"=>$this->data['categories'],
           ]);

           }
         
           $errormsg='This variant is out of stock, please choose color and size again.';
           $total_quantity=$this->productVariationModel->getTotalQuantity($product_id);
           $sizeProduct=$this->productVariationModel->getSizeById($product_id);
           $colorProduct=$this->productVariationModel->getColorById($product_id);
           $product=$this->productModel->findById($product_id);
           $comments=$this->productModel->getCommentById($product_id);
           return $this->view('frontend.products.detailProduct',[
              "menus"=>$this->data['menus'],
              "categories"=>$this->data['categories'],
              "product"=>$product,
              "comments"=>$comments,
              "colors"=>$colorProduct,
              "sizes"=>$sizeProduct,
              "total_quantity"=>$total_quantity[0],
              "message"=>$errormsg
           ]);
         }
      }
      public function update(){
         $newQuantity=$_POST['newqty'];

         foreach($newQuantity as $key=>$qty)
         {
           if($_SESSION['cart'][$key]['quantity']!=$qty)
           {
            if($qty<=0)
            {
              unset($_SESSION['cart'][$key]);
            }
            else 
            {
             $_SESSION['cart'][$key]['quantity']=$qty;
             $totalNew= $_SESSION['cart'][$key]['quantity'] * ($_SESSION['cart'][$key]['price'] - $_SESSION['cart'][$key]['sale_off']);
             $_SESSION['cart'][$key]['total']=$totalNew;

            }
           }
         }
         $this->TotalCart();
         return $this->view('frontend.cart.index',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
           ]);
      }
      public function delete(){
         if(isset($_GET['id']))
         {
           $product_id=$_GET['id'];
           unset($_SESSION['cart'][$product_id]);
           $this->TotalCart();
           return $this->view('frontend.cart.index',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
           ]);
         }
      }

      public function loadData(){
         $menus=$this->menuModel->getAll();
         $categories=$this->categoryModel->getAll(['*'],[],30);
         $this->data['menus']=$menus;
         $this->data['categories']=$categories;
      }
      public function TotalCart(){
         $_SESSION['totalCart']=0;
         foreach($_SESSION['cart'] as $item){
          $_SESSION['totalCart']+=$item['total'];
         }
      }
   }
?>