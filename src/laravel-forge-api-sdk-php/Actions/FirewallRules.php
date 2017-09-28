<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Firewall Rules Class: Handles all actions for firewall rules
 */
class FirewallRules extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Firewall Rule
 	 */
	public static function create($server_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
			"name"	=> $name,	// string: "rule name"
      "port"  => $port  // number: 88
		);
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/firewall-rules', $payload);
	}

  /**
	 * List Firewall Rules
 	 */
	public static function list($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
    return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/firewall-rules');
	}

  /**
	 * Get Firewall Rule
 	 */
	public static function get($server_id, $rule_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($rule_id) || !is_numeric($rule_id)) {
			return Errors::get('is_numeric($rule_id)');
		}
    return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/firewall-rules/'.$rule_id);
	}

  /**
	 * Delete Firewall Rule
 	 */
	public static function delete($server_id, $rule_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($rule_id) || !is_numeric($rule_id)) {
			return Errors::get('is_numeric($rule_id)');
		}
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/firewall-rules/'.$rule_id);
	}
}
