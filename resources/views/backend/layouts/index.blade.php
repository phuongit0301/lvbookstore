<!-- load header -->
@include("backend.layouts.header")
<!-- end load header -->

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

@include("backend.layouts.menu")

<!-- load aside -->
@include("backend.layouts.sidebar")
<!-- end load aside -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Content Here -->
        @include('backend.layouts.error-notification')

        @yield('content')
      <!-- End Content -->
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->

@include("backend.layouts.footer")
@include("backend.layouts.footer-bottom")