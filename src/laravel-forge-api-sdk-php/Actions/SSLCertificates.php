<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * SSL Certificates Class: Handles all actions for SSL certificates
 */
class SSLCertificates extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Certificate
   */
	public static function create($server_id, $site_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
    	"type" 		      => "new",
			"domain" 	      => $domain,		    // string: "domain.com"
  		"country"	      => $country,	    // string: "US"
      "state"         => $state,        // string: "NY"
      "city"          => $city,         // string: "New York"
      "organization"  => $organization, // string: "Company Name"
      "department"    => $department    // string: "IT"
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
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates', $payload	);
	}

  /**
	 * Installing An Existing Certificate
   */
	public static function install_existing($server_id, $site_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
    	"type" 		    => "existing",
			"key" 	      => $key,		     // string: "PRIVATE_KEY_HERE"
  		"certificate" => $certificate, // string: "CERTIFICATE_HERE"
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
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates', $payload	);
	}

  /**
	 * Cloning An Existing Certificate
   */
	public static function clone($server_id, $site_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
    	"type" 		       => "clone",
  		"certificate_id" => $certificate_id // number: 1
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
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates', $payload	);
	}

  /**
	 * Obtain A Let's Encrypt Certificate
   */
	public static function letsencrypt($server_id, $site_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
    	"domains" => $domains // array: array("www.site.com")
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
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates/letsencrypt', $payload	);
	}

  /**
	 * List Certificates
   */
	public static function list($server_id, $site_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates');
	}

  /**
	 * Get Certificate
   */
	public static function get($server_id, $site_id, $ssl_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($ssl_id) || !is_numeric($ssl_id)) {
      return Errors::get('is_numeric($ssl_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates/'.$ssl_id);
	}

  /**
	 * Get Signing Request (CSR)
   */
	public static function sign($server_id, $site_id, $ssl_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($ssl_id) || !is_numeric($ssl_id)) {
      return Errors::get('is_numeric($ssl_id)');
    }
		return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates/'.$ssl_id.'/csr');
	}

  /**
	 * Install Certificate
   */
	public static function install($server_id, $site_id, $ssl_id, $payload = []) {
    /* Sample $payload:
      $payload = array(
        "certificate"       => $certificate,      // string: "certificate content"
        "add_intermediates" => $add_intermediates // boolean: false
      );
    */
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($ssl_id) || !is_numeric($ssl_id)) {
      return Errors::get('is_numeric($ssl_id)');
    }
		if(empty($payload) || !is_array($payload)) {
      return Errors::get('is_array($payload)');
    }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates/'.$ssl_id.'/install');
	}

  /**
	 * Activate Certificate
   */
	public static function activate($server_id, $site_id, $ssl_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($ssl_id) || !is_numeric($ssl_id)) {
      return Errors::get('is_numeric($ssl_id)');
    }
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates/'.$ssl_id.'/activate');
	}

  /**
	 * Delete Certificate
   */
	public static function delete($server_id, $site_id, $ssl_id) {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
		if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
		if(empty($ssl_id) || !is_numeric($ssl_id)) {
      return Errors::get('is_numeric($ssl_id)');
    }
		return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/sites/'.$site_id.'/certificates/'.$ssl_id);
	}
}
