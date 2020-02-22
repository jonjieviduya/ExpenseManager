<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Expense Manager</title>
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('ionicon/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/skins/_all-skins.min.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/iCheck/blue.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/morris/morris.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
	<link rel="stylesheet" href="{{ asset('chosen/chosen.min.css') }}">
	<style>
		.content-wrapper{ background-color: #ffffff !important; }
	</style>
	@yield('additional-style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('templates.partials.admin-header')

		@include('templates.partials.sidebar')

		@yield('content')

		@include('templates.partials.admin-footer')
	</div>

	<script src="{{ asset('assets/js/jquery.js') }}"></script>
	<script src="{{ asset('AdminLTE/dist/js/jquery-ui.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('AdminLTE/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<script src="{{ asset('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
	<script src="{{ asset('AdminLTE/dist/js/app.min.js') }}"></script>
	<script src="{{ asset('AdminLTE/dist/js/pages/dashboard.js') }}"></script>
	<script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script>

	@if(session()->has('script-message'))
		<script>
			alert("{{ session()->get('script-message') }}");
		</script>
		<?php session()->forget('script-message'); ?>
	@endif

	@yield('additional-scripts')
</body>
</html>
