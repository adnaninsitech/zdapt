<?php
/**
 * Template Name: Solutions Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-solutions">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="2s">
            <?php wpautop(the_content()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
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
        
                <li data-wow-duration="<?php echo $x; ?>s"><a href="javascript:;" rel="<?php echo $x; ?>"  class="<?php if($x==1){ ?>active<?php } ?>"><?php echo $title; ?></a></li>
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
            <div class="col-md-5 nopadleft " data-wow-duration="2s">
                <img src="<?php echo $image; ?>">
            </div>
            <div class="col-md-4 " data-wow-duration="2s">
                <h6><?php echo $title; ?></h6>
                <?php echo $content; ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
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


<section class="sol-bottom-content" data-wow-duration="2s">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo the_field('bottom_content', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>

<?php endwhile; wp_reset_query(); ?>



<div class="main-wrapper">
<?php get_footer(); ?>