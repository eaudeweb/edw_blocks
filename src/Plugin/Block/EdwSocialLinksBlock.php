<?php

namespace Drupal\edw_blocks\Plugin\Block;

use Drupal\Core\Cache\Cache;

/**
 * Provides a Social Media Links block.
 *
 * @Block(
 *   id = "edw_social_links_block",
 *   admin_label = @Translation("EDW Social links"),
 *   category = @Translation("EDW")
 * )
 */
class EdwSocialLinksBlock extends EdwBlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $config = \Drupal::config('edw_socialmedialinks.settings');

    $links = array_filter([
      'facebook' => $config->get('facebook'),
      'youtube' => $config->get('youtube'),
      'linkedin' => $config->get('linkedin'),
      'x' => $config->get('x'),
    ]);

    return [
      '#theme' => 'edw_social_links_block',
      '#links' => $links,
      '#cache' => [
        'tags' => ['config:edw_socialmedialinks.settings'],
        'contexts' => $this->getCacheContexts(),
      ],
      '#attached' => [
        'library' => [
          'edw_blocks/social_links',
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags(): array {
    return Cache::mergeTags(parent::getCacheTags(), [
      'config:edw_socialmedialinks.settings',
    ]);
  }

}
