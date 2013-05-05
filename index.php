<?php
/*
Plugin Name: MuPost
Plugin URI: http://simpl.pro/
Description: Display post of one site to all network sites of Wordpress MU installation
Version: 0.1
Author: Igor Skorjanc
Author URI: http://simpl.pro
License: GPL2
*/

load_plugin_textdomain('simplemupost', false, basename( dirname( __FILE__ ) ) . '/languages' );

add_shortcode('mupost', 'MuPost');


function MuPost( $atts, $content = null ) {
	
	if ($atts['totalposts']==''){
		$numberPost = 5; 
	}else{
		$numberPost = $atts['totalposts']/2;
	}
        if ($atts['order']!=''){
		$order = $atts['order'];
        }else{
		$order = 'desc';
	}	
	
	// MAIN BLOG OF WORDPRESS NETWORK
	$other_blog_id = $atts['blogid'];

	// get posts from current blogd
	$self_posts = get_posts(array(
	    'numberposts' => $numberPost,
	    'cat' => $atts['selfcategoryid'],
	));

	switch_to_blog($other_blog_id);

	// get posts from the other blog
	$other_posts = get_posts(array(
	    'numberposts' => $numberPost,
	    'cat' => $atts['maincategoryid']
	));

	// ok, we're done with that other blog
	restore_current_blog();

	// merge the two arrays
	$posts = array_merge($self_posts, $other_posts);

	function sort_posts_array_by_post_date($a, $b) {
		if ($a->post_date == $b->post_date)
        		return 0;
                return $a->post_date > $b->post_date ? -1 : 1;
	}
        function sort_posts_array_by_post_date_asc($a, $b) {
                if ($a->post_date == $b->post_date)
                        return 0;
                return $a->post_date < $b->post_date ? -1 : 1;
        }
	

        if ($order=='asc')
          usort($posts, 'sort_posts_array_by_post_date_asc');
	else
	  usort($posts, 'sort_posts_array_by_post_date');

                      
	foreach ($posts  as $post){
		$output .= "<article><h2>".$post->post_date." - ".$post->post_title."</h2>";
		$output .= "<p>".$post->post_excerpt."</p>";
		$output .= "<p>".$post->post_content."</p></article>";
	}


	$output .='<pre>blogid: '.$atts['blogid'].' / maincategoryid: '.$atts['maincategoryid'].' totalposts: '.$atts['totalposts'].' '.$atts['order'].'</pre>';


	return $output;
}


?>
