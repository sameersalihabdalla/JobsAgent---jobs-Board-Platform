<?php include("texts.php"); ?>
<!DOCTYPE html>
<html lang="<?= isset($language_ch) ? $language_ch : 'ar' ?>" dir="<?= isset($direction) ? $direction : 'rtl' ?>">
<head>
    <title><?= isset($site_name_c) ? $site_name_c : 'JobsAgent' ?> - <?= isset($Developer) ? $Developer : 'عن المطور' ?></title>
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
            <a href="index.php" class="hover:underline"><?= isset($home) ? $home : 'الرئيسية' ?></a> &larr; <span>من نحن / المطور</span>
        </p>
        <h1 class="text-3xl md:text-4xl font-black">عن المطور</h1>
    </div>
</div>

<section class="py-16">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-gray-100 space-y-10">
            
            <!-- Profile Header -->
            <div class="flex flex-col md:flex-row items-center gap-8 pb-8 border-b border-gray-100">
                <div class="w-32 h-32 rounded-2xl bg-emerald-50 border-2 border-emerald-500/20 flex items-center justify-center p-4 shadow-inner">
                    <img src="/img/logo.png" alt="Jobsagent.org" class="max-w-full max-h-full object-contain">
                </div>
                <div class="space-y-3 text-center md:text-right flex-1">
                    <h2 class="text-2xl md:text-3xl font-black text-gray-900">سمير صالح عبد الله عثمان</h2>
                    <p class="text-emerald-600 font-bold text-lg">مبرمج / مطور ويب / محلل نظم / مسؤول أنظمة</p>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        محترف تقني بخبرة تزيد عن عشر سنوات في بناء وتطوير الأنظمة (المكتبية والويب)، وتحليلها وصيانتها واستكشاف الأخطاء وإصلاحها واختبارها بكفاءة عالية.
                    </p>
                </div>
            </div>

            <!-- Contact & Personal Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-2xl border border-gray-200">
                <div>
                    <span class="text-xs font-bold text-gray-400 block mb-1">البلد والموقع</span>
                    <span class="text-sm font-semibold text-gray-800">السودان، بورتسودان (البحر الأحمر)</span>
                </div>
                <div>
                    <span class="text-xs font-bold text-gray-400 block mb-1">أرقام التواصل</span>
                    <div class="space-y-1">
                        <a href="tel:+249999249900" class="text-sm font-semibold text-emerald-600 hover:underline block">+249 999 249 900</a>
                        <a href="tel:+249123539900" class="text-sm font-semibold text-emerald-600 hover:underline block">+249 123 539 900 (واتساب)</a>
                    </div>
                </div>
                <div>
                    <span class="text-xs font-bold text-gray-400 block mb-1">لينكد إن</span>
                    <a href="https://www.linkedin.com/in/sameersalihabdalla" target="_blank" class="text-xs font-semibold text-emerald-600 hover:underline break-all block">sameersalihabdalla</a>
                </div>
            </div>

            <!-- Skills & Tech Stack -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Programming Languages -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-r-4 border-emerald-500 pr-3">لغات البرمجة</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php 
                        $langs = ['PHP', 'JavaScript', 'HTML', 'Visual Basic 6.0', 'VB.NET', 'Kotlin', 'C++', 'C#'];
                        foreach($langs as $lang) {
                            echo '<span class="px-3 py-1.5 bg-gray-100 text-gray-700 font-semibold rounded-xl text-xs">'.$lang.'</span>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Software Applications -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-r-4 border-emerald-500 pr-3">أنظمة البرمجيات والأدوات</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php 
                        $apps = ['Photoshop', 'XD', 'Illustrator', 'Corel Draw', 'SQLyog', 'Packet Tracer', 'AnyDesk', 'Dreamweaver', 'MySQL', 'SQL Server', 'Android Studio', 'MS Office'];
                        foreach($apps as $app) {
                            echo '<span class="px-3 py-1.5 bg-gray-100 text-gray-700 font-semibold rounded-xl text-xs">'.$app.'</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Education & Certifications -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6 border-t border-gray-100">
                <!-- Education -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-r-4 border-emerald-500 pr-3">التعليم الأكاديمي</h3>
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 space-y-2">
                        <span class="text-xs font-bold text-emerald-600">مايو / 2012</span>
                        <h4 class="font-bold text-gray-800 text-sm">بكالوريوس علوم الحاسوب</h4>
                        <p class="text-xs text-gray-600">كلية شرق النيل [الخرطوم، السودان]</p>
                        <p class="text-xs font-semibold text-gray-700">المعدل التراكمي (GPA): 3.46</p>
                    </div>
                </div>

                <!-- Languages Proficiency -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 border-r-4 border-emerald-500 pr-3">اللغات</h3>
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-bold text-gray-800">اللغة العربية</span>
                            <span class="text-emerald-600 font-bold">اللغة الأم (متازة)</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-bold text-gray-800">اللغة الإنجليزية</span>
                            <span class="text-emerald-600 font-bold">جيدة جداً</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certifications Section -->
            <div class="space-y-4 pt-6 border-t border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 border-r-4 border-emerald-500 pr-3">الشهادات المهنية والدورات</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 text-sm">
                        <span class="font-bold block text-gray-800">مهارات الاتصال (TeraCourses)</span>
                        <span class="text-xs text-gray-500">معرف الشهادة: 112832</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 text-sm">
                        <span class="font-bold block text-gray-800">CCNA - مركز سوفت ستار للتدريب</span>
                        <span class="text-xs text-gray-500">الخرطوم، السودان، 2015</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 text-sm">
                        <span class="font-bold block text-gray-800">CCTV - مركز KYM للتدريب التقني</span>
                        <span class="text-xs text-gray-500">أكتوبر 2015</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 text-sm">
                        <span class="font-bold block text-gray-800">Kotlin & Laravel (TeraCourses)</span>
                        <span class="text-xs text-gray-500">معرف الشهادة: 104309</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 text-sm">
                        <span class="font-bold block text-gray-800">Google Blogger (TeraCourses)</span>
                        <span class="text-xs text-gray-500">معرف الشهادة: 182051</span>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center pt-6">
                <a href="https://wa.me/249912230352" target="_blank" class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-8 rounded-xl transition shadow-lg shadow-emerald-600/25">
                    <span>تواصل عبر الواتساب</span>
                    <i class="icon-whatsapp text-lg"></i>
                </a>
            </div>

        </div>
    </div>
</section>

<?php include("footer.php"); ?>

<!-- Loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<?php include("scripts.php"); ?>

</body>
</html>