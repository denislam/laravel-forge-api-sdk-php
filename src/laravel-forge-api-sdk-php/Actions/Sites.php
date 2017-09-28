<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Sites Class: Handles all actions for sites
 */
class Sites extends Forge
{
	const BASE_URL = parent::API_BASE_URL.'servers/';

	/**
	 * Create Site
 	 */
	 public static function create($server_id, $payload = []) {
	 /* Sample $payload:
		$payload = array(
			"domain"				=> $domain,				// string: "site.com"
			"project_type"	=> $project_type,	// string: "php", "html", "Symphony", "symphony_dev"
			"directory"			=> $directory			// string: "/directory"
		);
	 */
	 if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
	 }
	 if(empty($payload) || !is_array($payload)) {
		 return Errors::get('is_array($payload)');
	 }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites', $payload);
	}

	/**
	 * List Sites
 	 */
	public static function list($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
 		 return Errors::get('is_numeric($server_id)');
 	 }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites');
	}

	/**
	 * Get Site
 	 */
	public static function get($server_id, $site_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
 		 return Errors::get('is_numeric($server_id)');
 	 	}
		if(empty($site_id) || !is_numeric($site_id)) {
			return Errors::get('is_numeric($site_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id);
	}

	/**
	 * Update Site
 	 */
	public static function update($server_id, $site_id, $payload = []) {
		$payload = array(
			"directory"	=> $directory,	// string: "/some/path"
		);
		if(empty($server_id) || !is_numeric($server_id)) {
 		 return Errors::get('is_numeric($server_id)');
 	 	}
		if(empty($site_id) || !is_numeric($site_id)) {
			return Errors::get('is_numeric($site_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('PUT', self::BASE_URL.$server_id.'/sites/'.$site_id, $payload);
	}

 	/**
	 * Delete Site
	 */
	public static function delete($server_id, $site_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
 		 return Errors::get('is_numeric($server_id)');
 	 	}
		if(empty($site_id) || !is_numeric($site_id)) {
			return Errors::get('is_numeric($site_id)');
		}
		return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/sites/'.$site_id);
 	}

	/**
	 * Load Balancing
	 */
	public static function balancing($server_id, $site_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
			"servers"	=> $servers, // array: {"servers":[1,2,3]}
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
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites'.$site_id.'/balancing');
 	}
}
