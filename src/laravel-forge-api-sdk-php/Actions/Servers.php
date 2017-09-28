<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Servers Class: Handles all actions for servers
 */
class Servers extends Forge
{
	const BASE_URL = parent::API_BASE_URL.'servers/';

	/**
	 * Create Server
 	 */
	 public static function create($payload = []) {
	 /* Sample $payload:
		$payload = array(
			"provider"						=> $provider,						// string: "ocean2", "linode", "aws", "custom"
			"credential_id" 			=> $credential_id,			// string: required if provider is not 'custom'
			"name"								=> $name,								// string: "test-via-api"
			"size"								=> $size,								// string: "512MB", "1GB", "15GB", "m-16GB", "m-32GB", "m-64GB"
			"ip_address"					=> $ip_address,					// string: required if provider is 'custom'
			"private_ip_address"	=> $private_ip_address,	// string: required if provider is 'custom'
			"database"						=> $database,						// string: if empty, "forge" is used
			"maria"								=> $maria,							// boolean
			"php_version"					=> $php_version,				// string: "php71", "php70", "php56"
			"region"							=> $region,							// string: "uswest-2" (not-reqired if provider is 'custom');
			"load_balancer"				=> $load_balancer,			// boolean
			"network"							=> $network							// array: {"servers":[$server_id1, $server_id2]}
		);
		// See https://forge.laravel.com/api-documentation#regions for valid $region parameters
		// See https://forge.laravel.com/api-documentation#server-sizes for valid $size parameters
		*/
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL, $payload);
	}

	/**
	 * Get Server Status
 	 */
	public static function is_ready($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id)['server']['is_ready'];
	}

	/**
	 * List Servers
 	 */
	public static function list() {
		return parent::getClient()::requestApi('GET', self::BASE_URL);
	}

	/**
	 * Get Server
 	 */
	public static function get($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id);
	}

	/**
	 * Update Server
 	 */
	public static function update($server_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
			"name"								=> $name,								// string: "renamed-server"
			"size" 								=> $size,								// string: "512MB"
			"ip_address"					=> $ip_address,					// string: "192.241.143.108"
			"private_ip_address"	=> $private_ip_address,	// string: "10.136.8.40"
			"max_upload_size"			=> $max_upload_size,		// number: 123
			"network"							=> $network							// array: {"servers":[$server_id1, $server_id2]}
		);
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('PUT', self::BASE_URL.$server_id, $payload);
	}

	/**
	 * Update Database Password
	 */
	public static function update_database_password($server_id, $payload) {
	/* Sample $payload:
		$payload = array(
			"password" => $password	// string
		);
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('PUT', self::BASE_URL.$server_id.'/database-password', $payload);
 	}

 	/**
	 * Delete Server
	 */
	public static function delete($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id);
 	}

	/**
	 * Reboot Server
	 */
	public static function reboot($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/reboot');
 	}

	/**
	 * Revoke Forge Access to Server
	 */
	public static function revoke($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/revoke');
 	}

	/**
 	 * Reconnect Revoked Server
 	 */
	public static function reconnect($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/reconnect');
 	}

	/**
	 * Reactivate Revoked Server
	 */
	public static function reactivate($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
		 return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/reactivate');
 	}
}
