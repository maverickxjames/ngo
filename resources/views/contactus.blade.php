<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>अक्षरदान सेवा सोशल फाउंडेशन</title>

    <!-- libraries CSS -->
    <link rel="stylesheet" href="assets/icon/flaticon_charitics.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/splide/splide.min.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/vendor/slim-select/slimselect.css">
    <link rel="stylesheet" href="assets/vendor/animate-wow/animate.min.css">
    <link rel="stylesheet" href="assets/vendor/flatpickr/flatpickr.min.css">

    <!-- custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="preloader" id="preloader">
        <div class="loader"></div>
    </div>

    <!-- SIDEBAR SECTION START -->
    <div class="ul-sidebar">
        <!-- header -->
        <div class="ul-sidebar-header">
            <div class="ul-sidebar-header-logo">
                <a href="/">
                    <img src="assets/img/logo.png" alt="logo" class="logo">
                </a>
            </div>
            <!-- sidebar closer -->
            <button class="ul-sidebar-closer"><i class="flaticon-close"></i></button>
        </div>

        <div class="ul-sidebar-header-nav-wrapper d-block d-lg-none"></div>


        <!-- sidebar footer -->
        <div class="ul-sidebar-footer">
            <span class="ul-sidebar-footer-title">Follow us</span>

            <div class="ul-sidebar-footer-social">
                <a href="#"><i class="flaticon-facebook"></i></a>
                <a href="#"><i class="flaticon-twitter"></i></a>
                <a href="#"><i class="flaticon-instagram"></i></a>
                <a href="#"><i class="flaticon-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- SIDEBAR SECTION END -->

    <!-- SEARCH MODAL SECTION START -->
    <div class="ul-search-form-wrapper flex-grow-1 flex-shrink-0">
        <button class="ul-search-closer"><i class="flaticon-close"></i></button>

        <form action="#" class="ul-search-form">
            <div class="ul-search-form-right">
                <input type="search" name="search" id="ul-search" placeholder="Search Here">
                <button type="submit"><span class="icon"><i class="flaticon-search"></i></span></button>
            </div>
        </form>
    </div>
    <!-- SEARCH MODAL SECTION END -->

    <!-- HEADER SECTION START -->
<x-header />
    <!-- HEADER SECTION END -->


<main>
    <!-- BREADCRUMB SECTION START -->
    <section class="ul-breadcrumb ul-section-spacing">
        <div class="ul-container">
            <h2 class="ul-breadcrumb-title">संपर्क करें (Contact Us)</h2>
            <ul class="ul-breadcrumb-nav">
                <li><a href="/">Home</a></li>
                <li><span class="separator"><i class="flaticon-right"></i></span></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>
    <!-- BREADCRUMB SECTION END -->

    <!-- CONTACT INFO SECTION START -->
    <div class="ul-contact-infos">
        <div class="ul-section-spacing ul-container">
            <div class="row row-cols-md-3 row-cols-2 row-cols-xxs-1 ul-bs-row">
                <!-- Phone -->
                <div class="col">
                    <div class="ul-contact-info">
                        <div class="icon"><i class="flaticon-phone-call"></i></div>
                        <div class="txt">
                            <span class="title">फ़ोन नंबर (Phone)</span>
                            <a href="tel:+919893650250">+91 98936 50250</a>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="col">
                    <div class="ul-contact-info">
                        <div class="icon"><i class="flaticon-comment"></i></div>
                        <div class="txt">
                            <span class="title">ईमेल पता (Email Address)</span>
                            <a href="mailto:support@akshardan.org">support@akshardan.org</a>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="col">
                    <div class="ul-contact-info">
                        <div class="icon"><i class="flaticon-location"></i></div>
                        <div class="txt">
                            <span class="title">कार्यालय पता (Office Address)</span>
                            <span class="descr">
                                Akshardan Seva Social Foundation,<br>
                                Mahakal Marg, Ujjain, Madhya Pradesh – 456006
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTACT INFO SECTION END -->

    <!-- GOOGLE MAP START -->
    <div class="ul-contact-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3673.1420920234316!2d75.7724099150363!3d23.182777284869313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396374d7a46c454b%3A0x6c6a5b31f4985e5a!2sUjjain%2C%20Madhya%20Pradesh!5e0!3m2!1sen!2sin!4v1736854209235"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    <!-- GOOGLE MAP END -->

    <!-- CONTACT FORM SECTION START -->
    <section class="ul-inner-contact ul-section-spacing">
        <div class="ul-section-heading justify-content-center text-center wow animate__fadeInUp">
            <div>
                <span class="ul-section-sub-title">संपर्क करें</span>
                <h2 class="ul-section-title">
                    कोई भी सुझाव, प्रश्न या सहयोग के लिए हमसे जुड़ें
                </h2>
                <p class="text-gray-600 mt-2 max-w-xl mx-auto">
                    Feel free to reach out to <strong>Akshardan Seva Social Foundation</strong>.  
                    We would love to hear from you — whether it’s about our social initiatives, donations, or volunteering.
                </p>
            </div>
        </div>

        <div class="ul-inner-contact-container wow animate__fadeInUp">
            <form action="/contact-submit" method="POST" class="ul-contact-form ul-form">
                @csrf
                <div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" name="name" id="ul-contact-name" placeholder="आपका नाम / Your Name" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="email" name="email" id="ul-contact-email" placeholder="ईमेल / Email Address" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="subject" id="ul-contact-subject" placeholder="विषय / Subject" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="message" id="ul-contact-msg" placeholder="अपना संदेश लिखें / Type your message" required></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="ul-btn">
                            <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Submit Message
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- CONTACT FORM SECTION END -->

    <!-- CTA SECTION START -->
    <section class="ul-cta">
        <div class="ul-container text-center">
            <span class="ul-section-sub-title">Join Our Social Mission</span>
            <h2 class="ul-cta-title">
                साथ मिलकर समाज में बदलाव लाने की दिशा में एक कदम और बढ़ाएँ
            </h2>
            <a href="/donate" class="ul-btn">
                <i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Donate or Volunteer
            </a>
        </div>
        <img src="assets/img/cta-vector.svg" alt="Vector" class="ul-cta-vector">
    </section>
    <!-- CTA SECTION END -->
</main>



    <!-- FOOTER SECTION START -->
<x-footer />
    <!-- FOOTER SECTION END -->

    <!-- libraries JS -->
    <script src="assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/splide/splide.min.js"></script>
    <script src="assets/vendor/splide/splide-extension-auto-scroll.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/slim-select/slimselect.min.js"></script>
    <script src="assets/vendor/animate-wow/wow.min.js"></script>
    <script src="assets/vendor/splittype/index.min.js"></script>
    <script src="assets/vendor/mixitup/mixitup.min.js"></script>
    <script src="assets/vendor/fslightbox/fslightbox.js"></script>
    <script src="assets/vendor/flatpickr/flatpickr.js"></script>

    <!-- custom JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/tab.js"></script>
    <!-- <script src="assets/js/countdown.js"></script> -->
    <script src="assets/js/accordion.js"></script>
    <script src="assets/js/progressbar.js"></script>
</body>

</html>