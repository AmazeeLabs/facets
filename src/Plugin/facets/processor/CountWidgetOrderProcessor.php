<?php

namespace Drupal\facets\Plugin\facets\processor;

use Drupal\facets\Processor\WidgetOrderPluginBase;
use Drupal\facets\Processor\WidgetOrderProcessorInterface;
use Drupal\facets\Result\Result;

/**
 * A processor that orders the results by amount.
 *
 * @FacetsProcessor(
 *   id = "count_widget_order",
 *   label = @Translation("Sort by count"),
 *   description = @Translation("Sorts the widget results by count."),
 *   stages = {
 *     "build" = 50
 *   }
 * )
 */
class CountWidgetOrderProcessor extends WidgetOrderPluginBase implements WidgetOrderProcessorInterface {

  /**
   * {@inheritdoc}
   */
  public function sortResults(Result $a, Result $b) {
    if ($a->getCount() == $b->getCount()) {
      return 0;
    }
    return ($a->getCount() < $b->getCount()) ? -1 : 1;
  }

}
