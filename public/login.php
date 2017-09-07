<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

      <header>


          <?php login_user(); ?>
          <h2 class="text-center bg-warning"> <?php display_message(); ?></h2>

            <h1 class="text-center">Login</h1>
        <div class="col-sm-4 col-sm-offset-5">

            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="username">username<input type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="login"  value="login " class="btn btn-primary" >
                    <?php logout_user(); ?>

                    <input type="submit" name="logout"  value="logout " class="btn btn-primary" >
                    <h2 class="text-center bg-success"> <?php display_message(); ?></h2>


                </div>
            </form>
        </div>


    </header>


        </div>

   <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>