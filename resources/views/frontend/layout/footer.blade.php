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

		<script src="{{ asset('/js/owl.carousel.min.js') }}"></script>	
		
		<script type="text/javascript">
			$(function () {
			    //Initialize Select2 Elements
			    $(".select2").select2();
			});
		</script>
		<script>
			$(document).ready(function(){
			  var owl = $("#owl-demo");
 
			  owl.owlCarousel({
			  	loop: true,
			  	items: 1,
			  	autoplay:true,
			    autoplayTimeout:1000,
			    autoplayHoverPause:true
			  });
			 
			  // Custom Navigation Events
			  $(".next").click(function(){
			    owl.trigger('owl.next');
			  })
			  $(".prev").click(function(){
			    owl.trigger('owl.prev');
			  })
			});
		</script>
		<script src="{{ asset('/js/common.js') }}"></script>
		@yield('scripts')
	</body>
</html>