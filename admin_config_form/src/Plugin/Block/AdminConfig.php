<?php

namespace Drupal\admin_config_form\Plugin\Block;

use Drupal\domain\Plugin\Block\DomainBlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\admin_config_form\Form\SchedulesForm;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Datetime\DrupalDateTime;
/**
 * Provides a admin configuration block .
 *
 * @Block(
 *   id = "admin_config_block",
 *   admin_label = @Translation("Admin Configuration Block")
 * )
 */
class AdminConfig extends BlockBase {
  /**
   * Build the output.
   *
   */
  public function build() {	
		$timeZoneTime ='';
		$config = \Drupal::config('admin_config.settings');  
		$country = $config->get('admin_country'); 
		$timeZone = $config->get('admin_timezone');  
		$adminConfigService = \Drupal::service('admin_config_form.timezone_service');
		$timeZoneTime = $adminConfigService->getSelectedTimeZoneTime($timeZone);
    return [
      '#theme' => 'admin_config',
	  '#timeZone' => $timeZone,
	  '#timeZoneTime' => $timeZoneTime,
	  '#cache' => [
					'max-age' => 0,
				  ],
    ];
  }
}
