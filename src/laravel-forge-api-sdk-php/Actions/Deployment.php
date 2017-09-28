<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Deployment Class: Handles all actions for deployment
 */
class Deployment extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Enable Quick Deployment
   */
	public static function enable($server_id, $site_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/deployment');
	}

  /**
	 * Disable Quick Deployment
   */
	public static function disable($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/sites/'.$site_id.'/deployment');
	}

  /**
	 * Get Deployment Script
   */
	public static function get_script($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/deployment/script');
	}

  /**
	 * Update Deployment Script
   */
	public static function update($server_id, $site_id, $payload = []) {
    /* Sample $payload:
  		$payload = array(
  			"content"	=> $content	// string: "CONTENT_OF_THE_SCRIPT"
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
		return parent::getClient()::requestApi('PUT', self::BASE_URL.$server_id.'/sites/'.$site_id.'/deployment/script');
	}

  /**
	 * Deploy Now
   */
	public static function deploy($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/deployment/deploy');
	}

  /**
	 * Reset Deployment Status
   */
	public static function reset($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/deployment/reset');
	}

  /**
	 * Get Deployment Log
   */
	public static function get_log($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/deployment/log');
	}
}
