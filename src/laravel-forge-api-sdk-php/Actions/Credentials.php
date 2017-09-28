<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Credentials Class: Handles all actions for credentials
 */
class Credentials extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'credentials';

  /**
	 * List
   */
	public static function list() {
    return parent::getClient()::requestApi('GET', self::BASE_URL);
	}
}
