function media_upload(button_class) {

	jQuery('body').on('click', button_class, function(e) {
		var button_id ='#'+jQuery(this).attr('id');
		var display_field = jQuery(this).parent().children('input:text');
		var _custom_media = true;

		wp.media.editor.send.attachment = function(props, attachment){

			if ( _custom_media  ) {
				if(typeof display_field != 'undefined'){
					switch(props.size){
						case 'full':
							display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
							break;
						case 'medium':
							display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
							break;
						case 'thumbnail':
							display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
							break;
						case 'repeater_team':
							console.log(attachment.sizes);
							display_field.val(attachment.sizes.repeater_team.url);
                            display_field.trigger('change');
							break
						case 'repeater_services':
							display_field.val(attachment.sizes.repeater_services.url);
                            display_field.trigger('change');
							break
						case 'repeater_customers':
							display_field.val(attachment.sizes.repeater_customers.url);
                            display_field.trigger('change');
							break;
						default:
							display_field.val(attachment.url);
                            display_field.trigger('change');
					}
				}
				_custom_media = false;
			} else {
				return wp.media.editor.send.attachment( button_id, [props, attachment] );
			}
		}
		wp.media.editor.open(button_class);
		window.send_to_editor = function(html) {

		}
		return false;
	});
}

/********************************************
*** Generate uniq id ***
*********************************************/
function repeater_uniqid(prefix, more_entropy) {

  if (typeof prefix === 'undefined') {
    prefix = '';
  }

  var retId;
  var formatSeed = function(seed, reqWidth) {
    seed = parseInt(seed, 10)
      .toString(16); // to hex str
    if (reqWidth < seed.length) { // so long we split
      return seed.slice(seed.length - reqWidth);
    }
    if (reqWidth > seed.length) { // so short we pad
      return Array(1 + (reqWidth - seed.length))
        .join('0') + seed;
    }
    return seed;
  };

  // BEGIN REDUNDANT
  if (!this.php_js) {
    this.php_js = {};
  }
  // END REDUNDANT
  if (!this.php_js.uniqidSeed) { // init seed with big random int
    this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
  }
  this.php_js.uniqidSeed++;

  retId = prefix; // start with prefix, add current milliseconds hex string
  retId += formatSeed(parseInt(new Date()
    .getTime() / 1000, 10), 8);
  retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
  if (more_entropy) {
    // for more entropy we add a float lower to 10
    retId += (Math.random() * 10)
      .toFixed(8)
      .toString();
  }

  return retId;
}

/********************************************
*** General Repeater ***
*********************************************/
function repeater_refresh_general_control_values(){
	jQuery(".repeater_general_control_repeater").each(function(){
		var values = [];
		var th = jQuery(this);
		th.find(".repeater_general_control_repeater_container").each(function(){
			var icon_value = jQuery(this).find('.repeater_icon_control').val();
			var text = jQuery(this).find(".repeater_text_control").val();
			var link = jQuery(this).find(".repeater_link_control").val();
			var image_url = jQuery(this).find(".custom_media_url").val();
			var choice = jQuery(this).find(".repeater_image_choice").val();
			var title = jQuery(this).find(".repeater_title_control").val();
			var subtitle = jQuery(this).find(".repeater_subtitle_control").val();
			var id = jQuery(this).find(".repeater_box_id").val();
      var shortcode = jQuery(this).find(".repeater_shortcode_control").val();
      var color = jQuery(this).find(".repeater_color_control").val();
      var percentage = jQuery(this).find(".repeater_percentage_control").val();

			if(text){
				text = text.replace(/(['"])/g, "\\$1");
			}

			if(title){
				title = title.replace(/(['"])/g, "\\$1");
			}

			if(subtitle){
				subtitle = subtitle.replace(/(['"])/g, "\\$1");
			}

            if( text !='' || image_url!='' || title!='' || subtitle!='' ){
                values.push({
                    "icon_value" : (choice === 'parallax_none' ? "" : icon_value) ,
                    "text" : escapeHtml(text),
                    "link" : link,
                    "image_url" : (choice === 'parallax_none' ? "" : image_url),
                    "choice" : choice,
                    "title" : escapeHtml(title),
                    "subtitle" : escapeHtml(subtitle),
										"id" : id,
                    "shortcode" : escapeHtml(shortcode),
                    "color" : escapeHtml(color),
                    "percentage": percentage,
                });
            }

        });
        th.find('.repeater_colector').val(JSON.stringify(values));
        th.find('.repeater_colector').trigger('change');
    });
}


jQuery(document).ready(function(){
    jQuery('#customize-theme-controls').on('click','.parallax-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible'))
                jQuery(this).css('display','block');
        });
    });

    jQuery('#customize-theme-controls').on('change','.repeater_image_choice',function() {
        if(jQuery(this).val() == 'parallax_image'){
            jQuery(this).parent().parent().find('.repeater_general_control_icon').hide();
            jQuery(this).parent().parent().find('.repeater_image_control').show();
        }
        if(jQuery(this).val() == 'parallax_icon'){
            jQuery(this).parent().parent().find('.repeater_general_control_icon').show();
            jQuery(this).parent().parent().find('.repeater_image_control').hide();
        }
        if(jQuery(this).val() == 'parallax_none'){
            jQuery(this).parent().parent().find('.repeater_general_control_icon').hide();
            jQuery(this).parent().parent().find('.repeater_image_control').hide();
        }

        repeater_refresh_general_control_values();
        return false;
    });
    media_upload('.custom_media_button_parallax_one');
    jQuery(".custom_media_url").live('change',function(){
        repeater_refresh_general_control_values();
        return false;
    });


	jQuery("#customize-theme-controls").on('change', '.repeater_icon_control',function(){
		repeater_refresh_general_control_values();
		return false;
	});

	jQuery(".repeater_general_control_new_field").on("click",function(){

		var th = jQuery(this).parent();
		var id = 'repeater_'+repeater_uniqid();
		if(typeof th != 'undefined') {

            var field = th.find(".repeater_general_control_repeater_container:first").clone();
            if(typeof field != 'undefined'){
                field.find(".repeater_image_choice").val('parallax_icon');
                field.find('.repeater_general_control_icon').show();
				if(field.find('.repeater_general_control_icon').length > 0){
                	field.find('.repeater_image_control').hide();
				}
                field.find(".repeater_general_control_remove_field").show();
                field.find(".repeater_icon_control").val('');
                field.find(".repeater_text_control").val('');
                field.find(".repeater_link_control").val('');
				field.find(".repeater_box_id").val(id);
                field.find(".custom_media_url").val('');
                field.find(".repeater_title_control").val('');
                field.find(".repeater_subtitle_control").val('');
                field.find(".repeater_shortcode_control").val('');
                field.find(".repeater_color_control").val('');
                field.find(".repeater_percentage_control").val('');
                th.find(".repeater_general_control_repeater_container:first").parent().append(field);
                repeater_refresh_general_control_values();
            }

		}
		return false;
	 });

	jQuery("#customize-theme-controls").on("click", ".repeater_general_control_remove_field",function(){
		if( typeof	jQuery(this).parent() != 'undefined'){
			jQuery(this).parent().parent().remove();
			repeater_refresh_general_control_values();
		}
		return false;
	});


	jQuery("#customize-theme-controls").on('keyup', '.repeater_title_control',function(){
		 repeater_refresh_general_control_values();
	});

	jQuery("#customize-theme-controls").on('keyup', '.repeater_subtitle_control',function(){
		 repeater_refresh_general_control_values();
	});

    jQuery("#customize-theme-controls").on('keyup', '.repeater_shortcode_control',function(){
		 repeater_refresh_general_control_values();
	});

    jQuery("#customize-theme-controls").on('keyup', '.repeater_color_control',function(){
		 repeater_refresh_general_control_values();
	});

    jQuery("#customize-theme-controls").on('keyup', '.repeater_percentage_control',function(){
		 repeater_refresh_general_control_values();
	});

	jQuery("#customize-theme-controls").on('keyup', '.repeater_text_control',function(){
		 repeater_refresh_general_control_values();
	});

	jQuery("#customize-theme-controls").on('keyup', '.repeater_link_control',function(){
		repeater_refresh_general_control_values();
	});

	/*Drag and drop to change icons order*/
	jQuery(".repeater_general_control_droppable").sortable({
		update: function( event, ui ) {
			repeater_refresh_general_control_values();
		}
	});

});


var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;',
  };

	function escapeHtml(string) {
      string = String(string).replace(new RegExp('\r?\n','g'), '<br>');
      string = String(string).replace(/\\/g,'&#92;');
      return String(string).replace(/[&<>"'\/]/g, function (s) {
         return entityMap[s];
      });
}

/********************************************
*** Alpha Opacity
*********************************************/

jQuery(document).ready(function($) {

	Color.prototype.toString = function(remove_alpha) {
		if (remove_alpha == 'no-alpha') {
			return this.toCSS('rgba', '1').replace(/\s+/g, '');
		}
		if (this._alpha < 1) {
			return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
		}
		var hex = parseInt(this._color, 10).toString(16);
		if (this.error) return '';
		if (hex.length < 6) {
			for (var i = 6 - hex.length - 1; i >= 0; i--) {
				hex = '0' + hex;
			}
		}
		return '#' + hex;
	};

	  $('.pluto-color-control').each(function() {
		var $control = $(this),
			value = $control.val().replace(/\s+/g, '');
		// Manage Palettes
		var palette_input = $control.attr('data-palette');
		if (palette_input == 'false' || palette_input == false) {
			var palette = false;
		} else if (palette_input == 'true' || palette_input == true) {
			var palette = true;
		} else {
			var palette = $control.attr('data-palette').split(",");
		}
		$control.wpColorPicker({ // change some things with the color picker
			 clear: function(event, ui) {
			// TODO reset Alpha Slider to 100
			 },
			change: function(event, ui) {
				// send ajax request to wp.customizer to enable Save & Publish button
				var _new_value = $control.val();
				var key = $control.attr('data-customize-setting-link');
				wp.customize(key, function(obj) {
					obj.set(_new_value);
				});
				// change the background color of our transparency container whenever a color is updated
				var $transparency = $control.parents('.wp-picker-container:first').find('.transparency');
				// we only want to show the color at 100% alpha
				$transparency.css('backgroundColor', ui.color.toString('no-alpha'));
			},
			palettes: palette // remove the color palettes
		});
		$('<div class="pluto-alpha-container"><div class="slider-alpha"></div><div class="transparency"></div></div>').appendTo($control.parents('.wp-picker-container'));
		var $alpha_slider = $control.parents('.wp-picker-container:first').find('.slider-alpha');
		// if in format RGBA - grab A channel value
		if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
			var alpha_val = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
			var alpha_val = parseInt(alpha_val);
		} else {
			var alpha_val = 100;
		}
		$alpha_slider.slider({
			slide: function(event, ui) {
				$(this).find('.ui-slider-handle').text(ui.value); // show value on slider handle
				// send ajax request to wp.customizer to enable Save & Publish button
				var _new_value = $control.val();
				var key = $control.attr('data-customize-setting-link');
				wp.customize(key, function(obj) {
					obj.set(_new_value);
				});
			},
			create: function(event, ui) {
				var v = $(this).slider('value');
				$(this).find('.ui-slider-handle').text(v);
			},
			value: alpha_val,
			range: "max",
			step: 1,
			min: 1,
			max: 100
		}); // slider
		$alpha_slider.slider().on('slidechange', function(event, ui) {
			var new_alpha_val = parseFloat(ui.value),
				iris = $control.data('a8cIris'),
				color_picker = $control.data('wpWpColorPicker');
			iris._color._alpha = new_alpha_val / 100.0;
			$control.val(iris._color.toString());
			color_picker.toggler.css({
				backgroundColor: $control.val()
			});
			// fix relationship between alpha slider and the 'side slider not updating.
			var get_val = $control.val();
			$($control).wpColorPicker('color', get_val);
		});
	});


});



//RADIO CHECK
jQuery(document).ready(function() {
		var button_controls = jQuery ( '#customize-control-aza_appstore_link, #customize-control-aza_playstore_link, #customize-control-aza_button_text_1, #customize-control-aza_button_text_2, #customize-control-aza_button_link_1, #customize-control-aza_button_link_2, #customize-control-aza_button_color_1, #customize-control-aza_button_color_2, #customize-control-aza_button_text_color_1, #customize-control-aza_button_text_color_2' );
		button_controls.addClass("hidden-customizer-control");
		var store_buttons = jQuery('#customize-control-aza_appstore_link, #customize-control-aza_playstore_link');
		var normal_buttons = jQuery('#customize-control-aza_button_text_1, #customize-control-aza_button_text_2, #customize-control-aza_button_link_1, #customize-control-aza_button_link_2, #customize-control-aza_button_color_1, #customize-control-aza_button_color_2, #customize-control-aza_button_text_color_1, #customize-control-aza_button_text_color_2');
		var initial_radio_value = jQuery('input[name="_customize-radio-aza_header_buttons_type"]:checked').val();


//Check initial radio value

				if(initial_radio_value == 'store_buttons') {
					store_buttons.removeClass('hidden-customizer-control');
				} else if(initial_radio_value == 'normal_buttons') {
					normal_buttons.removeClass('hidden-customizer-control');
				}


//Update radio value on change

		jQuery('input[type=radio][name="_customize-radio-aza_header_buttons_type"]').change(function() {
		 	var radio_value = jQuery('input[name="_customize-radio-aza_header_buttons_type"]:checked').val();
			if(radio_value == 'store_buttons') {
				store_buttons.removeClass('hidden-customizer-control');
				normal_buttons.addClass('hidden-customizer-control');
		 } else if(radio_value == 'normal_buttons') {
			 	store_buttons.addClass('hidden-customizer-control');
				normal_buttons.removeClass('hidden-customizer-control');
		 } else if (radio_value == 'disabled_buttons') {
			 normal_buttons.addClass('hidden-customizer-control');
			 store_buttons.addClass('hidden-customizer-control');
		 }
	});
});
