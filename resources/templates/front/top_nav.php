  <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse log" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav ">
                    <li>
                        <a href="shop.php">Shop</a>
                    </li>
                     <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                    <li >
                        <a href="contact.php">Contact</a>
                    </li>


                    <?php

                    if(isset($_SESSION['username'])) {

                    echo'<li class="dropdown login">';
                        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';echo'<i class="fa fa-user"></i>';

                            if(isset($_SESSION['username']) ){
                                echo $_SESSION['username'];

                            } else {

                                echo "unregistered user";
                            }

                     echo'<b class="caret"></b>'; echo'</a>';

                     echo '<ul class="dropdown-menu">

                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>';
                    echo'</li>';

                    }else{

                         echo'<li class="login">
                         <a href="login.php">Login</a>
                         </li>';

                    }


                    ?>





<!--                   --><?php
//
//                     if(!@$_SESSION['username']){
//
//                    echo'<li class="login">
//                        <a href="login.php">Login</a>
//                    </li>';
//
//                    }else{
//                       echo'<li class="login">
//                       <a href="logout.php">Logout</a>
//                        </li>';
//                     }
//
//                    ?>
                </ul>
             </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->