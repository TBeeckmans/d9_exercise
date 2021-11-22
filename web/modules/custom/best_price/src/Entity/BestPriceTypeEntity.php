<?php

namespace Drupal\best_price\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Best Price Type entity.
 *
 * A configuration entity used to manage bundles for the Best Price entity.
 *
 * @ConfigEntityType(
 *   id = "best_price_type",
 *   label = @Translation("Best Price Type"),
 *   bundle_of = "best_price",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "best_price_type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\best_price\BestPriceTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\best_price\Form\BestPriceTypeEntityForm",
 *       "add" = "Drupal\best_price\Form\BestPriceTypeEntityForm",
 *       "edit" = "Drupal\best_price\Form\BestPriceTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/best_price_type/{best_price_type}",
 *     "add-form" = "/admin/structure/best_price_type/add",
 *     "edit-form" = "/admin/structure/best_price_type/{best_price_type}/edit",
 *     "delete-form" = "/admin/structure/best_price_type/{best_price_type}/delete",
 *     "collection" = "/admin/structure/best_price_type",
 *   },
 *   admin_permission = "administer best_price types",
 * )
 */
class BestPriceTypeEntity extends ConfigEntityBundleBase {

}