<!doctype html>
<html lang="en">

<?php
    include_once 'admin_page/Layout/Header.php';


    if(!empty($_POST))
    {
        //validate
        $errors = [];
        $query = "select * from users where email = :email limit 1";
        $row = query($query, ['email'=>$_POST['email']]);

        if($row)
        {
          $data = [];
          if(password_verify($_POST['password'], $row[0]['password']))
          {
            //grant access
            authenticate($row[0]);
            redirect('admin');

          }else{
            $errors['email'] = "wrong email or password";
          }

        }else{
          $errors['email'] = "wrong email or password";
        }
    }

  ?>
  <body>


    <div class="app-container app-theme-white body-tabs-shadow">




      <div class="app-container">
        <div class="h-100 bg-plum-plate bg-animation">
          <div class="d-flex h-100 justify-content-center align-items-center">
            <div class="mx-auto app-login-box col-md-8">
              <div class="modal-dialog w-100 mx-auto">
                <div class="modal-content">
                  <form method="post">
                  <div class="modal-body">
                    <div class="h5 modal-title text-center">
                      <h4 class="mt-2">
                        <div>Welcome back,</div><span>Please sign in to your account below.</span>
                      </h4>
                    </div>

                      <div class="form-row">
                        <div class="col-md-12">
                          <?php if (!empty($errors['email'])):?>
                            <div class="alert alert-danger"><?=$errors['email']?></div>
                          <?php endif;?>
                          <div class="position-relative form-group"><input name="email" id="exampleEmail" value="<?= old_value('email') ?>"  placeholder="Email here..." type="email" class="form-control"></div>
                        </div>
                        <div class="col-md-12">
                          <div class="position-relative form-group"><input name="password" id="examplePassword" value="<?=  old_value('password')  ?>" placeholder="Password here..." type="password" class="form-control"></div>
                        </div>
                      </div>
                      <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Keep me logged in</label></div>

                    <div class="divider"></div>
                    <h6 class="mb-0">No account? <a href="register" class="text-primary">Sign up now</a></h6>
                  </div>
                  <div class="modal-footer clearfix">
                    <div class="float-left"><a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a></div>
                    <div class="float-right"><button  type="submit" class="btn btn-primary btn-lg">Login to Dashboard</button></div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  <?php
      include_once 'admin_page/Layout/Footer.php';
  ?>
