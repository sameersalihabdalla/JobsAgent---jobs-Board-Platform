<?php
// 🔴 1. إظهار الأخطاء للتشخيص (مؤقتاً)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. بيانات التطبيق
$client_id = "778dzqk51q1gka"; 

/**
 * دالة بسيطة للنشر التلقائي على LinkedIn
 */
function publish_linkedin_post($token, $text, $author_urn) {

    // 3. بناء محتوى المنشور
    $post_data = [
        "author" => $author_urn,
        "lifecycleState" => "PUBLISHED",
        "specificContent" => [
            "com.linkedin.ugc.ShareContent" => [
                "shareCommentary" => [
                    "text" => $text
                ],
                "shareMediaCategory" => "NONE" // لنشر نص فقط
            ]
        ],
        "visibility" => [
            "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC"
        ]
    ];
    
    // 4. إعداد طلب cURL للنشر
    $post_api_url = 'https://api.linkedin.com/v2/ugcPosts';
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $post_api_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer {$token}",
        "Content-Type: application/json",
        "X-Restli-Protocol-Version: 2.0.0"
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ['status' => $http_code, 'response' => json_decode($response, true)];
}

// **مثال على الاستخدام عند نشر منشور عام**
$stored_token = @file_get_contents('linkedin_token.txt'); 
// 🚨 قراءة الـ URN المخزن من الملف الجديد
$author_urn = @file_get_contents('linkedin_urn.txt'); 

$post_text = "✨ منشور تجريبي من Sameer Salih Digital Solutions & Hardware! تم استخراج الـ URN بنجاح. سنبدأ النشر التلقائي. ✅";


if ($stored_token && $author_urn) {
    
    $result = publish_linkedin_post($stored_token, $post_text, trim($author_urn));

    if ($result['status'] == 201) {
        echo "✅ تم نشر المنشور بنجاح على LinkedIn! (HTTP 201)";
    } else {
        echo "❌ فشل النشر. رمز الخطأ: " . $result['status'];
        echo " الرسالة: " . print_r($result['response'], true);
    }
    
} else {
    echo "📌 خطأ: لا يوجد Access Token أو URN مخزن. يجب ربط الحساب أولاً من خلال عملية التفويض.";
}
?>