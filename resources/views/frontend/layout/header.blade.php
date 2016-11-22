<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<title>Đọc Truyện Online</title>
		
		<link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" />

		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('/css/tether.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('/plugins/select2/select2.min.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/owl.carousel.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/style.css') }}" />

		@yield('styles')
	</head>
	<body>
	<header id="header-container">
		<div class="top-header-area">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="top-header">
							<nav class="navbar navbar-light">
							  <a class="navbar-brand" href="#">Navbar</a>
							  <ul class="nav navbar-nav">
							    <li class="nav-item dropdown">
							      <a class="nav-link dropdown-toggle" href="http://example.com" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chuyên Mục</a>
							      <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
							        <a class="dropdown-item" href="#">Action</a>
							        <a class="dropdown-item" href="#">Another action</a>
							        <a class="dropdown-item" href="#">Something else here</a>
							      </div>
							    </li>
							    <li class="nav-item dropdown">
							      <a class="nav-link dropdown-toggle" href="http://example.com" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Thể Loại</a>
							      <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
							        <a class="dropdown-item" href="#">Action</a>
							        <a class="dropdown-item" href="#">Another action</a>
							        <a class="dropdown-item" href="#">Something else here</a>
							      </div>
							    </li>
							  </ul>
							  <form class="form-inline float-xs-right container-search">
							    <input class="form-control" type="text" placeholder="Search">
							    <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
							  </form>
							</nav>
						</div><!--end top-header-->
					</div>
				</div>
			</div>
		</div>
	</header>