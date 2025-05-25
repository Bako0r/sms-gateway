# OTP-Gateway
Use your android smartphone as OTP-gateway api SMS + whatsapp (using adb,php)

مشروع OTP Gateway يسمح لك بإرسال رسائل SMS + Whatsapp عبر هاتف أندرويد باستخدام واجهة برمجة تطبيقات (API) بسيطة. يعتمد المشروع على اتصال ADB مع الهاتف وخادم ويب مكتوب بلغة PHP.

بمجرد تنزيل تعريف Android Platform tools يمكنك اجراء جميع العمليات مثل ( ارسال رسالة SMS, رسالة واتس اب , اجراء اتصال , اغلاق الاتصال , مجيب آلي إلى أخره )

 الخصائص الرئيسية :
 إرسال رسائل SMS عبر واجهة API. بإستخدام 
index.php
أو رسالة whatsapp بإستخدام whatsapp.php
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
افتح ملف index.php و whatsapp.php وغير القيم التالية:

$valid_api_key = "KEY"; 

 استبدلها بمفتاح سري خاص بك

 3. تفعيل USB Debugging على الهاتف

اذهب إلى إعدادات المطورين على الهاتف.

فعّل خيار USB Debugging.

4. قم بتوصيل الهاتف بالكمبيوتر

وصّل الهاتف عبر USB واسمح للاتصال عند ظهور إشعار طلب الازن.


طريقة الإستعمال ::



1. عبر طلب GET
SMS:


http://your-server.com/index.php?api_key=SECRET&phone=+963999999999&message=مرحبا%20هذه%20رسالة%20تجريبية

أو

Whatsapp:

http://your-server.com/sms_gateway/whatsapp.php?api_key=KEY&phone=9639999999990&message=Your%20code%20is%20828



2. عبر طلب POST

bash
curl -X POST \
  -H "API-Key: SECRET" \
  -d "phone=+963999999999&message=مرحبا من cURL" \
  http://your-server.com/index.php

  or whatsapp:

bash
curl -X POST \
  -H "API-Key: SECRET" \
  -d "phone=+963999999999&message=مرحبا من cURL" \
  http://your-server.com/whatsapp.php

  
مثال على الرد الناجح:


json
{
    "status": "success",
    "message": "تم الإرسال بنجاح",
    "data": {
        "phone": "+96399999999",
        "message": "مرحبا هذه رسالة تجريبية"
    }
}

اذا كنت تتوقع انو تستخدم كثير طلبات بنفس الوقت , استخدم نظام دور ( طابور ) منعا لحصول تعارض او Override

قاعدة بيانات ( Jobs Table ) 
Queue Worker
يعالج الطلب بالدور 


شكرا ً لكم ..
