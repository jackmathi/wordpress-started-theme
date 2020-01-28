<?php
 function insertoffers(){

     $shopimage = strtotime(date('Y-m-d H:i:s'));

     $file_size =$_FILES['images']['size'];

     $file_tmp =$_FILES['images']['tmp_name'];

     $file_type=$_FILES['images']['type'];

     $file_ext=strtolower(end(explode('.',$_FILES['images']['name'])));

     $expensions= array("jpeg","jpg","png");

     if(in_array($file_ext,$expensions)=== false){

        $errors[]="extension not allowed, please choose a JPEG or PNG file.";

     }

     if($file_size > 2097152){

        $errors[]='File size must be excately 2 MB';

     }

    $paths =  'assets/dealers-image/'.$shopimage.'.jpg';

     if(empty($errors)==true){

        move_uploaded_file($file_tmp,$paths);
     }

}
?>