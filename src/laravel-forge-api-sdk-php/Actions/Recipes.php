<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Recipes Class: Handles all actions for recipes
 */
class Recipes extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'recipes/';

    /**
  	 * Create Recipe
   	 */
  	public static function create($payload = []) {
  	/* Sample $payload:
  		$payload = array(
  			"name"    => $name,  // string: "Recipe Name"
        "user"    => $user,  // string: "root"
        "script"  => $script // string: "SCRIPT_CONTENT"
  		);
  	*/
  		if(empty($payload) || !is_array($payload)) {
  			return Errors::get('is_array($payload)');
  		}
  		return parent::getClient()::requestApi('POST', self::BASE_URL, $payload);
  	}

  /**
	 * List Recipes
 	 */
	public static function list() {
    return parent::getClient()::requestApi('GET', self::BASE_URL);
	}

  /**
	 * Get Recipe
 	 */
	public static function get($recipe_id) {
		if(empty($recipe_id) || !is_numeric($recipe_id)) {
			return Errors::get('is_numeric($recipe_id)');
		}
    return parent::getClient()::requestApi('GET', self::BASE_URL.$recipe_id);
	}

  /**
	 * Update Recipe
 	 */
	public static function update($recipe_id, $payload = []) {
    /* Sample $payload:
  		$payload = array(
  			"name"    => $name,  // string: "Recipe Name"
        "user"    => $user,  // string: "root"
        "script"  => $script // string: "SCRIPT_CONTENT"
  		);
  	*/
		if(empty($recipe_id) || !is_numeric($recipe_id)) {
			return Errors::get('is_numeric($recipe_id)');
		}
    if(empty($payload) || !is_array($payload)) {
      return Errors::get('is_array($payload)');
    }
    return parent::getClient()::requestApi('PUT', self::BASE_URL.$recipe_id);
	}

  /**
	 * Delete Recipe
 	 */
	public static function delete($recipe_id) {
		if(empty($recipe_id) || !is_numeric($recipe_id)) {
			return Errors::get('is_numeric($recipe_id)');
		}
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$recipe_id);
	}

  /**
	 * Run Recipe
 	 */
	public static function run($recipe_id, $payload = []) {
    /* Sample $payload:
  		$payload = array(
  			"servers" => $servers // array: {"servers":[1,2]}
  		);
  	*/
		if(empty($recipe_id) || !is_numeric($recipe_id)) {
			return Errors::get('is_numeric($recipe_id)');
		}
    if(empty($payload) || !is_array($payload)) {
      return Errors::get('is_array($payload)');
    }
    return parent::getClient()::requestApi('POST', self::BASE_URL.$recipe_id.'/run', $payload);
	}
}
