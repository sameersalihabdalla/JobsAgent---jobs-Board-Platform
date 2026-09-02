<?php include("texts.php"); ?>
<!DOCTYPE html>
<html lang="<?= isset($language_ch) ? $language_ch : 'ar' ?>" dir="<?= isset($direction) ? $direction : 'rtl' ?>">
<head>
<title><?= isset($site_name_c) ? $site_name_c : 'JobsAgent' ?> - <?= isset($jobs_gallary) ? $jobs_gallary : 'معرض الوظائف' ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

<?php include("meta.php"); ?>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

<?php include("menu.php"); ?>

<!-- Hero Section -->
<div class="relative bg-cover bg-center py-20" style="background-image: url('images/bg_1.jpg');">
    <div class="absolute inset-0 bg-slate-900/75"></div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <p class="text-sm mb-2 text-emerald-400 font-semibold">
            <a href="/" class="hover:underline"><?= isset($home) ? $home : 'الرئيسية' ?></a> &larr; <span><?= isset($jobs_gallary) ? $jobs_gallary : 'معرض الوظائف' ?></span>
        </p>
        <h1 class="text-3xl md:text-4xl font-black"><?= isset($jobs_gallary) ? $jobs_gallary : 'معرض الوظائف' ?></h1>
    </div>
</div>

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Gallery List Column -->
            <div class="lg:col-span-8 space-y-6">
                
                <?php
                include("db_conn.php");
                $limit = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;

                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

                $query = "SELECT * FROM myjobs WHERE company LIKE '%$search%' ORDER BY id DESC LIMIT $start, $limit";
                $result = $conn->query($query);

                $total_query = "SELECT COUNT(*) FROM myjobs WHERE company LIKE '%$search%'";
                $total_result = $conn->query($total_query);
                $total = $total_result->fetch_row()[0];
                $pages = ceil($total / $limit);

                function convertToHashtags($text) {
                    $pureText = strip_tags($text);
                    $pureText = preg_replace("/&([a-zA-Z])(uml|acute|grave|circ|tilde|ring);/", '', $pureText);
                    $pureText = preg_replace('/\s+/', ' ', $pureText);
                    $pureText = trim($pureText);
                    $words = explode(' ', $pureText);
                    $hashtags = array_map(function($word) {
                        return '#' . $word;
                    }, $words);
                    return implode(' ', $hashtags);
                }
                ?>

                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php 
                        $text = $row['job_title'].' '.$row['name'].' '.$row['company'].' '.$row['job_cat'].' '.$row['job_cat_en'].' '.$row['city_name'].' '.$row['name_en'].' '.$row['capital'];
                        $hashtags = convertToHashtags($text);
                        ?>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                            <div class="md:col-span-7 space-y-3">
                                <div class="flex items-center gap-2 text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                    <span><?= $row['job_type_en'] ?></span> | <span><?= $row['company'] ?></span>
                                </div>
                                <div class="text-sm text-gray-500 font-medium">
                                    <?= $row['job_cat_en'] ?> | <?= $row['name_en'] ?>, <?= $row['city_name_en'] ?>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">
                                    <?= $row['job_title'] ?>
                                </h3>
                                <div>
                                    <a href="<?= isset($my_url) ? $my_url : '' ?>/readmore.php?job=<?= $row['id'] ?>" class="text-xs text-emerald-600 hover:underline break-all block">
                                        <?= isset($my_url) ? $my_url : '' ?>/readmore.php?job=<?= $row['id'] ?>
                                    </a>
                                </div>
                                <div class="text-xs text-gray-500 leading-relaxed">
                                    <a href="<?= isset($my_url) ? $my_url : '' ?>/readmore.php?job=<?= $row['id'] ?>" class="hover:text-emerald-700">
                                        <?= $hashtags ?> #jobs_agent #جوبز_ايجنت
                                    </a>
                                </div>
                            </div>
                            
                            <div class="md:col-span-5">
                                <div class="bg-gray-50 p-2 rounded-xl border border-gray-200">
                                    <img src="https://www.jobsagent.org/images/img<?= $row['id'] ?>.png" class="w-full h-auto rounded-lg shadow-sm object-cover" alt="<?= htmlspecialchars($row['job_title']) ?>" title="<?= htmlspecialchars($hashtags) ?>">
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 py-8 bg-white rounded-2xl border border-gray-100">No results found</p>
                <?php endif; ?>

                <!-- Beautiful Responsive Pagination -->
                <?php if ($pages > 1): ?>
                    <div class="flex justify-center my-10 w-full overflow-x-auto py-3">
                        <nav aria-label="Page navigation">
                            <ul class="flex flex-wrap items-center justify-center gap-2 max-w-full px-4">
                                <?php for ($i = 1; $i <= $pages; $i++): ?>
                                    <?php if ($page == $i): ?>
                                        <li>
                                            <span class="inline-flex items-center justify-center min-w-[40px] px-4 py-2.5 bg-emerald-600 text-white font-bold rounded-xl text-sm shadow-md shadow-emerald-600/25 scale-105 transition-transform">
                                                <?= $i ?>
                                            </span>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" class="inline-flex items-center justify-center min-w-[40px] px-4 py-2.5 bg-white border border-gray-200 hover:border-emerald-500 hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 font-semibold rounded-xl text-sm transition-all duration-200 shadow-sm">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Sidebar Column -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100"><?= isset($search_by_company_name) ? $search_by_company_name : 'بحث باسم الشركة' ?></h3>
                    <form method="GET" action="" class="space-y-4">
                        <div>
                            <input type="text" name="search" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" placeholder="<?= isset($Search) ? $Search : 'بحث' ?>..." value="<?= htmlspecialchars($search); ?>">
                        </div>

                        <div>
                            <select name="company_select" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                                <option value="0"><?= isset($all) ? $all : 'الكل' ?></option>
                                <?php
                                include('db_conn.php');
                                if (!$conn->connect_error) {
                                    $sql_comp = "SELECT * FROM myjobs GROUP BY company";
                                    $res_comp = $conn->query($sql_comp);
                                    if ($res_comp && $res_comp->num_rows > 0) {
                                        while($row_comp = $res_comp->fetch_assoc()) {
                                            echo '<option value="'.$row_comp["id"].'">'.$row_comp["company"].'</option>';
                                        }
                                    }
                                    $conn->close();
                                }
                                ?>
                            </select>
                        </div>

                        <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-xl transition text-sm shadow-md" type="submit">
                            <span class="icon-search mr-1"></span> <?= isset($Search) ? $Search : 'بحث' ?>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include("newsletter.php"); ?>
<?php include("footer.php"); ?>

<!-- Loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include("scripts.php"); ?>

</body>
</html>