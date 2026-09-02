<?php
session_start();
include 'db.php';

$error = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['uemail'];
    $pass = $_POST['upass'];

    $stmt = $conn->prepare("SELECT uid FROM user WHERE uemail = ? AND upass = ?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['user_id'] = $row['uid'];
        $redirect = $_GET['redirect'] ?? 'index.php';
        header("Location: $redirect");
        exit;
    } else {
        $error = true;
    }
}

$page_title = "تسجيل الدخول";
include 'includes/header.php';
?>

<!-- Hero / Header Section -->
<div class="relative bg-cover bg-center py-16" style="background-image: url('images/bg_1.jpg');">
    <div class="absolute inset-0 bg-slate-900/75"></div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <h1 class="text-3xl font-black">تسجيل الدخول</h1>
        <p class="text-sm text-slate-300 mt-2">قم بالدخول لإدارة الوظائف ومتابعة حسابك</p>
    </div>
</div>

<!-- Login Form Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            
            <?php if (!empty($error)): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-sm font-semibold rounded-xl text-center">
                    بيانات الدخول غير صحيحة. يرجى التحقق من البريد الإلكتروني وكلمة المرور.
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">البريد الإلكتروني</label>
                    <input type="email" name="uemail" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-800" placeholder="name@example.com" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">كلمة المرور</label>
                    <input type="password" name="upass" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-800" placeholder="••••••••" required>
                </div>

                <div>
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl transition duration-200 shadow-lg shadow-emerald-600/20">
                        تسجيل الدخول
                    </button>
                </div>

                <div class="text-center pt-2">
                    <a href="user/forgot.php" class="text-sm text-gray-500 hover:text-emerald-600 font-semibold transition">
                        هل نسيت كلمة المرور؟
                    </a>
                </div>
            </form>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>