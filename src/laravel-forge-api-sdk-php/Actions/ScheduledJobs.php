<?php
namespace Laravel_Forge_API_SDK_PHP\Actions;
use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Exceptions\Errors;

/**
 * Scheduled Jobs Class: Handles all actions for scheduled jobs
 */
class ScheduledJobs extends Forge
{
	const BASE_URL = Forge::API_BASE_URL.'servers/';

  /**
	 * Create Scheduled Job
 	 */
	public static function create($server_id, $payload = []) {
	/* Sample $payload:
		$payload = array(
			"command"    => $command,   // string: "COMMAND_THE_JOB_RUNS"
      "frequency"  => $frequency, // string: "custom"
      "user"       => $user,      // string: "root"
      "minute"     => $minute,    // string: "*"
      "hour"       => $hour,      // string: "*"
      "day"        => $day,       // string: "*"
      "month"      => $month,     // string: "*"
      "weekday"    => $weekday    // string: "*"
		);
	*/
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
		if(empty($payload) || !is_array($payload)) {
			return Errors::get('is_array($payload)');
		}
		return parent::getClient()::requestApi('POST', self::BASE_URL.$server_id.'/jobs', $payload);
	}

  /**
	 * List Scheduled Jobs
 	 */
	public static function list($server_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
    return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/jobs');
	}

  /**
	 * Get Scheduled Job
 	 */
	public static function get($server_id, $job_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
  	if(empty($job_id) || !is_numeric($job_id)) {
			return Errors::get('is_numeric($job_id)');
		}
    return parent::getClient()::requestApi('GET', self::BASE_URL.$server_id.'/jobs/'.$job_id);
	}

  /**
	 * Delete Scheduled Job
 	 */
	public static function delete($server_id, $job_id) {
		if(empty($server_id) || !is_numeric($server_id)) {
			return Errors::get('is_numeric($server_id)');
		}
  	if(empty($job_id) || !is_numeric($job_id)) {
			return Errors::get('is_numeric($job_id)');
		}
    return parent::getClient()::requestApi('DELETE', self::BASE_URL.$server_id.'/jobs/'.$job_id);
	}
}
