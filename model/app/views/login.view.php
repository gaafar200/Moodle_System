<?php $this->view("include/header",["pageName"=>$pageName]); ?>
  <div class="error-pagewrap">
    <div class="error-page-int">
      <div class="text-center m-b-md custom-login">
        <h1>LOGIN</h1>
      </div>
      <div class="content-error">
        <div class="hpanel">
          <div class="panel-body">
            <form method="POST" id="loginForm">
               
              <div class="form-group">
                <label class="control-label" for="username">Username</label>
                <input type="text" placeholder="username or id" title="Please enter you username" required=""
                  value="" name="username" id="username" class="form-control">
                <span class="help-block small">Your unique username to app</span>
                <?php if (isset($errors)): ?>
                      <em style="color:red" for="firstname" class="invalid"><?= ucfirst($errors) ?></em>
                <?php endif; ?>
              </div>
              
              <div class="form-group">
                <label class="control-label" for="password">Password</label>
                <input type="password" title="Please enter your password" placeholder="******" required="" value=""
                  name="password" id="password" class="form-control">
                <span class="help-block small">Your strong password</span>
              </div>
              <div class="checkbox login-checkbox">
                <label>
                  <input name="remember" type="checkbox" class="i-checks"> Remember me </label>
              </div>
              <button class="btn btn-success btn-block loginbtn">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->view("include/footer"); ?>
