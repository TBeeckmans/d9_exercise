<?php

namespace Drupal\best_price\Entity;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Best Price entity entities.
 *
 * @ingroup best_price
 */
interface BestPriceEntityInterface extends EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Best Price entity name.
   *
   * @return string
   *   Name of the Best Price entity.
   */
  public function getName();

  /**
   * Sets the Best Price entity name.
   *
   * @param string $name
   *   The Best Price entity name.
   *
   * @return \Drupal\best_price\Entity\BestPriceEntityInterface
   *   The called Best Price entity.
   */
  public function setName($name);

  /**
   * Gets the product price.
   *
   * @return string
   *   Name of the Best Price entity.
   */
  public function getPrice();

  /**
   * Sets the product price.
   *
   * @param float $price
   *   The price value.
   *
   * @return \Drupal\best_price\Entity\BestPriceEntityInterface
   *   The called Best Price entity.
   */
  public function setPrice($price);

  /**
   * Gets the store name.
   *
   * @return string
   *   Store name of the Best Price entity.
   */
  public function getStore();

  /**
   * Sets the store name.
   *
   * @param string $store
   *   The store name.
   *
   * @return \Drupal\best_price\Entity\BestPriceEntityInterface
   *   The called Best Price entity.
   */
  public function setStore($store);

  /**
   * Gets the Best Price entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Best Price entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Best Price entity creation timestamp.
   *
   * @param int $timestamp
   *   The Best Price entity creation timestamp.
   *
   * @return \Drupal\best_price\Entity\BestPriceEntityInterface
   *   The called Best Price entity.
   */
  public function setCreatedTime($timestamp);
}
