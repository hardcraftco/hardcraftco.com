jQuery(function(){

	// theme
	var theme = jQuery('#msl-theme option:selected').val();
	jQuery('#musli-social-links').removeClass().addClass(theme);

	jQuery('#msl-theme').on('keyup change', function(){
		var theme = jQuery(this).val();
		jQuery('#musli-social-links').removeClass().addClass(theme);
	});

	// position-margin
	jQuery('#musli-social-links').css('top', jQuery('#msl-position-margin').val() + '%');

	jQuery('#msl-form').on('keyup focusout change', "#msl-position-margin", function(){
		jQuery('#musli-social-links').css('top', parseInt(jQuery(this).val())+'%');
	});

	jQuery('#msl-form').on('slide', "#msl-position-margin-slider", function(event, ui){
		jQuery('#musli-social-links').css('top', ui.value+'%');
	});

	// icon-size
	var size = parseInt(jQuery('#msl-icon-size').val());
	jQuery('#musli-social-links li > a > i').css({
			'width': size+'px',
			'height': size+'px',
			'line-height': size+'px'
		});
	jQuery('#musli-social-links > li > a').css('line-height', size + 'px');
	jQuery('#musli-social-links > li').css('height', size + 'px');

	jQuery('#msl-form').on('keyup focusout change', "#msl-icon-size", function(){
		var size = parseInt(jQuery(this).val());
		jQuery('#musli-social-links li > a > i').css({
			'width': size+'px',
			'height': size+'px',
			'line-height': size+'px'
		});
		jQuery('#musli-social-links > li > a').css('line-height', size + 'px');
		jQuery('#musli-social-links > li').css('height', size + 'px');

		// var width = parseInt(jQuery('#msl-link-width').val());
		// jQuery('#musli-social-links > li').css('right', size - width + 'px');
	});

	jQuery('#msl-form').on('slide', "#msl-icon-size-slider", function(event, ui){
		var size = parseInt(ui.value);
		jQuery('#musli-social-links li > a > i').css({
			'width': size+'px',
			'height': size+'px',
			'line-height': size+'px'
		});
		jQuery('#musli-social-links > li > a').css('line-height', size + 'px');
		jQuery('#musli-social-links > li').css('height', size + 'px');

		// var width = parseInt(jQuery('#msl-link-width').val());
		// jQuery('#musli-social-links > li').css('right', size - width + 'px');
	});

	// font-size
	jQuery('#musli-social-links li > a > i').css('font-size', jQuery("#msl-font-size").val()+'px');

	jQuery('#msl-form').on('keyup focusout change', "#msl-font-size", function(){
		var size = parseInt(jQuery(this).val());
		jQuery('#musli-social-links li > a > i').css('font-size', size+'px');
	});

	jQuery('#msl-form').on('slide', "#msl-font-size-slider", function(event, ui){
		var size = parseInt(ui.value);
		jQuery('#musli-social-links li > a > i').css('font-size', size+'px');
	});

	// icon-radius
	jQuery('#msl-form').on('keyup focusout change', "#msl-icon-radius", function(){
		var size = parseInt(jQuery(this).val());
		jQuery('#musli-social-links li').css({
			"-webkit-border-radius": size+'px',
			"-moz-border-radius": size+'px',
			"border-radius": size+'px'
		});
	});

	jQuery('#msl-form').on('slide', "#msl-icon-radius-slider", function(event, ui){
		var size = parseInt(ui.value);
		jQuery('#musli-social-links li').css({
			"-webkit-border-radius": size+'px',
			"-moz-border-radius": size+'px',
			"border-radius": size+'px'
		});
	});

	// icon-spacing
	jQuery('#musli-social-links > li').css('margin-bottom', jQuery("#msl-icon-spacing").val()+'px');

	jQuery('#msl-form').on('keyup focusout change', "#msl-icon-spacing", function(){
		var size = parseInt(jQuery(this).val());
		jQuery('#musli-social-links > li').css('margin-bottom', size+'px');
	});

	jQuery('#msl-form').on('slide', "#msl-icon-spacing-slider", function(event, ui){
		var size = parseInt(ui.value);
		jQuery('#musli-social-links > li').css('margin-bottom', size+'px');
	});

	// link-width
	jQuery('#msl-form').on('keyup focusout change', "#msl-link-width", function(){
		var size = parseInt(jQuery(this).val());
		var icon = parseInt(jQuery('#msl-icon-size').val());

		jQuery('#musli-social-links').css('width', size + 'px');
		jQuery('#musli-social-links > li').css('right', icon - size + 'px');
	});

	jQuery('#msl-form').on('slide', "#msl-link-width-slider", function(event, ui){
		var size = parseInt(ui.value);
		var icon = parseInt(jQuery('#msl-icon-size').val());

		jQuery('#musli-social-links').css('width', size + 'px');
		jQuery('#musli-social-links > li').css('right', icon - size + 'px');
	});

	// form icons
	var icons = jQuery('.icons-set-prototype');

	jQuery('#msl-list').on("click", 'i.load-icons-set', function(){
		var current_link = jQuery(this).parent('li');

		jQuery('.icons-set').not('.icons-set-prototype').remove();

		icons.clone(true).appendTo(current_link).slideDown().removeClass('icons-set-prototype');

		jQuery('.active').removeClass('active');
		current_link.addClass('active');
	});

	jQuery('#msl-list').on("click", '.icons-set a', function(){
		var icon = jQuery(this).data('class');
		jQuery('#msl-list>li.active').find('.load-icons-set').removeClass().addClass('fa load-icons-set fa-'+icon);
		jQuery('#msl-list>li.active .msl_hidden').val(icon);
	});

	// link prototype
	var link = jQuery('.link-prototype');
	var last_link_id = jQuery('input[name="msl_last_id"]').val();

	jQuery('body').on("click", '.page-title-action', function(e){
		e.preventDefault();
		last_link_id = parseInt(last_link_id);
		last_link_id++;

		link.clone(true).appendTo('#msl-list').slideDown();

		var links = jQuery('#msl-list .link-prototype input');

		jQuery.each(links, function(){
			jQuery(this).attr('name', 'msl_links[msl-' + last_link_id + '][' + jQuery(this).attr('name') + ']');
		});

		jQuery('#msl-list .link-prototype').removeClass('link-prototype');

	});

	jQuery('#msl-list').on("focus", 'input', function(){
		jQuery('.active').removeClass('active');
		jQuery(this).parent('li').addClass('active');
	});

	jQuery('#msl-list').sortable({
		placeholder: "ui-state-highlight", delay: 150
	});

	jQuery('#msl-list').on("click", '.fa-action.fa-trash', function(){
		var to_del = jQuery(this).parent('li');
		to_del.slideUp(400, function(){
			to_del.remove();
		});
	});


});