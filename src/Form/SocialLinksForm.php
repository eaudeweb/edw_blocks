<?php

namespace Drupal\edw_blocks\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SocialLinksForm extends ConfigFormBase {

  public function getFormId(): string {
    return 'edw_socialmedialinks_settings_form';
  }

  protected function getEditableConfigNames(): array {
    return ['edw_socialmedialinks.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('edw_socialmedialinks.settings');

    $form['facebook'] = [
      '#type' => 'url',
      '#title' => $this->t('Facebook URL'),
      '#default_value' => $config->get('facebook') ?: '',
      '#maxlength' => 2048,
    ];

    $form['youtube'] = [
      '#type' => 'url',
      '#title' => $this->t('YouTube URL'),
      '#default_value' => $config->get('youtube') ?: '',
      '#maxlength' => 2048,
    ];

    $form['linkedin'] = [
      '#type' => 'url',
      '#title' => $this->t('LinkedIn URL'),
      '#default_value' => $config->get('linkedin') ?: '',
      '#maxlength' => 2048,
    ];

    $form['x'] = [
      '#type' => 'url',
      '#title' => $this->t('X URL'),
      '#default_value' => $config->get('x') ?: '',
      '#maxlength' => 2048,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory()
      ->getEditable('edw_socialmedialinks.settings')
      ->set('facebook', $form_state->getValue('facebook'))
      ->set('youtube', $form_state->getValue('youtube'))
      ->set('linkedin', $form_state->getValue('linkedin'))
      ->set('x', $form_state->getValue('x'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}