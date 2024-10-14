<?php
namespace App\Model;
session_start();
class Task {

    public static function getAll() {
        $data = self::give_data();
        $encoded_data = json_encode($data);
        return $encoded_data;
    }

    static function give_data() {
        // API URLs
        $loginUrl = 'https://api.baubuddy.de/index.php/login';
        $dataUrl = 'https://api.baubuddy.de/dev/index.php/v1/tasks/select';
        $accessToken = NULL;
        // use our last token if we already have one, otherwise ask for a new one
        if (!isset($_SESSION['access_token'])) {
            $accessToken = self::authenticate($loginUrl);
        } else {
            $accessToken = $_SESSION['access_token'];
        }
        $data = self::fetchData($dataUrl, $accessToken);

        //If we have no data then we have a token and he expired, we have to ask for new token
        if(is_null($data)){ 
            $accessToken = self::authenticate($loginUrl);

            // Then we ask again for data 
            $data = self::fetchData($dataUrl, $accessToken);

            // If we still have an error then there is no data
            if(is_null($data)){
                return NULL;
            }
        }
        return $data;
        
    }

    static function authenticate($url) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(["username" => "365", "password" => "1"]),
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return NULL;
        } else {
            $responseData = json_decode($response, true);
            $accessToken = $responseData['oauth']['access_token']; 
            $_SESSION['access_token'] = $accessToken;
            return  $accessToken;
        }
    }

    static function fetchData($url, $accessToken) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $accessToken,
                "Content-Type: application/json"
            ],
        ]);

        $dataResponse = curl_exec($curl);
        $err = curl_error($curl);
        $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($err || $httpStatusCode != 200) {
            return NULL;
        } else {
            return json_decode($dataResponse);
        }
    }
}
