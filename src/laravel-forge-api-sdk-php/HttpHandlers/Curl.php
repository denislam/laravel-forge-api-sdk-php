<?php
namespace laravel_forge_api_sdk_php\HttpHandlers;
use Exception;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Call the Forge API using the cURL PHP client.
 */
class Curl extends Forge
{
  public static function requestApi($method, $url, $payload = [])
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization: Bearer ' . Forge::getToken(),
    ));
    if ($method == 'POST') {
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    }
    if ($method == 'PUT') {
      curl_setopt($ch, CURLOPT_PUT, 1);
    }
    $response = curl_exec($ch);
    $response = Forge::isJson($response) ? json_decode($response, true) : $response;
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
      return Errors::get(curl_getinfo($ch, CURLINFO_HTTP_CODE));
    } else {
      if (empty($response)) {
        return Errors::get('invalid_token');
      } else {
        return $response;
      }
    }
    curl_close($ch);
  }
}
