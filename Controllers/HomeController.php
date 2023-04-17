<?php
   class HomeController extends BaseController{
      private $categoryModel;
      private $productModel;
      private $menuModel;
      private $data;

      public function __construct()
      {
         $this->LoadModel('MenuModel');
         $this->menuModel= new MenuModel;
         $this->LoadModel('ProductModel');
         $this->productModel= new ProductModel;
         $this->LoadModel('CategoryModel');
         $this->categoryModel= new CategoryModel;
         $this->loadData();
      }
      public function loadData(){
         $menus=$this->menuModel->getAll();
         $categories=$this->categoryModel->getAll(['*'],[],30);
         $this->data['menus']=$menus;
         $this->data['categories']=$categories;
      }
      public function index(){
         $data=$this->loadData();
         return $this->view('frontend.home.index',[
            "menus"=>$this->data['menus'],
            "categories"=>$this->data['categories']
         ]);
      }
   }
?>