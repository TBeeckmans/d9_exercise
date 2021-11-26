<?php

namespace Drupal\best_price\Form;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\Messenger;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BestPriceUserForm extends FormBase {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('messenger')
    );
  }

  /**
   * @inheritDoc
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, Messenger $messenger) {
    $this->entityTypeManager = $entity_type_manager;
    $this->messenger = $messenger;
  }

  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'best_price_user_form';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = [];

    /*
    // Get arguments passed to the form.
    $build_info = $form_state->getBuildInfo();
    $uid = $build_info['args'][0];
    $nid = $build_info['args'][1];
     */

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    ];

    $form['store'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Store'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    ];

    $form['price'] = [
      '#type' => 'number',
      '#title' => $this->t('Price'),
    ];

    $form['actions'] = [];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t("Submit the best price"),
    ];

    return $form;
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set default values for the BestPriceEntity.
    $bestPriceArguments = [
      'bundle' => 'physical_store',
      'uid' => 0,
      'created' => time(),
      'changed' => time(),
    ];

    foreach ($form_state->getValues() as $key => $value) {
      $bestPriceArguments[$key] = $value;
    }

    $bestPriceEntity = $this->entityTypeManager
      ->getStorage('best_price')
      ->create($bestPriceArguments);
    $bestPriceEntity->save();

    $this->messenger->addMessage($this->t("You added a new best price."));
  }
}