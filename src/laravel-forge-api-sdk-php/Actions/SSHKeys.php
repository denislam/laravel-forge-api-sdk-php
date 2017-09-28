<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * SSH Keys Class: Handles all actions for SSH keys
 */
class SSHKeys extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Key
   */
	public static function create($server_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
    	"name" => $name, // string: "test-key"
			"key"  => $key   // string: "KEY_CONTENT_HERE"
		);
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($payload) || !is_array($payload)) {
      return Errors::get('is_array($payload)');
    }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/keys', $payload	);
	}

  /**
	 * List Keys
   */
	public static function list($server_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/keys/');
	}

  /**
	 * Get Keys
   */
	public static function get($server_id, $key_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($key_id) || !is_numeric($key_id)) {
      return Errors::get('is_numeric($key_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/keys/'.$key_id);
	}

  /**
	 * Delete Key
   */
	public static function delete($server_id, $key_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($key_id) || !is_numeric($key_id)) {
      return Errors::get('is_numeric($key_id)');
    }
		return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/keys/'.$key_id);
	}
}
