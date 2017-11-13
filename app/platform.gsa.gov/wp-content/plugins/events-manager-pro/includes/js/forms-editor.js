jQuery(document).ready( function($){
	$('.bct-options').hide();
	//Booking Form
	$('form.em-form-custom').each( function( i, myform ){
		myform = $(myform);
		var booking_template = myform.find('#booking-custom-item-template').detach();
		myform.delegate('.booking-form-custom-field-remove', 'click', function(e){
			e.preventDefault();
			$(this).parents('.booking-custom-item').remove();
			reserve_selected_userfields();
		});
		myform.find('.booking-form-custom-field-add').click(function(e){
			e.preventDefault();
			booking_template.clone().appendTo($(this).parents('.em-form-custom').find('ul.booking-custom-body').first());
		});
		myform.delegate('.booking-form-custom-field-options', 'click', function(e){
			$(this).blur();
			e.preventDefault();
			if( $(this).attr('rel') != '1' ){
				$(this).parents('.em-form-custom').find('.booking-form-custom-field-options').attr('rel','0')
				$(this).parents('.booking-custom-item').find('.booking-form-custom-type').trigger('change');
			}else{
				$(this).parents('.booking-custom-item').find('.bct-options, .bct-options-toggle').slideUp();
				$(this).attr('rel','0');
			}
		});
		myform.delegate('.bct-options-toggle', 'click', function(e){
			e.preventDefault();
			$(this).blur().parents('.booking-custom-item').find('.booking-form-custom-field-options').trigger('click');
		});
		//specifics
		myform.delegate('.booking-form-custom-label', 'change', function(e){
			var parent_div =  $(this).parents('.booking-custom-item').first();
			var field_id = parent_div.find('input.booking-form-custom-fieldid').first();
			if( field_id.val() == '' ){
				field_id.val(escape($(this).val()).replace(/%[0-9]+/g,'_').toLowerCase());
			}
		});
		myform.delegate('input[type="checkbox"]', 'change', function(){
			var checkbox = $(this);
			if( checkbox.next().attr('type') == 'hidden' ){
				if( checkbox.is(':checked') ){
					checkbox.next().val(1);
				}else{
					checkbox.next().val(0);
				}
			}
		});
		var reserve_selected_userfields = function(){
			myform.find('.booking-form-custom-type optgroup.bc-custom-user-fields option:disabled, .booking-form-custom-type optgroup.bc-core-user-fields option:disabled').prop('disabled', false);
			myform.find('.booking-form-custom-type optgroup.bc-custom-user-fields option:selected, .booking-form-custom-type optgroup.bc-core-user-fields option:selected').each( function( i, item ){
				item = $(item);
				var item_val = item.val();
				var filter = '.booking-form-custom-type optgroup.bc-custom-user-fields option[value="'+item_val+'"], .booking-form-custom-type optgroup.bc-core-user-fields option[value="'+item_val+'"]';
				var found_items = myform.find(filter).add(booking_template.find(filter));
				found_items.each( function(i_2, taken_item){
					taken_item = $(taken_item);
					if( !taken_item.is(item) ){
						taken_item.prop('disabled', true);
					}
				});
			});
		};
		reserve_selected_userfields();
		myform.delegate('.booking-form-custom-type', 'change', function(){
			$('.bct-options').slideUp();
			$('.bct-options-toggle').hide();
			var reg_keys = []; //get reg keys from booking template for use in type_keys
			booking_template.find('.bc-custom-user-fields option, .bc-core-user-fields option').each( function( i, field ){
				reg_keys.push(field.value);
			});
			var type_keys = {
				select : ['select','multiselect'],
				country : ['country'],
				date : ['date'],
				time : ['time'],
				html : ['html'],
				selection : ['checkboxes','radio'],
				checkbox : ['checkbox'],
				text : ['text','textarea','email'],
				registration : reg_keys,
				captcha : ['captcha']
			}
			var select_box = $(this);
			var selected_value = select_box.val();
			$.each(type_keys, function(option,types){
				if( $.inArray(selected_value,types) > -1 ){
					//get parent div
					parent_div =  select_box.parents('.booking-custom-item').first();
					//slide the right divs in/out
					parent_div.find('.bct-'+option).slideDown();
					parent_div.find('.bct-options-toggle').show();
					parent_div.find('.booking-form-custom-field-options').attr('rel','1');
				}
			});
			reserve_selected_userfields();
		});
		myform.delegate('.bc-link-up, .bc-link-down', 'click', function(e){
			e.preventDefault();
			item = $(this).parents('.booking-custom-item').first();
			if( $(this).hasClass('bc-link-up') ){
				if(item.prev().length > 0){
					item.prev().before(item);
				}
			}else{
				if( item.next().length > 0 ){
					item.next().after(item);
				}
			}
		});
		myform.delegate('.bc-col-sort', 'mousedown', function(){
			parent_div =  $(this).parents('.booking-custom-item').first();
			parent_div.find('.bct-options').hide();
			parent_div.find('.booking-form-custom-field-options').attr('rel','0');
		});
		myform.find('.booking-custom-body').sortable({
			placeholder: "bc-highlight",
			handle:'.bc-col-sort'
		});
		//Fix for PHP max_ini_vars
		if (typeof JSON.stringify != 'undefined'){
			$('.em-form-custom').submit(function(event){
			    var myform = $(this);
				//count input vars
			    if ($('form#em_fields_json').length) return;	//have already made switch, so let default submit take place
				var a = myform.serializeArray();
				if( a.length < EM.max_input_vars ){
					return true;
				}
			    event.preventDefault();
				var o = {};
			    $.each(a, function() {
			        if (o[this.name] !== undefined) {
			            if (!o[this.name].push) { o[this.name] = [o[this.name]]; }
			            o[this.name].push(this.value || '');
			        } else {
			            o[this.name] = this.value || '';
			        }
			    });
			    var data = JSON.stringify(o, null, 2);
				//create new form and add data to it
				var new_form  = $('<form id="em_fields_json" action="" method="post"></form>').append($('<input type="hidden" />').attr({id:'em_fields_json', name:'em_fields_json', value:data}));
				myform.after(new_form);
				new_form.submit();
			});
		}
		//ML Stuff
		myform.find('.bc-translatable').click(function(){
			$(this).closest('li.booking-custom-item').find('.' + $(this).attr('rel')).slideToggle();
		});
	});
});