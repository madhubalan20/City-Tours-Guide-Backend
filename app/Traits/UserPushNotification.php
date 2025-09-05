<?php

namespace App\Traits;

trait UserPushNotification
{
    public function userPushNotification($user_id, $user_name, $title,  $image, $type, $description)
    {
        $content = array(
            "en" => $description
        );
        $headings = array(
            "en" => $title
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
            "big_picture" =>  $image,
            'large_icon' => $img,
            'content_available' => true,
            "ios_attachments" => $ios_img,
            "priority" => 10,
            "android_channel_id" => "a1e97b91-49dd-4a12-9a8e-43ed141b5319",
            "data" => array(
                'type' => $type,
                'user_name' => $user_name,
                'title' => $title,
                'image' => $image,
                'description' => $description,
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
