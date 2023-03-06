<?php
//session_start();
//include('includes/header.php');
//include('config/helper.php');
//include('connection.php');


$errors=[];
$values=[];
try{


   $conn=connect();

    $stmt=$conn->prepare("select * from registration.products where id=:id");

    $stmt->bindParam(":id",$id);
    $id=$_GET['productid'];
    $stmt->execute();
    $productforcart = $stmt->fetch();

   if($productforcart == false){

    redirectTo(localhost('404'));

 }
   if($_SERVER["REQUEST_METHOD"]== "GET"){
       $values['quantity']=1;
   }elseif($_SERVER["REQUEST_METHOD"]== "POST"){
       $_POST['quantity'] = trim($_POST['quantity']);
       if(empty($_POST['quantity'])){
           $errors['quantity']='Quantity is required';
       }else{
           if($_POST['quantity']>0){
               $value['quantity']= $_POST['quantity'];
           }else{
               $errors['quantity']="Quantity should be more than zero";
           }
       }

   }else{
       flash('Danger','Something went wrong');
       $_SESSION['errors']= $errors;
       redirectTo(localhost('details').'?productid=' .$_GET['productid']);
   }

if(count($errors)==0){
    $productdetail=array(
        'productid'=> $_GET['productid'],
        'quantity'=> $values['quantity']
    );
if(isset($_SESSION['_login'])){
    if(isset($_SESSION['cart'])){
        $cart=$_SESSION['cart'];
        foreach($cart as $product){
            if($product['productid'] ==$productdetail['productid']){
                flash('info','Product already present in your cart');
                redirectTo(localhost('cart'));
            }
        }
        $productid= $productdetail['productid'];
        $cart[$productid]=$productdetail;
    }else{
        $productid= $productdetail['productid'];
        $cart[$productid]=$productdetail;
    }
}
    $_SESSION['cart']= $cart;
     if($_SERVER["REQUEST_METHOD"]=="GET"){
         flash('Success',$productforcart['name'].' Has been added to your Cart');
         redirectTo(localhost('products').'?category='.$productforcart['category_id']);

     } elseif($_SERVER["REQUEST_METHOD"]=="POST"){
        flash('Success',$productforcart['name'].'Has been added to your Cart');
        redirectTo(localhost('details').'?productid='.$GET['productid']);

    }  else{
        $_SESSION['errors']=$errors;
        redirectTo(localhost('details').'?productid='.$GET['productid']);

    }
}
}
 catch(PDOException $e){
    echo "<br>" .  $e->getMessage();
    die();

}
?>
