<?php
   class VariantController extends BaseController{

      private $variationModel;
      private $errors;
      private $data;

      public function __construct()
      {

         $this->LoadModel('ProductVariationModel');
         $this->variationModel= new ProductVariationModel;

      }

      public function create(){
         if(isset($_GET['product_id'])){
            $product_id=$_GET['product_id'];
         }
         return $this->view('backend.productvariation.add',[
            'product_id'=>$product_id
         ]);
      }
      public function store(){

         $request = new Request;
         if($request->isPost()){

           $request->rules([
            'size'=>'required',
            'color'=>'required',
            'quantity'=>'required'
           ]);

           $request->message([
            'size.required'=>'Size san pham khong duoc de trong',
            'color.required'=>'Mau san pham khong duoc de trong',
            'quantity.required'=>'So luong san pham khong duoc de trong',
           ]);

           $product_id=$_POST['product_id'];
           if($request->validate()){

            $size=$_POST['size'];
            $color=$_POST['color'];
            $quantity=$_POST['quantity'];

            $variations=$this->variationModel->getAllByProductId($product_id);
            $checkSizeColor=true;

            foreach($variations as $variation){
               if($size==$variation['size'] && $color==$variation['color'])
               {
                  $checkSizeColor=false;
               }
            }

            if($checkSizeColor){

               $data=[
                  'product_id'=>$product_id,
                  'size'=>$size,
                  'color'=>$color,
                  'quantity'=>$quantity
               ];
               $this->variationModel->store($data);
   
               $variations=$this->variationModel->getAllByProductId($product_id);
               return $this->view('backend.productvariation.index',[
                  "variations"=>$variations,
                  "product_id"=>$product_id
               ]);

            }
            else{
               $this->data['addData']=$request->getFields();
               return $this->view('backend.productvariation.add',[
                  "errorSizeColor"=>"Bien the ($size,$color) cua san pham nay da ton tai trong he thong. Vui long nhap gia tri khac!",
                  "addData"=>$this->data['addData'],
                  "product_id"=>$product_id
               ]);
            }

           }
           else{

            $this->errors=$request->errors();
            $this->data['addData']=$request->getFields();
            return $this->view('backend.productvariation.add',[
               "errors"=>$this->errors,
               "addData"=>$this->data['addData'],
               "product_id"=>$product_id
            ]);

           }
         }

      }
      public function edit(){
         if(isset($_GET['id'])){
            $id=$_GET['id'];
            $variation=$this->variationModel->findById($id);

            return $this->view('backend.productvariation.edit',[
               "variation"=>$variation
            ]);
         }
      }
      public function update(){

         $request = new Request;
         if($request->isPost()){

           $request->rules([
            'size'=>'required',
            'color'=>'required',
            'quantity'=>'required'
           ]);

           $request->message([
            'size.required'=>'Size san pham khong duoc de trong',
            'color.required'=>'Mau san pham khong duoc de trong',
            'quantity.required'=>'So luong san pham khong duoc de trong',
           ]);
           $product_id=$_POST['product_id'];
           if($request->validate()){

            $id=$_GET['id'];
            $size=$_POST['size'];
            $color=$_POST['color'];
            $quantity=$_POST['quantity'];
            $data=[
               'product_id'=>$product_id,
               'size'=>$size,
               'color'=>$color,
               'quantity'=>$quantity
            ];
            $this->variationModel->updateData($id,$data);

            $variations=$this->variationModel->getAllByProductId($product_id);
            return $this->view('backend.productvariation.index',[
               "variations"=>$variations,
               "product_id"=>$product_id
            ]);

           }
           else{

            $this->errors=$request->errors();
            $this->data['editData']=$request->getFields();
            return $this->view('backend.productvariation.edit',[
               "errors"=>$this->errors,
               "editData"=>$this->data['editData'],
               "product_id"=>$product_id
            ]);

           }
         }
      }
      public function delete(){
         $id=$_GET['id'];
         $variation=$this->variationModel->findById($id);
         $this->variationModel->destroy($id);
         $variations=$this->variationModel->getAllByProductId($variation['product_id']);
         return $this->view('backend.productvariation.index',[
            "variations"=>$variations
         ]);
      }


   }
?>