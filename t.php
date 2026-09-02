<?php
// التوكن الذي حصلت عليه يدويًا
$access_token = 'AQVqGdn2lWQBzA7RXqEptK4IU1hEqT_nFnkfU0ePmEA6YeaGAU284NsIbQY0fz6I9iWAVJAh4d5oYVi9rP0yVH8wA29BseM8WCE23shykUVQbY43dpD46OEzH9jS0j-DB-hZFcdwpUL-mlEusj2rFqfPulRcOJUu5wpX2bCaKF-_sQ7orZiLt-s67G7yo34uQ54FsIvA2KhmjkXfSmN8w7w7tuFzStyormrPstAZpLmAe7y2vG8D-Shm3Pz06s8AofD6D_2su6sfo-PXl6YL0Ti6--lNT3WID8tu7-nCXUN4gbgq7eH0u8KeISDZOG2ynZYfk5Lgco5ou4lAr3NOGLowDW5sdA';


$ch = curl_init('https://api.linkedin.com/v2/me');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer {$access_token}"
]);
$response = curl_exec($ch);
curl_close($ch);

// عرض الاستجابة كاملة
echo "<pre>" . htmlspecialchars($response) . "</pre>";
?>