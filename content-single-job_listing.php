<?php
/**
 * Single Job Listing Content Template
 *
 * @package WP_Job_Manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="job_listing_header">
        <h1 class="job_listing_title"><?php the_title(); ?></h1>

        <?php the_company_logo(); ?>

        <div class="job_listing_meta">
            <?php the_company_name( '<strong class="company">', '</strong>' ); ?>
            <?php the_job_location( '<span class="location">', '</span>' ); ?>
            <span class="job_type"><?php the_job_type(); ?></span>
        </div>
    </header>

    <div class="job_listing_description">
        <?php echo wpautop( wptexturize( $post->post_content ) ); ?>
    </div>

    <footer class="job_listing_footer">
        <ul class="job_listing_meta_list">
            <li><?php _e( 'Posted on', 'wp-job-manager' ); ?>: <?php the_job_publish_date(); ?></li>
            <li><?php _e( 'Job Category', 'wp-job-manager' ); ?>: <?php the_job_category(); ?></li>
            <li><?php _e( 'Company Website', 'wp-job-manager' ); ?>: <?php the_company_website(); ?></li>
        </ul>
    </footer>

    <div class="job_application">
        <?php get_job_manager_template( 'job-application.php' ); ?>
    </div>

</article>
