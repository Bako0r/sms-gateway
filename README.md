# SMS-Gateway
use your android smartphone as sms-gateway api ( using adb,php)

مشروع SMS Gateway يسمح لك بإرسال رسائل SMS عبر هاتف أندرويد باستخدام واجهة برمجة تطبيقات (API) بسيطة. يعتمد المشروع على اتصال ADB مع الهاتف وخادم ويب مكتوب بلغة PHP.

بمجرد تنزيل تعريف Android Platform tools يمكنك اجراء جميع العمليات مثل ( ارسال رسالة , اجراء اتصال , اغلاق الاتصال , مجيب آلي إلى أخره )
مثال : ارسال رسالة ( أندرويد 10+)

adb shell service call isms 5 i32 0 s16 "com.android.mms.service" s16 "null" s16 "0999999999" s16 "null" s16 'الرسالة هنا' s16 "null" s16 "null" i32 0 i64 0

يمكنك استخدامه مباشرا ك كود bash

يوجد مشروع اخر قيد التطوير وهو لتفعيل البرامج OTP عبر الاتصال وليس SMS ايضا !
 لكن في هذا المشروع سنتحدث عن SMS Gateway otp عن طريق ربطه ب php api

 الخصائص الرئيسية :
إرسال رسائل SMS عبر واجهة API.
تسجيل النشاطات في ملف سجلات (sms_log.txt).
التحقق من الصلاحيات باستخدام مفتاح API.
دعم طلبات GET و POST.
حماية ضد الهجمات الأساسية مثل حقن الأوامر.

المتطلبات الأساسية
هاتف أندرويد مع تفعيل USB Debugging.
اتصال USB بين الهاتف والكمبيوتر.
Android Platform Tools (ADB).

خادم ويب (مثل XAMPP، WAMP، أو Nginx)

طريقة الإعداد ::
1. تأكد من تنزيل تعريفات الـADB الخاصة بالاندرويد في الكومبيوتر الخاص بك
2. تعديل الإعدادات
افتح ملف index.php وغير القيم التالية:

$valid_api_key = "YOUR_SECRET_KEY"; 
 استبدلها بمفتاح سري خاص بك
 3. تفعيل USB Debugging على الهاتف
اذهب إلى إعدادات المطورين على الهاتف.
فعّل خيار USB Debugging.
4. قم بتوصيل الهاتف بالكمبيوتر
وصّل الهاتف عبر USB واسمح للاتصال عند ظهور إشعار طلب الازن.


طريقة الإستعمال ::



1. عبر طلب GET

http://your-server.com/index.php?api_key=SECRET&phone=+963990385460&message=مرحبا%20هذه%20رسالة%20تجريبية

2. عبر طلب POST

bash
curl -X POST \
  -H "API-Key: SECRET" \
  -d "phone=+963990385460&message=مرحبا من cURL" \
  http://your-server.com/index.php
مثال على الرد الناجح:
json
{
    "status": "success",
    "message": "تم الإرسال بنجاح",
    "data": {
        "phone": "+963990385460",
        "message": "مرحبا هذه رسالة تجريبية"
    }
}

شكرا ً لكم ..
