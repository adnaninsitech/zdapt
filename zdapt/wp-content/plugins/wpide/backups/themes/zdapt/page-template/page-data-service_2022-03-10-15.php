<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec96aa2efd9b"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-data-service.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-data-service_2022-03-10-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Data Service & Analytics Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-cloud">
    <div class="container">
        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-duration="2s">
                  <h2><?php the_title(); ?></h2>
            <?php wpautop(the_content()); ?>
            </div>
            <div class="col-md-6 text-right wow fadeInRight" data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
    </div>
</section>


<section class="data-tabbing">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <?php

// Check rows exists.
if( have_rows('list') ):

    // Loop through rows.
   $x=1; while( have_rows('list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        // Do something...
        ?>
        
                <li class="wow fadeInDown" data-wow-duration="<?php echo $x; ?>s"><a href="javascript:;" rel="<?php echo $x; ?>"  class="<?php if($x==1){ ?>active<?php } ?>"><?php echo $title; ?></a></li>
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
            
            <div class="col-md-12">
           
                               <?php

// Check rows exists.
if( have_rows('list') ):

    // Loop through rows.
   $x=1; while( have_rows('list') ) : the_row();

        // Load sub field value.
        $description = get_sub_field('description');
        // Do something...
        ?>
        
                <div class="tab-content cloud-computing wow fadeIn" data-wow-duration="2s" id="tab-content<?php echo $x; ?>" <?php if($x==1){ ?> style="display : block;" <?php } ?>>
                    <?php echo $description; ?>
                </div>
                
                        <?php

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>

             <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Talk to Our Data Experts </a>

                
            </div>
        </div>
    </div>
    
</section>

<?php endwhile; wp_reset_query(); ?>



<div class="main-wrapper">
<?php get_footer(); ?>