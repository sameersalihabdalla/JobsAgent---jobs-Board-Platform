<!DOCTYPE html>
<?php 
$title = "";
$keywords = "";
$desc = "";   
include("texts.php");   
?>
<html lang="<?= isset($language_ch) ? $language_ch : 'ar' ?>" dir="<?= isset($direction) ? $direction : 'rtl' ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta property="og:type" content="Article"> 

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    brand: { 50: '#f0fdf4', 500: '#22c55e', 600: '#16a34a', 700: '#15803d', 900: '#14532d' }
                }
            }
        }
    }
</script>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Cairo', sans-serif; }
</style>

<?php
if (isset($_GET['job'])) { 
    echo '<meta property="og:image" content="https://www.jobsagent.org/images/img'.htmlspecialchars($_GET['job']).'.png">';
} else {
    echo '<meta property="og:image" content="https://www.jobsagent.org/img/android-chrome-192x192.png">';
}
?>
<meta property="og:url" content="https://<?php echo htmlspecialchars($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">

<?php
function limitWords($text, $limit) {
    $word_arr = explode(" ", $text);
    if (count($word_arr) > $limit) {
        return implode(" ", array_slice($word_arr, 0, $limit));
    }
    return $text;
}

function clear_input($data) {
    $data = preg_replace('#<[^>]+-0123456789()>#', ' ', $data);         
    $data = trim($data, "\t\n\r\0\x0B\xC2\xA0");
    $data = trim(html_entity_decode($data), " \t\n\r\0\x0B\xC2\xA0");
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars_decode($data);
    return htmlspecialchars($data);
}

$mydate = "";
include('db_conn.php');

if (isset($_GET['job'])) {
    $goal = intval($_GET['job']);
    $sql = "SELECT * FROM myjobs WHERE id = " . $goal;  
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['job_title'];
            $mydate = $row['date'];
            $keywords .= $row['job_title'] . ' ' . limitWords($row['desciption'], 12) . ' ' . $row['name'] . ' ' . $row['city_name'] . ' ' . $row['job_type'];
            $keywords = str_replace(" ", ",", $keywords);
            $desc = $row['job_title'] . ',' . $row['job_cat_en'] . ' : ' . $row['name_en'] . '' . $row['city_name'];
        }
    }

    $redirect_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    if (!empty($_POST['image'])) {
        $string = str_replace('data:image/png;base64,', '', $_POST['image']);
        file_put_contents('./images/img' . $goal . '.png', base64_decode($string));
        header('Location: ' . $redirect_url);
        exit;
    }
}
?>
<meta name="description" content="<?= htmlspecialchars($title); ?><?php echo clear_input($desc); ?>">
<meta name="keywords" content="<?= htmlspecialchars($title); ?><?php echo clear_input($keywords); ?>">
<meta property="article:published_time" content="<?php echo htmlspecialchars($mydate); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@SmeerSalih">

<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.7/dist/html2canvas.min.js"></script>

<?php include("meta.php"); ?>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

<?php include("menu.php"); ?>

<!-- Hero Section -->
<div class="relative bg-cover bg-center py-20" style="background-image: url('images/bg_1.jpg');">
    <div class="absolute inset-0 bg-slate-900/75"></div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <p class="text-sm mb-2 text-emerald-400 font-semibold">
            <a href="/" class="hover:underline">Home</a> &larr; <span><?= isset($Job_Details) ? $Job_Details : 'تفاصيل الوظيفة' ?></span>
        </p>
        <h1 class="text-3xl md:text-4xl font-black"><?= htmlspecialchars($title) ?></h1>
    </div>
</div>

<section class="py-12 bg-gray-50">
<div class="container mx-auto px-4">

<!-- Google AdSense -->
<div class="text-center mb-8">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9114422406437922" crossorigin="anonymous"></script>
    <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-9114422406437922" data-ad-slot="6956316898"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>

<?php
$out_id = 0;
if (isset($_GET['job'])) {
    $goal = intval($_GET['job']);
    include('db_conn.php');
    $sql = "SELECT * FROM myjobs WHERE id = '" . $goal . "'";
    
    function strip_tags_content($string) {
        $string = preg_replace('/<[^>]*>/', ' ', $string);
        $string = str_replace(array("\r", "\n", "\t"), ' ', $string);
        return trim(preg_replace('/ {2,}/', ' ', $string));
    }

    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<script type="application/ld+json">
            {
               "@context": "https://schema.org",
               "@type": "NewsArticle",
               "url": "https://www.jobsagent.org/readmore.php?job=' . intval($_GET['job']) . '",
               "publisher":{
                  "@type":"Organization",
                  "name":"www.jobsagent.org",
                  "logo":"https://www.jobsagent.org/img/logo.png"
               },
               "headline": "' . htmlspecialchars($row['job_title']) . '",
               "mainEntityOfPage":"https://www.jobsagent.org/readmore.php?job=' . intval($row['id']) . '",
               "articleBody": "' . strip_tags_content($row['desciption']) . '",
               "image":["https://www.jobsagent.org/images/img' . intval($_GET['job']) . '.png"],
               "datePublished":"' . htmlspecialchars($row['add_date']) . 'T20:30:54+00:00"
            }
            </script>';

            echo '<main>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Content -->
                <div class="lg:col-span-8 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                        <img src="../images/flags/' . strtolower($row["iso2"]) . '.png" alt="' . htmlspecialchars($row["iso2"]) . '" class="w-10 h-auto">
                        <h2 class="text-2xl font-bold text-gray-900">' . htmlspecialchars($row["job_title"]) . '</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center">
                            <h4 class="text-lg font-bold text-gray-800">' . (isset($Job_description) ? $Job_description : 'الوصف الوظيفي') . '</h4>
                            <button type="button" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition" data-toggle="modal" data-target="#exampleModalCenter">' . (isset($apply_now) ? $apply_now : 'التقدم للوظيفة') . '</button>
                        </div>

                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                            ' . str_replace(array("<h1>", "</h1>"), array("<h2>", "</h2>"), $row["desciption"]) . '
                            <img src="https://www.jobsagent.org/images/img' . intval($row['id']) . '.png" class="img-fluid mt-4 rounded-xl shadow-md max-w-xs" alt="' . htmlspecialchars($row['job_title']) . '">
                        </div>
                    </div>
                </div>

                <!-- Right Content (Overview Sidebar) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-4">
                        <h4 class="text-lg font-bold text-gray-900 pb-2 border-b border-gray-100 text-center">' . (isset($Overview) ? $Overview : 'نظرة عامة') . '</h4>
                        
                        <div class="flex justify-between text-sm"><span class="font-bold text-gray-700">' . (isset($Date_of_publication) ? $Date_of_publication : 'تاريخ النشر') . '</span> <span>' . htmlspecialchars($row["add_date"]) . '</span></div>
                        <div class="flex justify-between text-sm"><span class="font-bold text-gray-700">' . (isset($city) ? $city : 'المدينة') . '</span> <a href="cities.php?search=' . urlencode($row["city_name"]) . '" class="text-emerald-600 underline">' . htmlspecialchars($row["city_name"]) . '</a></div>';

            $is_ar = (isset($language_ch) && $language_ch == "ar");
            $c_name = $is_ar ? $row["name"] : $row["name_en"];
            
            echo '<div class="flex justify-between text-sm"><span class="font-bold text-gray-700">' . (isset($country) ? $country : 'الدولة') . '</span> <a href="Countries.php?search=' . urlencode($row["name_en"]) . '" class="text-emerald-600 underline">' . htmlspecialchars($c_name) . '</a></div>
                  <div class="flex justify-between text-sm"><span class="font-bold text-gray-700">' . (isset($company) ? $company : 'الشركة') . '</span> <a href="companies.php?search=' . urlencode($row['company']) . '" class="text-emerald-600 underline">' . htmlspecialchars($row["company"]) . '</a></div>
                  <div class="flex justify-between text-sm"><span class="font-bold text-gray-700">' . (isset($Field_of_work) ? $Field_of_work : 'المجال') . '</span> <a href="job_type.php?search=' . urlencode($row["job_cat_en"]) . '" class="text-emerald-600 underline">' . htmlspecialchars($is_ar ? $row["job_cat"] : $row["job_cat_en"]) . '</a></div>
                  <div class="flex justify-between text-sm"><span class="font-bold text-gray-700">' . (isset($salary) ? $salary : 'الراتب') . '</span> <span>' . htmlspecialchars($row["salary"] . " " . $row["currency"]) . '</span></div>
                  <div class="flex justify-between text-sm"><span class="font-bold text-gray-700">' . (isset($closing_date) ? $closing_date : 'تاريخ الإغلاق') . '</span> <span>' . htmlspecialchars($row["date"]) . '</span></div>

                  <button type="button" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition mt-4" data-toggle="modal" data-target="#exampleModalCenter">' . (isset($apply_now) ? $apply_now : 'التقدم للوظيفة') . '</button>
                    </div>
                </div>
            </div>
            </main>';

            $out_id = intval($row["id"]);
        }
    }
    $conn->close();

    // تسجيل الزيارة
    include("db_conn.php");
    $date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO visitors (post_id, datee) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("is", $out_id, $date);
        $stmt->execute();
        $stmt->close();
    }
    $conn->close();

    // عدد المشاهدات
    include("db_conn.php");
    $sql_v = "SELECT count(id) as x FROM visitors WHERE post_id = " . $goal;
    $result_v = mysqli_query($conn, $sql_v);
    if ($result_v && $row_v = mysqli_fetch_assoc($result_v)) {
        echo '<div class="mt-8 text-center bg-white p-6 rounded-2xl shadow-sm border border-gray-100 max-w-md mx-auto">
            <p class="text-gray-600 text-lg">
                ' . (isset($This_job_has_been_viewed) ? $This_job_has_been_viewed : 'تمت مشاهدة هذه الوظيفة') . '
                <strong class="text-rose-600 text-xl mx-1">' . intval($row_v['x']) . '</strong> ' . (isset($Once_times) ? $Once_times : 'مرة') . '
            </p>
        </div>';
    }
    $conn->close();
} else {
    echo '<p class="text-red-500 text-center font-bold">' . (isset($no_data) ? $no_data : 'لا توجد بيانات متاحة') . '</p>';
}
?>

</div>
</section>

<?php include("footer.php"); ?>

<!-- Loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include("scripts.php"); ?>

</body>
</html>