<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

      <header>


          <?php login_user(); ?>
          <h2 class="text-center bg-success"> <?php display_message(); ?></h2>


          <div class="panel-body">
              <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <label for="username" class="col-lg-5 control-label">Username</label>
                      <div class="col-lg-3">
                          <input required type="text" class="form-control"  autocomplete="off" name="username" placeholder="Username">

                      </div>
                  </div>
                  <div class="form-group">
                      <label for="password" class="col-lg-5 control-label">Password</label>
                      <div class="col-lg-3">
                          <input required type="password" class="form-control" autocomplete="off" name="password" placeholder="Password">
                      </div>
                  </div>
                  <div class="form-group">

                          <div class="col-lg-offset-5 col-lg-3">
                              <button class="btn btn-primary btn-lg btn-block" name="login" type="submit">Login</button>
                              <a  class="btn btn-info btn-lg btn-block" href="SignUp.php">Signup</a>
                          </div>
                      </div>
                 </form>
             </div>

































<!---->
<!--            <h1 class="text-center">Login</h1>-->
<!--        <div class="col-sm-4 col-sm-offset-5">-->
<!---->
<!--            <form class="" action="" method="post" enctype="multipart/form-data">-->
<!--                <div class="form-group"><label for="username">username<input type="text" name="username" class="form-control"></label>-->
<!--                </div>-->
<!--                 <div class="form-group"><label for="password">-->
<!--                    Password<input type="password" name="password" class="form-control"></label>-->
<!--                </div>-->
<!---->
<!--                <div class="form-group">-->
<!--                  <input type="submit" name="login"  value="login " class="btn btn-primary" >-->
<!--                    --><?php //logout_user(); ?>
<!---->
<!--                    <input type="submit" name="logout"  value="logout " class="btn btn-primary" >-->
<!--                    <h2 class="text-center bg-success"> --><?php //display_message(); ?><!--</h2>-->
<!---->
<!---->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->


    </header>


        </div>

   <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>