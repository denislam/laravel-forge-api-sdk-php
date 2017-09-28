<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Configuration Files Class: Handles all actions for configuration files
 */
class ConfigurationFiles extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Get Nginx Configuration
   */
	public static function get_nginx($server_id, $site_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/nginx');
	}

  /**
	 * Update Nginx Configuration
   */
	public static function update_nginx($server_id, $site_id, $payload = []) {
    /* Sample $payload:
  		$payload = array(
  			"content"	=> $content	// string: "CONTENT"
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
		return parent::getClient()::requestApi('PUT', self::BASE_URL.$server_id.'/sites/'.$site_id.'/nginx');
	}

  /**
	 * Get .env File
   */
	public static function get_env($server_id, $site_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/env');
	}

  /**
	 * Update .env File
   */
	public static function update_env($server_id, $site_id, $payload = []) {
    /* Sample $payload:
  		$payload = array(
  			"content"	=> $content	// string: "CONTENT"
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
		return parent::getClient()::requestApi('PUT', self::BASE_URL.$server_id.'/sites/'.$site_id.'/env');
	}
}
