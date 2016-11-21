    <!-- REQUIRED JS SCRIPTS -->

    <script src="{{ asset('js/tether.min.js') }}"></script>
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<!-- 
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
 -->
    <script src="{{ asset('js/common.js') }}"></script>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
    @yield('scripts')
  </body>
</html>
