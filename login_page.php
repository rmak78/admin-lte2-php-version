 
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Marketing - </b><?php echo get_company_detail()['company_name']; ?></a>
    </div>
    <div class="card-body">
      <p id="msg" class="login-box-msg">Sign in to start your session</p>
 
      <form action="" name="frmLogin" id="frmLogin" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user_name" placeholder="Email" id="user_name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
             <input  type="button" name="log_in" id="log_in" class="btn btn-primary btn-block btn-flat" value="Log In"/>
          </div>
          <!-- /.col -->
        </div>
		          <?php 
          if (isset($_GET['route'])) {
              $path = '?route='.$_GET['route'];
          } else {
              $path = '';
          }
          ?>
          <input type="hidden" id="route" name="route" value="<?php echo $path; ?>">
      </form>
 

      <p class="mb-1">
        <a href="index.php?route=forgot-password">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="index.php?route=register" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
 
  

		<script>
	$(document).ready(function(){
		$('body').addClass("login-page").removeClass("sidebar-collapse layout-top-nav").removeAttr("style");
		$('.main-footer').remove();
		$('.wrapper').removeClass('wrapper').addClass('login-box');
		$('#log_in').click(function(){
				user = $('#user_name').val();
				password = $('#password').val();
				if(($.trim(user)!='')&&($.trim(password)!='')){
						attempLogin();
						$('#msg').html(" ");
				} else {
					$('#msg').html("Please enter User ID and Password");
				}
				
			});
			
			$('input').keydown(function(e) {
			  if (e.which == 13) {
				user = $('#user_name').val();
				password = $('#password').val();
				if(($.trim(user)!='')&&($.trim(password)!='')){
						attempLogin();
						$('#msg').html(" ");
				} else {
					$('#msg').html("Please Enter User ID and Password");
				}
			  }
			});

	});
	function attempLogin(){
		var	user = $('#user_name').val();
		var	password = $('#password').val();
			console.log(user);
			console.log(password);
		var	posted = {'user':user,'password':password};
				$.ajax({  
						type: "POST",  
						url: "ajax_helpers/ajax_check_login.php",  
						data: posted, 
						beforeSend: function(){
								$('#log_in').attr( "value", "Loging In.." );
								$('#log_in').addClass( "disabled");
								
								},					
						success: function(data){  
							if(data==1){
								rout=$("#route").val();
								$(location).attr('href','index.php'+rout);
							}else{
								$('#msg').html("Invalid User ID or Password");
								$('#log_in').attr( "value", "Log In" );
								$('#log_in').removeClass( "disabled");
							}
						}
					});
	}
	</script>
 