<?php

namespace SaArash\ReligiousTime\Religious;

class Religious
{
    public $apiUrl = 'https://one-api.ir/owghat/';
    public $apiKey = '{YOUR API KEY}';
    public $city = 'تهران';
    public $enNum = 'false';
    public function __construct($city)
    {
        $this->city = $city;
    }
    public function getReligious()
    {
        $url = $this->apiUrl . '?token=' . $this->apiKey . '&city=' . urlencode($this->city) . '&en_num=' . $this->enNum;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //ssl validation
        $response = curl_exec($curl);

        // بررسی خطا در اتصال
        if ($response === false) {
            $error = curl_error($curl);
            echo "خطا در ارتباط با API: " . $error;
            // دستورات دیگر برای مدیریت خطا
        } else {
            // پردازش پاسخ دریافتی
            // مثال:
            $data = json_decode($response, true);
            if ($data && isset($data['result'])) {
                $result = $data['result'];
                // var_dump(($result));
                echo ("<table border=''>");
                echo ("<tr>");
                echo ("<td style='text-align: center' colspan='3'>" . $result['city'] . '</td>');
                echo ("<td style='text-align: center' colspan='3'>" . '   تاریخ ' . $result['month'] . '/' . $result['day'] . '</td>');
                echo ('</tr>');
                echo ('<tr>');
                echo ('<td>اذان صبح</td>');
                echo ('<td>طلوع افتاب</td>');
                echo ('<td>اذان ظهر</td>');
                echo ('<td>غروب افتاب</td>');
                echo ('<td>اذان مغرب</td>');
                echo ('<td>نیمه شب شرعی </td>');
                echo ('</tr>');
                echo ('<tr>');
                echo ('<td>' . $result['azan_sobh'] . '</td>');
                echo ('<td>' . $result['toloe_aftab'] . '</td>');
                echo ('<td>' . $result['azan_zohre'] . '</td>');
                echo ('<td>' . $result['ghorob_aftab'] . '</td>');
                echo ('<td>' . $result['azan_maghreb'] . '</td>');
                echo ('<td>' . $result['nime_shabe_sharie'] . '</td>');
                echo ('</tr>');
                echo ('</table>');
                // عملیات دیگر با نتیجه دریافتی
            } else {
                echo "خطا";
                // دستورات دیگر برای مدیریت خطا
            }
        }
        // close connection
        curl_close($curl);
    }
}
