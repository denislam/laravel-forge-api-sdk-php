<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Workers Class: Handles all actions for workers
 */
class Workers extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Worker
   */
	public static function create($server_id, $site_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
    	"connection" => $connection, // string: "sqs"
			"timeout"    => $timeout,    // number: 90
      "sleep"      => $sleep,      // number: 60
      "tries"      => $tries,      // number: null
      "daemon"     => $daemon      // boolean: true
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
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/workers', $payload	);
	}

  /**
	 * List Workers
   */
	public static function list($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/workers');
	}

  /**
	 * Get Worker
   */
	public static function get($server_id, $site_id, $worker_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($worker_id) || !is_numeric($worker_id)) {
      return Errors::get('is_numeric($worker_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/workers/'.$worker_id);
	}

  /**
	 * Delete Worker
   */
	public static function delete($server_id, $site_id, $worker_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($worker_id) || !is_numeric($worker_id)) {
      return Errors::get('is_numeric($worker_id)');
    }
		return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/sites/'.$site_id.'/workers/'.$worker_id);
	}

  /**
	 * Restart Worker
   */
	public static function restart($server_id, $site_id, $worker_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($worker_id) || !is_numeric($worker_id)) {
      return Errors::get('is_numeric($worker_id)');
    }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/workers/'.$worker_id.'/restart');
	}
}
