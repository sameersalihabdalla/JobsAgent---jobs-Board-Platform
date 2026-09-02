<?php
session_start();
include "db_conn.php"; // الاتصال بقاعدة البيانات

$status = "";
$alert_class = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = trim($_POST['query']);

    if (!empty($query)) {
        if ($conn->multi_query($query)) {
            do {
                if ($result = $conn->store_result()) {
                    $result->free();
                } else {
                    // تحقق من نوع الاستعلام
                    if (preg_match('/^INSERT INTO jobs/i', $query)) {
                        $job_id = $conn->insert_id;

                        // استخراج بيانات الوظيفة
                        $job_result = $conn->query("SELECT job_title, company, job_cat_id, date FROM jobs WHERE id = $job_id");
                        $job_data = $job_result->fetch_assoc();

                        // نشر على فيسبوك
                        include 'fb/fb_config.php';
                        $access_token = include 'fb/fb_token_manager.php';

                        $pages_url = "https://graph.facebook.com/me/accounts?access_token=" . $access_token;
                        $pages_response = file_get_contents($pages_url);
                        $pages_data = json_decode($pages_response, true);

                        if (!empty($pages_data['data'])) {
                            $page = $pages_data['data'][0];
                            $page_id = $page['id'];
                            $page_token = $page['access_token'];

                            $job_link = "https://www.jobs.jobsagent.org/readmore.php?job=" . $job_id;
                            $message = <<<EOT
📢 تم نشر وظيفة جديدة على JobsAgent.org!

💼 المسمى الوظيفي: {$job_data['job_title']}  
🏢 الشركة: {$job_data['company']}  
🗂️ المجال: {$job_data['job_cat_id']}  
📅 آخر موعد للتقديم: {$job_data['date']}

🔗 التفاصيل والتقديم:
$job_link
EOT;

                            $post_url = "https://graph.facebook.com/{$page_id}/feed";
                            $post_data = [
                                'message' => $message,
                                'access_token' => $page_token
                            ];

                            $options = [
                                'http' => [
                                    'method'  => 'POST',
                                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                    'content' => http_build_query($post_data)
                                ]
                            ];

                            $context = stream_context_create($options);
                            $fb_response = file_get_contents($post_url, false, $context);
                            $fb_data = json_decode($fb_response, true);

                            if (isset($fb_data['id'])) {
                                $status = "✅ تم تنفيذ الاستعلام ونشر الوظيفة على فيسبوك.";
                                $alert_class = "alert-success";
                            } else {
                                $status = "✅ تم تنفيذ الاستعلام، لكن فشل النشر على فيسبوك.";
                                $alert_class = "alert-warning";
                            }
                        } else {
                            $status = "✅ تم تنفيذ الاستعلام، لكن لم يتم العثور على صفحة فيسبوك للنشر.";
                            $alert_class = "alert-warning";
                        }
                    } else {
                        $status = "✅ تم تنفيذ الاستعلام بنجاح.";
                        $alert_class = "alert-success";
                    }
                }
            } while ($conn->next_result());
        } else {
            $status = "❌ خطأ في تنفيذ الاستعلام: " . $conn->error;
            $alert_class = "alert-danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تنفيذ استعلام + نشر على فيسبوك</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      direction: rtl;
      background: #f9f9f9;
      padding: 5vw;
      margin: 0;
    }

    h2 {
      font-size: 5vw;
      margin-bottom: 4vw;
      text-align: center;
    }

    label {
      font-size: 4vw;
      display: block;
      margin-bottom: 2vw;
    }

    textarea {
      width: 100%;
      height: 40vh;
      font-family: monospace;
      font-size: 3.5vw;
      padding: 2vw;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
      resize: vertical;
    }

    button {
      width: 100%;
      padding: 3vw;
      font-size: 4vw;
      margin-top: 3vw;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .alert {
      padding: 3vw;
      margin-top: 4vw;
      border-radius: 5px;
      font-size: 4vw;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
    }

    .alert-warning {
      background: #fff3cd;
      color: #856404;
    }

    .alert-danger {
      background: #f8d7da;
      color: #721c24;
    }
  </style>
</head>
<body>
  <h2>📌 تنفيذ استعلام الوظيفة + نشر تلقائي على فيسبوك</h2>
  <form method="POST">
    <label>📥 الصق استعلام SQL هنا:</label><br>
    <textarea name="query" required placeholder="INSERT INTO jobs (...) VALUES (...)"></textarea><br>
    <button type="submit">تنفيذ الاستعلام ونشر الوظيفة</button>
  </form>

  <?php if (!empty($status)): ?>
    <div class="alert <?= $alert_class ?>"><?= $status ?></div>
  <?php endif; ?>
</body>
</html>
