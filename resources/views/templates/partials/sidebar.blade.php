<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset('assets/img/avatar.png') }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ auth()->user()->name }} {!! (auth()->user()->isAdmin()) ? '<small class="text-muted">(Admin)</small>' : '' !!}</p>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">NAVIGATIONS</li>
			<li class="treeview{{ (url()->current() == route('dashboard')) ? ' active' : '' }}">
				<a href="{{ route('dashboard') }}">
					<i class="fa fa-home"></i> <span>Dashboard</span>
				</a>
			</li>
			
			@if(auth()->user()->isAdmin())
				<li class="treeview">
					<a href="#">
						<i class="fa fa-user"></i>
						<span>User Management</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li>
							<a href="{{ route('roles') }}">Roles</a>
						</li>
						<li>
							<a href="{{ route('users') }}">Users</a>
						</li>
					</ul>
				</li>
			@endif

			<li class="treeview">
				<a href="#">
					<i class="fa fa-book"></i>
					<span>Expense Management</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					@if(auth()->user()->isAdmin())
						<li>
							<a href="{{ route('expense-categories') }}">Expense Categories</a>
						</li>
					@endif
					<li>
						<a href="{{ route('expenses') }}">Expenses</a>
					</li>
				</ul>
			</li>
			
			<li class="header">Account Settings</li>
			<li class="treeview">
				<a href="{{ route('changepassword') }}">
					<i class="fa fa-key"></i> <span>Change Password</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
