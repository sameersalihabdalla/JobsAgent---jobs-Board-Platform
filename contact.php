<?php include("texts.php"); ?>
<!DOCTYPE html>
<html lang="<?= isset($language_ch) ? $language_ch : 'ar' ?>" dir="<?= isset($direction) ? $direction : 'rtl' ?>">
<head>
    <title><?= isset($site_name_c) ? $site_name_c : 'JobsAgent' ?> - <?= isset($Contact) ? $Contact : 'اتصل بنا' ?></title>
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
            <a href="index.php" class="hover:underline"><?= isset($home) ? $home : 'الرئيسية' ?></a> &larr; <span><?= isset($Contact) ? $Contact : 'اتصل بنا' ?></span>
        </p>
        <h1 class="text-3xl md:text-4xl font-black"><?= isset($Contact) ? $Contact : 'اتصل بنا' ?></h1>
    </div>
</div>

<section class="py-16">
    <div class="container mx-auto px-4">
        
        <!-- Contact Information Cards -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6"><?= isset($Contact_Information) ? $Contact_Information : 'معلومات الاتصال' ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-2">
                    <span class="text-emerald-600 font-bold block text-sm"><?= isset($address) ? $address : 'العنوان' ?></span>
                    <p class="text-gray-600 text-sm"><?= isset($address_f) ? $address_f : '' ?></p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-2">
                    <span class="text-emerald-600 font-bold block text-sm"><?= isset($Phone) ? $Phone : 'الهاتف' ?></span>
                    <p><a href="tel://<?= isset($phone_number) ? $phone_number : '' ?>" class="text-gray-600 hover:text-emerald-600 text-sm font-semibold transition"><?= isset($phone_number) ? $phone_number : '' ?></a></p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-2">
                    <span class="text-emerald-600 font-bold block text-sm">البريد الإلكتروني</span>
                    <p><a href="mailto:<?= isset($email) ? $email : '' ?>" class="text-gray-600 hover:text-emerald-600 text-sm font-semibold transition break-all"><?= isset($email) ? $email : '' ?></a></p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-2">
                    <span class="text-emerald-600 font-bold block text-sm">الموقع الإلكتروني</span>
                    <p><a href="#" class="text-gray-600 hover:text-emerald-600 text-sm font-semibold transition">www.jobsagent.org</a></p>
                </div>

            </div>
        </div>

        <!-- Form and Map Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Contact Form -->
            <div class="lg:col-span-7 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-6">أرسل لنا رسالة</h3>
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">الاسم</label>
                        <input type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" placeholder="Your Name" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">البريد الإلكتروني</label>
                        <input type="email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" placeholder="Your Email" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">الموضوع</label>
                        <input type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" placeholder="Subject" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">الرسالة</label>
                        <textarea rows="5" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm" placeholder="Message" required></textarea>
                    </div>

                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-8 rounded-xl transition text-sm shadow-lg shadow-emerald-600/20">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Map / Location Box -->
            <div class="lg:col-span-5 bg-white p-4 rounded-2xl shadow-sm border border-gray-100 h-full min-h-[420px] flex items-center justify-center">
                <div id="map" class="w-full h-[400px] bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 font-semibold text-sm">
                    خريطة الموقع (Google Map)
                </div>
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