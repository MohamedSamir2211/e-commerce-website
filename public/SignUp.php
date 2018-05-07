<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <header>


            <?php Signup_user(); ?>

            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="email" class="col-lg-5 control-label">Email</label>
                        <div class="col-lg-3">
                            <input type="email" required class="form-control" name="email" autocomplete="off" id="email" placeholder="Email" onkeyup="validateEmail()"> <label id="emailPrompt"></label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="username" class="col-lg-5 control-label">Username</label>
                        <div class="col-lg-3">
                            <input type="text" required class="form-control" name="username" autocomplete="off" id="username" placeholder="Username" onkeyup="validateUsername()"> <label id="usernamePrompt"></label>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="password" class="col-lg-5 control-label">Password</label>
                        <div class="col-lg-3">
                            <input type="password"  required class="form-control" name="password" autocomplete="off" id="password" placeholder="Password" onkeyup="validatePassword()"> <label id="PasswordPrompt"></label>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-lg-offset-5 col-lg-3">
                            <button class="btn btn-info btn-lg btn-block" name="signup" type="submit">Signup</button>
                        </div>
                    </div>
                </form>
            </div>



















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