<?php
/**
 * Template Name: Cloud V2 Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-cloud">
    <div class="container">
        <div class="row">
            <div class="col-md-6 " data-wow-duration="2s">
                  <h2><?php the_title(); ?></h2>
            <?php wpautop(the_content()); ?>
            <?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
            <div class="col-md-6 text-right" data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                      <ul>
                          
                <?php

// Check rows exists.
if( have_rows('accordion_list') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion_list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        
        if($x<=3){
        ?>
            
      
                <li data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?>
                        <?php edit_post_link('edit', '<p>', '</p>'); ?>
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
if( have_rows('accordion_list') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion_list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        
        if($x>3 && $x<=6){
        ?>
            
      
                <li data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?>
                        <?php edit_post_link('edit', '<p>', '</p>'); ?>
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
        
        <div class="row tcont" data-wow-duration="2s" style="display : none;">
           <!-- <div class="col-md-12">
                    <?php //echo the_field('top_content', get_the_ID()); ?>
               </div>-->
<!--                       <div class="col-md-12">
                  <ul>
                          
                <?php

// Check rows exists.
if( have_rows('accordion_list') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion_list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        
        if($x==5){
        ?>
            
      
                <li data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?>
                        <?php edit_post_link('edit', '<p>', '</p>'); ?>
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
            </div>-->
            
                    <div class="row">
            <div class="col-md-6">
                      <ul>
                          
                <?php

// Check rows exists.
if( have_rows('accordion_list') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion_list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        
        if($x==5){
        ?>
            
      
                <li data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?>
                        <?php edit_post_link('edit', '<p>', '</p>'); ?>
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
if( have_rows('accordion_list') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion_list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        
            if($x==6){
        ?>
            
      
                <li data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?>
                        <?php edit_post_link('edit', '<p>', '</p>'); ?>
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
    </div>
</section>


<section class="ex-con" style="background-image : url(<?php bloginfo('template_directory'); ?>/images/c1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-7" data-wow-duration="2s">
                <?php echo the_field('expert_consulting', get_the_ID()); ?>
                <?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>

<section class="ex-con-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <?php

// Check rows exists.
if( have_rows('expert_consulting_bottom_list') ):

    // Loop through rows.
    while( have_rows('expert_consulting_bottom_list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        ?>
          <li data-wow-duration="2s">
              <h6><?php echo $title; ?></h6>
              <?php echo $description; ?>
              <?php edit_post_link('edit', '<p>', '</p>'); ?>
          </li>
        
        <?php

    // End loop.
    endwhile;

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



<section class="ex-con" style="background-image : url(<?php bloginfo('template_directory'); ?>/images/c2.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-7 " data-wow-duration="2s">
                <?php echo the_field('cloud_adoption', get_the_ID()); ?>
                <?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>

<section class="ex-adop-list">
    <div class="container">
           <div class="row why">
            <div class="col-md-12">
                <ul>
                    <?php

// Check rows exists.
if( have_rows('cloud_adoption_bottom_list') ):

    // Loop through rows.
   $x=1; while( have_rows('cloud_adoption_bottom_list') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        ?>
        
        <li  data-wow-duration="2s">
            <a href="javascript:;" rel="<?php echo $x; ?>" class="liq"><?php echo $title; ?> <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
            <div class="desc" id="desc<?php echo $x; ?>">
                <?php echo $description; ?>
                <?php edit_post_link('edit', '<p>', '</p>'); ?>
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

<section class="cloud-computing">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="2s">
                <?php echo the_field('cloud_computing', get_the_ID()); ?>
                <?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>

<section class="cloud-stack">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h2  data-wow-duration="2s">Cloud Stack</h2>
            <div class="imagebox">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg.svg"><!--
                <img src="<?php bloginfo('template_directory'); ?>/images/svg2.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg3.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg4.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg5.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg6.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg7.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg8.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg9.svg">
                <img src="<?php bloginfo('template_directory'); ?>/images/svg10.svg">-->
            </div>
                <!--<img   data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Logo1.jpg">-->
            <!--<div class="slid">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/1-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/2-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/3-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/4-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/5.png">
            </div>-->
            
             <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Talk to a Cloud Expert</a>
            
            <h4  data-wow-duration="2s">Clients</h4>
             <img data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Clind-Logos.png">
        </div>
      </div> 
    </div>
    
</section>

<?php endwhile; wp_reset_query(); ?>



<div class="main-wrapper">
<?php get_footer(); ?>