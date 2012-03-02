    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">iDoctor</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><?php echo HTML::link( 'home', 'Home' ); ?></li>
              <li class="active"><?php echo HTML::link( 'auth/login', 'Login' ); ?></li>
              <li class="active"><?php echo HTML::link( 'auth/register', 'Register' ); ?></li>
            </ul>
            <p class="navbar-text pull-right">Please Login</p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>