<?php 
include("texts.php");
include("db_conn.php");

function shortText($text, $length) {
    if (mb_strlen($text, 'UTF-8') <= $length) {
        return $text;
    } else {
        $text = mb_substr($text, 0, $length, 'UTF-8');
        $lastSpace = mb_strrpos($text, ' ', 0, 'UTF-8');
        if ($lastSpace !== false) {
            $text = mb_substr($text, 0, $lastSpace, 'UTF-8');
        }
        return $text . '...';
    }
}

// توليد الكلمات الدلالية بناءً على اللغة المتاحة
$kw = "";
if (isset($language_ch) && $language_ch == "en") {
    $sql_kw = "SELECT name_en FROM myjobs GROUP BY city_id ORDER BY RAND() LIMIT 20";
    $result_kw = $conn->query($sql_kw);
    if ($result_kw && $result_kw->num_rows > 0) {
        while($row_kw = $result_kw->fetch_assoc()) {
            $kw .= ', jobs in ' . $row_kw['name_en'];
        }
    }
} else {
    $sql_kw = "SELECT native FROM myjobs GROUP BY city_id ORDER BY RAND() LIMIT 20";
    $result_kw = $conn->query($sql_kw);
    if ($result_kw && $result_kw->num_rows > 0) {
        while($row_kw = $result_kw->fetch_assoc()) {
            $kw .= ', وظائف في ' . $row_kw['native'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= isset($language_ch) ? $language_ch : 'ar' ?>" dir="<?= isset($direction) ? $direction : 'rtl' ?>">
<head>
    <title><?= isset($home_page_title) ? $home_page_title : 'منصة الوظائف' ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include("meta.php") ?>
    <meta property="og:description" content="<?= isset($site_name_c) ? $site_name_c : '' ?> <?= isset($Middle_East_Jobs_Platform) ? $Middle_East_Jobs_Platform : '' ?>" />
    <meta name='description' content='<?= isset($site_name_c) ? $site_name_c : '' ?> , <?= isset($Middle_East_Jobs_Platform) ? $Middle_East_Jobs_Platform : '' ?> , <?= $kw ?>' />
    <meta property="keywords" content="<?= $kw ?>"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
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
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

<?php include("menu.php") ?>

<div class="relative bg-cover bg-center py-24 lg:py-32" style="background-image: url('images/bg_1.jpg');">
    <div class="absolute inset-0 bg-slate-900/75"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <p class="text-amber-400 font-semibold tracking-wider uppercase mb-3"><?= isset($msg5) ? $msg5 : '' ?></p>
            <h1 class="text-3xl md:text-5xl font-black text-white mb-8 leading-tight"><?= isset($msg6) ? $msg6 : '' ?></h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                <div class="bg-slate-800/90 backdrop-blur border border-slate-700 p-5 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="text-emerald-400 text-3xl"><span class="flaticon-worldwide"></span></div>
                    <div class="text-right">
                        <?php
                        $counter = 0;
                        $sql_c = "SELECT COUNT(id) FROM myjobs GROUP BY name";
                        $res_c = $conn->query($sql_c);
                        if ($res_c) { $counter = $res_c->num_rows; }
                        ?>
                        <span class="block text-2xl font-bold text-amber-400" data-number="<?= $counter ?>"><?= $counter ?></span>
                        <span class="text-gray-300 text-sm"><?= isset($Active_Countries) ? $Active_Countries : 'الدول' ?></span>
                    </div>
                </div>
                <div class="bg-slate-800/90 backdrop-blur border border-slate-700 p-5 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="text-emerald-400 text-3xl"><span class="flaticon-visitor"></span></div>
                    <div class="text-right">
                        <?php
                        $counter1 = 0;
                        $sql_comp = "SELECT COUNT(id) FROM myjobs GROUP BY company";
                        $res_comp = $conn->query($sql_comp);
                        if ($res_comp) { $counter1 = $res_comp->num_rows; }
                        ?>
                        <span class="block text-2xl font-bold text-amber-400" data-number="<?= $counter1 ?>"><?= $counter1 ?></span>
                        <span class="text-gray-300 text-sm"><?= isset($Companies) ? $Companies : 'الشركات' ?></span>
                    </div>
                </div>
                <div class="bg-slate-800/90 backdrop-blur border border-slate-700 p-5 rounded-xl shadow-lg flex items-center justify-between">
                    <div class="text-emerald-400 text-3xl"><span class="flaticon-resume"></span></div>
                    <div class="text-right">
                        <?php
                        $total_jobs = 0;
                        $sql_jobs = "SELECT COUNT(id) AS mycount FROM myjobs";
                        $res_jobs = $conn->query($sql_jobs);
                        if ($res_jobs && $row_j = $res_jobs->fetch_assoc()) {
                            $total_jobs = $row_j['mycount'];
                        }
                        ?>
                        <span class="block text-2xl font-bold text-amber-400" data-number="<?= $total_jobs ?>"><?= $total_jobs ?></span>
                        <span class="text-gray-300 text-sm"><?= isset($Active_JOBS) ? $Active_JOBS : 'الوظائف النشطة' ?></span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-2xl">
                <form action="browsejobs.php" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        <div class="md:col-span-5 relative">
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 icon-briefcase"></span>
                            <input type="text" name="search" class="w-full pr-10 pl-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="<?= isset($eg_Web_Developer) ? $eg_Web_Developer : 'مثال: مبرمج ويب' ?>">
                        </div>
                        <div class="md:col-span-4 relative">
                            <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" name="cat">
                                <option value="0"><?= isset($all) ? $all : 'الكل' ?></option>
                                <?php
                                $sql_cat = "SELECT * FROM jobs_cat";
                                $res_cat = $conn->query($sql_cat);
                                if ($res_cat && $res_cat->num_rows > 0) {
                                    while($row_cat = $res_cat->fetch_assoc()) {
                                        $cat_title = (isset($language_ch) && $language_ch == "en") ? $row_cat["job_en"] : $row_cat["job"];
                                        echo '<option value="'.$row_cat["id"].'">'.$cat_title.'</option>';
                                    }
                                }
                                ?> 
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl transition duration-200 shadow-md"><?= isset($Search) ? $Search : 'بحث' ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-9">
                <div class="mb-8">
                    <span class="text-emerald-600 font-semibold tracking-wide text-sm block mb-1"><?= isset($Recently_Added_Jobs) ? $Recently_Added_Jobs : 'أحدث الوظائف' ?></span>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900"><?= isset($Featured_Jobs_Posts) ? $Featured_Jobs_Posts : 'الوظائف المميزة' ?></h2>
                </div>

                <div class="space-y-4">
                    <?php
                    $sql_jobs_list = "SELECT * FROM myjobs ORDER BY id DESC LIMIT 20";
                    $res_jobs_list = $conn->query($sql_jobs_list);

                    if ($res_jobs_list && $res_jobs_list->num_rows > 0) {
                        while($row = $res_jobs_list->fetch_assoc()) {
                            $is_ar = (!isset($language_ch) || $language_ch == "ar");
                            $j_type = $is_ar ? $row["job_type"] : $row["job_type_en"];
                            $c_name = $is_ar ? $row["name"] : $row["name_en"];
                            $city_name = $is_ar ? $row["city_name"] : $row["city_name_en"];
                            
                            echo '<div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="bg-emerald-50 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full">'.$j_type.'</span>
                                        <span class="text-gray-400 text-xs">'.$row['date'].' - '.$row['add_date'].'</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                                        <a href="/readmore.php?job='.$row['id'].'" class="hover:text-emerald-600">'.$row["job_title"].'</a>
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                        <div><span class="icon-layers ml-1"></span> <a href="/companies.php?search='.urlencode($row['company']).'" class="text-emerald-600 font-medium">'.$row['company'].'</a></div>
                                        <div><span class="icon-my_location ml-1"></span> <a href="Countries.php?search='.$row['name_en'].'">'.$c_name.'</a> , <a href="cities.php?search='.$row['city_name_en'].'">'.$city_name.'</a></div>
                                    </div>
                                </div>
                                <div class="w-full md:w-auto flex items-center justify-between md:justify-end gap-3 pt-3 md:pt-0 border-t md:border-t-0 border-gray-100">
                                    <a href="/readmore.php?job='.$row['id'].'" class="bg-emerald-50 hover:bg-emerald-600 hover:text-white text-emerald-700 font-medium px-5 py-2.5 rounded-xl text-sm transition">'.(isset($read_more) ? $read_more : 'قراءة المزيد').'</a>
                                </div>
                            </div>';
                        }
                    } else {
                        echo "<p class='text-center text-gray-500 py-8'>0 results</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100"><?= isset($Top_Recruitments) ? $Top_Recruitments : 'أبرز الجهات' ?></h3>
                    
                    <div class="space-y-4">
                        <?php
                        $sql_rec = "SELECT city_name, name, city_name_en, name_en, iso2, company, COUNT(company) AS xx FROM myjobs GROUP BY company ORDER BY xx DESC LIMIT 10";
                        $res_rec = $conn->query($sql_rec);

                        if ($res_rec && $res_rec->num_rows > 0) {
                            while($row_r = $res_rec->fetch_assoc()) {
                                $is_ar = (!isset($language_ch) || $language_ch == "ar");
                                $r_name = $is_ar ? $row_r['name'] : $row_r['name_en'];
                                $r_city = $is_ar ? $row_r['city_name'] : $row_r['city_name_en'];

                                echo '<div class="pb-3 border-b border-gray-50 last:border-0 last:pb-0">
                                    <a href="/companies.php?search='.urlencode($row_r['company']).'" class="font-bold text-gray-800 hover:text-emerald-600 block mb-1">'.$row_r['company'].'</a>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span><strong class="text-rose-600">'.$row_r['xx'].'</strong> '.(isset($Open_position) ? $Open_position : 'وظيفة متاحة').'</span>
                                        <span><a href="Countries.php?search='.$row_r['name_en'].'" class="hover:underline">'.$r_name.'</a></span>
                                    </div>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-white border-t border-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-emerald-600 font-semibold text-sm block mb-1"><?= isset($Top_Categories) ? $Top_Categories : 'التصنيفات' ?></span>
            <h2 class="text-3xl font-bold text-gray-900"><?= isset($Top_Categories) ? $Top_Categories : 'التصنيفات الرئيسية' ?></h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            $sql_cats = "SELECT job_cat, job_cat_en, logo, id, COUNT(job_cat_en) AS xx FROM myjobs GROUP BY job_cat_en ORDER BY xx DESC LIMIT 12";
            $res_cats = $conn->query($sql_cats);

            if ($res_cats && $res_cats->num_rows > 0) {
                while($row_cat = $res_cats->fetch_assoc()) {
                    $is_ar = (!isset($language_ch) || $language_ch == "ar");
                    $tx = $is_ar ? $row_cat['job_cat'] : $row_cat['job_cat_en'];
                    $ftx = shortText($tx, 30);
                    
                    echo '<a href="/job_type.php?search='.$row_cat['job_cat_en'].'" class="bg-gray-50 hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 p-6 rounded-xl transition text-center block group">
                        <div class="text-3xl text-emerald-600 mb-3 '.$row_cat['logo'].'"></div>
                        <h3 class="font-bold text-gray-900 group-hover:text-emerald-700 mb-1">'.$ftx.'</h3>
                        <span class="text-xs text-gray-500"><strong class="text-emerald-600">'.$row_cat['xx'].'</strong> '.(isset($Open_position) ? $Open_position : 'وظيفة').'</span>
                    </a>';
                }
            }
            $conn->close();
            ?>
        </div>
    </div>
</section>

<section class="py-16 bg-emerald-600 text-white text-center">
    <div class="container mx-auto px-4 max-w-3xl">
        <h2 class="text-3xl font-bold mb-4"><?= isset($post_job_title) ? $post_job_title : 'أضف وظيفتك الآن' ?></h2>
        <p class="text-emerald-100 text-lg mb-8"><?= isset($post_job_msg) ? $post_job_msg : 'انشر إعلان وظيفتك ليصل إلى آلاف الباحثين عن عمل' ?></p>
        <a class="inline-block bg-white text-emerald-700 hover:bg-emerald-50 font-bold px-8 py-4 rounded-xl shadow-lg transition" href="/new-post.php"><?= isset($click_here) ? $click_here : 'اضغط هنا للنشر' ?></a>
    </div>
</section>

<?php 
if(file_exists("newsletter.php")) include("newsletter.php");
if(file_exists("footer.php")) include("footer.php");
?>

<?php if(file_exists("scripts.php")) include("scripts.php"); ?>

</body>
</html>