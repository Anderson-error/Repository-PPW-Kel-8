<?php include 'template/header.php'; ?>

<main id="main">

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-5" data-aos="fade-right">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d997.4179010894248!2d117.14798425043088!3d-0.49136149277774593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f55e57531bb%3A0x40391ff699ec6829!2sBazar%20segiri%20samarinda!5e0!3m2!1sid!2sid!4v1714675507803!5m2!1sid!2sid" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                
                <div class="col-lg-7" data-aos="fade-left">
                    <h1>Tentang Kami</h1>
                    <p style="white-space: pre-line;">
                        <?= $toko['deskripsi'] ?>
                        <br/>
                        Alamat :
                        <?= $toko['alamat'] ?>
                        <br/>
                        Telpon :
                        <?= $toko['telpon'] ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include 'template/footer.php'; ?>