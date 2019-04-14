<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">Guestbook</a>
	<ul class="navbar-nav px-3">
		<li class="nav-item text-nowrap">
			<?php if (isset($_SESSION['username'])): ?>
			<a class="nav-link" href="/?logout">Sign out</a>
			<?php else:?>
			<a class="nav-link" href="/?login">Admin Login</a>
			<?php endif;?>
		</li>
	</ul>
</nav>