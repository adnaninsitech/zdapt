<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec1298c2b153"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-index.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-index_2022-03-03-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Home Template
 */

get_header(); ?>
</div>

<div id="particles-js" style="background-color: #010222;" >
    
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        
    <section class="home-help">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class=" wow fadeInDown" data-wow-duration="2s">How we can help you</h1>
                    
                    <ul>
                    
                        <?php

// Check rows exists.
if( have_rows('help_list') ):

    // Loop through rows.
   $x=1; while( have_rows('help_list') ) : the_row();

        // Load sub field value.
        $icon = get_sub_field('icon');
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        
        // Do something...
        ?>
        
          <li class=" wow fadeInDown" data-wow-duration="<?php echo $x; ?>s">
                            <a href="javascript:;" rel="<?php echo $x; ?>" class="liq"><img src="<?php echo $icon; ?>"><span><?php echo $title; ?><i class="fa fa-arrow-down" aria-hidden="true"></i></span></a>
                            <div class="desc" id="desc<?php echo $x; ?>">
                <?php echo $description; ?>
                 <a href="<?php echo get_sub_field('link'); ?>" class="header wow bounceIn">Learn More</a>
            </div>
           
                        </li>
                        
        
        <?php

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>
                      
                        
                    
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
        <?php endwhile; wp_reset_query(); ?>
  
  <?php $index_query = new WP_Query(array( 'post_type' => 'page' , 'page_id' => '99')); ?>

<?php while ($index_query->have_posts()) : $index_query->the_post(); ?>

        <section class="home-poss" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                         <h2 class=" wow fadeInLeft" data-wow-duration="2s"><?php the_title(); ?></h2>
                         <div  class=" wow fadeInLeft" data-wow-duration="4s">
      <?php wpautop(the_content()); ?>
      </div>
      <a href="<?php echo get_site_url(); ?>/about-us/" class=" wow bounceIn" data-wow-duration="6s">Philosophy</a>
                    </div>
                    <div class="">
                        <div class="">
                            <img src="<?php bloginfo('template_directory'); ?>/images/globe.png" id="img1">
                          <!--  <img src="<?php bloginfo('template_directory'); ?>/images/hand.png" id="img2">-->
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

 <?php endwhile; wp_reset_query(); ?>
 
 
  <?php $index_query = new WP_Query(array( 'post_type' => 'page' , 'page_id' => '103')); ?>

<?php while ($index_query->have_posts()) : $index_query->the_post(); ?>

 <section class="home-last-section">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-4 wow fadeInLeft" data-wow-duration="2s"> <img src="<?php the_post_thumbnail_url('full'); ?>"></div>
             <div class="col-md-7">
                  <div  class=" wow fadeInRight" data-wow-duration="2s">
                    <?php wpautop(the_content()); ?>
                    </div>
      <a href="<?php echo get_site_url(); ?>/how-we-wrok/" class=" wow bounceIn" data-wow-duration="2s">HOW WE WORK</a>
             </div>
         </div>
     </div>
 </section>
 
  <?php endwhile; wp_reset_query(); ?>
 
<!--    <section class="home-cap">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1 class="ml11">
                <span class="text-wrapper">
                  <span class="line line1"></span>
                  <span class="letters">CAPABILITIES</span>
                </span>
              </h1>
            </div>
          </div>
          <div class="row">

<?php $index_query = new WP_Query(array( 'post_type' => 'capability' , 'posts_per_page' => '3')); ?>

<?php $x=2; while ($index_query->have_posts()) : $index_query->the_post(); ?>

            <div class="col-md-4">
              <div class="box wow bounceInUp" data-wow-duration="<?php echo $x; ?>s">
                <div class="overlay"></div>
              <div class="image"><img src="<?php the_post_thumbnail_url('full'); ?>"></div>
              <div class="content">
                <h6><?php the_title(); ?></h6>
                <a href=""><img src="<?php bloginfo('template_directory'); ?>/images/ar.png"></a>
              </div>
              </div>
            </div>

            <?php $x++; endwhile; wp_reset_query(); ?>


          </div>
        </div>
    </section>


    <section class="home-client">
      <h3>CAPABILITIES</h3>
      <div class="container">
        <div class="row">
            <div class="col-md-12">
              <h1 class="ml14">
                <span class="text-wrapper">
                  <span class="line line1"></span>
                  <span class="letters">OUR PARTNERS / CLIENTS</span>
                </span>
              </h1>
            </div>

<?php $index_query = new WP_Query(array( 'post_type' => 'page' , 'page_id' => '21')); ?>

<?php while ($index_query->have_posts()) : $index_query->the_post(); ?>

            <div class="col-md-12">
              <ul>
                <?php

// Check rows exists.
if( have_rows('list') ):

    // Loop through rows.
   $x=2; while( have_rows('list') ) : the_row();

        // Load sub field value.
        $images = get_sub_field('image_list');
        // Do something...
        ?>

   <li class="wow bounceInDown" data-wow-duration="<?php echo $x; ?>s"><img src="<?php echo $images; ?>"></li>
        <?php

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>
             
              </ul>
            </div>

<?php endwhile; wp_reset_query(); ?>

          </div>
      </div>
    </section>
-->

</div>


<div class="main-wrapper">
<?php get_footer(); ?>