<?php

namespace Drupal\admin_config_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class AdminConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
        'admin_config.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
   
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
    $config = $this->config('admin_config.settings');
   // $form['#cache'] = ['max-age' => 0];
	$options = [0 => t('Time Zone'), 'America/Chicago' => 'America/Chicago', 'America/New_York' => 'America/New_York', 'Asia/Tokyo' => 'Asia/Tokyo', 'Asia/Dubai' => 'Asia/Dubai', 'Asia/Kolkata' => 'Asia/Kolkata', 'Europe/Amsterdam' => 'Europe/Amsterdam', 'Europe/Oslo' => 'Europe/Oslo', 'Europe/London' => 'Europe/London']; 
	
    $form['admin_country'] = [        
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#required' => true,
      '#default_value' => $config->get('admin_country'),
    ];
    
    $form['admin_city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#required' => true,
      '#default_value' => $config->get('admin_city'),
    ];
   
	$form['admin_timezone'] = [
		'#type' => 'select',
		'#title' => $this->t('Time Zone'),
		'#required' => true,
		'#options' => $options,
		'#default_value' => $config->get('admin_timezone'),
	];
  
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('admin_config.settings')
    ->set('admin_country', $values['admin_country'])
    ->set('admin_city',$values['admin_city'])
    ->set('admin_timezone',$values['admin_timezone'])
    ->save();
    drupal_set_message('Admin Configuration changes have been saved');
  }
}
