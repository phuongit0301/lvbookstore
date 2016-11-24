		<footer id="footer-container">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6">
						<p>Truyện Full - Đọc truyện online, đọc truyện chữ, truyện hay. Website luôn cập nhật những bộ truyện mới thuộc các thể loại đặc sắc như truyện tiên hiệp, truyện kiếm hiệp, hay truyện ngôn tình một cách nhanh nhất. Hỗ trợ mọi thiết bị như di động và máy tính bảng.</p>
					</div>
					<div class="col-lg-6">
						<ul class="tags-container">
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
							<li><a href="#" class="tags"><h6><span class="tag tag-pill tag-default">Default</span></h6></a></li>
						</ul>
					</div>
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
			    autoplayTimeout: 5000,
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