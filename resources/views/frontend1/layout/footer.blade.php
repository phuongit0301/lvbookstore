		<footer id="footer-container">
			<div class="container-fluid">
				<div class="row">

				</div>
			</div>
		</footer>

		<script src="{{ asset('/js/jquery.min.js') }}"></script>
		<script src="{{ asset('/js/tether.min.js') }}"></script>
		<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
		<!-- Select2 -->
		<script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>	
		
		<script type="text/javascript">
			$(function () {
			    //Initialize Select2 Elements
			    $(".select2").select2();
			});
		</script>
		<script src="{{ asset('/js/common.js') }}"></script>
		@yield('scripts')
	</body>
</html>