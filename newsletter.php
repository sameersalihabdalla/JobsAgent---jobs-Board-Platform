<?php include("texts.php"); ?>

<section class="py-16 bg-slate-900 relative overflow-hidden text-white">
    <!-- إعلانات جوجل أدسنس -->
    <div class="container mx-auto px-4 mb-12 text-center">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9114422406437922" crossorigin="anonymous"></script>
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-format="autorelaxed"
             data-ad-client="ca-pub-9114422406437922"
             data-ad-slot="9873924581"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    <!-- النشرة البريدية -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-2xl mx-auto text-center space-y-4">
            <h2 class="text-3xl font-black"><?= isset($news_letter_title) ? $news_letter_title : 'اشترك في النشرة البريدية' ?></h2>
            <p class="text-slate-400 text-sm leading-relaxed"><?= isset($news_letter_data) ? $news_letter_data : 'احصل على أحدث الوظائف مباشرة إلى بريدك الإلكتروني.' ?></p>
            
            <form action="#" class="mt-6">
                <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" class="w-full px-4 py-3.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder:text-slate-600 focus:outline-none focus:border-emerald-500 transition" placeholder="Enter email address" required>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-3.5 rounded-xl transition shadow-lg shadow-emerald-600/20 whitespace-nowrap">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</section>