<?php include("texts.php"); ?>
<!DOCTYPE html>
<html lang="<?= isset($language_ch) ? $language_ch : 'ar' ?>" dir="<?= isset($direction) ? $direction : 'rtl' ?>">
<head>
    <title><?= isset($site_name_c) ? $site_name_c : 'JobsAgent' ?> - <?= isset($Post_a_Job) ? $Post_a_Job : 'نشر وظيفة' ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SZ30VHHEQQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-SZ30VHHEQQ');
    </script>
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "ksij1t2fdb");
    </script>

    <?php include("meta.php"); ?>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

<?php include("menu.php"); ?>

<div class="relative bg-cover bg-center py-20" style="background-image: url('images/bg_1.jpg');">
    <div class="absolute inset-0 bg-slate-900/75"></div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <p class="text-sm mb-2 text-emerald-400 font-semibold">
            <a href="/" class="hover:underline">Home</a> &larr; <span><?= isset($Post_a_Job) ? $Post_a_Job : 'نشر وظيفة' ?></span>
        </p>
        <h1 class="text-3xl md:text-4xl font-black"><?= isset($Post_a_Job) ? $Post_a_Job : 'نشر وظيفة' ?></h1>
    </div>
</div>

<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                
                <?php
                $targetFile = "";
                $uploadOk = 1;
                if (isset($_POST["submit"])) {
                    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                        $targetDir = "uploads/";
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir, 0755, true);
                        }
                        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                        $check = @getimagesize($_FILES["image"]["tmp_name"]);
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            echo '<div class="mb-4 p-4 bg-red-50 text-red-700 rounded-xl">الملف ليس صورة صالحة.</div>';
                            $uploadOk = 0;
                        }

                        if (file_exists($targetFile)) {
                            echo '<div class="mb-4 p-4 bg-amber-50 text-amber-700 rounded-xl">عذراً، الملف موجود مسبقاً.</div>';
                            $uploadOk = 0;
                        }

                        if ($_FILES["image"]["size"] > 500000) {
                            echo '<div class="mb-4 p-4 bg-red-50 text-red-700 rounded-xl">حجم الملف كبير جداً (أكبر من 500 كيلوبايت).</div>';
                            $uploadOk = 0;
                        }

                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            echo '<div class="mb-4 p-4 bg-red-50 text-red-700 rounded-xl">عذراً، مسموح فقط بملفات JPG, JPEG, PNG & GIF.</div>';
                            $uploadOk = 0;
                        }

                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                                echo '<div class="mb-4 p-4 bg-emerald-50 text-emerald-700 rounded-xl">تم رفع الملف بنجاح: ' . htmlspecialchars(basename($_FILES["image"]["name"])) . '</div>';
                            } else {
                                echo '<div class="mb-4 p-4 bg-red-50 text-red-700 rounded-xl">حدث خطأ أثناء رفع الملف.</div>';
                            }
                        }
                    }
                }
                ?>

                <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="font-bold text-gray-700 mb-3">رفع صورة توضيحية للإعلان</p>
                    <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
                        <input type="file" name="image" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" required>
                        <input type="submit" name="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded-xl transition cursor-pointer text-sm" value="رفع الصورة">
                    </form>

                    <?php if (isset($_FILES["image"]) && $uploadOk == 1 && !empty($targetFile)) : ?>
                        <div class="mt-4">
                            <img src="<?php echo htmlspecialchars($targetFile); ?>" alt="Uploaded Image" class="max-h-40 rounded-lg shadow-md mb-2">
                            <span class="text-xs text-gray-500 block"><?php echo (isset($my_url) ? $my_url : '') . '/' . htmlspecialchars($targetFile); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <h2 class="text-xl font-bold text-gray-900 mb-1"><?= isset($add_a_new_job) ? $add_a_new_job : 'أضف وظيفة جديدة' ?></h2>
                <hr class="my-4 border-gray-100">
                <h3 class="text-md font-semibold text-gray-700 mb-6"><?= isset($msg1) ? $msg1 : 'يرجى إدخال تفاصيل الوظيفة أدناه' ?></h3>

                <form action="/insert_job.php" method="POST" class="space-y-6">
                    
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">المسمى الوظيفي</label>
                        <input type="text" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" maxlength="254" id="job_title" placeholder="<?= isset($job_title) ? $job_title : 'المسمى الوظيفي' ?>" name="txt_job_title">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700"><?= isset($desciption) ? $desciption : 'التفاصيل والوصف الوظيفي' ?></label>
                        <textarea id="txt_description" name="txt_description" rows="6" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                        <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
                        <script>
                            ClassicEditor
                                .create(document.querySelector("#txt_description"))
                                .catch(error => { console.error(error); });
                        </script>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">الدولة</label>
                            <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" required id="txt_country" name="txt_country" onChange="get_city()">
                                <?php
                                require('db_conn.php');
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT * from countries order by name";
                                $result = $conn->query($sql);
                                if ($result && $result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) { 
                                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">المدينة</label>
                            <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" name="txt_city" id="txt_city">
                            </select>
                        </div>
                    </div>

                    <script>
                    function get_city() {
                        var strrr = document.getElementById("txt_country").value;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("txt_city").innerHTML = this.responseText;
                            }
                        };
                        xmlhttp.open("GET", "/get_city.php?q=" + strrr, true);
                        xmlhttp.send();
                    }
                    </script>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">تصنيف الوظيفة</label>
                            <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" name="txt_job_cat" required>
                                <?php
                                include('db_conn.php');
                                if (!$conn->connect_error) {
                                    $sql = "SELECT * from jobs_cat";
                                    $result = $conn->query($sql);
                                    if ($result && $result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) { 
                                            echo '<option value="'.$row["id"].'">'.$row["job_en"].'</option>';
                                        }
                                    }
                                    $conn->close();
                                }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">نوع الدوام</label>
                            <select class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" name="txt_type" id="txt_type" required>
                                <?php
                                include('db_conn.php');
                                if (!$conn->connect_error) {
                                    $sql = "SELECT * from jobs_type";
                                    $result = $conn->query($sql);
                                    if ($result && $result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) { 
                                            echo '<option value="'.$row["id"].'">'.$row["name_en"].'</option>';
                                        }
                                    }
                                    $conn->close();
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">تاريخ النشر</label>
                            <input type="date" name="txt_date" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" id="txt_date" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">الراتب المتوقع</label>
                            <input type="number" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="<?= isset($salary) ? $salary : 'الراتب' ?>" id="txt_sallary" name="txt_sallary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">اسم الشركة</label>
                            <input type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="<?= isset($company) ? $company : 'الشركة' ?>" id="txt_company" name="txt_company" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">رابط التقديم</label>
                            <input type="url" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="<?= isset($url) ? $url : 'الرابط الإلكتروني' ?>" id="txt_link" name="txt_link">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">البريد الإلكتروني للجهة</label>
                        <input type="email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="<?= isset($email_address) ? $email_address : 'البريد الإلكتروني' ?>" id="txt_email" name="txt_email">
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <input name="submit" id="submit" type="submit" value="<?= isset($Post_a_Job) ? $Post_a_Job : 'نشر الوظيفة' ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-xl transition cursor-pointer shadow-lg shadow-emerald-600/25">
                        <a href="index.php" class="text-gray-600 hover:text-emerald-600 font-semibold transition"><?= isset($home) ? $home : 'الرئيسية' ?></a>
                    </div>

                </form>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100">معلومات الاتصال</h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div>
                            <span class="font-bold block text-gray-800">العنوان</span>
                            <span><?= isset($address_f) ? $address_f : '' ?></span>
                        </div>
                        <div>
                            <span class="font-bold block text-gray-800">الهاتف</span>
                            <a href="#" class="text-emerald-600 hover:underline"><?= isset($phone_number) ? $phone_number : '' ?></a>
                        </div>
                        <div>
                            <span class="font-bold block text-gray-800">البريد الإلكتروني</span>
                            <a href="#" class="text-emerald-600 hover:underline"><?= isset($email) ? $email : '' ?></a>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-3"><?= isset($More_Info) ? $More_Info : 'معلومات إضافية' ?></h3>
                    <p class="text-sm text-gray-600 mb-4"><?= isset($msg2) ? $msg2 : '' ?></p>
                    <a href="#" class="bg-gray-100 hover:bg-emerald-50 hover:text-emerald-700 text-gray-800 text-sm font-semibold py-2 px-4 rounded-xl transition block text-center"><?= isset($read_more) ? $read_more : 'اقرأ المزيد' ?></a>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include("newsletter.php"); ?>
<?php include("footer.php"); ?>

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= isset($post_job_title) ? $post_job_title : '' ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Data Saved</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include("scripts.php"); ?>

<?php
if (isset($_GET["saved"]) && $_GET["saved"] == "true") {
    echo "<script type='text/javascript'>
    $(window).on('load', function() {
        $('#exampleModalCenter').modal('show');
    });
    </script>";
}
?>

</body>
</html>