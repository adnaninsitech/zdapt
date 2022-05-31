<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec96aa2efd9b"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-solutions.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-solutions_2022-03-10-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Solutions Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-solutions">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wow fadeInDown" data-wow-duration="2s">
            <?php wpautop(the_content()); ?>
            </div>
        
        </div>
    </div>
</section>

<section class="data-tabbing soltab" style=" padding: 2% 0 6%;">
    
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
            
        </div>
    </div>
    
</section>

<section class="sol-tab-content">
    <div class="container-fluid">
                                       <?php

// Check rows exists.
if( have_rows('list') ):

    // Loop through rows.
   $x=1; while( have_rows('list') ) : the_row();

        // Load sub field value.
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $content = get_sub_field('content');
        $page_link = get_sub_field('page_link');
        // Do something...
        ?>
        
                <div class="tab-content cloud-computing" id="tab-content<?php echo $x; ?>" <?php if($x==1){ ?> style="display : block;" <?php } ?>>
                    
        <div class="row">
            <div class="col-md-5 nopadleft wow fadeInLeft" data-wow-duration="2s">
                <img src="<?php echo $image; ?>">
            </div>
            <div class="col-md-4 wow fadeInRight" data-wow-duration="2s">
                <h6><?php echo $title; ?></h6>
                <?php echo $content; ?>
                <a href="<?php echo $page_link; ?>">LEARN MORE</a>
            </div>
        </div></div>
        
                                <?php

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>

    </div>
</section>


<section class="sol-bottom-content wow fadeInDown" data-wow-duration="2s">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo the_field('bottom_content', get_the_ID()); ?>
            </div>
        </div>
    </div>
</section>

<?php endwhile; wp_reset_query(); ?>



<div class="main-wrapper">
<?php get_footer(); ?>