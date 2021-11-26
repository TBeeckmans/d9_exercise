<?php

namespace Drupal\best_price\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BestPriceFormBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $formBuilder;

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder'),
    );
  }

  /**
   * @inheritDoc
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder,) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->formBuilder = $form_builder;
  }
  /**
   * @inheritDoc
   */
  public function build() {
    $build = [];

    // Add a form to add nodes to a watch later list.
    $build['form'] = $this->formBuilder->getForm(
      'Drupal\watch_later\Form\WatchLaterNodeForm',
      'optional_argument_1',
      'optional_argument_2'
    );
    return $build;
  }

}