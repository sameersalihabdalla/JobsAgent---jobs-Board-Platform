<?php

echo "<pre>";
print_r($_GET);
echo "</pre>";


// إعدادات التطبيق
$app_id = '1180575963872646';
$app_secret = '4d0fe7dcb5d8d1f9d97d1c646a055a00';
$redirect_uri = 'https://jobsagent.org/callback.php';

// التحقق من وجود كود التفويض
if (!isset($_GET['code'])) {
    exit("❌ لم يتم استلام كود التفويض من Facebook.");
}

// 1. الحصول على Short-Lived User Token
$token_url = "https://graph.facebook.com/v23.0/oauth/access_token?" . http_build_query([
    'client_id' => $app_id,
    'redirect_uri' => $redirect_uri,
    'client_secret' => $app_secret,
    'code' => $_GET['code']
]);

$response = file_get_contents($token_url);
$data = json_decode($response, true);

if (!isset($data['access_token'])) {
    echo "❌ فشل في الحصول على التوكن المؤقت:<br>";
    print_r($data);
    exit;
}

$short_token = $data['access_token'];
echo "<h3>✅ Short-Lived Token:</h3><textarea rows='3' cols='80'>$short_token</textarea><hr>";

// 2. تحويله إلى Long-Lived Token
$long_token_url = "https://graph.facebook.com/v23.0/oauth/access_token?" . http_build_query([
    'grant_type' => 'fb_exchange_token',
    'client_id' => $app_id,
    'client_secret' => $app_secret,
    'fb_exchange_token' => $short_token
]);

$response = file_get_contents($long_token_url);
$data = json_decode($response, true);

if (!isset($data['access_token'])) {
    echo "❌ فشل في تحويل التوكن إلى طويل الأجل:<br>";
    print_r($data);
    exit;
}

$long_token = $data['access_token'];
echo "<h3>✅ Long-Lived User Token:</h3><textarea rows='3' cols='80'>$long_token</textarea><hr>";

// 3. جلب الصفحات المرتبطة
$pages_url = "https://graph.facebook.com/v23.0/me/accounts?access_token=$long_token";
$response = file_get_contents($pages_url);
$pages = json_decode($response, true);

if (isset($pages['data']) && count($pages['data']) > 0) {
    echo "<h3>📄 الصفحات المرتبطة:</h3>";
    foreach ($pages['data'] as $page) {
        echo "<p><strong>{$page['name']}</strong><br>";
        echo "🆔 ID: {$page['id']}<br>";
        echo "🔐 Page Token:<br><textarea rows='2' cols='80'>{$page['access_token']}</textarea></p><hr>";
    }
} else {
    echo "❌ لم يتم العثور على صفحات أو حدث خطأ:<br>";
    print_r($pages);
}
