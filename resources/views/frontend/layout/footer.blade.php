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
		<script src="{{ asset('/js/owl.carousel.min.js') }}"></script>	
		
		<script>
			$(document).ready(function(){
			  var owl = $(".owl-carousel");
 
			  owl.owlCarousel({
			  	loop: true,
			  	autoplay: true,
			    autoplayTimeout: 3000,
			    autoplayHoverPause: true,
			    animateOut: 'fadeOut',
			    responsiveClass:true,
			    margin: 10,
			    responsive:{
			        0:{
			            items:1,
			            nav:true
			        },
			        600:{
			            items:3,
			            nav:false
			        },
			        1000:{
			            items:8,
			            nav:true,
			            loop:true
			        },
			        1500:{
			        	items:8,
			            nav:true,
			            loop:true
			        }
			    },
			    nav: true,
			    navText: ["<a href='javascript:void(0)'><i class='fa fa-angle-left fa-3x'></i></a>", "<a href='javascript:void(0)'><i class='fa fa-angle-right fa-3x'></i></a>"]
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