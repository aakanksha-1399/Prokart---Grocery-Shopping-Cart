<?php
//session_start();
//include('includes/header.php');
//include('config/helper.php');
//include('connection.php');
$total=0;
$conn=connect();

//$register1_Username= $_SESSION['_login'];
if(isset($_SESSION['cart'])){
$cart= $_SESSION['cart'];
foreach($cart as $product){
    $productids[]=$product['productid'];

}    // var_dump($productids);

     $productids = implode(',',$productids);
   //  var_dump($productids);
   //  die();

     $stmt = $conn->prepare("select registration.products.*,products.image as product_image, categories.name as category_name,categories.image as category_image FROM registration.products JOIN registration.categories ON products.category_id = categories.id where products.id IN ('$productids')");
     $stmt->execute();
     $products=$stmt->fetchall();


    }else{
        $products=array();

    }
?>
 <head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/theme.css">
<link rel="stylesheet" type="text/css" href="css/theme1.css">
  </head>
<section class="">
  <div class="container">
    <h2>My Cart(<?php echo count($products); ?>)
      <span class="pull-right">
        <a href="<?php echo controller('removefromcart').'?emptycart=true'; ?>" class="btn btn-sm btn-danger">Empty Cart<span class="glyphicon glyphicon-shopping-cart"></span></a></span></h2>
        <div class="row">
          <div class="col-md-8">
           <h4>Products<br></h4>


           <?php
           foreach($products as $product){
               $productid=$product['id'];
               $cartproduct= $cart[$productid];
               $quantity=$cartproduct['quantity'];
               $cost= $product['price'];
           ?>
           <div class="border-tb row pad">
             <div class="thumbnail col-xs-2 nomargin">
             <img src="<?php echo asset($product['product_image']); ?>" alt="alt"  style="max-height:200px; width:100%">
             </div>
             <div class="col-md-10">
              <div class="row">
               <div class="col-md-9">

                <h3><?php echo $product['name']; ?> </h3>
                <span class="subtitle">Estimated Price: Rs <?php echo $product['price'];  ?> </span> <br>

               <!-- <span class="subtitle">Category: Rs <?php // echo $categories['name'];  ?> </span> -->
             </div>
             <div class="col-md-3 text-right">
             <h4>Rs <?php echo $cost; ?>/-</h4>

             <br></div>
             <div class="col-md-12 text-right">
             <a href="<?php echo controller('removefromcart').'?emptycart=true'; ?>" class="btn  btn-danger btn-md">Remove Service<span class="glyphicon glyphicon-shopping-cart"></span></a></span>
            </div>
            </div>
            </div>
            </div>
           <?php }  ?>
           </div>
                  <div class="col-md-4">
                  <div class="border-r1 pad">
                  <h3 class="text-center">Subtotal</h3>
                  <table class="table table:hover table-condensed">
                  <tbody>

            <?php
            if(count($products)> 0){
            foreach($products as $product)
            {
                $productid=$product['id'];
                $cartproduct=$cart[$productid];
                $quantity=$cartproduct['quantity'];
                $cost=$product['price']* $quantity;
                $total=$total+$cost;
                ?>
                <tr>
                <td> <?php echo $product['name']; ?></td>
                <td class="text-right">Rs <?php echo $cost; ?>/-</td>
                </tr>
            <?php }
            }else { ?>
             <tr>
             <td colspan="2">No Product Available</td>
             </tr>
            <?php }  ?>

            <tr>
            <td>TOTAL</td>
            <td class="text-right">Rs <?php echo $total; ?>/-</td>
            <tr>
            <tr>
            <td>Travelling Charges</td>
            <td class="text-right">Rs <?php echo $total*0.05; ?>/-</td>
            <tr>
            <tr>
            <td>TOTAL</td>
            <td class="text-right">Rs <?php echo $total*1.05; ?>/-</td>
            <tr>

            </tbody>
            </table>
            </div>
            <?php if(isset($_SESSION['cart'])) {  ?>
            <a href="<?php echo localhost('paymentmethod') .  '?id='.$product['id']; ?>" class="btn btn-success btn-lg btn-block">Checkout<span class="glyphicon glyphicon-log-out"></span></a>
            <?php } ?>
            </div>
            </div>

            </div>


            <?php include('includes/footer.php') ?>
