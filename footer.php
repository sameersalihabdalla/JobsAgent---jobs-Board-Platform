<footer class="bg-slate-900 text-slate-400 pt-16 pb-8 border-t border-slate-800">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
            
            <div class="space-y-4">
                <h2 class="text-xl font-black text-white"><?= isset($site_name_c) ? $site_name_c : 'JobsAgent' ?></h2>
                <p class="text-sm text-slate-400 leading-relaxed">
                    <?= isset($footer_msg) ? $footer_msg : 'منصة رائدة للبحث عن الوظائف في الشرق الأوسط والعالم.' ?>    
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <?php if (!empty($twitter_link)): ?>
                        <a href="<?= htmlspecialchars($twitter_link) ?>" class="w-10 h-10 bg-slate-800 hover:bg-emerald-600 text-white rounded-xl flex items-center justify-center transition"><span class="icon-twitter"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($facebook_link)): ?>
                        <a href="<?= htmlspecialchars($facebook_link) ?>" class="w-10 h-10 bg-slate-800 hover:bg-emerald-600 text-white rounded-xl flex items-center justify-center transition"><span class="icon-facebook"></span></a>
                    <?php endif; ?>
                    <?php if (!empty($linkedin_link)): ?>
                        <a href="<?= htmlspecialchars($linkedin_link) ?>" class="w-10 h-10 bg-slate-800 hover:bg-emerald-600 text-white rounded-xl flex items-center justify-center transition"><span class="icon-linkedin"></span></a>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-bold text-white mb-4"><?= isset($Jobs_Categories) ? $Jobs_Categories : 'تصنيفات الوظائف' ?></h2>
                <ul class="space-y-2 text-sm">
                    <?php
                    // اتصال محلي مستقل لمنع تعارض مؤشرات الـ MySQL
                    $footer_conn = @new mysqli("localhost", "root", "", "jobsagent");
                    if (!$footer_conn->connect_error) {
                        $footer_conn->set_charset("utf8");
                        $sql_cat = "SELECT * FROM jobs_cat LIMIT 10";
                        $result_cat = $footer_conn->query($sql_cat);

                        if ($result_cat && $result_cat->num_rows > 0) {
                            while($row_c = $result_cat->fetch_assoc()) {
                                $is_ar = (!isset($language_ch) || $language_ch == "ar");
                                $cat_name = $is_ar ? $row_c["job"] : $row_c["job"];
                                $cat_slug = $row_c["job_en"];
                                echo '<li><a class="hover:text-emerald-400 transition flex items-center gap-2" href="/job_type.php?search='.urlencode($cat_slug).'"><i class="'.htmlspecialchars($row_c["logo"]).'"></i>'.htmlspecialchars($cat_name).'</a></li>';
                            }
                        } else {
                            echo '<li class="text-slate-500">0 results</li>';
                        }
                        $footer_conn->close();
                    } else {
                        echo '<li class="text-slate-500">Database error</li>';
                    }
                    ?>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-bold text-white mb-4"><?= isset($Quick_Links) ? $Quick_Links : 'روابط سريعة' ?></h2>
                <ul class="space-y-2 text-sm">
                    <li><a href="/browsejobs.php" class="hover:text-emerald-400 transition"><?= isset($browsejobs) ? $browsejobs : 'تصفح الوظائف' ?></a></li>
                    <li><a href="/new-post.php" class="hover:text-emerald-400 transition"><?= isset($Post_a_Job) ? $Post_a_Job : 'أضف وظيفة' ?></a></li>
                    <li><a href="/companies.php" class="hover:text-emerald-400 transition"><?= isset($Companies) ? $Companies : 'الشركات' ?></a></li>
                    <li><a href="/cities.php" class="hover:text-emerald-400 transition"><?= isset($cities) ? $cities : 'المدن' ?></a></li>
                    <li><a href="/Countries.php" class="hover:text-emerald-400 transition"><?= isset($Countries) ? $Countries : 'الدول' ?></a></li>
                    <li><a href="/image_list.php" class="hover:text-emerald-400 transition"><?= isset($jobs_gallary) ? $jobs_gallary : 'معرض الصور' ?></a></li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-bold text-white mb-4"><?= isset($Root_JOBS_AGENT) ? $Root_JOBS_AGENT : 'روابط هامة' ?></h2>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-emerald-400 transition"><?= isset($home) ? $home : 'الرئيسية' ?></a></li>
                    <li><a href="/admin/" class="hover:text-emerald-400 transition"><?= isset($administrator) ? $administrator : 'لوحة التحكم' ?></a></li>
                    <li><a href="/about.php" class="hover:text-emerald-400 transition"><?= isset($Developer) ? $Developer : 'من نحن / المطور' ?></a></li>
                    <li><a href="/sitemap.xml" class="hover:text-emerald-400 transition">Sitemap.xml</a></li>
                    <li><a href="/statistics.php" class="hover:text-emerald-400 transition"><?= isset($Statistics) ? $Statistics : 'الإحصائيات' ?></a></li>
                    <li><a href="/jobs_list.php" class="hover:text-emerald-400 transition"><?= isset($Jobs_List) ? $Jobs_List : 'قائمة الوظائف' ?></a></li>
                    <li><a href="/link_out.php" class="hover:text-emerald-400 transition"><?= isset($Links) ? $Links : 'روابط خارجية' ?></a></li>
                    <li><a href="/sitemap.php" class="hover:text-emerald-400 transition"><?= isset($SiteMap) ? $SiteMap : 'خريطة الموقع' ?></a></li>
                    <li><a href="/search_engine.php" class="hover:text-emerald-400 transition"><?= isset($SEO_Tools) ? $SEO_Tools : 'أدوات البحث' ?></a></li>
                    
                    <li class="pt-3">
                        <div class="flex flex-wrap gap-3">
                            <a href="https://www.arabic.jobsagent.org" class="inline-flex items-center gap-1 text-xs hover:text-white transition"><img src="/images/flags/sa.png" alt="arabic" width="16px">عربي</a>
                            <a href="https://www.french.jobsagent.org" class="inline-flex items-center gap-1 text-xs hover:text-white transition"><img src="/images/flags/fr.png" alt="French" width="16px">French</a>
                            <a href="https://www.jobsagent.org" class="inline-flex items-center gap-1 text-xs hover:text-white transition"><img src="/images/flags/us.png" width="16px" alt="English">English</a>
                        </div>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-bold text-white mb-4"><?= isset($have_q) ? $have_q : 'استفسارات؟' ?></h2>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2"><span class="icon icon-map-marker mt-1 text-emerald-500"></span><span><?= isset($address_f) ? $address_f : 'الخرطوم، السودان' ?></span></li>
                    <?php if (!empty($phone_number)): ?>
                        <li><a class="hover:text-emerald-400 transition flex items-center gap-2" href="tel:<?= htmlspecialchars($phone_number) ?>"><i class="icon icon-phone text-emerald-500"></i><?= htmlspecialchars($phone_number) ?></a></li>
                    <?php endif; ?>
                    <?php if (!empty($phone_number2)): ?>
                        <li><a class="hover:text-emerald-400 transition flex items-center gap-2" href="tel:<?= htmlspecialchars($phone_number2) ?>"><i class="icon icon-phone text-emerald-500"></i><?= htmlspecialchars($phone_number2) ?></a></li>
                    <?php endif; ?>
                    <?php if (!empty($email)): ?>
                        <li><a class="hover:text-emerald-400 transition flex items-center gap-2" href="mailto:<?= htmlspecialchars($email) ?>"><span class="icon icon-envelope text-emerald-500"></span><span><?= htmlspecialchars($email) ?></span></a></li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>

        <div class="pt-8 border-t border-slate-800 text-center space-y-4">
            <div class="flex flex-wrap justify-center gap-4 text-xs text-slate-500">
                <a class="hover:text-white transition" href="/about.php"><?= isset($Developer) ? $Developer : 'المطور' ?></a> 
                <a class="hover:text-white transition" href="/sitemap.xml">Sitemap.xml</a>
                <a class="hover:text-white transition" href="/statistics.php"><?= isset($Statistics) ? $Statistics : 'الإحصائيات' ?></a>
                <a class="hover:text-white transition" href="/jobs_list.php"><?= isset($Jobs_List) ? $Jobs_List : 'قائمة الوظائف' ?></a>
                <a class="hover:text-white transition" href="/link_out.php"><?= isset($Links) ? $Links : 'الروابط' ?></a>
                <a class="hover:text-white transition" href="/sitemap.php"><?= isset($SiteMap) ? $SiteMap : 'خريطة الموقع' ?></a>
                <a class="hover:text-white transition" href="/search_engine.php"><?= isset($SEO_Tools) ? $SEO_Tools : 'أدوات السيو' ?></a>
                <a class="hover:text-white transition" href="https://www.arabic.jobsagent.org">عربي</a> 
                <a class="hover:text-white transition" href="https://www.french.jobsagent.org">French</a>
                <a class="hover:text-white transition" href="https://www.jobsagent.org">English</a>
            </div>
            <p class="text-xs text-slate-500">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This platform is maintained by <span class="text-white font-bold">Sameer Salih</span>
            </p>
        </div>
    </div>
</footer>