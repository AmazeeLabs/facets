<?php

/**
 * @file
 * Contains \Drupal\facetapi\Searcher\SearcherPluginManager.
 */

namespace Drupal\facetapi\Searcher;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Manages facetapi searcher plugins.
 *
 * @see plugin_api
 */
class SearcherPluginManager extends DefaultPluginManager {

  /**
   * Constructs a new FacetapiSearcherManager.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/FacetApi/Searcher', $namespaces, $module_handler, 'Drupal\facetapi\SearcherInterface', 'Drupal\facetapi\Annotation\FacetApiSearcher');
    $this->alterInfo('facetapi_searcher_info');
    $this->setCacheBackend($cache_backend, 'facetapi_searcher_plugins');
  }

}