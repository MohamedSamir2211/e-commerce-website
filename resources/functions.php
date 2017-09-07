<?php

$uploads = "uploads";

function set_message($msg){

    if(!empty($msg)) {

        $_SESSION['message']= $msg;
    } else {

        $msg = "";
    }
}


function display_message(){

if(isset($_SESSION['message'])){

    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
}

function redirect($location){
    header("Location: $location");
}


function query($sql){

global $connection;  // using global to use the same variable in the config file
    return mysqli_query($connection,$sql);
}


function confirm($result) {

 global $connection;
    if(!$result) {
        die("Query Failed".mysqli_error($connection));
    }
}



function escape_string($string) {

    global $connection;
    return mysqli_real_escape_string($connection,$string);
}


function fetch_array($result){

    return mysqli_fetch_array($result);
}


function get_products() {

   $query = query("SELECT * FROM products ");

   confirm($query);

   while ($row = fetch_array($query)){

       $product_image = display_image($row['product_image']);


       $product = <<<DELIMETER
      
   <div class="col-sm-4 col-lg-4 col-md-4">
      <div class="thumbnail">
         <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
         <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
        </div>
    </div>
 </div>
DELIMETER;

   echo $product;
   };
}



function get_categories() {

   $query = query("SELECT * FROM categories ");
    confirm($query);
    while ($row = fetch_array($query)) {

            echo "<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a> ";
    }

}



function get_products_in_cat_page() {

    $query = query("SELECT * FROM products WHERE product_category_id = ".escape_string($_GET['id'])." ");
    confirm($query);
    while ($row = fetch_array($query)) {

        $product_image = display_image($row['product_image']);

 $product = <<<DELIMETER
        
<div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="../resources/{$product_image}" alt="">
        <div class="caption">
            <h3>{$row['product_title']}</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
            <p>
                 <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a>  <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
            </p>
        </div>
    </div>
</div>

DELIMETER;

 echo $product;
}

}




function get_products_in_shop_page() {

    $query = query("SELECT * FROM products");
    confirm($query);
    while ($row = fetch_array($query)) {

        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
        
<div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="../resources/{$product_image}" alt="">
        <div class="caption">
            <h3>{$row['product_title']}</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
            <p>
                 <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a>  <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
            </p>
        </div>
    </div>
</div>

DELIMETER;

        echo $product;
    }

}


function login_user(){

   if(isset($_POST['login'])) {
       $username = escape_string($_POST['username']);
       $password = escape_string($_POST['password']);


       $query = query("SELECT * FROM users WHERE username = '{$username}' AND  password = '{$password}' ");
       confirm($query);

       $row = mysqli_fetch_array($query);


       if (mysqli_num_rows($query) == 0) {


           set_message('Wrong username or password');

       } else if($row['role_id'] == 0 ) {

           session_start();
           $_SESSION['username'] = $username;
           $_SESSION['id'] = $row['id'];
           redirect('/e-commerce/public');

       } else if($row['role_id'] == 1 ) {

//           session_start();
           $_SESSION['username'] = $username;
           $_SESSION['id'] = $row['id'];
           redirect('/e-commerce/public/admin/index.php');
       }
   }
   }


function logout_user()
{

    if (isset($_POST['logout'])) {

        if (isset($_SESSION['username'])) {

            session_destroy();
            set_message('You are Logged out ');
        }
    }
}

function send_message()
{

    if (isset($_POST['SendMessage'])) {

        $name      = $_POST['name'];
        $subject   = $_POST['subject'];
        $email     = $_POST['email'];
        $message   = $_POST['message'];
        $to        = "Mohamed_samir9696@hotmail.com";

        $headers = "From: {$name} {$email}";

       $result = mail($to,$subject,$message,$headers);

      if(!$result){

          set_message( "ERROR Massage Not sent");
      }else {

          set_message("Massage Sent successfully");
      }

    }

}


function display_orders()
{


    $query = query("SELECT * FROM orders");
    confirm($query);

    while ($row = fetch_array($query)) {

        $orders = <<<DELEMITERS

         <tr>
          <td>{$row['order_id']}</td>
          <td>{$row['order_amount']}</td>
          <td>{$row['order_transaction']}</td>
          <td>{$row['order_status']}</td>
          <td>{$row['order_currency']}</td>
          <td><a href="../../resources/templates/back/delete_order.php?id={$row['order_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
         </tr>


DELEMITERS;

        echo  $orders;
    }

}


function display_image($image){

    global $uploads;
return $uploads . DS .$image;

}


function get_products_in_admin() {

    $query = query("SELECT * FROM products ");

    confirm($query);

    while ($row = fetch_array($query)){

        if(empty($row['product_category_id'])) {

            $category = $row['product_category_id'] = "Uncategorized";
        } else {

            $category = show_product_category_title($row['product_category_id']);
        }
        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
      
        <tr>
          <td>{$row['product_id']}</td>
          <td>{$row['product_title']} <br> 
          <a href="index.php?edit_product&id={$row['product_id']}"> <img width="150" src="../../resources/{$product_image}"</a> </td>
          <td>{$category}</td>
          <td>{$row['product_price']}</td>
          <td>{$row['product_quantity']}</td>
          <td><a href="../../resources/templates/back/delete_product.php?id={$row['product_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>

         </tr>
DELIMETER;

        echo $product;
    };

}



function show_product_category_title($product_category_id) {

 $query = query("SELECT * FROM categories WHERE cat_id = ".$product_category_id." ");

     confirm($query);

     while ($row = fetch_array($query)){

         return $row['cat_title'];

     }
}



function add_product() {


    if(isset($_POST['publish'])) {
        $title = escape_string($_POST['product_title']);
        $description = escape_string($_POST['product_description']);
        $price = escape_string($_POST['product_price']);
        $short_desc = escape_string($_POST['short_desc']);
        $category = escape_string($_POST['product_category_id']);
        $quantity = escape_string($_POST['product_quantity']);
        $image = escape_string($_FILES['file'] ['name']);
        $image_temp = escape_string($_FILES['file'] ['tmp_name']);

        move_uploaded_file($image_temp  , UPLOAD_DIRECTORY . DS . $image);

        $query = query("INSERT INTO products 
        (product_title,product_description,product_price,short_desc,product_category_id,
        product_quantity,product_image)  
        VALUES('{$title}','{$description}','{$price}','{$short_desc}','{$category}','{$quantity}','{$image}' ) ");

        confirm($query);

        global $connection;

        if (mysqli_affected_rows($connection) > 0) {


            set_message('Product Added  successfully ');


        } else {

            set_message('Failed To add Product');

        }

    }
}


function show_categories_add_product_page()
{

    $query = query('SELECT * FROM categories');
    confirm($query);

    while ($row = fetch_array($query)) {

        $categories = <<<DELEMITER

         <option value="{$row['cat_id']}">{$row['cat_title']}</option>

DELEMITER;

        echo $categories;
    }

}


function update_product() {

    if(isset($_POST['update'])){


        $title = $_POST['product_title'];
        $description = escape_string($_POST['product_description']);
        $price = $_POST['product_price'];
        $short_desc = escape_string($_POST['short_desc']);
        $category = $_POST['product_category_id'];
        $quantity = $_POST['product_quantity'];
        $image = escape_string($_FILES['file'] ['name']);
        $image_temp = escape_string($_FILES['file'] ['tmp_name']);

        move_uploaded_file($image_temp  , UPLOAD_DIRECTORY . DS . $image);

      if(empty($image)) {

          $get_img = query("SELECT product_image FROM products WHERE  product_id = ".escape_string($_GET['id']) ." ");


          confirm($get_img);

          $row = fetch_array($get_img);
          $image = $row['product_image'];

      }


        $query = query("UPDATE products SET
        product_title         = '{$title}'   , product_description  = '{$description}', 
        product_price         = '{$price}'   , short_desc           = '{$short_desc}' ,
        product_category_id   = '{$category}', product_quantity     = '{$quantity}'   ,
        product_image         = '{$image}' WHERE product_id = ".escape_string($_GET['id'])."  ");

        confirm($query);

        global $connection;

        if (mysqli_affected_rows($connection) >= 0) {

            redirect('?products');
            set_message('Product Updated Successfully');

        } else {

            set_message('Failed To Update product');

        }

    }

}



function show_categories_in_admin(){

    $query = query("SELECT * FROM categories ");
    confirm($query);
    while ($row = fetch_array($query)) {

        $categories = <<<DELEMITER

            <tr>
            <td>{$row['cat_id']}</td>
            <td>{$row['cat_title']}</td>
            <td><a href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>

           </tr>
       
DELEMITER;


        echo $categories;
    }



}





function add_category() {

        if(isset($_POST['add_category'])) {
            $title = $_POST['cat_title'];

            $query = query("INSERT INTO categories (cat_title)  VALUES('{$title}') ");
             confirm($query);

            global $connection;

            if (mysqli_affected_rows($connection) > 0) {


                set_message('Category Added  successfully ');


            } else {

                set_message('Failed To add Category');

            }
        }
}


function display_users()
{


    $query = query("SELECT * FROM users ");
    confirm($query);
    while ($row = fetch_array($query)) {
        $user_image = display_image($row['user_image']);

        $users = <<<DELEMITER

  <tr>
    <td>{$row['id']}</td>
    <td>{$row['username']}</td>
    <td><a href="index.php?edit_user&id={$row['id']}"> <img width="150" src="../../resources/{$user_image}"</a> </td>
    <td>{$row['email']}</td>
    <td><a href="../../resources/templates/back/delete_user.php?id={$row['id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>

  </tr>


DELEMITER;

        echo $users;
    }
}




function show_roles_add_user_page() {

    $query = query('SELECT * FROM roles');
    confirm($query);

    while ($row = fetch_array($query)) {

        $roles = <<<DELEMITER

         <option value="{$row['id']}">{$row['role_name']}</option>

DELEMITER;

        echo $roles;
    }

}


function ValidateItem($table,$column,$value) {

    $query = query("SELECT * FROM $table WHERE $column = '{$value}' ");
     confirm($query);
     global $connection;
     if(mysqli_affected_rows($connection) > 0){

           set_message("$column is already exist please try another one");
     } else {

         return true;
     }


}




function add_user() {



    if(isset($_POST['add_user'])) {
        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string(sha1($_POST['password']));
        $role = escape_string($_POST['role']);
        $status = escape_string($_POST['status']);
        $image = escape_string($_FILES['file'] ['name']);
        $image_temp = escape_string($_FILES['file'] ['tmp_name']);

        move_uploaded_file($image_temp  , UPLOAD_DIRECTORY . DS . $image);

        if(ValidateItem("users","email",$email) && ValidateItem("users","username","$username")){

        $query = query("INSERT INTO users (username,email,password,role_id,status,user_image)  
                            VALUES('{$username}','{$email}','{$password}','{$role}','{$status}','{$image}' )");
           confirm($query);

        global $connection;

        if (mysqli_affected_rows($connection) > 0) {

                redirect('?users');

        } else {

            set_message('Failed To add User');

        }

    }
}
}


function get_reports() {

    $query = query("SELECT * FROM reports ");
    confirm($query);
    while ($row = fetch_array($query)) {

        $product_title = get_report_product_title($row['product_id']);
        $product_price = get_report_product_price($row['product_id']);

        $reports = <<<DELEMITER

  <tr>
    <td>{$row['report_id']}</td>
    <td>{$row['product_id']}</td>
    <td>{$row['order_id']}</td>
    <td>{$product_price}</td>
    <td>{$product_title}</td>
    <td>{$row['product_quantity']}</td>
    <td><a href="../../resources/templates/back/delete_report.php?id={$row['report_id']}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>

  </tr>


DELEMITER;

        echo $reports;
    }

}


function get_report_product_title($product_id) {

    $query = query("SELECT * FROM products WHERE product_id = '{$product_id}' ");

    confirm($query);

    $row = fetch_array($query);
    return $row['product_title'];


}



function get_report_product_price($product_id) {

    $query = query("SELECT * FROM products WHERE product_id = '{$product_id}' ");

    confirm($query);

    $row = fetch_array($query);
    return $row['product_price'];


}


function show_user_role_name($role_id) {


    $query = query("SELECT * FROM roles WHERE id = '{$role_id}' ");

    confirm($query);

    $row = fetch_array($query);
    return $row['role_name'];
}




function get_user_roles_name() {


    $query = query("SELECT * FROM roles");

    confirm($query);

    while ($row = fetch_array($query)) {

        $roles = <<<DELEMITER

  <option value=" {$row['id']} "> {$row['role_name']} </option>

DELEMITER;

     echo $roles;

    }
}


function update_user(){

    if(isset($_POST['update_user'])) {


        $username = escape_string($_POST['username']);
        $email = escape_string($_POST['email']);
        $password = escape_string(sha1($_POST['password']));
        $role = escape_string($_POST['role']);
        $status = escape_string($_POST['status']);
        $image = escape_string($_FILES['file'] ['name']);
        $image_temp = escape_string($_FILES['file'] ['tmp_name']);

        move_uploaded_file($image_temp, UPLOAD_DIRECTORY . DS . $image);

        if (empty($image)) {

            $get_img = query("SELECT user_image FROM users WHERE  id = " . escape_string($_GET['id']) . " ");


            confirm($get_img);

            $row = fetch_array($get_img);
            $image = $row['user_image'];

        }


        if (empty($password)) {

            $get_pass = query("SELECT password FROM users WHERE  id = " . escape_string($_GET['id']) . " ");


            confirm($get_pass);

            $row = fetch_array($get_pass);
            $password = $row['password'];

        }



        if (ValidateItem("users", "email", $email)
            && ValidateItem("users", "username", "$username"))
        {


            $query = query("UPDATE users SET
        username              = '{$username}'   , password    = '{$password}' , 
        email                 = '{$email}'      , role_id     = '{$role}'     ,
        status                = '{$status}'     , user_image  = '{$image}'
             WHERE id = " . escape_string($_GET['id']) . "  ");

            confirm($query);

            global $connection;

            if (mysqli_affected_rows($connection) >= 0) {

                redirect('?users');
                set_message('User Updated Successfully');

            } else {

                set_message('Failed To Update user');

            }

        }
    }
}
