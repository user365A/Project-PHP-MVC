<?php
   class UserController extends BaseController{

      private $userModel;
      private $errors;
      private $data;

      public function __construct()
      {
         $this->LoadModel('UserModel');
         $this->userModel= new UserModel;
      }
      public function index(){
         $selectColumns=['*'];
         $orders=['column'=>'id','order'=>'asc'];
         $users=$this->userModel->getAll($selectColumns,$orders);
         return $this->view('backend.users.index',[
            "users"=>$users
         ]);

      }
      public function create(){
         return $this->view('backend.users.add');
      }
      public function store(){

         $request = new Request;
         if($request->isPost()){

           $request->rules([
            'name'=>'required|min:6|max:50',
            'username'=>'required|min:6|max:30|unique:users:username',
            'password'=>'required|min:6|max:30',
            'email'=>'required|email|unique:users:email',
            'address'=>'required',
            'phone'=>'required|min:10|:max:11'
           ]);

           $request->message([
            'name.required'=>'Ten nhan vien khong duoc de trong',
            'name.min'=>'Ten nhan vien phai lon hon 6 ky tu',
            'name.max'=>'Ten nhan vien phai nho hon 30 ky tu',
            'username.required'=>'Ten dang nhap  khong duoc de trong',
            'username.min'=>'Ten dang nhap phai lon hon 6 ky tu',
            'username.max'=>'Ten dang nhap phai nho hon 30 ky tu',
            'username.unique'=>'Ten dang nhap da ton tai trong he thong',
            'password.required'=>'Password khong duoc de trong',
            'password.min'=>'Password phai lon hon 6 ky tu',
            'password.max'=>'Password phai nho hon 30 ky tu',
            'email.required'=>'Email khong duoc de trong',
            'email.email'=>'Email phai dung dinh dang',
            'email.unique'=>'Email nay da ton tai trong he thong',
            'address.required'=>'Dia chi nhan vien khong duoc de trong',
            'phone.required'=>'So dien thoai khong duoc de trong',
            'phone.min'=>'So dien thoai it nhat phai 10 ky tu',
            'phone.max'=>'So dien thoai nhieu nhat la 11 ky tu',
           ]);
           if($request->validate()){

            $name=$_POST['name'];
            $username=$_POST['username'];
            $password=md5($_POST['password']);
            $email=$_POST['email'];
            $address=$_POST['address'];
            $phone=$_POST['phone'];
            $data=[
               'name'=>$name,
               'username'=>$username,
               'password'=>$password,
               'email'=>$email,
               'address'=>$address,
               'phone'=>$phone,
            ];
            $this->userModel->store($data);

            $this->index();
           }
           else{

            $this->errors=$request->errors();
            $this->data['addData']=$request->getFields();
            return $this->view('backend.users.add',[
               "errors"=>$this->errors,
               "addData"=>$this->data['addData']
            ]);

           }
         }

      }
      public function edit(){
         if(isset($_GET['id'])){
            $id=$_GET['id'];
            $user=$this->userModel->findById($id);
            return $this->view('backend.users.edit',[
               "user"=>$user,
            ]);
         }
      }
      public function update(){

            $id=$_GET['id'];
            $request = new Request;
            if($request->isPost()){
   
               $request->rules([
                  'name'=>'required|min:6|max:50',
                  'username'=>'required|min:6|max:30|unique:users:username:id='.$id,
                  'password'=>'required|min:6|max:30',
                  'email'=>'required|email|unique:users:email:id='.$id,
                  'address'=>'required',
                  'phone'=>'required|min:10:|max:11'
                 ]);
      
                 $request->message([
                  'name.required'=>'Ten nhan vien khong duoc de trong',
                  'name.min'=>'Ten nhan vien phai lon hon 6 ky tu',
                  'name.max'=>'Ten nhan vien phai nho hon 30 ky tu',
                  'username.required'=>'Ten dang nhap  khong duoc de trong',
                  'username.min'=>'Ten dang nhap phai lon hon 6 ky tu',
                  'username.max'=>'Ten dang nhap phai nho hon 30 ky tu',
                  'username.unique'=>'Ten dang nhap da ton tai trong he thong',
                  'password.required'=>'Password khong duoc de trong',
                  'password.min'=>'Password phai lon hon 6 ky tu',
                  'password.max'=>'Password phai nho hon 30 ky tu',
                  'email.required'=>'Email khong duoc de trong',
                  'email.email'=>'Email phai dung dinh dang',
                  'email.unique'=>'Email nay da ton tai trong he thong',
                  'address.required'=>'Dia chi nhan vien khong duoc de trong',
                  'phone.required'=>'So dien thoai khong duoc de trong',
                  'phone.min'=>'So dien thoai chi duoc 10 hoac 11 ky tu',
                  'phone.max'=>'So dien thoai chi duoc 10 hoac 11 ky tu',
                 ]);
              if($request->validate()){
   
               
               $name=$_POST['name'];
               $username=$_POST['username'];
               $password=md5($_POST['password']);
               $email=$_POST['email'];
               $address=$_POST['address'];
               $phone=$_POST['phone'];
               $data=[
                  'name'=>$name,
                  'username'=>$username,
                  'password'=>$password,
                  'email'=>$email,
                  'address'=>$address,
                  'phone'=>$phone,
               ];
            $this->userModel->updateData($id,$data);

   
               $this->index();
              }
              else{
   
               $this->errors=$request->errors();
               $this->data['editData']=$request->getFields();
               return $this->view('backend.users.edit',[
                  "errors"=>$this->errors,
                  "editData"=>$this->data['editData'],
               ]);
   
              }
            }
      }
      public function delete(){
         $id=$_GET['id'];
         $this->userModel->destroy($id);
         $this->index();
      }

   }
?>