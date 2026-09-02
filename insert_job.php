
<?php
if (isset($_POST['submit'])) {
    session_start();

    // تنظيف البيانات
    function clear_input($data) {
        return trim(stripslashes($data));
    }

    // جلب البيانات من النموذج
    $job_title     = clear_input($_POST['txt_job_title']);
    $desciption    = clear_input($_POST['txt_description']);
    $date          = clear_input($_POST['txt_date']);
    $city_id       = (int) clear_input($_POST['txt_city']);
    $country_id    = (int) clear_input($_POST['txt_country']);
    $salary        = (int) clear_input($_POST['txt_sallary']);
    $job_type_id   = (int) clear_input($_POST['txt_type']);
    $company       = clear_input($_POST['txt_company']);
    $job_cat_id    = (int) clear_input($_POST['txt_job_cat']);
    $link          = clear_input($_POST['txt_link']);
    $email         = clear_input($_POST['txt_email']);
    $add_date      = date('Y-m-d H:i:s');

    // الاتصال بقاعدة البيانات
    include "db_conn.php";
    include 'fb/fb_config.php';
    $access_token = include 'fb/fb_token_manager.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // حفظ الوظيفة في جدول jobs
    $sql = "INSERT INTO jobs (
        job_title, desciption, date, city_id, country_id, salary, job_type_id, company, job_cat_id, link, email, add_date
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        header("Location: new-post.php?saved=false&error=prepare_failed");
        exit();
    }

    $stmt->bind_param("sssiisississ", 
        $job_title, $desciption, $date, $city_id, $country_id, $salary, 
        $job_type_id, $company, $job_cat_id, $link, $email, $add_date
    );

    if ($stmt->execute()) {
        $last_job_id = $conn->insert_id;
        $stmt->close();

        // جلب البيانات من View myjobs
        $stmt_view = $conn->prepare("SELECT job_title, company, city_name, name_en, job_cat, salary, currency, job_type FROM myjobs WHERE id = ?");
        $stmt_view->bind_param("i", $last_job_id);
        $stmt_view->execute();
        $stmt_view->bind_result($job_title, $company, $city_name, $country_name, $category_name, $salary, $currency, $job_type);
        $stmt_view->fetch();
        $stmt_view->close();

        // بناء رابط الوظيفة
        $job_link = "https://www.jobs.jobsagent.org/readmore.php?job=".$last_job_id;

        // بناء رسالة فيسبوك
        $message = "📢 فرصة عمل جديدة في {$job_title}!\n"
                 . "💼 الشركة: {$company}\n"
                 . "📂 الفئة: {$category_name}\n"
                 . "🌍 الموقع: {$city_name}، {$country_name}\n"
                 . "💰 الراتب: {$salary} {$currency}\n"
                 . "✨ النوع: {$job_type}\n"
                 . "🔗 للتقديم ومعرفة التفاصيل: {$job_link}\n\n"
                 . "#وظائف_السودان #فرصة_عمل #توظيف #JobsAgent #SudanJobs #وظيفة #"
                 . str_replace(' ', '', $job_title) . " #" . str_replace(' ', '', $company) . "\n"
                 . "لو عجبك البوست اعمل لايك وشير\n\n"
                 . "✅ صفحات التواصل:\n"
                 . "🌐 فيسبوك: https://www.facebook.com/ssDigitalSolutionshardware\n"
                 . "🐦 تويتر: https://x.com/SmeerSalih\n"
                 . "🔗 لينكدإن: https://www.linkedin.com/in/sameersalihabdalla\n"
                 . "🎵 تيك توك: https://www.tiktok.com/@sameersalihabdalla\n"
                 . "📞 واتساب: wa.me/c/249912230352\n"
                 . "💻 الموقع: www.jobs.jobsagent.org\n\n"
                 . "مع تحيات: Sameer Salih Digital Solutions & Hardware";

        // نشر على فيسبوك
        $pages_url = "https://graph.facebook.com/me/accounts?access_token={$access_token}";
        $pages_response = @file_get_contents($pages_url);
        $pages_data = json_decode($pages_response, true);

        $fb_shared = false;
        if (!empty($pages_data['data'])) {
            $page = $pages_data['data'][0];
            $page_id = $page['id'];
            $page_token = $page['access_token'];

            $post_url = "https://graph.facebook.com/{$page_id}/feed";
            $post_data = [
                'message' => $message,
                'access_token' => $page_token
            ];

            $options = [
                'http' => [
                    'method'  => 'POST',
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'content' => http_build_query($post_data),
                    'timeout' => 5
                ]
            ];

            $context = stream_context_create($options);
            $response = @file_get_contents($post_url, false, $context);

            if ($response) {
                $fb_shared = true;
            }
        }

        header("Location: new-post.php?saved=true&fb_shared=" . ($fb_shared ? 'true' : 'false'));
    } else {
        $stmt->close();
        header("Location: new-post.php?saved=false");
    }

    $conn->close();
}
?>
