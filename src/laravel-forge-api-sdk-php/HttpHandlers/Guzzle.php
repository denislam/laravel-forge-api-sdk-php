<?php
namespace Laravel_Forge_API_SDK_PHP\HttpHandlers;
use Exception;
use GuzzleHttp\Client;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Call the Forge API using the Guzzle 6 PHP client.
 */
class Guzzle extends Forge
{
  public static function requestApi($method, $url, $payload = [])
  {
    $client = new Client([
        'base_url'    => parent::API_BASE_URL,
        'http_errors' => false
    ]);
    $res = $client->request($method, $url, [
      'headers' => [
        'Authorization' => 'Bearer ' . parent::getToken(),
        'Accept'        => 'application/json',
        'Content-Type'  => 'application/json'
      ],
      'json' => $payload
    ]);
    if ($res->getStatusCode() != 200) {
      return Errors::get($res->getStatusCode());
    } else {
      $body = $res->getBody();
      $body = Forge::isJson($body) ? json_decode($body, true) : $body;
      if (empty($body)) {
        return Errors::get('invalid_token');
      } else {
        return $body;
      }
    }
  }
}
