<?php


namespace App\Classes;


class CURL
{
    public static function GET($url = 'localhost', $header = [], $config = []){
        $cURL = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header
        ];
        $keys = array_merge(array_keys($options), array_keys($config));
        $values = array_merge(array_values($options), array_values($config));
        $options = array_combine($keys, $values);
        curl_setopt_array($cURL, $options);
        $output = curl_exec($cURL);
        curl_close($cURL);
        return $output;
    }
    public static function POST($url = 'localhost', $body = null, $head = []){
        $cURL = curl_init();
        $options = [
            CURLOPT_URL => $url
            ,CURLOPT_CUSTOMREQUEST => 'POST'
            ,CURLOPT_HTTPHEADER => $head
            ,CURLOPT_POSTFIELDS => $body
            ,CURLOPT_RETURNTRANSFER => true
        ];
        curl_setopt_array($cURL, $options);
        $output = curl_exec($cURL);
        curl_close($cURL);
        return $output;
    }
    public static function PUT($url = 'localhost' , $body = null, $head = null ,$file = null, $fileSize = 0){
        $cURL = curl_init();
        $options = [
            CURLOPT_URL => $url
            ,CURLOPT_CUSTOMREQUEST => 'PUT'
            ,CURLOPT_HTTPHEADER => $head
            ,CURLOPT_POSTFIELDS => $body
            ,CURLOPT_INFILE => $file
            ,CURLOPT_INFILESIZE => $fileSize
            ,CURLOPT_RETURNTRANSFER => true
        ];
        curl_setopt_array($cURL, $options);
        $output = curl_exec($cURL);
        curl_close($cURL);
        return $output;
    }
    public static function DELETE($url = 'localhost', $body = null , $head = false ){
        $cURL = curl_init();
        $options = [
            CURLOPT_URL => $url
            ,CURLOPT_CUSTOMREQUEST => 'DELETE'
            ,CURLOPT_HTTPHEADER => $head
            ,CURLOPT_POSTFIELDS => $body
            ,CURLOPT_RETURNTRANSFER => true
        ];
        curl_setopt_array($cURL, $options);
        $output = curl_exec($cURL);
        curl_close($cURL);
        return $output;
    }
}
