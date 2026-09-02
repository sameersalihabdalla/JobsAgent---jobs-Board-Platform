<?php

 
require( dirname(__FILE__) . '/wp-load.php' );

?>


<?php

$my_tag = "";
    $add_date = "";
    $date = "";
    $job_title  ="";
    $location   = "";
    $salary     = "";
    $salary_char   = "";
    $email  =   "";
    $url    =   "";
    $company_logo = "";
    $keyword            = "";
    $job_type   = "";
    $job_cat            = "";
    $txt_description    = "";
    $company=   "";



if(isset($_POST['submit'])){

    $my_tag = $_POST['my_tag'];
    $add_date = $_POST['add_date'];
    $dateString = $_POST['my_date'];
$date = new DateTime($dateString);

    $job_title  = $_POST['job_title'];
    $location   = $_POST['location'];
    $salary     = $_POST['salary'];
    $salary_char    = $_POST['salary_char'];
    $email  = $_POST['email'];
    $url    = $_POST['url'];
    $company_logo    = $_POST['img_url'];
    $keyword    = $_POST['keywords'];
    $job_type   = $_POST['job_type'];
    $job_cat    = $_POST['job_cat'];
    $txt_description    = $_POST['txt_description'];
    $company= $_POST['company'];

} 

// Set up the post data
$post_data = array(
    'post_title'    =>$job_title,
    'post_content'  => $txt_description,
    'post_status'   => 'publish',
    'post_author'   => 1, // ID of the author
    'post_type'     => 'job_listing', // Custom post type for job listings
    'meta_input'    => array(
        'job_location'      => $location,
        'job_type'          => $job_type,
        'job_salary'        => $salary,
        'job_company'       => $company,
        'job_company_website' => 'https://www.jobsagent.org',
        'job_company_email' => $email,
        'application_deadline' => $date
    )
);

// Insert the post
$post_id = wp_insert_post($post_data);

if ($post_id > 0) {
    // Set custom fields
    update_post_meta($post_id, '_company_name',$company);
    update_post_meta($post_id, '_job_location', $location);
    update_post_meta($post_id, '_salary', $salary);
    update_post_meta($post_id, '_salary_currency', $salary_char);
    update_post_meta($post_id, '_salary_period', 'month');
    update_post_meta($post_id, '_salary_period', $salary);
    update_post_meta($post_id, '_company_logo', $company_logo);
    update_post_meta($post_id, '_job_type', $job_type);
    update_post_meta($post_id, '_application_deadline',$date);
    update_post_meta($post_id, '_company_tagline',$my_tag);
    if($email=="")
    {
        update_post_meta($post_id, '_application', $url);


    }
    else
    {
        update_post_meta($post_id, '_application', $email);

    }
    //update_post_meta($post_id, '_company_name', 'Jobs agent');

    update_post_meta($post_id, '_company_website', $url);
    update_post_meta($post_id, '_company_twitter', 'SmeerSalih');
    update_post_meta($post_id, '_company_email', $email);
    

   

    // Set taxonomies (categories, tags, etc.)
    wp_set_object_terms($post_id, $job_cat, 'job_category'); // Set job category
    wp_set_object_terms($post_id,$my_tag, 'job_tags'); // Example tags

    echo 'Job post added successfully with ID: ' . $post_id;
} else {
    echo 'Failed to add job post.';
}

?>








