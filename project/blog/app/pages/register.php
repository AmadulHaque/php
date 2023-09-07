<?php
      include_once 'admin_page/Layout/Header.php';

      if(!empty($_POST))
      {
        //validate
        $errors = [];

        if(empty($_POST['username']))
        {
          $errors['username'] = "A username is required";
        }else
        if(!preg_match("/^[a-zA-Z]+$/", $_POST['username']))
        {
          $errors['username'] = "Username can only have letters and no spaces";
        }

        $query = "select id from users where email = :email limit 1";
        $email = query($query, ['email'=>$_POST['email']]);

        if(empty($_POST['email']))
        {
          $errors['email'] = "A email is required";
        }else
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        {
          $errors['email'] = "Email not valid";
        }else
        if($email)
        {
          $errors['email'] = "That email is already in use";
        }

        if(empty($_POST['password']))
        {
          $errors['password'] = "A password is required";
        }else
        if(strlen($_POST['password']) < 8)
        {
          $errors['password'] = "Password must be 8 character or more";
        }else
        if($_POST['password'] !== $_POST['retype_password'])
        {
          $errors['password'] = "Passwords do not match";
        }
        if(empty($errors))
        {
          //save to database
          $data = [];
          $data['username'] = $_POST['username'];
          $data['email']    = $_POST['email'];
          $data['role']     = "user";
          $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

          $query = "insert into users (username,email,password,role) values (:username,:email,:password,:role)";
          query($query, $data);
          redirect('login');
        }

      }
  ?>






  <body>
    <div class="app-container app-theme-white body-tabs-shadow">
      <div class="app-container">
        <div class="h-100 bg-premium-dark">
          <div class="d-flex h-100 justify-content-center align-items-center">
            <div class="mx-auto app-login-box col-md-8">
              <div class="modal-dialog w-100">
                <div class="modal-content">
                  <form  method="post">
                  <div class="modal-body">
                    <h5 class="modal-title">
                      <h4 class="mt-2">
                        <div>Welcome,</div><span>It only takes a <span class="text-success">few seconds</span> to create your account</span>
                      </h4>
                    </h5>
                    <div class="divider row"></div>

                    <?php if (!empty($errors)):?>
                       <div class="alert alert-danger">Please fix the errors below</div>
                     <?php endif;?>

                    <div class="form-row">
                      <div class="col-md-12">
                        <?php if(!empty($errors['username'])):?>
                          <div class="text-danger"><?=$errors['username']?></div>
                        <?php endif;?>
                        <div class="position-relative form-group"><input  name="username" id="exampleEmail" value="<?=  old_value('username') ?>"  placeholder="username here..." type="text" class="form-control"></div>
                      </div>
                      <div class="col-md-12">
                        <?php if(!empty($errors['email'])):?>
                          <div class="text-danger"><?=$errors['email']?></div>
                        <?php endif;?>
                        <div class="position-relative form-group"><input name="email"   value="<?= old_value('email')  ?>"  placeholder="Email here..." type="email" class="form-control"></div>
                      </div>
                      <div class="col-md-12">
                        <?php if(!empty($errors['password'])):?>
                          <div class="text-danger"><?=$errors['password']?></div>
                        <?php endif;?>
                        <div class="position-relative form-group"><input name="password" id="examplePassword" value="<?= old_value('password') ?>"  placeholder="Password here..." type="password" class="form-control"></div>
                      </div>
                      <div class="col-md-12">
                        <?php if(!empty($errors['retype_password'])):?>
                          <div class="text-danger"><?=$errors['retype_password']?></div>
                        <?php endif;?>
                        <div class="position-relative form-group"><input name="retype_password" id="examplePasswordRep" value="<?= old_value('retype_password') ?>"  placeholder="Repeat Password here..." type="password" class="form-control"></div>
                      </div>
                    </div>
                    <div class="mt-3 position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Accept our <a href="javascript:void(0);">Terms and Conditions</a>.</label></div>
                    <div class="divider row"></div>
                    <h6 class="mb-0">Already have an account? <a href="login" class="text-primary">Sign in</a> | <a href="javascript:void(0);" class="text-primary">Recover Password</a></h6>
                  </div>
                  <div class="modal-footer d-block text-center"><button type="submit" class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg">Create Account</button></div>

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
