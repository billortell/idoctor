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
              <li class="active"><a href="#">Home</a></li>
            </ul>
            <p class="navbar-text pull-right">Welcome back <?php echo Auth::user()->name; ?></p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>