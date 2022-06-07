<?php

namespace Drupal\admin_config_form\Services;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Datetime\DrupalDateTime;
/**
 * Helper functions for country service.
 */
class AdminConfigFormService {

	/**
	* Returns the
	*
	* @return time $timeZoneTime 
	*/
	public function getSelectedTimeZoneTime($timeZone) {
		$date = new DrupalDateTime();
		$date->setTimezone(new \DateTimeZone($timeZone));
		$timeZoneTime = $date->format('jS M Y - g:i A');
		return $timeZoneTime;
	}
	
	

}
