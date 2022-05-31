<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec1298c2b153"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-how-we-work.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-how-we-work_2022-03-03-16.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: How we work Template
 */

get_header(); ?>
</div>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


<section class="main-how">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="tabdiv wow fadeInDown" data-wow-duration="2s">
                    <li><a href="javascript:;" rel="1" class="active">Agile</a></li>
                    <li><a href="javascript:;"  rel="2">Waterfall</a></li>
                </ul>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <?php

// Check rows exists.
if( have_rows('agile_&_waterfall') ):

    // Loop through rows.
   $x=1; while( have_rows('agile_&_waterfall') ) : the_row();

        // Load sub field value.
        $description = get_sub_field('description');
        // Do something...
        ?>
        <?php  if($x==1){ ?>
        <div class="tabcontent wow fadeInUp" data-wow-duration="2s" style="display : block;" id="cont<?php echo $x; ?>">
            <?php } else{ ?>
            <div class="tabcontent" id="cont<?php echo $x; ?>">
            <?php } ?>
            <?php echo $description; ?>
        </div>
        
        <?php

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif; ?>
            </div>
        </div>
    </div>
</section>


<section class="models">
    <div class="container">
        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-duration="2s">
                <?php echo the_field('engagemode', get_the_ID()); ?>
            </div>
        </div>
        
                <div class="row why">
            <div class="col-md-12">
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
        
        <li class="wow fadeInDown" data-wow-duration="2s">
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
    </div>
</section>

<section class="compar">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center"><h1>Comparison of engagement models</h1></div>
        </div>
        <div class="row">
            <div class="col-md-3 wow fadeInDown" data-wow-duration="2s"><h4>Features</h4></div>
            <div class="col-md-3 wow fadeInDown" data-wow-duration="4s"><h4>Fixed Price</h4></div>
            <div class="col-md-3 wow fadeInDown" data-wow-duration="6s"><h4>Time & Materials</h4></div>
            <div class="col-md-3 wow fadeInDown" data-wow-duration="8s"><h4>Dedicated Team</h4></div>
        </div>
        
        <div class="row flist">
            
            <?php

// Check rows exists.
if( have_rows('feature_list') ):

    // Loop through rows.
    while( have_rows('feature_list') ) : the_row();

        // Load sub field value.
        $features = get_sub_field('features');
        $fixed_price = get_sub_field('fixed_price');
        $time_materials = get_sub_field('time_&_materials');
        $dedicated_team = get_sub_field('dedicated_team');
        // Do something...
        ?>
        
            <div class="col-md-3 wow fadeInDown" data-wow-duration="2s"><p><?php echo $features; ?></p></div>
            <div class="col-md-3 wow fadeInDown" data-wow-duration="2s"><p><?php echo $fixed_price; ?></p></div>
            <div class="col-md-3 wow fadeInDown" data-wow-duration="2s"><p><?php echo $time_materials; ?></p></div>
            <div class="col-md-3 wow fadeInDown" data-wow-duration="2s"><p><?php echo $dedicated_team; ?></p></div>
        
        
        <?php

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?>

        </div>
        
        
        
    </div>
</section>

            
<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>