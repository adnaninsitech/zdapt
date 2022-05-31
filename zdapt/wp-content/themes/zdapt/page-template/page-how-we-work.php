<?php
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
                <ul class="tabdiv" data-wow-duration="2s">
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
        <div class="tabcontent" data-wow-duration="2s" style="display : block;" id="cont<?php echo $x; ?>">
            <?php } else{ ?>
            <div class="tabcontent" id="cont<?php echo $x; ?>">
            <?php } ?>
            <?php echo $description; ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
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
            <div class="col-md-6" data-wow-duration="2s">
                <?php echo the_field('engagemode', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
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
        
        <li  data-wow-duration="2s">
            <a href="javascript:;" rel="<?php echo $x; ?>" class="liq"><?php echo $title; ?> <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
            <div class="desc" id="desc<?php echo $x; ?>">
                <?php echo $description; ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
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
<!--        <div class="row">
            <div class="col-md-3 " data-wow-duration="2s"><h4>Features</h4></div>
            <div class="col-md-3 " data-wow-duration="4s"><h4>Fixed Price</h4></div>
            <div class="col-md-3 " data-wow-duration="6s"><h4>Time & Materials</h4></div>
            <div class="col-md-3 " data-wow-duration="8s"><h4>Dedicated Team</h4></div>
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
        
            <div class="col-md-3 " data-wow-duration="2s"><p><?php echo $features; ?></p></div>
            <div class="col-md-3 " data-wow-duration="2s"><p><?php echo $fixed_price; ?></p></div>
            <div class="col-md-3 " data-wow-duration="2s"><p><?php echo $time_materials; ?></p></div>
            <div class="col-md-3 " data-wow-duration="2s"><p><?php echo $dedicated_team; ?></p></div>
        
        
        <?php

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?>

        </div>-->
        
        
        <div class="row">
            
            <div class="col-md-12">
               <div class="table-responsive">
                     <table id="mytsable" class="table">
  <tr>
    <th>Features</th>
    <th>Fixed Price</th>
    <th>Time & Materials</th>
    <th>Dedicated Team</th>
  </tr>
  
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
        
  <tr>
    <td><?php echo $features; ?><?php edit_post_link('edit', '<p>', '</p>'); ?></td>
    <td><?php echo $fixed_price; ?><?php edit_post_link('edit', '<p>', '</p>'); ?></td>
    <td><?php echo $time_materials; ?><?php edit_post_link('edit', '<p>', '</p>'); ?></td>
    <td><?php echo $dedicated_team; ?><?php edit_post_link('edit', '<p>', '</p>'); ?></td>
  </tr>
  
          <?php

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?>

</table>
               </div>
            </div>
            
        </div>
        
        
        
    </div>
</section>

            
<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>