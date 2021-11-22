<?php

namespace Drupal\best_price;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Class BestPriceListBuilder
 */
class BestPriceListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(){
    $header['id'] = $this->t('Id');
    $header['content_entity_label'] = $this->t('Entity');
    $header['bundle_label'] = $this->t('Bundle');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->toLink($entity->id());
    $row['content_entity_label'] = $entity->getEntityType()->getLabel()->render();
    $row['bundle_label'] = $entity->bundle->entity->label();

    return $row + parent::buildRow($entity);
  }
}
