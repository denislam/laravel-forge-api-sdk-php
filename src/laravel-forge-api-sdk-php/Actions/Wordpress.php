<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Wordpress Class: Handles all actions for Wordpress
 */
class Wordpress extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
   * Install
   */
  public static function install($server_id, $site_id, $payload = []) {
    /* Sample $payload:
      $payload = array(
        "database"  => $database, // string: "forge"
        "user"      => $user      // string: "forge"
      );
    */
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
    if(empty($payload) || !is_array($payload)) {
      return Errors::get('is_array($payload)');
    }
    return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/wordpress', $payload);
  }

  /**
   * Uninstall Wordpress
   */
  public static function uninstall($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/sites/'.$site_id.'/wordpress');
  }
}
