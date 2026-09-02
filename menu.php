<?php include("texts.php"); ?>

<header class="fixed top-0 left-0 right-0 z-50 bg-slate-900/90 backdrop-blur-md border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <a href="/" class="text-2xl font-black tracking-wider text-emerald-500">
            <?= isset($site_name_c) ? $site_name_c : 'Jobs' ?><span class="text-white">Agent.</span>
        </a>
        
        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-300">
            <a href="index.php" class="hover:text-emerald-500 transition"><?= isset($home) ? $home : 'الرئيسية' ?></a>
            <a href="browsejobs.php" class="hover:text-emerald-500 transition"><?= isset($Browse_Jobs) ? $Browse_Jobs : 'تصفح الوظائف' ?></a>
            <a href="companies.php" class="hover:text-emerald-500 transition"><?= isset($Companies) ? $Companies : 'الشركات' ?></a>
            <a href="image_list.php" class="hover:text-emerald-500 transition"><?= isset($jobs_gallary) ? $jobs_gallary : 'معرض الصور' ?></a>
            <a href="contact.php" class="hover:text-emerald-500 transition"><?= isset($Contact) ? $Contact : 'اتصل بنا' ?></a>
            <a href="about.php" class="hover:text-emerald-500 transition"><?= isset($about) ? $about : 'من نحن' ?></a>
        </nav>

        <div class="flex items-center gap-4">
            <a href="new-post.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-emerald-600/20 transition">
                <?= isset($Post_a_Job) ? $Post_a_Job : 'أضف وظيفة' ?>
            </a>
            
            <a href="/admin" class="hidden sm:inline-block border border-slate-700 hover:border-slate-500 text-slate-300 hover:text-white px-4 py-2.5 rounded-xl font-bold text-sm transition">
                <?= isset($administrator) ? $administrator : 'الإدارة' ?>
            </a>

            <!-- Language Dropdown using Tailwind -->
            <div class="relative group">
                <button class="flex items-center gap-1 text-slate-300 hover:text-emerald-500 font-semibold text-sm py-2 transition focus:outline-none">
                    🌐 اللغة
                </button>
                <div class="absolute left-0 mt-2 w-36 bg-slate-900 border border-slate-800 rounded-xl shadow-xl py-2 hidden group-hover:block z-50">
                    <a class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-emerald-400 transition" href="https://www.arabic.jobsagent.org">عربي</a>
                    <a class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-emerald-400 transition" href="https://www.jobsagent.org">English</a>
                    <a class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-emerald-400 transition" href="https://www.french.jobsagent.org">French</a>
                </div>
            </div>
        </div>
    </div>
</header>