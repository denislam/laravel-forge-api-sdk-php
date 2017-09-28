<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * git Projects Class: Handles all actions for git projects
 */
class GitProjects extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
   * Install New
   */
  public static function install($server_id, $site_id, $payload = []) {
    /* Sample $payload:
      $payload = array(
        "provider"    => $provider,   // string: "github"
        "repository"  => $repository  // string: "username/repository"
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
    return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/git', $payload);
  }

  /**
   * Remove Project
   */
  public static function remove($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/sites/'.$site_id.'/git');
  }
}
