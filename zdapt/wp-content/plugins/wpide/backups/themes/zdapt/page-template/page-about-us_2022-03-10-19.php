<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec92637412ec"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-about-us.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-about-us_2022-03-10-19.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: About Template
 */

get_header(); ?>
</div>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-about">
    <div class="container">
        <div class="row">
            <div class="col-md-12" data-wow-duration="2s">
                <?php wpautop(the_content()); ?>
            </div>
        </div>
        
        <div class="row">
            
            <h1  data-wow-duration="2s">Key Facts <span>About Us</span></h1>
            
            <?php

// Check rows exists.
if( have_rows('key_facts') ):

    // Loop through rows.
   $x=2; while( have_rows('key_facts') ) : the_row();

        // Load sub field value.
        $year = get_sub_field('year');
        $title = get_sub_field('title');
        // Do something...
        ?>
        
             <div class="col-md-4 " data-wow-duration="<?php echo $x; ?>s">
                 <div class="box">
                     <h5><?php echo $year; ?></h5>
                     <p><?php echo $title; ?></p>
                 </div>
             </div>
             
        <?php

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>
       
            
        </div>
        
        
        <div class="row why">
            <div class="col-md-12">
                <h1 data-wow-duration="2s"><span>Why work with us</span></h1>
                <ul>
                    <?php

// Check rows exists.
if( have_rows('list') ):

    // Loop through rows.
   $x=1; while( have_rows('list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        ?>
        
        <li data-wow-duration="2s">
            <a href="javascript:;" rel="<?php echo $x; ?>" class="liq"><?php echo $title; ?> <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
            <div class="desc" id="desc<?php echo $x; ?>">
                <?php echo $description; ?>
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
        
        
        <div class="row our-industry">
            <div class="col-md-12">
                 <h1  data-wow-duration="2s"><span>Our industry focus</span></h1>
                 <div  data-wow-duration="2s">
                 <h4><?php

// Check rows exists.
if( have_rows('industry_focus') ):

    // Loop through rows.
    while( have_rows('industry_focus') ) : the_row();

        // Load sub field value.
        $icon = get_sub_field('icon');
        $title = get_sub_field('title');
        // Do something...
        ?><?php echo $title; ?><span><img src="<?php echo $icon; ?>"></span><?php

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?></h4></div>
            </div>
        </div>
        
        <div class="row powerful">
            
            <div class="col-md-12">
                <h1 data-wow-duration="2s"><span><?php echo the_field('middle_description', get_the_ID()); ?></span></h1>
            </div>
                 
        </div>
        
<?php

// Check rows exists.
if( have_rows('powerful_values') ):

    // Loop through rows.
   $i=0; while( have_rows('powerful_values') ) : the_row();

        // Load sub field value.
        $image = get_sub_field('image');
        $description = get_sub_field('description');
        // Do something...
          if ($i % 2 == 0){
        ?>
 
         <div class="row powerlist">
           
            <div class="col-md-6 " data-wow-duration="2s">
                <?php echo $description; ?>
            </div>
             <div class="col-md-6 text-left " data-wow-duration="2s">
                <img src="<?php echo $image; ?>">
            </div>
        </div>
        <?php } else { ?>
         <div class="row powerlist">
               <div class="col-md-6 text-right " data-wow-duration="2s">
                <img src="<?php echo $image; ?>">
            </div>
           
            <div class="col-md-6 " data-wow-duration="2s">
                <?php echo $description; ?>
            </div>
           
        </div>
        
        <?php } ?>
        
        <?php

    // End loop.
  $i++;  endwhile;

// No value.
else :
    // Do something...
endif;
?>
        

        
    </div>
</section>
            
            
<?php endwhile; wp_reset_query(); ?>

<?php $index_query = new WP_Query(array( 'post_type' => 'page' , 'page_id' => '84')); ?>

<?php while ($index_query->have_posts()) : $index_query->the_post(); ?>

<section class="people-focused" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="2s">
                     <h2><?php the_title(); ?></h2>
      <?php wpautop(the_content()); ?></br></br></br>
      <!--<a href="https://www.linkedin.com/in/jeffrey-attoh-053a91198" target="_blank">MEET THE TEAM</a>-->
            </div>
        </div>
    </div>
</section>
        
<?php endwhile; wp_reset_query(); ?>

<div class="main-wrapper">
<?php get_footer(); ?>