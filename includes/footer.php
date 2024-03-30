            <hr/>
            <section id="contact-info">
                <div class="spacer-30 "></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-box-left">
                                <div class="contact-icon-left"><i class="ion ion-ios-location"></i></div>
                                <h6>Address</h6>
                                <p>
                                  <?php echo $contact ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-box-left">
                                <div class="contact-icon-left"><i class="ion ion-ios-telephone"></i></div>
                                <h6>Call Us</h6>
                                <p>
                                    <span><?php echo $companyphone ?></span><br />
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-box-left">
                                <div class="contact-icon-left"><i class="ion ion-ios-email"></i></div>
                                <h6>Email</h6>
                                <p>
                                    <a href="mailto:<?php echo $companyemail ?>"><?php echo $companyemail ?></a> 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer-30"></div>
            </section>
            <!-- END CONTENT -->

            <!-- FOOTER -->
            <footer class="footer pt-80">
                <!-- Copyright Bar -->
                <section class="copyright pb-60">
                    <div class="container">
                        <p class="">
                            &copy; <?=date('Y')?> <a><b>Intelleral</b></a>. All Rights Reserved.
                            <br />
                        </p>
                    </div>
                    <div class="container">
                        <p>*The statements made on this website have not been evaluated by the Food & Drug Administration (FDA). The FDA evaluates only foods and drugs, not supplements like those found in <?php echo $LLproductName ?>. <?php echo $LLproductName ?> is not intended to diagnose, prevent, treat, or cure any disease(s). Representations regarding the efficacy and safety of <?php echo $LLproductName ?> have not been scientifically substantiated or evaluated by the Food and Drug Administration. Our website may have testimonials, reviews, or advertisements that link to it. Please be aware, we do not have control over these other websites and therefore you should review all the claims from those websites with this website. We do not condone any specific results that they may claim. Any claims made may not be typical results, and your results may vary. The information provided on this website is not a substitute for a face-to-face consultation with your physician or health care professional and should not be construed as medical advice for you. Please consult your physician or health care professional before beginning any supplementation. If there is a change in your medical condition, please stop using <?php echo $LLproductName ?> immediately and consult your physician or health care professional. The testimonials on this website are unique cases and we do not guarantee that you will get similar results. Your results may vary. Individuals are remunerated. You hereby irrevocably waive any right you may have to join claims with those of others in the form of a class action or similar procedural device. Any claims arising out of, relating to, or connected with this must be asserted individually. <?php echo $LLproductName ?> is not affiliated with any media outlets mentioned on this website. All trademarks on , whether registered or not, are the property of their respective owners. </p>
                    </div>
                </section>
                <!-- End Copyright Bar -->
            </footer>
            <!-- END FOOTER -->

            <!-- Scroll Top -->
            <a class="scroll-top">
                <i class="fa fa-angle-double-up"></i>
            </a>
            <!-- End Scroll Top -->
        </div>
        <!-- Site Wraper End -->

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <!-- <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script> -->
        <script src="js/plugin/jquery.easing.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/plugin/jquery.flexslider.js" type="text/javascript"></script>
        <script src="js/plugin/jquery.fitvids.js" type="text/javascript"></script>
        <script src="js/plugin/jquery.viewportchecker.js" type="text/javascript"></script>
        <script src="js/plugin/jquery.stellar.min.js" type="text/javascript"></script>
        <script src="js/plugin/wow.min.js" type="text/javascript"></script>
        <script src="js/plugin/jquery.colorbox-min.js" type="text/javascript"></script>
        <script src="js/plugin/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/plugin/jquery.singlePageNav.js" type="text/javascript"></script>
        <script src="js/plugin/isotope.pkgd.min.js" type="text/javascript"></script>
        <script src="js/plugin/masonry.pkgd.min.js" type="text/javascript"></script>
        <script src="js/plugin/imagesloaded.pkgd.min.js" type="text/javascript"></script>
        <script src="js/plugin/sidebar-menu.js" type="text/javascript"></script>
        <script src="js/plugin/jquery.fs.tipper.min.js" type="text/javascript"></script>
        <script src="js/plugin/mediaelement-and-player.min.js"></script>
        <!-- <script src="js/revolution-slider.js" type="text/javascript"></script> -->
        <script src="js/theme.js" type="text/javascript"></script>
        <script src="js/navigation.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/additional-methods.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </body>
</html>