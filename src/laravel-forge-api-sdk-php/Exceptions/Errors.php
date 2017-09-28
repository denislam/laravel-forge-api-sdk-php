<?php
namespace Laravel_Forge_API_SDK_PHP\Exceptions;
use Exception;
use Laravel_Forge_API_SDK_PHP\Forge;

/**
 * Errors Class: Base class for the custom Exception class
 */
abstract class Errors extends Exception
{
  protected $id;
  protected $details;

  /**
	 * Custom error message $id manager
   */
  private static function errors($id)
  {
    $data = [
      // HTTP response errors
      '302' => ['context'  => '302 Error: Something is wrong. Redirecting to homepage...' ],
      '400' => ['context'  => '400 Error: Valid data was given but the request has failed.' ],
      '401' => ['context'  => '401 Error: No valid API Key was given..'],
      '404' => ['context'  => '404 Error: The requested resource could not be found.'],
      '422' => ['context'  => '422 Error: The payload has missing required parameters or invalid data was given.'],
      '429' => ['context'  => '429 Error: The requested resource could not be found.'],
      '500' => ['context'  => '500 Error: Request failed due to an internal error in Forge.'],
      '503' => ['context'  => '503 Error: Forge is offline for maintenance.'],

      // General errors
      'invalid_token'             => ['context'  => 'Server is returning NULL. Check your Forge API token!'],
      'is_array($payload)'        => ['context'  => '$payload needs to be a valid array.'],

      // Servers action errors
      'is_numeric($server_id)'    => ['context'  => '$server_id needs to be a valid number.'],

      // Daemons action errors
      'is_numeric($daemon_id)'    => ['context'  => '$daemon_id needs to be a valid number.'],

      // Firewall Rules action errros
      'is_numeric($rule_id)'      => ['context'  => 'Firewall $rule_id needs to be a valid number.'],

      // Scheduled Jobs action errors
      'is_numeric($job_id)'       => ['context'  => 'Scheduled $job_id needs to be a valid number.'],

      // MySQL Database action errors
      'is_numeric($database_id)'  => ['context'  => 'MySQL $database_id needs to be a valid number.'],

      // MySQL Database Users action errors
      'is_array($databases)'      => ['context'  => 'MySQL $databases needs to be a valid array.'],
      'is_numeric($user_id)'      => ['context'  => 'MySQL $user_id needs to be a valid number.'],

      // Sites action errors
      'is_numeric($site_id)'      => ['context'  => '$site_id needs to be a valid number.'],

      // SSL Certificates action errors
      'is_numeric($ssl_id)'       => ['context'  => '$ssl_id needs to be a valid number.'],

      // SSH Keys action errors
      'is_numeric($key_id)'       => ['context'  => '$key_id needs to be a valid number.'],

      // Worker action errors
      'is_numeric($worker_id)'    => ['context'  => '$worker_id needs to be a valid number.'],

      // Recipes action errors
      'is_numeric($recipe_id)'    => ['context'  => '$recipe_id needs to be a valid number.'],

      // Let's Encrypt extension errors
      'is_array($add_domains)'    => ['context'  => '$add_domains needs to be a valid array.'],
      'is_array($delete_domains)' => ['context'  => '$delete_domains needs to be a valid array.'],
      'is_ssl_installed == false' => ['context'  => '$ssl_id needs to be installed first.'],
      'is_ssl_active == false'    => ['context'  => '$ssl_id needs to be activated first.'],
      'is_numeric($new_ssl_id)'   => ['context'  => '$new_ssl_id needs to be a valid number.'],

// ### DO NOT REMOVE THE ERROR MESSAGES ABOVE THIS LINE! ADD CUSTOM ERRORS BELOW...###

    ];
      return $data[$id];
  }

  /**
	 * Get an error message.
   */
  public static function get($context)
  {
    try {
      throw new ForgeException($context);
    }
    catch(ForgeException $e) {
      return $e->getMessage();
    }
  }

  /**
	 * Create an error message.
   */
  protected function create(array $args)
  {
      $this->id = array_shift($args);
      $error = $this->errors($this->id);
      $this->details = vsprintf($error['context'], $args);
      return $this->details;
  }
}

/**
 * Larvel Forge API PHP SDK custom Exception class
 */
class ForgeException extends Errors
{
    public function __construct()
    {
        $message = $this->create(func_get_args());
        parent::__construct($message);
    }
}
