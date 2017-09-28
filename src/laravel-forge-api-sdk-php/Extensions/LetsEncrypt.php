<?php
namespace Laravel_Forge_API_SDK_PHP\Extensions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Actions\SSLCertificates;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * SSL Extensions Class: Extra functions for SSL certificates
 */
class LetsEncrypt extends SSLCertificates
{

  /*
   * Let's Encrypt Certificate Aggregator:
   * Obtain and activate a Let's Encrypt certificate with all existing domains then deletes all other inactive certificates
   * @param $server_id numeric
   * @param $site_id numeric
   * @param $add_domains array Optional: Add new domains for the new SSL certificate
   * @param $delete_domains array Optional: Remove existing domains for the new SSL certificate
   * @param $delete_existing boolean Default == true; Specifying false will prevent existing certificates from being deleted
   * @return json Lists all installed certificates
   */
  public static function letsencrypt_aggregator($server_id, $site_id, $add_domains, $delete_domains, $delete_existing = true) {
    /* Sample $add_domains:
 		$add_domains = array(
      'domain1.com',
      'domain2.com',
      'domain3.com'
 		);
    $delete_domains = array(
      'domain1.com',
      'domain2.com',
      'domain3.com'
 		);
    */
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
    if(!is_array($add_domains)) {
      return Errors::get('is_array($add_domains)');
    }
    if(!is_array($delete_domains)) {
      return Errors::get('is_array($delete_domains)');
    }
    $old_ssl_ids = LetsEncrypt::get_ssl_ids($server_id, $site_id);
    $domains = LetsEncrypt::get_ssl_domains($server_id, $site_id, $add_domains, $delete_domains);
    $payload = array("domains" => $domains);
    $new_ssl = SSLCertificates::letsencrypt($server_id, $site_id, $payload);
    $new_ssl_id = $new_ssl['certificate']['id'];
    if(!empty($new_ssl_id)) {
      LetsEncrypt::ssl_activate_when_installed($server_id, $site_id, $new_ssl_id, 5);
      if ($delete) {
        LetsEncrypt::ssl_cleanup($server_id, $site_id, $new_ssl_id, $old_ssl_ids, 3);
      }
    }
    return SSLCertificates::list($server_id, $site_id);
  }

  /*
   * Get all domains from existing SSL certificates (optional: add/delete domains to the array).
   * @return array
   */
  public static function get_ssl_domains($server_id, $site_id, $add_domains = [], $delete_domains = [])
  {
    /* Sample $add_domains:
 		$add_domains = array(
      'domain1.com',
      'domain2.com',
      'domain3.com'
 		);
    $delete_domains = array(
      'domain1.com',
      'domain2.com',
      'domain3.com'
 		);
    */
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
    if(!is_array($add_domains)) {
      return Errors::get('is_array($add_domains)');
    }
    if(!is_array($delete_domains)) {
      return Errors::get('is_array($delete_domains)');
    }
    // Get list of all SSL certificates for the server site
    $all_ssl = parent::list($server_id, $site_id);
    $active_ssl_domains = [];
    if (!empty($all_ssl)) {
      // Create an array with the domains of all current activated SSL certificates without any duplicate domains
      foreach ($all_ssl as $k => $ssls) {
        foreach ($ssls as $i => $ssl) {
          if ($ssl['active']) {
            $active_ssl_domains[] = $ssl['domain'];
          }
        }
      }
      $active_ssl_domains = array_unique(explode(',', implode(',', $active_ssl_domains)));
    }
    $domains = !empty($add_domains) ? array_merge($active_ssl_domains, $add_domains) : $active_ssl_domains;
    $domains = !empty($delete_domains) ? array_values(array_diff($domains, array_intersect($active_ssl_domains, $delete_domains))) : $active_ssl_domains;
    return $domains;
  }

  /*
   * Get all the ids of existing SSL certificates.
   * @return array
   */
  public static function get_ssl_ids($server_id, $site_id)
  {
    if(empty($server_id) || !is_numeric($server_id)) {
      return Errors::get('is_numeric($server_id)');
    }
    if(empty($site_id) || !is_numeric($site_id)) {
      return Errors::get('is_numeric($site_id)');
    }
      return array_column(parent::list($server_id, $site_id)['certificates'], 'id');
  }

    /*
     * Check if a SSL certificate is installed.
     * @return boolean
     */
    public static function is_ssl_installed($server_id, $site_id, $ssl_id)
    {
      if(empty($server_id) || !is_numeric($server_id)) {
        return Errors::get('is_numeric($server_id)');
      }
      if(empty($site_id) || !is_numeric($site_id)) {
        return Errors::get('is_numeric($site_id)');
      }
      if(empty($ssl_id) || !is_numeric($ssl_id)) {
        return Errors::get('is_numeric($ssl_id)');
      }
      return parent::get($server_id, $site_id, $ssl_id)['certificate']['existing'];
    }

    /*
     * Check if a SSL certificate is activated.
     * @return boolean
     */
    public static function is_ssl_active($server_id, $site_id, $ssl_id)
    {
      if(empty($server_id) || !is_numeric($server_id)) {
        return Errors::get('is_numeric($server_id)');
      }
      if(empty($site_id) || !is_numeric($site_id)) {
        return Errors::get('is_numeric($site_id)');
      }
      if(empty($ssl_id) || !is_numeric($ssl_id)) {
        return Errors::get('is_numeric($ssl_id)');
      }
      return parent::get($server_id, $site_id, $ssl_id)['certificate']['active'];
    }

    /*
     * Activates a new SSL certificate when it is finished installing.
     * Pings Forge every $time seconds to determine if installation is complete.
     */
    public static function ssl_activate_when_installed($server_id, $site_id, $ssl_id, $time = 5)
    {
      if(empty($server_id) || !is_numeric($server_id)) {
        return Errors::get('is_numeric($server_id)');
      }
      if(empty($site_id) || !is_numeric($site_id)) {
        return Errors::get('is_numeric($site_id)');
      }
      if(empty($ssl_id) || !is_numeric($ssl_id)) {
        return Errors::get('is_numeric($ssl_id)');
      }
      if (self::is_ssl_installed($server_id, $site_id, $ssl_id) == false) {
        return Errors::get('is_ssl_installed() == false');
      }
      if (self::is_ssl_active($server_id, $site_id, $ssl_id) == false) {
        return Errors::get('is_ssl_active == false');
      }
      $ssl_install_status = false;
      do {
        if (self::is_ssl_installed($server_id, $site_id, $ssl_id)) {
        	parent::activate($server_id, $site_id, $ssl_id);
          $ssl_install_status = true;
        }
        sleep($time);
      }
      while ($ssl_install_status == false);
    }

    /*
     * Deletes SSL certificates that are not activated after a new SSL installation.
     * Pings Forge every $time seconds; if new SSL is activated, delete all other SSL
     * @param $server_id numeric
     * @param $site_id numeric
     * @param $new_ssl_id numeric
     * @param $old_ssl_ids array
     * @param $time numeric
     * Note: $old_ssl_ids = get_ssl_ids($server_id, $site_id)
     */
    public static function ssl_cleanup($server_id, $site_id, $new_ssl_id, $old_ssl_ids, $time = 3)
    {
      /* Sample $old_ssl_ids:
      $old_ssl_ids = array(
        '12345',
        '23456',
        '34567'
      );
      */
      if(empty($server_id) || !is_numeric($server_id)) {
        return Errors::get('is_numeric($server_id)');
      }
      if(empty($site_id) || !is_numeric($site_id)) {
        return Errors::get('is_numeric($site_id)');
      }
      if(empty($new_ssl_id) || !is_numeric($new_ssl_id)) {
        return Errors::get('is_numeric($new_ssl_id)');
      }
      if (self::is_ssl_active($server_id, $site_id, $new_ssl_id) == false) {
        return Errors::get('is_ssl_active == false');
      }
      $ssl_activation_status = false;
      do {
        if (self::is_ssl_active($server_id, $site_id, $new_ssl_id)) {
            foreach ($old_ssl_ids as $old_ssl_id) {
              parent::delete($server_id, $site_id, $old_ssl_id);
            }
            $ssl_activation_status = true;
        }
        sleep($time);
      }
      while ($ssl_activation_status == false);
    }


}
