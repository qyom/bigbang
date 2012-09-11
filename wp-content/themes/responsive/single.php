<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Single Posts Template
 *
 *
 * @file           single.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/single.php
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 * @since          available since Release 1.0
 */

$cat = get_the_right_category(get_the_ID());
$permalink = get_permalink();
?>

<?php get_header(); ?>



<?php
  //if(get_the_category_by_ID( $cat->cat_ID ) == "HOSTS") {
  $hosts_cat_id = get_category_by_slug('hosts')->cat_ID;
   if (cat_is_ancestor_of( $hosts_cat_id, $cat->cat_ID ) ){ 	
   	echo '<div id="host_image_name">';
   $sub_cats = get_categories(array( 'child_of' => $hosts_cat_id, 'hide_empty' => 0, ));     
   if($sub_cats){ 
   foreach($sub_cats as $sub_cat) {
   //echo $sub_cat->term_id.' '.$sub_cat->name.'<br/>'; //sub cat(s)  	  	  	
  	//echo "We are in hosts";
  	 $imageURL = z_taxonomy_image_url( $sub_cat->cat_ID);   	 
     //echo  '<img src="' . $imageURL . '" />';     
     $category_link = get_category_link( $category_id );   
      echo "<div class='host_names'>" . $sub_cat->name . "</div>";     
     ?>     
     <div class="host_images"><a href="<?php echo add_query_arg(array("cat_id" =>$sub_cat->cat_ID), $permalink); ?>" title="Category Name"><img src="<?php echo $imageURL;  ?>" /></a></div>     
     

     
     <?php
     }
   }
   echo "</div>";
 } 
 
?>

		<div class="filterbar">
			<span class="category"><?php echo $cat->name?>:</span> 
			<a href="<?php echo add_query_arg(array("cat_id" => $cat->cat_ID), $permalink)?>" <?php echo (!$_GET['filter'] ? 'class="active"' : '')?>>Recent</a> 
			<a href="<?php echo add_query_arg(array("cat_id" => $cat->cat_ID, "filter"=>"upcoming"), $permalink)?>" <?php echo ($_GET['filter']=='upcoming' ? 'class="active"' : '')?>>Upcoming</a> 
			<a href="<?php echo add_query_arg(array("cat_id" => $cat->cat_ID, "filter"=>'popular'), $permalink)?>" <?php echo ($_GET['filter']=='popular' ? 'class="active"' : '')?>>Popular</a>
			<form action="<?php echo $permalink?>" method="GET" style="display: inline-block">
			<?php wp_dropdown_categories(array('child_of' => get_category_by_slug('_topics')->cat_ID,'selected'=>$_GET['topic'], 'hide_empty' => 0, 'show_option_none'=>'-All Topics-', 'name' => 'topic', 'class' => 'topics'))?>
			<input type="hidden" name="cat_id" value="<?php echo  $cat->cat_ID?>" />
			</form>
			
		</div>
		
        <div id="content" class="grid col-620">
        
<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
        <?php $options = get_option('responsive_theme_options'); ?>
		<?php if ($options['breadcrumb'] == 0): ?>
		<?php echo responsive_breadcrumb_lists(); ?>
        <?php endif; ?> 
          
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
               
                <div class="post-entry">
                 
                
                
                	<?php the_content(__('Read more &#8250;', 'responsive')); ?>
                
                    <?php if(function_exists('the_ratings_V')) { the_ratings_V(get_the_ID()); } ?>
                    
                        
                    <div class="post-meta">
	                <?php 
	                // By  by %3$s meta-prep-author
	                    printf( __( '<span class="%1$s">Posted on</span> %2$s', 'responsive' ),'meta-prep',
			            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
				            get_permalink(),
				            esc_attr( get_the_time() ),
				            get_the_date()
			            ),
			            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				            get_author_posts_url( get_the_author_meta( 'ID' ) ),
				        sprintf( esc_attr__( 'View all posts by %s', 'responsive' ), get_the_author() ),
				            get_the_author()
			                )
				        );
			        ?>
					    <?php if ( comments_open() ) : ?>
	                        <span class="comments-link">
	                        <span class="mdash">&mdash;</span>
	                    <?php comments_popup_link(__('No Comments &darr;', 'responsive'), __('1 Comment &darr;', 'responsive'), __('% Comments &darr;', 'responsive')); ?>
	                        </span>
	                    <?php endif; ?> 
	                </div><!-- end of .post-meta -->
	                
	                <?php /*if ( get_the_author_meta('description') != '' ) : ?>
                    
                    <div id="author-meta">
                    <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>
                        <div class="about-author"><?php _e('About','responsive'); ?> <?php the_author_posts_link(); ?></div>
                        <p><?php the_author_meta('description') ?></p>
                    </div><!-- end of #author-meta -->
                    
                    <?php endif; // no description, no author's meta */?>
                    
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->
                
                <div class="post-data">
				    <?php the_tags(__('Tagged with:', 'responsive') . ' ', ', ', '<br />'); ?> 
					<?php /* printf(__('Posted in %s', 'responsive'), get_the_category_list(', ')); */?> 
                </div><!-- end of .post-data -->             

            <div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div>             
            </div><!-- end of #post-<?php the_ID(); ?> -->
            
			<?php comments_template( '', true ); ?>
            
        <?php endwhile; ?> 

        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div class="navigation">
			<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ) ); ?></div>
            <div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ) ); ?></div>
		</div><!-- end of .navigation -->
        <?php endif; ?>

	    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'responsive'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'responsive'); ?></p>
        <h6><?php _e( 'You can return', 'responsive' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'responsive' ); ?>"><?php _e( '&larr; Home', 'responsive' ); ?></a> <?php _e( 'or search for the page you were looking for', 'responsive' ); ?></h6>
        <?php get_search_form(); ?>

<?php endif; ?>  
      
        </div><!-- end of #content -->
        
        
        <?php show_right_joints($cat); ?>

<?php get_footer(); ?>

