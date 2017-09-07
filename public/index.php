<?php

//session_start();
//
//if(!isset($_SESSION['username'])) {
//
//
//    redirect("login.php");
//
//}
//
//if(isset($_SESSION['username'])){
//
//  echo "welcome ". $_SESSION['username'];
//}


require_once("../resources/config.php");
include(TEMPLATE_FRONT . DS . "header.php");

?>




    <!-- Page Content -->
    <div class="container">

        <div class="row">

          <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>


            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">

                      <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>
                        
                    </div>

                </div>

                <div class="row">


                    <?php get_products(); ?>


                </div><!-- ROw ends here-->

            </div>

        </div>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>