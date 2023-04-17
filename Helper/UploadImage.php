
<?php

     function uploadimg(){
        $target_dir="../public/assets/image/";
        // lay ten file luu tren server
        $target_file=$target_dir.basename($_FILES['image']['name']);
        // lay phan mo rong cua hinh ra va doi dang chu in hoa hoac thuong
        $imagefiletype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // kiem tra khi nguoi dung nhan nut submit c dc upload len server k

        $errors=[];
        if(isset($_POST['submit'])){
            $check=getimagesize($_FILES['image']['tmp_name']);
            if($check==false){
                $err="Hinh k dc upload";
                array_push($errors,$err);
            }
        }
        //kiem tra file da ton tai hay chua
        if(file_exists($target_file))
        {
            $err="file nay da ton tai ";
            array_push($errors,$err);
        }
        // co vuot qua 500kb khong
        if($_FILES["image"]['size']>500000){
            $err="hinh vuot dung luong cho phep ";
            array_push($errors,$err);
        }
        if($imagefiletype!="jpg"&&$imagefiletype!="png"&&$imagefiletype!="gif"){
            $err="hinh khong dung dinh dang ";
            array_push($errors,$err);
     }
     //b5
     if(count($errors)!=0){
         return null;
     }
     else
     {
         if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file))
         {
             
             return $errors;
         }
         else
         return null;
     }
     }
?>