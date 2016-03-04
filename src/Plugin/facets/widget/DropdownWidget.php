<?php

/**
 * @file
 * Contains \Drupal\facets\Plugin\facets\widget\DropdownWidget.
 */

namespace Drupal\facets\Plugin\facets\widget;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\facets\FacetInterface;
use Drupal\facets\Form\DropdownWidgetForm;
use Drupal\facets\Widget\WidgetInterface;

/**
 * The dropdown widget.
 *
 * @FacetsWidget(
 *   id = "select",
 *   label = @Translation("Dropdown"),
 *   description = @Translation("A configurable widget that shows a dropdown."),
 * )
 */
class DropdownWidget implements WidgetInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function build(FacetInterface $facet) {
    $form_builder = \Drupal::getContainer()->get('form_builder');
    $form_object = new DropdownWidgetForm($facet);
    return $form_builder->getForm($form_object);
  }

  /**
   * {@inheritdoc}
   */
  public function getQueryType($query_types) {
    return $query_types['string'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state, $config) {

    $form['show_numbers'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show the amount of results'),
    ];

    if (!is_null($config)) {
      $widget_configs = $config->get('widget_configs');
      if (isset($widget_configs['show_numbers'])) {
        $form['show_numbers']['#default_value'] = $widget_configs['show_numbers'];
      }
    }

    return $form;
  }

}
