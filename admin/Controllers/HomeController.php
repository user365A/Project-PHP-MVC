<?php
   class HomeController extends BaseController{

      private $userModel;

      public function __construct()
      {
         $this->LoadModel('UserModel');
         $this->userModel = new UserModel;
      }
      
      public function login(){
         if($_SERVER['REQUEST_METHOD']=='POST')
         {
             $username=$_POST['txtusername'];
             $password=$_POST['txtpassword'];
             $encode=md5($password);
             $log=$this->userModel->getAdminLogin($username,$encode);
             if($log==true)
             {
                 $_SESSION['admin_id']=$log['id'];
                 $_SESSION['admin_name']=$log['username'];
                 echo '<script> alert("Đăng nhập thành công");</script>';
                 return $this->view('backend.home.index');
             }
             else{
                 echo '<script> alert(" Đăng nhập không thành công");</script>';
                 return $this->view('backend.auth.login');
             }
         }
      }

      public function logout(){
         if(isset($_SESSION['admin_id'])){
             unset($_SESSION['admin_id']);
             unset($_SESSION['admin_name']);
             session_destroy();
             echo '<script> alert(" Đăng xuất thành công");</script>';
         }{
             echo '<script> alert("Xin loi ban chua dang nhap?");</script>';
         }
 
         return $this->view('backend.auth.login');
 
     }

      public function index(){
         if(isset($_SESSION['admin_id'])){
            return $this->view('backend.home.index',);
         }
         else{
            return $this->view('backend.auth.login',);
         }
         
      }
   }
?>