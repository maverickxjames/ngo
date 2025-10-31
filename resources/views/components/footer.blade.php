<div>
     <footer class="ul-footer">
        {{-- <div class="ul-footer-top">
            <div class="ul-footer-container">
                <div class="ul-footer-top-contact-infos">
                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-pin"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Address</span>
                            <h5 class="ul-footer-top-contact-info-address">समाजसेवी संस्थान, उज्जैन, मध्य प्रदेश</h5>
                        </div>
                    </div>

                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-email"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Send Email</span>
                            <h5 class="ul-footer-top-contact-info-address"><a href="mailto:info@exmple.com">info@exmple.com</a></h5>
                        </div>
                    </div>

                    <!-- single info -->
                    <div class="ul-footer-top-contact-info">
                        <!-- icon -->
                        <div class="ul-footer-top-contact-info-icon">
                            <div class="ul-footer-top-contact-info-icon-inner">
                                <i class="flaticon-telephone-call-1"></i>
                            </div>
                        </div>
                        <!-- txt -->
                        <div class="ul-footer-top-contact-info-txt">
                            <span class="ul-footer-top-contact-info-label">Call Emergency</span>
                            <h5 class="ul-footer-top-contact-info-address"><a href="tel:919893650250">+91 98936 50250</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="ul-footer-middle">
            <div class="ul-footer-container">
                <div class="ul-footer-middle-wrapper wow animate__fadeInUp">
                    <div class="ul-footer-about">
                        <a href="#0"><img src="assets/img/logo.png" alt="logo" class="logo"></a>
                        <p class="ul-footer-about-txt">गरीब व अनाथ बच्चो के शिक्षा व शादी में सहयोग करना</p>
                        <div class="ul-footer-socials">
                            <a href="#0"><i class="flaticon-facebook"></i></a>
                            <a href="#0"><i class="flaticon-twitter"></i></a>
                            <a href="#0"><i class="flaticon-linkedin-big-logo"></i></a>
                            <a href="#0"><i class="flaticon-youtube"></i></a>
                        </div>
                    </div>

                    <div class="ul-footer-widget">
                        <h3 class="ul-footer-widget-title">Quick Links</h3>

                        <div class="ul-footer-widget-links">
                            <a href="#0">About Us</a>
                            {{-- <a href="#0">Our Services</a>
                            <a href="#0">Our Blogs</a>
                            <a href="#0">FAQ’S</a> --}}
                            <a href="#0">Contact Us</a>
                        </div>
                    </div>

                    {{-- <div class="ul-footer-widget ul-footer-recent-posts">
                        <h3 class="ul-footer-widget-title">Recent Posts</h3>

                        <div class="ul-blog-sidebar-posts">
                            <!-- single post -->
                            <div class="ul-blog-sidebar-post ul-footer-post">
                                <div class="img">
                                    <img src="assets/img/blog-2.jpg" alt="Post Image">
                                </div>

                                <div class="txt">
                                    <span class="date">
                                        <span class="icon"><i class="flaticon-calendar"></i></span>
                                        <span>May 12, 2025</span>
                                    </span>

                                    <h4 class="title"><a href="#0">There are many vario ns of passages of</a></h4>
                                </div>
                            </div>

                            <!-- single post -->
                            <div class="ul-blog-sidebar-post ul-footer-post">
                                <div class="img">
                                    <img src="assets/img/blog-1.jpg" alt="Post Image">
                                </div>

                                <div class="txt">
                                    <span class="date">
                                        <span class="icon"><i class="flaticon-calendar"></i></span>
                                        <span>May 12, 2025</span>
                                    </span>

                                    <h4 class="title"><a href="#0">There are many vario ns of passages of</a></h4>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="ul-footer-widget ul-nwsltr-widget">
                        <h3 class="ul-footer-widget-title">Contact Us</h3>
                        <div class="ul-footer-widget-links ul-footer-contact-links">
                            {{-- <a href="mailto:info@example.com"><i class="flaticon-mail"></i> info@example.com</a>
                            <a href="tel:919893650250"><i class="flaticon-telephone-call"></i> +91 98936 50250</a> --}}
                        </div>
                        <form action="#0" class="ul-nwsltr-form">
                            <div class="top">
                                <input type="email" name="email" id="nwsltr-email" placeholder="Your Email Address" class="ul-nwsltr-input">
                                <button type="submit"><i class="flaticon-next"></i></button>
                            </div>

                            <div class="agreement">
                                <label for="nwsltr-agreement" class="ul-checkbox-wrapper">
                                    <input type="checkbox" name="agreement" id="nwsltr-agreement" hidden>
                                    <span class="ul-checkbox"><i class="flaticon-tick"></i></span>
                                    <span class="ul-checkbox-txt">I agree with the <a href="{{ route('policy.main') }}">Privacy Policy</a></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer bottom -->
        <div class="ul-footer-bottom">
            <div class="ul-footer-container">
                <div class="ul-footer-bottom-wrapper">
                    <p class="copyright-txt">&copy;
                        <span id="footer-copyright-year"></span> Akshardan Foundation. All rights reserved
                    </p>
                    <div class="ul-footer-bottom-nav"><a href="{{ route('terms.main') }}">Terms & Conditions</a> <a href="{{ route('policy.main') }}">Privacy Policy</a></div>
                </div>
            </div>
        </div>

        <!-- vector -->
        <div class="ul-footer-vectors">
            <img src="assets/img/footer-vector-img.png" alt="Footer Image" class="ul-footer-vector-1">
        </div>
    </footer>
</div>