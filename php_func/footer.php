  </div><!-- Start Footer -->
  <footer class="bg-dark mt-5 text-white py-3 text-center fixed-bottom" id="tempaltemo_footer">
      Bitcom Test &copy; 2023
  </footer>
  <!-- End Footer -->

  <script src="assets/js/jquery-1.11.0.min.js"></script>
  <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/templatemo.js"></script>
  <script src="https://kit.fontawesome.com/7439c22f5d.js" crossorigin="anonymous"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/apps/index.js"></script>
  <script src="assets/js/apps/shop.js"></script>
  <script src="assets/js/apps/shop_single.js"></script>
  <script src="assets/js/apps/proc_cart.js"></script>
  <!-- End Script -->

  <!-- Start Slider Script -->
  <script src="assets/js/slick.min.js"></script>
  <script>
      $('#carousel-related-product').slick({
          infinite: true,
          arrows: false,
          slidesToShow: 4,
          slidesToScroll: 3,
          dots: true,
          responsive: [{
                  breakpoint: 1024,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 3
                  }
              },
              {
                  breakpoint: 600,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 3
                  }
              },
              {
                  breakpoint: 480,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 3
                  }
              }
          ]
      });

      const alert = document.getElementById('alert');
      if(alert) {
        setTimeout(() => {
          alert.style.display = 'none';
        },4000);
      }
  </script>
</body>
</html>
  <!-- End Slider Script -->