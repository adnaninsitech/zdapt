<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec96aa2efd9b"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/header.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/header_2022-03-10-17.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *

 */
?><!DOCTYPE html>



<html <?php language_attributes(); ?>>


<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

  <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
  <link href="<?php bloginfo('template_directory'); ?>/images/favicon.png" rel="shortcut icon" type="image/x-icon" />
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


  <!-- Google Fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- owl carousel -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/slick.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/slider.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/animate.css" />



  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/fonts/font-awesome/css/font-awesome.css" />
  
  <link crossorigin="anonymous" media="all" integrity="sha512-DErLq3paCmmgCEBV1010baQTFHlti2OVhXaprG3Lq0+mATZ4aRf2cUeGLhlyeTdRcDz6cXO28WuBmVYXXUWzQQ==" rel="stylesheet" href="https://github.githubassets.com/assets/home-0c4acbab7a5a0a69a008.css" />

<script crossorigin="anonymous" defer="defer" type="application/javascript" integrity="sha512-eY2Ruy1Wbhh2EDCI4I14JY43gVjelk0Iobugnxx3iZBfBomq2k41Pnv3RkAuyePDX2f13aKBpe7AaDmpJMNVMg==" src="https://github.githubassets.com/assets/webgl-globe-798d91bb.js"></script>
  




  <link rel="assets" href="https://github.githubassets.com/">


  <?php
  /* We add some JavaScript to pages with the comment form
   * to support sites with threaded comments (when in use).
   */
  if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
  global $options;global $logo;global $copyrite;
  $options = get_option('cOptn');
  $logo = $options['logo'];
  $copyrite = $options['copyrite'];
  $size = 300;
  $options['logo'] = wp_get_attachment_image($logo, array($size, $size), false);
  $att_img = wp_get_attachment_image($logo, array($size, $size), false); 
  $logoSrc = wp_get_attachment_url($logo);
  $att_src_thumb = wp_get_attachment_image_src($logo, array($size, $size), false);

  /* Always have wp_head() just before the closing </head>
   * tag of your theme, or you will break many plugins, which
   * generally use this hook to add elements to <head> such
   * as styles, scripts, and meta tags.
   */
  wp_head();
  
  
  global $more;
  $more = 0;
  ?>

</head>




<body <?php body_class( $class ); ?> > 

<section class="navigationDiv">
      <div class="container-fluid" style="width : 94%;">
          <div class="row">
              <div class="col-md-6">
                  <!--<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/logo.png">-->
                  <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/02/logo.png">
              </div>
              <div class="col-md-6 text-right">
                   <a href="javascript:;" id="sbtn" style="margin-right: 36px;"><img src="<?php bloginfo('template_directory'); ?>/images/search.png" alt=""></a>
            <a href="javascript:;" id="mclose"><img src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/cross.png" alt=""></a>
              </div>
          </div>
          </div>
          <div class="container">
          <div class="row navlist">
              <div class="col-md-6">
                  <div class="box">
                      <div class="cont">
                          <h6>Contact Us</h6>
                          <a href="javascript:;"><?php echo $options['Address']  ?></a>
                          <a href="mailto:<?php echo $options['email']  ?>"><?php echo $options['email']  ?></a>
                      </div>
                       <div class="social">
                           <a href="<?php echo $options['googleplus']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/g.png"></a>
                     <a href="<?php echo $options['linkedin']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/l.png"></a>
                     <a href="<?php echo $options['twitter']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/t.png"></a>
                     <a href="<?php echo $options['facebook']  ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/f.png"></a>
                    
                </div>
                  </div>
              </div>
              <div class="col-md-6">
                   <nav>
              <?php wp_nav_menu(array('menu'=>'Menu 1')); ?> 
            </nav>
              </div>
          </div>
      </div>
  </section>

 <div class="mainwrapper"  id="particles-js" style="background-color: #010222;">

  <header>
    <section class="header ">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <a href="<?php echo site_url(); ?>" class="res" ><?php echo $options['logo']  ?></a>
          </div>
          <div class="col-md-6 text-right sideb">
            <a href="javascript:;" id="sbtn"><img src="<?php bloginfo('template_directory'); ?>/images/search.png" alt=""></a>
            <a href="javascript:;" id="mnu" ><img src="<?php bloginfo('template_directory'); ?>/images/menu.png" alt=""></a>
          </div>
        </div>
      </div>
    </section>
  </header>
  

<?php if(Is_home()|| is_front_page() ) { ?>

  
  <section class="slider">

<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">

    <div class="carousel-inner carousel-zoom">

      <?php $index_query = new WP_Query(array( 'post_type' => 'slider' , 'posts_per_page' => '4' , 'order'=>'asc')); ?>

      <?php $x=1; while ($index_query->have_posts()) : $index_query->the_post(); ?>

        <div class="<?php if($x==1){echo 'active'; } ?> item">
          <img class="img-responsive" src="<?php the_post_thumbnail_url('full'); ?>" >
          <div class="carousel-caption">
               <h2 class="wow fadeInLeft" data-wow-duration="2s"><?php the_title(); ?></h2>
               <div class=" wow fadeInUp" data-wow-duration="7s">
            <?php wpautop(the_content()); ?>
          </div>
            <a href="<?php echo get_site_url(); ?>/about-us/" class="header wow bounceIn" data-wow-duration="6s">Learn MOre</a>

          </div>

 
        </div>

         <?php $x++; endwhile; wp_reset_query(); ?>

       </div>
</div>

</section> 

<?php } else { ?>

 <?php  $page = basename(get_permalink()); ?>
<?php $content = get_posts(array('name' => '"'.$page.'"','post_type' => 'page')); ?>
<?php $title =  get_field('banner_content', get_the_ID()); ?>
<?php $image =  get_field('banner_image', get_the_ID()); ?>


<?php if( empty($image) ){ ?>

<style>section.header{ position : initial; }</style>

<?php } else { ?>

<section class="banner" style="background-image: url(<?php echo $image; ?>);">
   <div class="container">
    <div class="row">
      <div class="box">
        <div class="content">
            <div class="col-md-12">
            <?php if($title != ''){ ?>
            <h2><?php echo $title; ?></h2>
          <?php }else{ ?> 
            <h2><?php the_title(); ?></h2>
          <?php } ?>
            
            </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php } } ?>
 

        

 <div class="main-wrapper">