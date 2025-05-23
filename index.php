<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$log_file = "sms_log.txt";
$valid_api_key = "KEY";

ini_set('default_charset', 'UTF-8');
mb_internal_encoding('UTF-8');

try {

    $received_api_key = $_REQUEST['api_key'] ?? '';
    if ($received_api_key !== $valid_api_key) {
        throw new Exception('مفتاح API غير صحيح', 401);
    }

  
    $phone = $_REQUEST['phone'] ?? '';
    $message = urldecode($_REQUEST['message'] ?? ''); // فك تشفير URL

    
    if (empty($phone) || !preg_match('/^\+?[0-9]\d{1,14}$/', $phone)) {
        throw new Exception('رقم الهاتف غير صالح', 400);
    }



    $adb_command = sprintf(
    'adb shell service call isms 5 i32 0 s16 "com.android.mms.service" s16 "null" s16 %s s16 "null" s16 \'%s\' s16 "null" s16 "null" i32 0 i64 0',
    escapeshellarg($phone),
    $message  
);


    $output = shell_exec($adb_command . ' 2>&1');


    $success = (strpos($output, "Parcel") !== false);

    
    $log_entry = sprintf(
        "[%s] Phone: %s | Message: %s | Output: %s\n",
        date('Y-m-d H:i:s'),
        $phone,
        $message,
        $output
    );
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);

    if (!$success) {
        throw new Exception('فشل في الإرسال: ' . $output, 500);
    }

    $response = [
        'status' => 'success',
        'message' => 'تم الإرسال بنجاح',
        'data' => [
            'phone' => $phone,
            'message' => $message
        ]
    ];

} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    $response = [
        'status' => 'error',
        'message' => $e->getMessage(),
        'debug' => $output ?? null
    ];
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>