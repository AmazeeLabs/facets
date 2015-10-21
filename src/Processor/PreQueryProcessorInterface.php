<?php

/**
 * @file
 * Contains \Drupal\facetapi\Processor\PreQueryProcessorInterface.
 */

namespace Drupal\facetapi\Processor;

use Drupal\facetapi\FacetInterface;

/**
 * Processor runs before the query is executed.
 */
interface PreQueryProcessorInterface extends ProcessorInterface {

  /**
   * Processor runs before the query is executed.
   *
   * Uses the queryType and the facetSource implementation to make sure the
   * alteration to the query was added before the query is executed in the
   * backend?
   *
   * @param \Drupal\facetapi\FacetInterface $queryType
   */
  public function preQuery(FacetInterface $facet);

}