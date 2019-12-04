<?php
header("Access-Control-Allow-Origin: *");

$message = "desde php";
$id      = "ez3snI3APvU:APA91bH07lPP6g-TQVE6Gmm6iHvvLGkE_DJhejK-qpsMVAqUaor-7d84uAw2nCSxg9TyO2FzBDvYsAYmc-i7Q1vxXZAbPAfmNime4izYOuThcay1GXQ4CKtWpzs4T0eTJm0eWMkhkJnz";

sendGCM($message, $id) ;// disparo

function sendGCM($message, $id) {

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array (
            'registration_ids' => $id,
            'data' => array (
                    "message" => $message
            )
    );
    $fields = json_encode ( $fields );

    $headers = array (
            'Authorization: key=' . "AAAA8ij454s:APA91bFxFhVn7n63R8JoHQ6ujcwlE59jysPn38L1lWH8mr4F2i4tHn32WqjJdbVZlLU4l54NXFsJrFNjb94JxM46QUSP_rCxL6XnteNxG_jypuu48pCmnmO-0IfB4-5L8A3IUxZy_tqS",
            'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    echo $result.'hasta aqui';
    curl_close ( $ch );
}

?>

