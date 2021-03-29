
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            
				<div class="copyright">
					<p><strong>Challenge Site Dashboard</strong> ©All Rights Reserved</p>
					
				</div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <!-- Datatable -->
    <script src="../css/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../css/js/plugins-init/datatables.init.js"></script>
    <script src="../css/vendor/global/global.min.js"></script>
	<script src="../css/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="../css/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="../css/js/custom.min.js"></script>
	<script src="../css/js/deznav-init.js"></script>
	<script src="../css/vendor/owl-carousel/owl.carousel.js"></script>
	
	<!-- Chart piety plugin files -->
    <script src="../css/vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="../css/js/dashboard/dashboard-1.js"></script>
	
	<script>
		function carouselReview(){
			/*  testimonial one function by = owl.carousel.js */
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:15,
				nav:false,
				dots: false,
				left:true,
				navText: ['', ''],
				responsive:{
					0:{
						items:1
					},
					800:{
						items:2
					},	
					991:{
						items:2
					},			
					
					1200:{
						items:2
					},
					1600:{
						items:2
					}
				}
			})		
			jQuery('.testimonial-two').owlCarousel({
				loop:true,
				autoplay:true,
				margin:15,
				nav:false,
				dots: true,
				left:true,
				navText: ['', ''],
				responsive:{
					0:{
						items:1
					},
					600:{
						items:2
					},	
					991:{
						items:3
					},			
					
					1200:{
						items:3
					},
					1600:{
						items:4
					}
				}
			})					
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});
	</script>
</body>


</html>