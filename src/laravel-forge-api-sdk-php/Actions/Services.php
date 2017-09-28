<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Services Class: Handles all actions for services
 */
class Services extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

	/**
	 * Reboot MySQL
 	 */
	public static function reboot_mysql($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/mysql/reboot');
	}

	/**
	 * Stop MySQL
 	 */
	public static function stop_mysql($server_id) {
		if(!is_numeric($server_id)) { return Errors::get('is_numeric($server_id)'); }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/mysql/stop');
	}

	/**
	 * Reboot Nginx
 	 */
	public static function reboot_nginx($server_id) {
		if(!is_numeric($server_id)) { return Errors::get('is_numeric($server_id)'); }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/nginx/reboot');
	}

	/**
	 * Stop Nginx
 	 */
	public static function stop_nginx($server_id) {
		if(!is_numeric($server_id)) { return Errors::get('is_numeri($server_id)'); }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/nginx/stop');
	}

	/**
	 * Reboot Postgres
 	 */
	public static function reboot_postgres($server_id) {
		if(!is_numeric($server_id)) { return Errors::get('is_numeric($server_id)'); }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'');
	}

	/**
	 * Stop Postgres
 	 */
	public static function stop_postgres($server_id) {
		if(!is_numeric($server_id)) { return Errors::get('is_numeric($server_id)'); }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/postgres/stop');
	}

	/**
	 * Install Blackfire
 	 */
	public static function install_blackfire($payload = []) {
	/* Sample $payload:
		$payload = array(
			"server_id"			=> $server_id,		// numeric string: "128345"
			"server_token"	=> $server_token	// string
		);
	*/
		if(!is_array($payload)) { return Errors::get('is_array($payload)'); }
		return parent::getClient()::requestApi('POST', self::BASE_URL.'blackfire/install', $payload);
	}

	/**
	 * Install Papertrail
 	 */
	public static function install_papertrail($payload = []) {
	/* Sample $payload:
		$payload = array(
			"host"		=> $host	// string: "192.241.143.108"
		);
	*/
		if(!is_array($payload)) { return Errors::get('is_array($payload'); }
		return parent::getClient()::requestApi('POST', self::BASE_URL.'papertrail/install', $payload);
	}

	/**
	 * Remove Papertrail
 	 */
	public static function remove_papertrail($payload = []) {
	/* Sample $payload:
		$payload = array(
			"host"		=> $host	// string: "192.241.143.108"
		);
	*/
		if(!is_array($payload)) { return Errors::get('is_array($payload)'); }
		return parent::getClient()::requestApi('DELETE', self::BASE_URL.'papertrail/remove', $payload);
	}
}
