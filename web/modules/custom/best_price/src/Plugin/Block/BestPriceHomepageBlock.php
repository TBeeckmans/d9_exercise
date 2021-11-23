<?php

namespace Drupal\best_price\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\Renderer;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BestPriceHomepageBlock.
 *
 * @Block(
 *   id = "best_price_homepage_block",
 *   admin_label = @Translation("Latest Best Price")
 * )
 */
class BestPriceHomepageBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a BestPriceHomepageBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Render\Renderer $renderer
   *   The renderer service.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, Renderer $renderer, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->renderer = $renderer;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('renderer'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * @inheritDoc
   */
  public function build() {
    $build = [];
    $bestPriceManager = $this->entityTypeManager->getStorage('best_price');
    $bestPriceViewBuilder = $this->entityTypeManager->getViewBuilder('best_price');

    $bestPriceIds = $bestPriceManager->getQuery()
      ->condition('created', \strtotime('-1 week'), '>')
      ->sort('created', 'DESC')
      ->range(0, 1)
      ->execute();

    $bestPriceEntities = $bestPriceManager->loadMultiple($bestPriceIds);

    if (!empty($bestPriceEntities)) {
      $build['title'] = [
        '#type' => 'html_tag',
        '#tag' => 'h3',
        '#value' => new TranslatableMarkup('The Best price of the moment.'),
      ];

      $bestPriceEntity = \array_pop($bestPriceEntities);
      $build['product'] = $bestPriceViewBuilder->view($bestPriceEntity, 'teaser');
    }

    return $build;
  }

}