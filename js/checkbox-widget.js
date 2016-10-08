/**
 * @file
 * Transforms links into checkboxes / radios.
 */

(function ($) {

  "use strict";

  Drupal.facets = Drupal.facets || {};
  Drupal.behaviors.facetsCheckboxWidget = {
    attach: function (context, settings) {
      Drupal.facets.makeInputs();
    }
  };

  /**
   * Turns all facet links into checkboxes / radios.
   */
  Drupal.facets.makeInputs = function () {
    // Find all facet links and give them an input.
    var $links = $('.js-facets-checkbox-links .facet-item a');
    $links.once('facets-input-transform').each(Drupal.facets.makeInput);
  };

  /**
   * Replace a link with a checked checkbox/radio.
   */
  Drupal.facets.makeInput = function () {
    var $link = $(this);
    var $ul = $link.parents('.js-facets-checkbox-links');
    var active = $link.hasClass('is-active');
    var description = $link.html();
    var href = $link.attr('href');
    var id = $link.data('drupal-facet-item-id');
    var name = $ul.data('drupal-facet-id');

    var input = $('<input class="facets-input">')
      .attr('id', id)
      .attr('name', name)
      .data($link.data())
      .data('facetsredir', href);

    if ($ul.data('drupal-facet-show-only-one-result')) {
      input.attr('type', 'radio').addClass('facets-radio');
    }
    else {
      input.attr('type', 'checkbox').addClass('facets-checkbox');
    }

    var label = $('<label for="' + id + '">' + description + '</label>');

    input.on('change.facets', function (e) {
      Drupal.facets.disableFacet($ul);
      window.location.href = $(this).data('facetsredir');
    });

    if (active) {
      input.attr('checked', true);
      label.find('.js-facet-deactivate').remove();
    }

    $link.before(input).before(label).remove();

  };

  /**
   * Disable all facet checkboxes / radios in the facet and apply a 'disabled' class.
   */
  Drupal.facets.disableFacet = function ($facet) {
    $facet.addClass('facets-disabled');
    $('input.facets-input').click(Drupal.facets.preventDefault);
    $('input.facetapi-checkbox', $facet).attr('disabled', true);
  };

  /**
   * Event listener for easy prevention of event propagation.
   */
  Drupal.facets.preventDefault = function (e) {
    e.preventDefault();
  }

})(jQuery);
