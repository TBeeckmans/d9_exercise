<?php

namespace Drupal\best_price\Plugin\WebformHandler;

use Drupal\best_price\Entity\BestPriceEntityInterface;
use Drupal\webform\Plugin\WebformHandlerBase;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Create a new best price entity from a webform submission.
 *
 * @WebformHandler(
 *   id = "create_best_price",
 *   label = @Translation("Create a best price"),
 *   category = @Translation("Entity creation"),
 *   description = @Translation("Creates a new best price from a webform submission"),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 *   submission = \Drupal\webform\Plugin\WebformHandlerInterface::SUBMISSION_REQUIRED,
 * )
 */
class BestPriceEntityWebformHandler extends WebformHandlerBase {

  /**
   * @inheritDoc
   */
  public function postSave(WebformSubmissionInterface $webform_submission, $update = TRUE) {
    // Get an array of the values from the submission.
    $values = $webform_submission->getData();

    $bestPriceArguments = [
      'bundle' => 'physical_store',
      'uid' => 0,
      'name' => $values['product'],
      'store' => $values['store'],
      'price' => $values['price'],
      'created' => time(),
      'changed' => time(),
    ];

    $bestPriceEntity = $this->entityTypeManager->getStorage('best_price')->create($bestPriceArguments);
    $bestPriceEntity->save();

    $this->sendNotificationMail($bestPriceEntity);
  }

  /**
   * Sends a notification email to admins.
   *
   * @param NodeInterface $node
   *   The newly created garden node.
   */
  protected function sendNotificationMail(BestPriceEntityInterface $bestPriceEntity) {
    // We don't inject the mail manager to prevent serialization issues.
    // See Drupal\webform\Plugin\WebformHandlerBase::create
    /** @var \Drupal\Core\Mail\MailManagerInterface $mailManager */
    $mailManager = \Drupal::service('plugin.manager.mail');

    $mailParams = [
      'subject' => $this->t('A new best price has been added on @site', ['@site' => \Drupal::request()->getHost()]),
      'body' => [
        $this->t('Product: @name', ['@name' => $bestPriceEntity->getName()]),
        $this
          ->t('URL: @url', [
          '@url' => $bestPriceEntity->toLink(NULL, 'canonical', ['absolute' => TRUE])->getUrl()->toString()
        ]),
      ]
    ];

    // Send the mail.
    $mailManager->mail(
      'best_price',
      'best_price_notification',
      'sites@dropsolid.com',
      'nl',
      $mailParams,
    );
  }



}