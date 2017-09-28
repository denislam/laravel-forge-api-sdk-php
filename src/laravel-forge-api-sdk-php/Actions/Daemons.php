<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Daemons Class: Handles all actions for daemons
 */
class Daemons extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Daemon
 	 */
	public static function create($server_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
			"command"	=> $command,	// string: "COMMAND"
      "user"    => $user      // string: "root"
		);
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/daemons', $payload);
	}

  /**
	 * List Daemon
 	 */
	public static function list($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
    return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/daemons');
	}

  /**
	 * Get Daemon
 	 */
	public static function get($server_id, $daemon_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($daemon_id) || !is_numeric($daemon_id)) {
			return Errors::get('is_numeric($daemon_id)');
		}
    return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/daemons/'.$daemon_id);
	}

  /**
	 * Delete Daemon
 	 */
	public static function delete($server_id, $daemon_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($daemon_id) || !is_numeric($daemon_id)) {
			return Errors::get('is_numeric($daemon_id)');
		}
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/daemons/'.$daemon_id);
	}

  /**
	 * Restart Daemon
 	 */
	public static function restart($server_id, $daemon_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($daemon_id) || !is_numeric($daemon_id)) {
			return Errors::get('is_numeric($daemon_id)');
		}
    return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/daemons/'.$daemon_id.'/restart');
	}
}
