<?php
   class CheckoutController extends BaseController{

      private $categoryModel;
      private $menuModel;
      private $checkoutModel;
      private $detailcheckoutModel;
      private $data;

      public function __construct()
      {
         $this->LoadModel('CheckoutModel');
         $this->checkoutModel=new CheckoutModel;
         $this->LoadModel('DetailCheckoutModel');
         $this->detailcheckoutModel=new DetailCheckoutModel;
         $this->LoadModel('MenuModel');
         $this->menuModel= new MenuModel;
         $this->LoadModel('CategoryModel');
         $this->categoryModel= new CategoryModel;
         $this->loadData();
      }
      public function index(){
         return $this->view('frontend.payment.index',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
         ]);
      }

      public function store(){
         
         if(isset($_SESSION['cart'])){
            // Them vao bang checkouts don hang vua duoc dat
            $date=new DateTime("now");
            $orderDate=$date->format('Y-m-d H:i:s');
            $dataCheckout=[
                "customer_id"=>$_SESSION['login_id'],
                "order_date"=>$orderDate,
                "total"=>$_SESSION['totalCart'],
                "status"=>"order"
            ];
            $this->checkoutModel->store($dataCheckout);
            $checkout_id=$this->checkoutModel->getIdByData($dataCheckout);

            // // Them vao bang detail_checkout chi tiet cua don hang vua dat
            foreach($_SESSION['cart'] as $key=>$item)
            {

               $dataDetailCheckout=[
                  'checkout_id'=>$checkout_id,
                  'product_id'=>$item['product_id'],
                  'quantity'=>$item['quantity'],
                  'color'=>$item['color'],
                  'size'=>$item['size'],
                  'total'=>($item['price'] - $item['sale_off']) * $item['quantity'],
               ];
               $this->detailcheckoutModel->store($dataDetailCheckout);
            }
            // Lay ra thong tin cho trang web
            $customer_info = $this->checkoutModel->getCheckout($checkout_id); 
            $order_info = $this->checkoutModel->getDetailCheckout($checkout_id);
         }
         // Sau khi cap nhat 2 bang checkouts va detail_checkout thi xóa đi giỏ hàng đã đặt
         unset($_SESSION['cart']);
         unset($_SESSION['totalCart']);

         return $this->view('frontend.payment.index',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
            "customer_info"=>$customer_info,
            "order_info"=>$order_info
         ]);
      }
      public function update(){

      }
      public function delete(){

      }

      public function loadData(){
         $menus=$this->menuModel->getAll();
         $categories=$this->categoryModel->getAll(['*'],[],30);
         $this->data['menus']=$menus;
         $this->data['categories']=$categories;
      }
   }
?>