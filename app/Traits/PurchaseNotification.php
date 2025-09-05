<?php

namespace App\Traits;

trait PurchaseNotification
{
    public function tourPurchaseNotification($user_id, $purchase_id, $type, 
    $order_number, $order_status, $tour_id, $tour_name, $city_id, $city_name)
    {
        $content = array(
            "en" => "Your purchase (" . $order_number . ") is confirmed. Thank you for choosing City Tour Guide!"
        );
        $headings = array(
            "en" => "Purchase Notification"
        );
        $img = array(
            "id1" => ""
        );
        $ios_img = array(
            "id2" => ""
        );

        $fields = array(
            'app_id' => '40b9e9ca-c4b5-4538-9a4a-6a2b133507cb',
            "headings" => $headings,
            'include_external_user_ids' => array(strval($user_id)),
            "channel_for_external_user_ids" => "push",

            'contents' => $content,
            'android_sound' => 'notification',
            "big_picture" => $img,
            'large_icon' => $img,
            'content_available' => true,
            "ios_attachments" => $ios_img,
            "priority" => 10,
            "android_channel_id" => "a1e97b91-49dd-4a12-9a8e-43ed141b5319",
            "data" => array(
                'type' => $type,
                'purchase_id' => $purchase_id,
                'purchase_status' => $order_status,
                'tour_id' => $tour_id,
                'tour_name' => $tour_name,
                'city_id' => $city_id,
                'city_name' => $city_name
            )
        );
       
        $headers = array(
            'Authorization: Basic YzE5MDM3ZWEtMGE1ZC00Y2Q2LThlZGEtZDM0NDk2ZGZlMmQ0',
            'Content-Type: application/json; charset=utf-8'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);

        curl_close($ch);
    }
}
