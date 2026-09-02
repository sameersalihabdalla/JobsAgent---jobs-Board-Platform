<?php
get_header();
if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                the_content();

                // Retrieve and display custom fields
                $company_name = get_post_meta(get_the_ID(), '_company_name', true);
                $location = get_post_meta(get_the_ID(), '_location', true);
                $salary = get_post_meta(get_the_ID(), '_salary', true);
                $salary_currency = get_post_meta(get_the_ID(), '_salary_currency', true);
                $salary_period = get_post_meta(get_the_ID(), '_salary_period', true);
                $job_type = get_post_meta(get_the_ID(), '_job_type', true);
                $experience_level = get_post_meta(get_the_ID(), '_experience_level', true);
                $application_deadline = get_post_meta(get_the_ID(), '_application_deadline', true);
                $company_logo = get_post_meta(get_the_ID(), '_company_logo', true);

                // Display the custom fields
                if (!empty($company_name)) {
                    echo '<p><strong>اسم الشركة:</strong> ' . esc_html($company_name) . '</p>';
                }
                if (!empty($location)) {
                    echo '<p><strong>الموقع:</strong> ' . esc_html($location) . '</p>';
                }
                if (!empty($salary) && !empty($salary_currency) && !empty($salary_period)) {
                    echo '<p><strong>الراتب:</strong> ' . esc_html($salary_currency) . ' ' . esc_html($salary) . ' per ' . esc_html($salary_period) . '</p>';
                }
                if (!empty($job_type)) {
                    echo '<p><strong>نوع الوظيفة:</strong> ' . esc_html($job_type) . '</p>';
                }
                if (!empty($experience_level)) {
                    echo '<p><strong>مستوى الخبرة:</strong> ' . esc_html($experience_level) . '</p>';
                }
                if (!empty($application_deadline)) {
                    echo '<p><strong>تاريخ نهاية التقديم:</strong> ' . esc_html($application_deadline) . '</p>';
                }
                if (!empty($company_logo)) {
                    echo '<p><strong>شعار الشركة:</strong> <img src="' . esc_url($company_logo) . '" alt="Company Logo" /></p>';
                }
                ?>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
        <?php
    endwhile;
endif;
get_footer();
?>
