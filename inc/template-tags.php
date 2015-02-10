<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gojoseon
 */

if ( ! function_exists( 'gojoseon_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function gojoseon_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
        }
        
        // Better paging navigation found in the Twenty-Fourteen Theme
        $paged          = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link   = html_entity_decode( get_pagenum_link() );
        $query_args     = array();
        $url_parts      = explode( '?', $pagenum_link );
        
        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }
        
        $pagenum_link   = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link   = trailingslashit( $pagenum_link ) . '%_%';
        
        $format  = $GLOBALS[ 'wp_rewrite' ]->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS[ 'wp_rewrite' ]->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
        
        // Set up paginated links.
        $links = paginate_links( array( 
            'base'      => $pagenum_link,
            'format'    => $format,
            'total'     => $GLOBALS[ 'wp_query' ]->max_num_pages,
            'current'   => $paged,
            'mid_size'  => 3,   // This value tells how many numbers to display to the right and left of the current page in paging nav
            'add_args'  => array_map( 'urlencode', $query_args ),
            'prev_text' => __( '&larr; Previous', 'gojoseon' ),
            'next_text' => __( 'Next &rarr;', 'gojoseon' ),
            'type'      => 'list',
        ) );
        
        if ( $links ) :
            
	?>
        <nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'gojoseon' ); ?></h1>
		<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
        
        endif;
}
endif;

if ( ! function_exists( 'gojoseon_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 * 
 * Improve the post_nav() with post thumbnails. Help from this
 * @link: http://www.measureddesigns.com/adding-previous-next-post-wordpress-post/
 * @link: http://wpsites.net/web-design/add-featured-images-to-previous-next-post-nav-links/
 */
function gojoseon_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
        $prevID   = $previous ? $previous->ID : '';
        $nextID   = $next ? $next->ID : '';

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation clear" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'gojoseon' ); ?></h1>
                
                    <?php // My custom code below FIRST, then _s code
                    
                    // PREVIOUS POST LINK
                    if ( ! empty( $previous ) ) { ?>
                    <div class="nav-links-left">
                    
                    <?php if ( ( has_post_thumbnail( $prevID ) && has_post_thumbnail( $nextID ) ) || ( has_post_thumbnail( $prevID ) && empty( $next ) ) ) { ?>
                        <a href="<?php echo get_permalink( $prevID ); ?>" class="nav-previous">
                            <div class="post-nav-thumb">
                                <?php $prev_thumb = get_the_post_thumbnail( $prevID, 'medium', array( 'class' => 'img-responsive' ) );
                                echo $prev_thumb ? $prev_thumb : '<img src="http://localhost:8080/wordpress/wp-content/uploads/2012/08/cropped-keytokorean-logo2.png" />';
                                ?>
                            </div>
                        </a>
                    <?php } ?>
                    
                    <div class="post-nav-link">
                        <p><i class="fa fa-arrow-left"></i> Previous Post</p>
                        <h2><a href="<?php echo get_permalink( $prevID ); ?>"><?php echo $previous->post_title; ?></a></h2>
                    </div>
                    </div>
                    <?php } 
                    
                    // NEXT POST LINK
                    if ( ! empty( $next ) ) { ?>
                    <div class="nav-links-right">
                    
                    <?php if ( get_the_post_thumbnail( $nextID ) && get_the_post_thumbnail( $nextID ) ) { ?>
                        <a href="<?php echo get_permalink( $nextID ); ?>" class="nav-next">
                            <div class="post-nav-thumb">
                                <?php $next_thumb = get_the_post_thumbnail( $nextID, 'medium', array( 'class' => 'img-responsive' ) );
                                echo $next_thumb ? $next_thumb : '<img src="http://localhost:8080/wordpress/wp-content/uploads/2012/08/cropped-keytokorean-logo2.png" />';
                                ?>
                            </div>
                        </a>
                    <?php } ?>
                    
                    <div class="post-nav-link">
                        <p>Next Post <i class="fa fa-arrow-right"></i></p>
                        <h2><a href="<?php echo get_permalink( $nextID ); ?>"><?php echo $next->post_title; ?></a></h2>
                    </div>
                    </div>
                        <?php } ?>
                    
                        <?php /*
				previous_post_link( '<div class="nav-previous large-6 columns">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'gojoseon' ) );
				next_post_link( '<div class="nav-next large-6 columns">%link</div>', _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'gojoseon' ) );
			*/ ?>
                
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'gojoseon_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gojoseon_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'gojoseon' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'Written by %s', 'post author', 'gojoseon' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . ucwords( esc_html( get_the_author() ) ) . '</a></span>'
	);
        
        // Post Meta
        echo '<div id="header-meta">';
        echo '<div class="posted-on">' . $posted_on . '</div>';
        
        if ( !is_home() && !is_archive() && !is_search() && !is_404() ) {
            echo '<div class="byline">' . $byline . '</div>';
            echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span class="author-image">' . get_avatar( get_the_author_meta( 'ID' ), 64 ) . '</span></a>';
        }
            
        // Comments
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<div class="comments-link"><i class="fa fa-comment"></i>';
		comments_popup_link( __( 'Leave a comment', 'gojoseon' ), __( '1 Comment', 'gojoseon' ), __( '% Comments', 'gojoseon' ) );
		echo '</div>';
	}
        
        echo '</div><!-- #header-meta -->';
        
        //if ( function_exists( 'sharing_display' ) ) { sharing_display( '', true ); }
        //else { gojoseon_social_sharing_buttons(); }

}
endif;

if ( ! function_exists( 'gojoseon_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function gojoseon_entry_footer() {
    
        edit_post_link( __( 'Edit', 'gojoseon' ), '<span class="edit-link bottom-edit-link">', '</span>' );
	
// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
            echo '<div class="footer-meta">';
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( '</li><li>', 'gojoseon' ) );
		if ( $categories_list && gojoseon_categorized_blog() ) {
			printf( '<div class="cat-links">' . __( '<h1><i class="fa fa-folder-open"></i> Topics:</h1><ul><li>%1$s', 'gojoseon' ) . '</li></ul></div>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		echo get_the_tag_list( '<div class="tag-links"><h1><i class="fa fa-tag"></i> Keywords:</h1><ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul></div>' );
	
                if ( function_exists( 'sharing_display' ) ) { sharing_display( '', true ); }
                else {
                    echo '<div class="share-links"><h1><i class="fa fa-share"></i> Share:</h1><div>';
                        gojoseon_social_sharing_buttons();
                    echo '</div></div>';
                }
            echo '</div>';
        }

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'gojoseon' ), __( '1 Comment', 'gojoseon' ), __( '% Comments', 'gojoseon' ) );
		echo '</span>';
	}
       
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Posts in the %s category:', 'gojoseon' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Posts with the %s tag:', 'gojoseon' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Posts written by %s', 'gojoseon' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Posts from %s', 'gojoseon' ), get_the_date( _x( 'Y', 'yearly archives date format', 'gojoseon' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Posts from %s', 'gojoseon' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'gojoseon' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Posts from %s', 'gojoseon' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'gojoseon' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'gojoseon' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'gojoseon' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'gojoseon' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'gojoseon' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'gojoseon' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function gojoseon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'gojoseon_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'gojoseon_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so gojoseon_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so gojoseon_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in gojoseon_categorized_blog.
 */
function gojoseon_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'gojoseon_categories' );
}
add_action( 'edit_category', 'gojoseon_category_transient_flusher' );
add_action( 'save_post',     'gojoseon_category_transient_flusher' );


/**
 * -----------------------------------------------------------------------------
 * My custom functions below
 * -----------------------------------------------------------------------------
 */

/**
 * Custom Breadcrumbs
 * 
 * @link: http://thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 */
function the_breadcrumb() {
    global $post;
    
    if ( !is_home() ) {
        echo '<ul id="breadcrumbs" class="breadcrumbs">';
        echo '<li><a href="';
        echo get_option( 'home' );
        echo '">';
        echo 'Home';
        echo '</a></li>';
        
        if ( is_category() || is_single() ) {
            echo '<li>';
            the_category('</li><li>');
            if ( is_single() ) {
                echo '</li><li>';
                the_title();
                echo '</li>';
            }
        } else if ( is_page() ) {
            if( $post->post_parent ) {
                $ancestors = get_post_ancestors( $post->ID );
                $title = get_the_title();
                
                foreach ( $ancestors as $ancestor ) {
                    $output = '<li><a href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li></li>';    
                }
                
                echo $output;
                echo '<strong title="' . $title . '"> ' . $title . '</strong>';
            } else {
                echo '<li><strong> ' . get_the_title() . '</strong></li>';
            }
        } 
        else if ( is_tag() ) { single_tag_title(); }
        else if ( is_day() ) { echo "<li>Archive for "; the_time( 'F jS, Y' ); echo '</li>'; }
        else if ( is_month() ) { echo "<li>Archive for "; the_time( 'F, Y' ); echo '</li>'; }
        else if ( is_year() ) { echo "<li>Archive for "; the_time( 'Y' ); echo '</li>'; }
        else if ( is_author() ) { echo "<li>Author Archive"; echo '</li>'; }
        else if ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) { echo "<li>Blog Archives"; echo '</li>'; }
        else if ( is_search() ) { echo "<li>Search Results"; echo '</li>'; }
        
        echo '</ul>';
    }
}

/**
 * Fancy excerpts
 * 
 * @link: http://wptheming.com/2015/01/excerpt-versus-content-for-archives/
 */
function the_fancy_excerpt() {
    global $post;
    if (has_excerpt() ) :
        the_excerpt();
    elseif ( @strpos( $post->post_content, '<!--more-->' ) ) :
        the_content();
    elseif ( str_word_count( $post->post_content ) < 200 ) :
        the_content();
    else :
        the_excerpt();
    endif;
}

/**
 * Quick menu function
 */
function gojoseon_quick_menu() {
    if ( has_nav_menu ( 'quick' ) ) {
        wp_nav_menu(
                array(
                    'theme_location'    => 'quick',
                    'container'         => 'div',
                    'container_id'      => 'menu-quick',
                    'container_class'   => 'menu-quick',
                    'menu_id'           => 'menu-quick-items',
                    'menu_class'        => 'menu-items quick',
                    'depth'             => 3,
                    'link_before'       => '',
                    'link_after'        => '',
                    'fallback_cb'       => '',
                    'walker'            => new Gojoseon_Quick_Menu_Walker(),
                )
        );
    }
}

/**
 * Primary Menu (uses Foundation's Off-canvas menu
 */
function gojoseon_primary_menu() {
    if ( has_nav_menu ( 'primary' ) ) {
        wp_nav_menu(
                array(
                    'theme_location'    => 'primary',
                    'container'         => 'div',
                    'container_id'      => '',
                    'container_class'   => 'left-off-canvas-menu primarymenu-list',
                    'menu_id'           => '',
                    'menu_class'        => 'off-canvas-list',
                    'depth'             => 3,
                    'link_before'       => '',
                    'link_after'        => '',
                    'fallback_cb'       => '',
                    'walker'            => new Gojoseon_Foundation_Menu_Walker(),
                )
        );
    }
}

/**
 * Social media icon menu 
 * 
 * @link: http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 */
function gojoseon_social_menu() {
    if ( has_nav_menu( 'social' ) ) {
        wp_nav_menu(
                array(
                    'theme_location'    => 'social',
                    'container'         => 'div',
                    'container_id'      => 'menu-social',
                    'container_class'   => 'menu-social',
                    'menu_id'           => 'menu-social-items',
                    'menu_class'        => 'menu-items',
                    'depth'             => 1,
                    'link_before'       => '<span class="screen-reader-text">',
                    'link_after'        => '</span>',
                    'fallback_cb'       => '',
                )   
        );
    }
}

/**
 * Social Sharing buttons in Single Posts
 * 
 * @link: http://kikolani.com/social-sharing-buttons-in-single-post-templates.html
 */
function gojoseon_social_sharing_buttons() {
    
    if( !is_home() ) {
    
    ?>
    <div class="social-sharing">
    <!-- TWITTER -->
    <div id="tweetthis">
        <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
        <div>
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="jekkilekki" data-size="medium">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </div>
    </div>
            
    <!-- FACEBOOK -->
    <div id="likethis">
        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo rawurlencode( get_permalink() ); ?>&layout=button_count&show_faces=false&&share=true&width=100&action=like&font=verdana&colorscheme=light&height=21" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 100px;; height: 21px;" allowTransparency="true">
        </iframe>
    </div>
    
    <!-- GOOGLE+ -->
    <div id="plusonethis">
        <g:plusone size="medium"></g:plusone>
    </div>
    
    <!-- LINKEDIN -->
    <div id="linkthisin">
        <script type="text/javascript" src="http://platform.linkedin.com/in.js"></script>
        <script type="in/share" data-counter="right"></script>
    </div>
    
    <!-- STUMBLEUPON -->
    <div id="stumblethis">
        <script src="http://www.stumbleupon.com/hostedbadge.php?s=1"></script>
    </div>
    
    <!-- PINTEREST -->
    
    <!-- REDDIT -->
    
    <!-- DIGG -->
    
    <!-- EMAIL -->
    
    </div>

    <?php  }
}

/**
 * Get the first image of a post if there's no featured image set
 * 
 * @link: http://www.wprecipes.com/how-to-get-the-first-image-from-the-post-and-display-it
 */
function get_the_first_image() {
    global $post, $posts;
    
    $first_img = '';
    
    ob_start();
    ob_end_clean();
    
    $output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
    $first_img = ( !empty ( $matches [1] [0] ) ) ? $matches [1] [0] : '';
    
    if( empty( $first_img ) ) { // Defines a default image
        // $first_img = get_template_directory_uri() . '/images/contemporary_china.png';
    }
    
    return $first_img;
}

/**
 * Get Stickies as "Featured Posts"
 * 
 * @link: http://blog.josemcastaneda.com/2013/05/10/creating-a-sticky-post-slider/
 */
function gojoseon_featured_posts( $stickies ) {
    
    // STICKY POSTS stick them to the top            
    // How many are there?
    $count = count( $stickies );

    // Create a set of arguments to pass
    $args = array(
        'post__in'  => $stickies,
        // 'posts_per_page' => 3, commented out so it displays all
        'post_type' => 'post',
        'nopaging'  => true,
    );
    $featured = new WP_Query( $args );

    // If there is one or more sticky posts, we create our slider
    if ( $count > 0 ) : ?>

    <section class="featured-post" id="featured-slider">
        
        <?php while( $featured->have_posts() ) : $featured->the_post(); ?>
        
        <article <?php post_class( 'featured' ); ?> id="post-<?php the_ID(); ?>">
        
        <?php
        // Post thumbnail
        echo '<div class="single-post-thumbnail clear">';
        echo '<a href="' . get_permalink() . '" title="' . __( 'Read the article ', 'gojoseon' ) . get_the_title() . '" rel="bookmark">';
        if ( has_post_thumbnail() ) {
            echo the_post_thumbnail( 'large-thumb' );
        } else {
            echo '<img src="' . get_the_first_image() . '" />';
        }
        echo '</a>';
        echo '<div id="count"><i class="fa fa-thumb-tack"></i> Featured Post ' . $count . '</div>';
        echo '</div>'; 
        
        ?>
        
        <div class="featured-article">
            <header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gojoseon_posted_on(); ?>
                        <?php edit_post_link( __( 'Edit', 'gojoseon' ), '<span class="edit-link top-edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
            </header><!-- .entry-header -->
        
            <div class="entry-content"><?php the_excerpt(); ?></div>
            <div class="content"><?php wp_link_pages(); ?></div>
            <footer class="footer-meta continue-reading">
                <?php echo '<a href="' . get_permalink() . '" title="' . __( 'Continue Reading ', 'gojoseon' ) . get_the_title() . '" rel="bookmark">Continue Reading<i class="fa fa-arrow-right"></i></a>'; ?>
            </footer>
        </div>
        </article>
        
        <hr class="thick" />

        <?php endwhile; wp_reset_query(); ?>
    </section><!-- .featured -->

    <?php endif; // end of the featured posts
}