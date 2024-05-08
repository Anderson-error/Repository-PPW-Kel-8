<?php include 'template/header.php'; ?>

<?php 

$best_seller_menus = getData("SELECT * FROM tb_menu WHERE best_seller = 1 LIMIT 20");

?>

<main id="main">

  <!-- ======= Hero Slider Section ======= -->
  <section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
      <div class="row">
        <div class="col-12">
          <div class="swiper sliderFeaturedPosts">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/1.JPG');">
                  <div class="img-bg-inner">
                    <h2>The First and The Best</h2>
                    <p>Jadilah yang pertama dan yang terbaik dengan produk kami, hanya untuk Anda yang menginginkan yang terbaik</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/3.jpg');">
                  <div class="img-bg-inner">
                    <h2>Trendit</h2>
                    <p>Nikmati cita rasa terkini dengan hidangan-hidangan Trendit, pilihan sempurna untuk mengawali petualangan kuliner Anda!</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/4.jpg');">
                  <div class="img-bg-inner">
                    <h2>Otentik </h2>
                    <p>Tingkatkan pengalaman kuliner Anda dengan cita rasa otentik yang kami sajikan.</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/2.jpg');">
                  <div class="img-bg-inner">
                    <h2>Fresh</h2>
                    <p>Kami menghadirkan pengalaman kuliner yang tak terlupakan dengan menyajikan hidangan-hidangan istimewa berbahan baku Segar pilihan terbaik, karena kami percaya bahwa kesegaran adalah kunci utama cita rasa yang tiada tanding. Bergabunglah dengan kami dan nikmati kelezatan yang menggugah selera, hanya di TTEOKBEOKKI makanan yang selalu berkomitmen untuk memberikan yang terbaik bagi pelanggan setia kami.</p>
                  </div>
                </a>
              </div>
            </div>
            <div class="custom-swiper-button-next">
              <span class="bi-chevron-right"></span>
            </div>
            <div class="custom-swiper-button-prev">
              <span class="bi-chevron-left"></span>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero Slider Section -->

  <section class="">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center">
            <h2>Selamat Datang Di <?= $toko['nama_toko'] ?></h2>
            <p class="mb-4">The First and The Best</p>

            <a href="menu.php" class="px-3 py-2 border border-2 border-dark-subtle rounded-pill btn-lp-lihat-menu">
              Lihat Menu
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======= Best Seller Section ======= -->
  <section id="best-seller" class="posts bg-light">
    <div class="container" data-aos="fade-up">
      <div class="row mb-4">
        <div class="col-lg-12 text-center">
          <p class="m-0 lp-subtitle">Wajib Cobain</p>
          <h2>
            Menu Best Seller
          </h2>
        </div>
      </div>

      <div class="row g-5">
        <div class="col-lg-12 masonry">

        <?php foreach($best_seller_menus as $index => $best_seller_menu) { ?>
          <div class="masonry-item">
            <img src="assets/upload/menu/<?= $best_seller_menu['foto']; ?>">
            <div class="masonry-item__body">
              <div class="mt-auto" >
                <span class="masonry-item__tag"><?= $best_seller_menu['nama_menu']; ?></span>
              </div>
            </div>
          </div>
          <?php } ?>
          

        </div>
      </div>
    </div>
  </section> <!-- End Best Seller Section -->


</main>

<?php include 'template/footer.php'; ?>