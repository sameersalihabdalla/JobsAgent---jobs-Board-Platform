<style>

.job-listings {
    list-style: none;
    padding: 0;
}

.job-listing {
    margin-bottom: 10px;
}

.job-listing a {
    text-decoration: none;
    color: #0073aa;
}

.job-listing a:hover {
    text-decoration: underline;
    color: #005177;
}


</STYLE>


<?php
/*
Plugin Name: Custom Job Widget
Description: Widget to display job listings from WP Job Manager.
*/

class Custom_Job_Widget extends WP_Widget {

    // Initialize the widget
    function __construct() {
        parent::__construct(
            'custom_job_widget', // Base ID
            __('Custom Job Widget', 'text_domain'), // Name
            array( 'description' => __( 'Displays job listings', 'text_domain' ), ) // Args
        );
    }

    // Widget output
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        // Fetch and display job listings
        $query_args = array(
            'post_type' => 'job_listing',
            'posts_per_page' => 5, // Number of jobs to display
        );
        $jobs = new WP_Query( $query_args );
        if ( $jobs->have_posts() ) {
            echo '<ul class="job-listings">';
            while ( $jobs->have_posts() ) : $jobs->the_post();
                echo '<li class="job-listing">';
                echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                echo '</li>';
            endwhile;
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '<p>' . __( 'No job listings found.', 'text_domain' ) . '</p>';
        }

        echo $args['after_widget'];
    }

    // Widget settings
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Job Listings', 'text_domain' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    }

    // Save widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        return $instance;
    }
}

// Register the widget
function register_custom_job_widget() {
    register_widget( 'Custom_Job_Widget' );
}
add_action( 'widgets_init', 'register_custom_job_widget' );
?>
