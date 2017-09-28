<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * MySQL Database Users: Handles all actions for MySQL database users
 */
class MySQLDatabaseUsers extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Database User
   */
	public static function create($server_id, $payload = []) {
	/* Sample $payload:
    $payload = array(
      "name"      => $name,      // string: "forge"
      "password"  => $password,  // string: "dolores"
      "databases" => $databases  // array: "{"databases:[$database_id1, $database_id2]}"
    );
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/mysql-users', $payload);
	}

  /**
	 * List Database Users
   */
	public static function list($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/mysql-users');
	}

  /**
	 * Get Database User
   */
	public static function get($server_id, $user_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($user_id) || !is_numeric($user_id)) {
			return Errors::get('is_numeric($user_id)');
		}
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/mysql-users/'.$user_id);
	}

  /**
	 * Update Database User
   */
	public static function update($server_id, $user_id, $payload = []) {
	/* Sample $payload:
    $payload = array(
      "databases" => $databases  // array: {"databases:[$database_id1, $database_id2]"}
    );
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($user_id) || !is_numeric($user_id)) {
			return Errors::get('is_numeric($user_id)');
		}
    if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('PUT', self::BASE_URL.$server_id.'/mysql-users/'.$user_id, $payload);
	}

  /**
   * Delete Database User
   */
  public static function delete($server_id, $user_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($user_id) || !is_numeric($user_id)) {
			return Errors::get('is_numeric($user_id)');
		}
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/mysql-users/'.$user_id);
  }
}
