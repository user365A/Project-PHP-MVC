<?php
   class CheckoutController extends BaseController{


      private $checkoutdetailModel;
      private $checkoutModel;

      public function __construct()
      {
         $this->LoadModel('CheckoutModel');
         $this->checkoutModel= new CheckoutModel;
         $this->LoadModel('DetailCheckoutModel');
         $this->checkoutdetailModel= new DetailCheckoutModel;
      }
      public function index(){
         $selectColumns=['*'];
         $orders=['column'=>'id','order'=>'asc'];
         $checkouts=$this->checkoutModel->getAll($selectColumns,$orders);
         return $this->view('backend.orders.index',[
            'orders'=>$checkouts
         ]);

      }

      public function showDetail(){

         if(isset($_GET['id']))
         {
            $order_id=$_GET['id'];
         }
         $detailCheckout=$this->checkoutModel->getDetailCheckout($order_id);
         $customerInfo=$this->checkoutModel->getCustomerInfo($order_id);
         return $this->view('backend.orders.detail',[
            'detailcheckout'=>$detailCheckout,
            'customerInfo'=>$customerInfo
         ]);

      }

      public function delete(){
         $id=$_GET['id'];
         $this->checkoutdetailModel->destroyAll($id);
         $this->checkoutModel->destroy($id);
         $this->index();
      }

   }
?>