<?php

namespace Drupal\best_price;

use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BestPriceListBuilder
 */
class BestPriceListBuilder extends EntityListBuilder {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * Constructs a new PracticalListBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The entity storage class.
   * @param \Drupal\Core\Datetime\DateFormatter $date_formatter
   *   The date formatter service.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage, DateFormatter $date_formatter) {
    parent::__construct($entity_type, $storage);

    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager')->getStorage($entity_type->id()),
      $container->get('date.formatter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader(){
    $header['id'] = $this->t('Id');
    $header['name'] = $this->t('Name');
    $header['bundle_label'] = $this->t('Bundle');
    $header['owner'] = $this->t('Owner');
    $header['created'] = $this->t('Created');
    $header['changed'] = $this->t('Changed');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\best_price\Entity\BestPriceEntityInterface $entity */
    $row['id'] = $entity->id();
    $row['name'] = $entity->toLink($entity->getName());
    $row['bundle_label'] = $entity->bundle->entity->label();
    $row['owner'] = ($entity->get('uid')->isEmpty() || is_null($entity->getOwner()) || $entity->getOwnerId() == 0) ? '' : $entity->getOwner()->toLink($entity->getOwner()->label());
    $row['created'] = $this->dateFormatter->format($entity->getCreatedTime(), 'short');
    $row['changed'] = $this->dateFormatter->format($entity->getChangedTime(), 'short');

    return $row + parent::buildRow($entity);
  }
}
