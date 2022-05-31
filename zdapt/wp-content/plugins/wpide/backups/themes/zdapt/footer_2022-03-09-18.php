<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec6e605636a0"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/footer.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/footer_2022-03-09-18.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

  $options = get_option('cOptn');
 ?>

</div>

<footer>
    <section class="footer">
        <div class="container">
        <div class="row">
            <div class="col-md-3">
                 <div class="cont">
                                 <a href="https://outlook.office365.com/owa/calendar/ZDAPT@zdapt.com/bookings/" class="cbtn">Schedule a Free 30 Mins Consultation</a>
                <a href="javascript:;"><?php echo $options['Address']; ?></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cont">
                     
                    <a href="mailto:<?php echo $options['email']; ?>"><?php echo $options['email']; ?></a>
                    <a href="tel:<?php echo $options['phone_number']; ?>"><?php echo $options['phone_number']; ?></a>
                </div>
                <div class="social">
                    <a href="<?php echo $options['facebook']; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="<?php echo $options['instagram']; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="<?php echo $options['youtube']; ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    <a href="<?php echo $options['twitter']; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <img src="<?php bloginfo('template_directory'); ?>/images/f1.png" style="    background: #fff;   border-radius: 10px;   padding: 0 4%;">
   
                </div>
            <!--<div class="col-md-4">
                 <h6>Get Connect With Us</h6>
                 <div class="social">
                     <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/images/g.png"></a>
                     <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/images/l.png"></a>
                     <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/images/t.png"></a>
                     <a href="javascript:;"><img src="<?php bloginfo('template_directory'); ?>/images/f.png"></a>
                 </div>
                 <div class="rlink">
                     <a href="javascript:;">Terms of Use</a><span>  |</span><a href="javascript:;">  Privacy policy</a>
                     <p><?php echo $options['copyright']; ?></p>
                     <a href="https://insitech.ae/" target="_blank">Love by Insitech <img src="<?php bloginfo('template_directory'); ?>/images/insi.png"> </a>
                 </div>
            </div>-->
        </div>
        
        <div class="row rlink">
            <div class="col-md-6"><p><?php echo $options['copyright']; ?></p></div>
            <div class="col-md-6 text-right">
                    <a href="https://insitech.ae/" target="_blank">Made with love by Insitech <img src="<?php bloginfo('template_directory'); ?>/images/insi.png"> </a></div>
        </div>
        </div>
    </section>
</footer>

</div>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-latest.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/slick.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/particles.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/app.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/wow.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/slider.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/functions.js"></script>
</body></html>

<?php wp_footer(); ?>

