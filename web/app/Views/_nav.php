<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-md-3 col-lg-3 col-xl-2 mr-0" href="/">Guestbook</a>
	<ul class="navbar-nav px-3">
		<li class="nav-item text-nowrap">
			<a class="nav-link d-md-none d-sm-block text-light" href="javascript: (0);" data-toggle="modal" data-target="#newMessageModal">
				Post a Message
			</a>
		</li>
		<li class="nav-item text-nowrap">
			<?php if (isset($_SESSION['username'])): ?>
			<a class="nav-link text-light" href="/?logout">Sign out</a>
			<?php else:?>
			<a class="nav-link text-light" href="/?login">Admin Login</a>
			<?php endif;?>
		</li>
	</ul>
</nav>