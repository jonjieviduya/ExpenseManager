<header class="main-header">
	<a href="{{ url('/') }}" class="logo">

		<span class="logo-mini">
			<b>E</b>
		</span>

		<span class="logo-lg">
			<b>Expense</b>Mngt
		</span>
	</a>

	<nav class="navbar navbar-static-top">

		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li>
					<a href="{{ url('/') }}">Welcome to Expense Manager</a>
				</li>
				<li>
					<a href="{{ route('logout') }}">Log out</a>
				</li>
			</ul>
		</div>
	</nav>
</header>
