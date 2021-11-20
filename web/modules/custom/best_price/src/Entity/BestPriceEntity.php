<?php

namespace Drupal\best_price\Entity;

use Drupal\Core\Entity\ContentEntityBase;

/**
 * Defines the Best Price entity.
 *
 * @ContentEntityType(
 *   id = "best_price",
 *   label = @Translation("Best Price"),
 *   base_table = "best_price",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *   },
 *   bundle_entity_type = "best_price_type",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\Core\Entity\EntityListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\ContentEntityForm",
 *       "add" = "Drupal\Core\Entity\ContentEntityForm",
 *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/best_price/{best_price}",
 *     "add-page" = "/best_price/add",
 *     "add-form" = "/best_price/add/{best_price_type}",
 *     "edit-form" = "/best_price/{best_price}/edit",
 *     "delete-form" = "/best_price/{best_price}/delete",
 *     "collection" = "/admin/content/best_prices",
 *   },
 *   admin_permission = "administer best_price types",
 *   fieldable = TRUE,
 *   field_ui_base_route = "entity.best_price_type.edit_form",
 * )
 */
class BestPriceEntity extends ContentEntityBase {

}