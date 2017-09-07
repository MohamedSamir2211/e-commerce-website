<?php require_once("config.php"); ?>
<?php



 if(isset($_GET['add'])){

   $query =  query("SELECT * FROM products WHERE product_id = ".escape_string($_GET['add']) ."   " );
     confirm($query);
     while ($row = fetch_array($query)){


        if($row['product_quantity'] != $_SESSION['product_'. $_GET['add']] ){

        $_SESSION['product_'. $_GET['add']]+=1;
        redirect('../public/checkout.php');

        } else {

         set_message('We only have '.$row['product_quantity'].' items available of this product');
            redirect('../public/checkout.php');

        }

         }
}



if(isset($_GET['remove'])){

   if($_SESSION['product_'.$_GET['remove']] == 0) {

       $_SESSION['product_'. $_GET['remove']] = '0';
       redirect('../public/checkout.php');

   }else{
       $_SESSION['product_'. $_GET['remove']]-=1;

        if($_SESSION['product_'. $_GET['remove']] < 1){
            unset($_SESSION['item_total']);
            unset ($_SESSION['item_quantity']);
            redirect('../public/checkout.php');
        } else {

            redirect('../public/checkout.php');

        }
    }
}





if(isset($_GET['delete'])){
$_SESSION['product_'. $_GET['delete']] = '0';
unset($_SESSION['item_total']);
unset ($_SESSION['item_quantity']);
redirect('../public/checkout.php');

}



function cart() {

     $total = 0;
     $totalquantity =0;
     $item_name = 1;
     $item_number =1;
     $amount = 1;
     $Quantity = 1;

    foreach ($_SESSION as $name => $quantity) {

    if($quantity > 0) {

      if(substr($name,0,8) == "product_"){

          $length = @strlen($name - 8) or die();

          $id = substr($name,8,$length);

   $query = query("SELECT * FROM  products WHERE  product_id = " . escape_string($id) . "  ");
     confirm($query);
     while ($row = fetch_array($query)){

         $SubTotal = $row['product_price'] * $quantity;
         $totalquantity +=$quantity;

         $product_image = display_image($row['product_image']);
         $product = <<<DELIMETER
         <tr>
         
         <td>{$row['product_title']}
           <br>  <img width="150" src="../resources/{$product_image}">
          </td>
         <td>&#36;{$row['product_price']}</td>
         <td>{$quantity}</td>
         <td>&#36;{$SubTotal}</td>
         <td>
         <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a> 
         <a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a> 
         <a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a> 
         </td>
      </tr>

  <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
  <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
  <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
  <input type="hidden" name="quantity_{$Quantity}" value="{$quantity}">

DELIMETER;

         echo $product;

         $item_name++;
         $item_number++;
         $amount++;
         $Quantity++;

     }

     $_SESSION['item_total']= $total += $SubTotal;
     $_SESSION['item_quantity']= $totalquantity;

      }
        }
    }
}


function show_paypal(){

    if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {


        $paypal_button = <<<DELIMETER


<input type="image" name="upload"
           src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
           alt="PayPal - The safer, easier way to pay online">
DELIMETER;


        return $paypal_button;

    }
}





function process_transaction() {

    global  $connection;
    if(isset($_GET['tx'])){

        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];



    $total = 0;
    $totalquantity =0;

    foreach ($_SESSION as $name => $quantity) {

        if($quantity > 0) {

            if(substr($name,0,8) == "product_") {

                $length = @strlen($name - 8) or die();

                $id = substr($name, 8, $length);

                $query = query("SELECT * FROM  products WHERE  product_id = " . escape_string($id) . "  ");
                confirm($query);
                while ($row = fetch_array($query)) {

                    $SubTotal = $row['product_price'] * $quantity;
                    $totalquantity += $quantity;

                    $insert_order = query("INSERT INTO orders (order_amount,order_transaction,order_status,order_currency) VALUES ('{$amount}','{$transaction}','{$status}','{$currency}' )");
                    $order_id = mysqli_insert_id($connection);
                    confirm($insert_order);


                    $query2 = query("INSERT INTO reports (product_id,product_quantity,order_id) 
                                   VALUES ('{$id}','{$quantity}','{$order_id}' )");

                    confirm($query2);
                }

                $total += $SubTotal;
                $totalquantity;
            }
            }
    }
        session_destroy();
    } else {

        redirect("index.php");
    }
}
