<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>نموذج الاشتراك</title>
    <style>
      /* تنسيق النموذج */
      form {
        max-width: 500px;
        margin: 0 auto;
      }
      
      label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
      }
      
      input[type="text"],
      input[type="email"],
      input[type="password"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
      }
      
      input[type="radio"] {
        margin-right: 10px;
      }
      
      input[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
  <form action="#" method="post" enctype="multipart/form-data">
      <label for="name">الاسم:</label>
      <input type="text" id="name" name="name" >
      
      <label for="email">البريد الإلكتروني:</label>
      <input type="email" id="email" name="email"  >
      
      <label for="password">كلمة المرور:</label>
      <input type="password" id="password" name="password"  >
      
      <label for="gender">الجنس:</label>
  <input type="radio" id="male" name="gender" value="male" >
  <label for="male">ذكر</label>
  <input type="radio" id="female" name="gender" value="female" >
  <label for="female">أنثى</label>
  <br>
  <label for="image">الصورة:</label>
  <input type="file" id="image" name="image" >
  <br>
  <input type="checkbox" id="remember" name="remember">
  <label for="remember">تذكرني</label>
      
      <input type="submit" value="اشتراك"name="submit">
    </form>



<?php
// تحقق من إرسال النموذج
$host="localhost";
$username="root";
$pass="";
$db="weba";
$conn=mysqli_connect($host,$username,$pass,$db);
if(mysqli_connect_error()){
    echo "error";}
    else{
      echo "donne";
    }

if(isset($_POST['submit'])){
    // تحقق من وجود الحقول الإلزامية
  if($_POST['name']==""||$_POST['password']==""||$_POST['email']==""||$_POST['gender']==""){
    echo "please enter";
    exit;
  }else{
      $name=$_POST['name'];
      $email=$_POST['email'];
      $pas=$_POST['password'];
      $hashe=password_hash($pas,PASSWORD_DEFAULT);
      $gen=$_POST['gender'];
      $fileName=$_FILES['image']['name'];
      
      // $sql = "INSERT INTO users (name, email, hash,gender,image) VALUES ('$name', '$email', '$hashe','$gen','$fileName')";
      // $res = mysqli_query($conn, $sql);
      // if ($res==TRUE) {
      //   echo "New record created successfully";
      //   } else {
          // if(isset($_POST['submit'])){
            $sq=$conn->prepare("insert into users set name=?, email=?, hash=?, gender=?, image=?");
            $sq->bind_param("sssss",$name,$email,$hashe,$gen,$fileName);
            $sq->execute();
            echo "New record created successfully";           
                //mysqli لربط القيم المراد إدخالها إلى الاستعلام مع المعاملات 
           
            //
            // mysqli_stmt_execute() لتنفيذ الاستعلام المُعدّ في دالة mysqli_stmt_bind_param() تُستخدم عادةً لاسترداد نتائج استعلامات 
              //هالوقت ما بكفي تكون لكويريي صح للازم يكون الصف بداتا بيز عندي فمش هتتحقق بس من لكويري لا كمان من الصف
                }
  }

if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  //!filter_var()من شو بدي اتحقق, تصفيةة وفلترة البيانات المدخلة
  echo "عنوان البريد الإلكتروني غير صالح";

}
if(strlen($_POST['password'])<8){
  echo "كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل";
  exit;

}
if($_FILES["image"]["size"]<1000000){
  echo "حجم الصورة يجب أن لا يتجاوز 1 ميجابايت";
  exit;


}




// $sql="select *from users";
// $res=mysqli_query($conn,$sql);
// print_r($res);

  mysqli_close($conn);

  
  
?>
