<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec96aa2efd9b"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-devops.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-devops_2022-03-10-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Devops Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-cloud">
    <div class="container">
        <div class="row">
             <div class="col-md-6" data-wow-duration="2s">
                  <h2><?php the_title(); ?></h2>
            <?php wpautop(the_content()); ?>
            </div>
            <div class="col-md-6 text-right " data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
        
    </div>
</section>

<section class="cloud-computing devopsmain">
    <div class="container">
        <div class="row">
            <div class="col-md-12" data-wow-duration="2s">
                <?php echo the_field('description', get_the_ID()); ?>
            </div>
        </div>
    </div>
</section>

<section class="devhelp" style="background-image:url(<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/bg-3.png);">
       <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="2s">
                <?php echo the_field('helped_companies', get_the_ID()); ?>
            </div>
        </div>
    </div>
</section>


<section class="main-cloud devaccord">
    <div class="container">
        
        <div class="row">
            <div class="col-md-6">
                      <ul>
                          
                <?php

// Check rows exists.
if( have_rows('accordion') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('ttitle');
        $description = get_sub_field('description');
        // Do something...
        
        if($x<=2){
        ?>
            
      
                <li  data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?>
                    </div>
                </li>
        
        
        <?php
        }

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>    </ul>
            </div>
            <div class="col-md-6">
                  <ul>
                          
                <?php

// Check rows exists.
if( have_rows('accordion') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('ttitle');
        $description = get_sub_field('description');
        // Do something...
        
        if($x>2){
        ?>
            
      
                <li  data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?>
                    </div>
                </li>
        
        
        <?php
        }

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>    </ul>
            </div>
        </div>
    </div>
</section>

<section class="cloud-stack">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h2  data-wow-duration="2s">DevOps Stack</h2>
          <img   data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Color-Logos.jpg">
        <!-- <div class="slid">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/1-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/2-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/3-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/4-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/5.png">
            </div>-->
            
            <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Schedule a DevOps Consultation</a>
            
            <h4   data-wow-duration="2s">Clients</h4>
             <img   data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/c.jpg">
        </div>
      </div> 
    </div>
    
</section>

<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>