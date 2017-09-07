<?php
      $query =  query("SELECT * FROM users WHERE id ='{$_GET['id']}'");
       confirm($query);
       $row = fetch_array($query);
       $username  = $row['username'];
       $email  = $row['email'];
       $role_id  = $row['role_id'];
       $status  = $row['status'];
       $user_image = display_image($row['user_image']);

    update_user();


       ?>
<h3 class="bg-danger"><?php display_message(); ?></h3>

                        <h1 class="page-header">
                            Edit User
                            <small><?php echo $row['username']; ?></small>

                        </h1>

                      <div class="col-md-6 user_image_box">

                          <img height="200" src="../../resources/<?php echo $user_image; ?>" alt="">

                          <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="../resources/<?php $user_image ?>" alt=""></a>

                      </div>


                    <form action="" method="post" enctype="multipart/form-data">

  


                        <div class="col-md-6">



                           <div class="form-group">
                            <label for="username">Username</label>
                            <input required type="text" name="username" value="<?php echo $username ?>" class="form-control"  >
                               
                           </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                            <input required type="email" name="email"  value="<?php echo $email ?>" class="form-control"  >

                           </div>

<!--                            <div class="form-group">-->
<!--                                <label for="last name">Last Name</label>-->
<!--                            <input type="text" name="last_name" class="form-control" >-->
<!--                               -->
<!--                           </div>-->


                            <div class="form-group">
                                <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                               
                           </div>





                            <div class="form-group">
                                <label for="role">Role</label>

                                <select  name="role" id="" class="form-control">


                                    <option value="<?php echo $role_id; ?>"><?php echo show_user_role_name($role_id); ?></option>

                                    <?php get_user_roles_name(); ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="status">status</label>

                                <select name="status" id="" class="form-control">


                                    <option value="<?php echo $status; ?>"><?php if($status == 0 ){ echo "Not Active"; } else if($status == 1){ echo "Active"; }?> </option>
                                    <option value="0">Not Active</option>
                                    <option value="1">Active</option>


                                </select>


                            </div>




                            <div class="form-group">

                                <input type="file" name="file">


                            </div>

                              <br>
                            <div class="form-group">


                            <input type="submit" name="update_user" class="btn btn-primary pull-right" value="Update" >
                               
                           </div>


                            

                        </div>

                      

            </form>





    