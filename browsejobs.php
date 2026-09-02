<!DOCTYPE html>
<?php include("texts.php"); ?>
<html lang="<?= isset($language_ch) ? $language_ch : 'ar' ?>" dir="<?= isset($direction) ? $direction : 'rtl' ?>">
<head>
    <title><?= isset($site_name_c) ? $site_name_c : 'JobsAgent' ?> - <?= isset($browsejobs) ? $browsejobs : 'تصفح الوظائف' ?></title>
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
    <!-- Google Fonts (Cairo) -->
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
            <a href="/" class="hover:underline"><?= isset($home) ? $home : 'الرئيسية' ?></a> &larr; <span><?= isset($browsejobs) ? $browsejobs : 'تصفح الوظائف' ?></span>
        </p>
        <h1 class="text-3xl md:text-4xl font-black"><?= isset($browsejobs) ? $browsejobs : 'تصفح الوظائف' ?></h1>
    </div>
</div>

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Jobs List Column -->
            <div class="lg:col-span-8 space-y-4">
                <?php
                include("db_conn.php");
                $limit = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $start = ($page - 1) * $limit;

                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

                $query = "SELECT * FROM myjobs WHERE job_title LIKE '%$search%' ORDER BY id DESC LIMIT $start, $limit";
                $result = $conn->query($query);

                $total_query = "SELECT COUNT(*) FROM myjobs WHERE job_title LIKE '%$search%'";
                $total_result = $conn->query($total_query);
                $total = $total_result->fetch_row()[0];
                $pages = ceil($total / $limit);
                ?>

                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php 
                        $is_ar = (isset($language_ch) && $language_ch == "ar");
                        $j_type = $is_ar ? $row["job_type"] : $row["job_type_en"];
                        $c_name = $is_ar ? $row["name"] : $row["name_en"];
                        $city_name = $is_ar ? $row["city_name"] : $row["city_name_en"];
                        ?>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="bg-emerald-50 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full"><?= $j_type ?></span>
                                    <span class="text-gray-400 text-xs"><?= $row['date'] ?> - <?= $row['add_date'] ?></span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">
                                    <a href="/readmore.php?job=<?= $row['id'] ?>" class="hover:text-emerald-600"><?= $row["job_title"] ?></a>
                                </h3>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-4">
                                    <div><span class="icon-layers ml-1"></span> <a href="/companies.php?search=<?= urlencode($row['company']) ?>" class="text-emerald-600 font-medium"><?= $row['company'] ?></a></div>
                                    <div><span class="icon-my_location ml-1"></span> <a href="Countries.php?search=<?= $row['name_en'] ?>"><?= $c_name ?></a> , <a href="cities.php?search=<?= $row['city_name_en'] ?>"><?= $city_name ?></a></div>
                                </div>
                                
                                <div class="flex items-center gap-2 pt-2 border-t border-gray-100">
                                    <span class="text-xs text-gray-400">مشاركة:</span>
                                    <button style="color:#3399cc;" class="icon-twitter btn btn-sm p-1" data-sharer="twitter" data-title="<?= $row['job_title'] ?>" data-url="http://www.jobsagent.org/readmore.php?job=<?= $row["id"] ?>"></button>
                                    <button style="color:blue;" class="icon-facebook btn btn-sm p-1" data-sharer="facebook" data-title="<?= $row['job_title'] ?>" data-url="http://www.jobsagent.org/readmore.php?job=<?= $row["id"] ?>"></button>
                                    <button style="color:#04779d;" class="icon-linkedin btn btn-sm p-1" data-sharer="linkedin" data-title="<?= $row['job_title'] ?>" data-url="http://www.jobsagent.org/readmore.php?job=<?= $row["id"] ?>"></button>
                                    <button style="color:green;" class="icon-whatsapp btn btn-sm p-1" data-sharer="whatsapp" data-title="<?= $row['job_title'] ?>" data-url="http://www.jobsagent.org/readmore.php?job=<?= $row["id"] ?>"></button>
                                    <button style="color:#086583;" class="icon-telegram btn btn-sm p-1" data-sharer="telegram" data-title="<?= $row['job_title'] ?>" data-url="http://www.jobsagent.org/readmore.php?job=<?= $row["id"] ?>"></button>
                                </div>
                            </div>
                            <div class="w-full md:w-auto flex items-center justify-between md:justify-end gap-3 pt-3 md:pt-0 border-t md:border-t-0 border-gray-100">
                                <a href="/readmore.php?job=<?= $row['id'] ?>" class="bg-emerald-50 hover:bg-emerald-600 hover:text-white text-emerald-700 font-medium px-5 py-2.5 rounded-xl text-sm transition"><?= isset($read_more) ? $read_more : 'قراءة المزيد' ?></a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 py-8 bg-white rounded-2xl border border-gray-100">No results found</p>
                <?php endif; ?>
           
                <!-- Pagination -->

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
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100"><?= isset($search_by_jobtitle) ? $search_by_jobtitle : 'بحث عن وظيفة' ?></h3>
                    <form method="GET" action="" class="space-y-4">
                        <div>
                            <input type="text" name="search" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" placeholder="<?= isset($Search) ? $Search : 'بحث' ?>..." value="<?= htmlspecialchars($search); ?>">
                        </div>

                        <div>
                            <select name="cat" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                                <option value="0"><?= isset($all) ? $all : 'الكل' ?></option>
                                <?php
                                include('db_conn.php');
                                $sql_c = "SELECT * FROM jobs_cat";
                                $res_c = $conn->query($sql_c);
                                if ($res_c && $res_c->num_rows > 0) {
                                    while($row_c = $res_c->fetch_assoc()) {
                                        $cat_title = (isset($language_ch) && $language_ch == "ar") ? $row_c["job"] : $row_c["job_en"];
                                        echo '<option value="'.$row_c["id"].'">'.$cat_title.'</option>';
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <div>
                            <select name="country" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
                                <option value="0"><?= isset($all) ? $all : 'جميع الدول' ?></option>
                                <?php
                                include('db_conn.php');
                                $sql_cnt = "SELECT * FROM countries ORDER BY native DESC";
                                $res_cnt = $conn->query($sql_cnt);
                                if ($res_cnt && $res_cnt->num_rows > 0) {
                                    while($row_cnt = $res_cnt->fetch_assoc()) {
                                        echo '<option value="'.$row_cnt["id"].'">'.$row_cnt["native"].'</option>';
                                    }
                                }
                                $conn->close();
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

<!-- Newsletter Section -->
<section class="py-16 bg-slate-900 text-white text-center">
    <div class="container mx-auto px-4 max-w-2xl space-y-4">
        <h2 class="text-3xl font-black">Subscribe to our Newsletter</h2>
        <p class="text-slate-400 text-sm">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia...</p>
        <form action="#" class="mt-6">
            <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input type="email" class="w-full px-4 py-3.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder:text-slate-600 focus:outline-none focus:border-emerald-500 transition text-sm" placeholder="Enter email address" required>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-3.5 rounded-xl transition shadow-lg shadow-emerald-600/20 whitespace-nowrap text-sm">Subscribe</button>
            </div>
        </form>
    </div>
</section>

<?php include("footer.php"); ?>

<!-- Loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include("scripts.php"); ?>

</body>
</html>