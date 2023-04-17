<?php

class CustomerController extends BaseController{
    private $categoryModel;
    private $menuModel;
    private $customerModel;
    private $productModel;
    private $expositionModel;
    private $data;
    private $errors;

    public function __construct()
    {
       $this->LoadModel('MenuModel');
       $this->menuModel= new MenuModel;
       $this->LoadModel('CategoryModel');
       $this->categoryModel= new CategoryModel;
       $this->LoadModel('CustomerModel');
       $this->customerModel= new CustomerModel;
       $this->LoadModel('ProductModel');
       $this->productModel= new ProductModel;
       $this->LoadModel('ExpositionModel');
       $this->expositionModel= new ExpositionModel;
       $this->loadData();
    }
    
    public function register_view(){
        return $this->view('frontend.auth.register',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories']
        ]);
    }

    public function login_view(){

        return $this->view('frontend.auth.login',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories']
        ]);
    }

    public function register(){

        $request = new Request;
        if($request->isPost()){

          $request->rules([
           'txtName'=>'required',
           'txtAddress'=>'required',
           'txtNumberPhone'=>'required|min:10|max:11',
           'txtEmail'=>'required|email|unique:customers:email',
           'txtLogin'=>'required|min:6|max:30|unique:customers:username',
           'txtPass'=>'required|min:6|max:30'
          ]);

          $request->message([
           'txtName.required'=>'Ten cua ban khong duoc de trong',
           'txtAddress.required'=>'Dia chi khong duoc de trong',
           'txtNumberPhone.required'=>'So dien thoai khong duoc de trong',
           'txtNumberPhone.min'=>'So dien thoai chi duoc 10 hoac 11 ky tu',
           'txtNumberPhone.max'=>'So dien thoai chi duoc 10 hoac 11 ky tu',
           'txtEmail.required'=>'Email khong duoc de trong',
           'txtEmail.email'=>'Email phai dung dinh dang',
           'txtEmail.unique'=>'Email nay da ton tai trong he thong',
           'txtLogin.required'=>'Ten dang nhap khong duoc de trong',
           'txtLogin.min'=>'Ten dang nhap phai lon hon 6 ky tu',
           'txtLogin.max'=>'Ten dang nhap phai nho hon 30 ky tu',
           'txtLogin.unique'=>'Ten dang nhap da ton tai trong he thong',
           'txtPass.required'=>'Password khong duoc de trong',
           'txtPass.min'=>'Password phai lon hon 6 ky tu',
           'txtPass.max'=>'Password phai nho hon 30 ky tu',

          ]);
          if($request->validate()){

            $name=$_POST['txtName'];
            $address=$_POST['txtAddress'];
            $phone=$_POST['txtNumberPhone'];
            $username=$_POST['txtLogin'];
            $email=$_POST['txtEmail'];
            $password=$_POST['txtPass'];
            $cypt=md5($password);

            $data=[
                "name"=>$name,
                "username"=>$username,
                "password"=>$cypt,
                "email"=>$email,
                "address"=>$address,
                "phone"=>$phone
            ];

            $this->customerModel->createCustomer($data);
            echo '<script>alert("Đăng ký thành công");</script>';

            return $this->view('frontend.home.index',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories']
         ]);
           
          }
          else{

           $this->errors=$request->errors();
           $this->data['regisData']=$request->getFields();
           return $this->view('frontend.auth.register',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
              "errors"=>$this->errors,
              "regisData"=>$this->data['regisData']
           ]);

          }
        }
        
    }
    public function login(){

        $request = new Request;
        if($request->isPost()){

          $request->rules([
           'txtusername'=>'required|min:6|max:30',
           'txtpassword'=>'required|min:6|max:30'
          ]);

          $request->message([
           'txtusername.required'=>'Ten dang nhap khong duoc de trong',
           'txtusername.min'=>'Ten dang nhap phai lon hon 6 ky tu',
           'txtusername.max'=>'Ten dang nhap phai nho hon 30 ky tu',
           'txtpassword.required'=>'Password khong duoc de trong',
           'txtpassword.min'=>'Password phai lon hon 6 ky tu',
           'txtpassword.max'=>'Password phai nho hon 30 ky tu',
          ]);
          if($request->validate()){

            $username=$_POST['txtusername'];
            $password=$_POST['txtpassword'];
            $mahoa=md5($password);
            $log=$this->customerModel->getUserLogin($username,$mahoa);
            if($log==true)
            {
                $_SESSION['login_id']=$log['id'];
                echo '<script> alert("Đăng nhập thành công");</script>';
                return $this->view('frontend.home.index',[
                    "menus"=>$this->data['menus'],
                    "categories"=>$this->data['categories']
                 ]);
            }
            else{
                echo '<script> alert(" Đăng nhập không thành công");</script>';
                return $this->view('frontend.auth.login',[
                    "menus"=>$this->data['menus'],
                    "categories"=>$this->data['categories']
                 ]);
            }
           
          }
          else{

           $this->errors=$request->errors();
           $this->data['loginData']=$request->getFields();
           return $this->view('frontend.auth.login',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories'],
              "errors"=>$this->errors,
              "loginData"=>$this->data['loginData']
           ]);

          }
        }
        
    }
    public function logout(){
        if(isset($_SESSION['login_id'])){
            unset($_SESSION['login_id']);
            session_destroy();
            echo '<script> alert(" Đăng xuat thành công");</script>';
        }{
            echo '<script> alert("Xin loi ban chua dang nhap?");</script>';
        }

        return $this->view('frontend.auth.login',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories']
         ]);

    }
    public function comment(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // in_array($_POST['comment'],)
            if($_POST['comment']!="")
            {
            $date= new DateTime('now');
            $comment_date= $date->format('Y-m-d H:i:s');
            $dataComment=[
                "customer_id" =>$_SESSION['login_id'],
                "product_id"=>$_POST['txtproductid'],
                "date"=>$comment_date,
                "content"=>$_POST['comment']
            ];
            
            $this->expositionModel->store($dataComment);
            }
            
          }
          $product=$this->productModel->findById($_GET['id']);
          $comments=$this->productModel->getCommentById($_GET['id']);
          return $this->view('frontend.products.detailProduct',[
             "menus"=>$this->data['menus'],
             "categories"=>$this->data['categories'],
             "product"=>$product,
             "comments"=>$comments
          ]);
    }
     public function loadData(){
        $menus=$this->menuModel->getAll();
        $categories=$this->categoryModel->getAll(['*'],[],30);
        $this->data['menus']=$menus;
        $this->data['categories']=$categories;
     }
}
