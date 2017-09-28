<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * MySQL Databases Class: Handles all actions for MySQL databases
 */
class MySQLDatabases extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Database
   */
	public static function create($server_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
    	"name" 			=> "forge",		// string: "forge"
			"user" 			=> "forge",		// string: "forge" (cannot use existing username)
  		"password"	=> "dolores"	// string: "dolores"
		);
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/mysql', $payload	);
	}

  /**
	 * List Databases
   */
	public static function list($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/mysql');
	}

  /**
	 * Get Database
   */
	public static function get($server_id, $database_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
    if(empty($database_id) || !is_numeric($database_id)) {
			return Errors::get('is_numeric($database_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/mysql/'.$database_id);
	}

  /**
   * Delete Database
   */
  public static function delete($server_id, $database_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
    if(empty($database_id) || !is_numeric($database_id)) {
			return Errors::get('is_numeric($database_id)');
		}
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/mysql/'.$database_id);
  }
}
