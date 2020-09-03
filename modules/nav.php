<!--Navbar-->
<nav class="navbar navbar-expand-md navbar-dark py-2 py-md-0 sticky-top">
<div class="container">
  	<!-- Navbar brand -->
  	<a class="navbar-brand pl-1 pl-md-3 mx-auto mx-md-1" href="./home.php"><img src="./assets/img/logo2.png"></a>
  	<!-- Collapse button -->
  	<button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#top-nav">
    	<span class="navbar-toggler-icon"></span>
  	</button>
  	<!-- Collapsible content -->
  	<div class="collapse navbar-collapse" id="top-nav">
    	<!-- Links -->
    	<ul class="navbar-nav mr-auto">
<!--       		<li class="nav-item" title="Home">
        		<a class="nav-link py-3 px-3 px-md-3" href="#"><i class="fas fa-home d-none d-md-block"></i><span class="d-block d-md-none">Home</span></a>
      		</li> -->
      		<form class="form-inline d-none d-md-flex mx-md-3">
      			<input type="search" class="form-control" placeholder="Search" title="Search">
      		</form>
      	</ul>
      	<ul class="navbar-nav ml-auto py-3 py-md-0">
      		<!-- IF LOGGED IN -->
          <?php
          if($LOGGED_IN) {
          ?>
      		<li class="nav-item" title="Forum">
      			<a class="nav-link py-3 py-md-2 px-3 px-md-3" href="./home.php"><i class="fas fa-newspaper d-none d-md-block text-center"></i><span class="d-block">Forum</span></a>
      		</li>
      		<li class="nav-item" title="Messages">
      			<a class="nav-link py-3 py-md-2 px-3 px-md-3" href="./viewmessages.php"><i class="fas fa-comment-alt d-none d-md-block text-center"></i><span class="d-block">Messages</span></a>
      		</li>
      		<li class="nav-item" title="Account">
      			<a class="nav-link py-3 py-md-2 px-3 px-md-3" href="./viewaccount.php"><i class="fas fa-user-circle d-none d-md-block text-center"></i><span class="d-block">Account</span></a>
      		</li>
      		<li class="nav-item" title="Logout">
      			<a class="nav-link py-3 py-md-2 px-3 px-md-3" href="./home.php?logout"><i class="fas fa-sign-out-alt d-none d-md-block text-center"></i><span class="d-block">Logout</span></a>
      		</li>
          <?php } else { ?>
      		<!-- ELSE -->
      		<li class="nav-item" title="Login">
        		<a class="nav-link py-3 py-md-2 px-3 px-md-3" href="./login.php"><i class="fas fa-sign-in-alt d-none d-md-block text-center"></i><span class="d-block">Login</span></a>
      		</li>
  			  <li class="nav-item" title="Sign Up">
        		<a class="nav-link py-3 py-md-2 px-3 px-md-3" href="./signup.php"><i class="fas fa-user-plus d-none d-md-block text-center"></i><span class="d-block">Sign Up</span></a>
      		</li>
          <?php } ?>
      		<!-- Search Bar (Small Screens) -->
      		<form class="form-inline d-md-none">
				<input type="search" class="form-control w-100 my-3 my-md-2 mx-3" placeholder="Search" title="Search">
			</form>
    	</ul>
    	<!-- Links End -->
	</div>
  <!-- Collapsible Content End -->
</div>
</nav>
<!-- Navbar End -->