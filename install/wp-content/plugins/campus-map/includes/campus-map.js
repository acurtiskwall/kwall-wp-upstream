(function ($) {

  'use strict';

  /**
   * Check if element is in viewport.
   */
  $.fn.isOnScreen = function(){

    var win = $(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

  };

  /**
   * The common functionality for the module.
   *
   * @type {{attach: Drupal.behaviors.kwallMap.attach}}
   */
   behaviors.kwallMap = {
    attach: function (context) {

      $(window).bind("load", function () {
        if (typeof (geolocation) != "undefined" && !$('body').hasClass('kwall-map-processed')) {

          var KwallMapSettings = kwall_map,
            imgOverlay = KwallMapSettings['overlay_path'],
            neLat = KwallMapSettings['ne_lat'],
            neLon = KwallMapSettings['ne_lon'],
            swLat = KwallMapSettings['sw_lat'],
            swLon = KwallMapSettings['sw_lon'],
            styles = KwallMapSettings['style'];

          if (imgOverlay !== '') {
            console.log('Overlay path: ' + imgOverlay);

            var southWest = new google.maps.LatLng(swLat, swLon),
              northEast = new google.maps.LatLng(neLat, neLon),
              overlayBounds = new google.maps.LatLngBounds(southWest, northEast);

            kwallOverlay.prototype = new google.maps.OverlayView();

            function kwallOverlay(bounds, image, map) {
              // Initialize all properties.
              this.bounds_ = bounds;
              this.image_ = image;
              this.map_ = map;
              // Define a property to hold the image's div. We'll
              // actually create this div upon receipt of the onAdd()
              // method so we'll leave it null for now.
              this.div_ = null;
              // Explicitly call setMap on this overlay.
              this.setMap(map);
            }

            /**
             * onAdd is called when the map's panes are ready and the overlay
             * has been added to the map.
             */
            kwallOverlay.prototype.onAdd = function () {
              var div = document.createElement('div');

              div.style.borderStyle = 'none';
              div.style.borderWidth = '0px';
              div.style.position = 'absolute';

              // Create the img element and attach it to the div.
              var img = document.createElement('img');

              img.src = this.image_;
              img.style.width = '100%';
              img.style.height = '100%';
              img.style.position = 'absolute';
              div.appendChild(img);
              this.div_ = div;
              // Add the element to the "overlayLayer" pane.

              var panes = this.getPanes();

              panes.overlayLayer.appendChild(div).style['zIndex'] = 1001;
            };

            kwallOverlay.prototype.draw = function () {
              // We use the south-west and north-east
              // coordinates of the overlay to peg it to the correct position
              // and size. To do this, we need to retrieve the projection from
              // the overlay.
              var overlayProjection = this.getProjection();

              // Retrieve the south-west and north-east coordinates of this
              // overlay in LatLngs and convert them to pixel coordinates.
              // We'll use these coordinates to resize the div.
              var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest()),
                ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

              // Resize the image's div to fit the indicated dimensions.
              var div = this.div_;

              div.style.left = sw.x + 'px';
              div.style.top = ne.y + 'px';
              div.style.width = (ne.x - sw.x) + 'px';
              div.style.height = (sw.y - ne.y) + 'px';
            };

            setTimeout(function () {
              new kwallOverlay(overlayBounds, imgOverlay, geolocation.maps[0].googleMap);

              google.maps.event.addListenerOnce(geolocation.maps[0].googleMap, 'maptypeid_changed', function (e) {
                var imgsrc = '';

                $(".gm-style img").each(function () {
                  imgsrc = this.src.split('/').reverse();
                });

                $('.gm-style-mtc >div').on('click', function () {
                  console.log($(this).attr('title'));
                  if ($(this).attr('title') === 'Show satellite imagery') {
                    $('.img-overlay').hide();
                  }
                  if ($(this).attr('title') === 'Show street map') {
                    $('.img-overlay').show();
                  }
                })
              });
            }, 250);
          }

          if (styles !== '') {
            // Add custom map styles.
            setTimeout(function () {
              geolocation.maps[0].googleMap.setOptions({styles: JSON.parse(styles)});
            }, 250);
          }

          $('body').addClass('kwall-map-processed');

        }
      });
    }
  }

  /**
   * Toogle map sidebar POI content.
   *
   * @type {{attach: Drupal.behaviors.mapInfoToggle.attach}}
   */
  behaviors.mapInfoToggle = {
    attach: function (context, settings) {

      function adjustBubble() {
        jQuery('.infobubble').each(function() {
          var $this = jQuery(this);
          var $parent = $this.parent();
          $parent.css('overflow','hidden');
          if ( $parent.is(':hidden') || $this.height() <= 60) {
            $parent.css('margin-top','0');
            return;
          }
          var heightDiff = $this.height() - $parent.height();
          var topPlacement = $parent.parent().css('top');

          const regex = /([1-9]\d*(\.\d+)?)/gi;
          const topValue = topPlacement.match(regex);
          var adjustedTopValue = parseInt(topValue[0]) + heightDiff;

          $parent.height($this.height());
          $parent.parent().css('top','-' + adjustedTopValue + 'px');
          $this.find('.views-field-field-media a').attr('tabindex','-1');
        });
        // Adjust close button placement.
        jQuery('.js-info-bubble-close').css('top','2px').css('right','2px');
        // Scroll to map
        var $mapElem = jQuery('div[data-map-type="google_maps"]');
        var scrollToMap = $mapElem.offset().top - 150;
        if ( $mapElem.isOnScreen() === false ) {
          jQuery('html,body').animate({scrollTop: scrollToMap});
        }
      }

      // Trigger bubble adjust on map click
      $( ".list-map .campus-map" ).on( "click", function() {
        setTimeout(function(){
          adjustBubble();
        }, 200);
      });

      var $geolocation = $('.geo-navigation .geolocation', context);

      $geolocation.on('click', function () {
        var clickedLatitude = $(this).find("meta[property='latitude']").attr('content'),
          clickedLongitude = $(this).find("meta[property='longitude']").attr('content');

        clickedLatitude = parseFloat(clickedLatitude).toFixed(12);
        clickedLongitude = parseFloat(clickedLongitude).toFixed(12);

        // Toggle active class.
        $geolocation.removeClass('active');
        $(this).addClass('active');

        // Trigger marked.
        for (var i = 0; i < geolocation.maps[0].mapMarkers.length; i++) {
          var marker = geolocation.maps[0].mapMarkers[i],
            currentLatitude = marker.getPosition().lat(),
            currentLongitude = marker.getPosition().lng();

          currentLatitude = parseFloat(currentLatitude).toFixed(12);
          currentLongitude = parseFloat(currentLongitude).toFixed(12);

          if (clickedLatitude === currentLatitude
            && clickedLongitude === currentLongitude) {
            google.maps.event.trigger(marker, 'click');
            setTimeout(function(){
              adjustBubble();
            }, 200);
            return;
          }
        }


      });

      // Trigger click on enter push
      $('body').on('keydown', function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if ($geolocation.hasClass('tabfocus')) {
          // Code 13 is enter key.
          if (code === 13) {
            e.preventDefault();
            e.stopPropagation();
            $('.geolocation.tabfocus').trigger('click');
          }
        }
      });

    }
  };

})(jQuery);
