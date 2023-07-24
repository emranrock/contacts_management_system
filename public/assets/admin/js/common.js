jQuery(document).ready(function () {

	jQuery(document).on("click", ".deleteUser", function () {
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);

		var confirmation = confirm("Are you sure to delete this user ?");
		if (confirmation) {
			jQuery.ajax({
				type: "POST",
				dataType: "json",
				url: hitURL,
				data: { userId: userId }
			}).done(function (data) {
				console.log(data);
				currentRow.parents('tr').remove();
				if (data.status = true) { alert("User successfully deleted"); }
				else if (data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	$(".overlay").hide();
	$("#dataTable").dataTable({
		"pageLength": 50,
	});

	$('#dataTable').on('draw.dt', function (e, settings, len) {
		$('input').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue',
		});
	});


	var merge_arr = [];
	$('#merge_order_box').on('hide.bs.modal', function (e) {
		$(this).find('.modal-body').html();
	});

	$(document).on("click", ".move_line_items1", function (e) {
		e.preventDefault();

		console.log('here');
		return false;
		var move_to = $(this).parent(".modal-footer").prev('.modal-body').find('#move_to_id').val();
		var from_id = $(this).parent(".modal-footer").prev('.modal-body').find('#order_id').val();
		var from_line_id = $(this).parent(".modal-footer").prev('.modal-body').find('#line_id').val();
		var cur_item = $(`.${from_id}`).find(`.line_items`).children();
		if (cur_item.length > 1) {
			var parentEle = $(`.item_${from_id}_${from_line_id}`);
			var from_items_price = parentEle.find(`.title .text-justify .real_prc`).text();
			var from_items_discount = parentEle.find(`.title .text-justify .disc`).text();
			var real_prc = parseFloat(from_items_price) - parseFloat(from_items_discount);
			var price_field = $("#dataTable_backend").find(`.${from_id}`).find('.prices').children('span');
			var new_price = parseFloat(price_field.text() - real_prc);
			price_field.text(parseFloat(new_price).toFixed(2));/**/
		}
		var lc_obj = {};
		lc_obj['order_id'] = from_id;
		lc_obj['line_id'] = from_line_id;
		lc_obj['status'] = false;
		if (localStorage["removable_arr"] == undefined) {
			merge_arr.push(lc_obj);
			localStorage["removable_arr"] = JSON.stringify(merge_arr);
		} else {
			var removable_arr = JSON.parse(localStorage["removable_arr"]);
			removable_arr.push(lc_obj);
			localStorage["removable_arr"] = JSON.stringify(removable_arr);
		}
		var app_to = $("#dataTable_backend").find(`.${move_to}`).children('.line_items');
		var child_order_id;
		var new_id;
		if (check(from_id) == true) {
			new_id = from_id.split("_");
			child_order_id = `.item_${new_id[0]}_${from_line_id}`;
		} else {
			child_order_id = `.item_${from_id}_${from_line_id}`;
		}
		var copy_ele = $(`.${from_id}`).find(`.line_items`).children(child_order_id).clone(true);
		$(`.${from_id}`).find(`.line_items`).children(child_order_id).remove();
		copy_ele.children('.hidden_fields').children().each(function (index) {
			var name = $(this).attr("id");
			var ids = name.split('_');
			ids[2] = move_to;
			name = ids.join('_');
			$(this).removeAttr('id');
			$(this).attr('id', name);
			var order_id_txt = ids.length == 4 ? `order_id_${move_to}_${ids[3]}` : `order_id_${move_to}_${ids[3]}_${ids[4]}`
			if (name == order_id_txt) {
				$(this).val(move_to);
			}
		});
		var change_item_row_name = copy_ele.attr('class');
		var new_item_class = change_item_row_name.split('_');
		new_item_class[1] = move_to;
		change_item_row_name = new_item_class.join('_');
		copy_ele.removeAttr('class');
		copy_ele.attr('class', change_item_row_name);
		copy_ele_edit = copy_ele.children();
		for (let index = 0; index < copy_ele_edit.length; index++) {
			const element = copy_ele_edit[index];
			if ($(element).attr('type') == 'hidden') {
				//console.log(element);
				/** changing id attr */
				var id = $(element).attr('id');
				var ids = id.split('_');
				ids[2] = move_to;
				id = ids.join('_');
				$(element).removeAttr('id');
				$(element).attr('id', id);

				/** changing name attr */
				var name = $(element).attr('name');
				var names = name.split('[');
				names[1] = move_to + ']';
				name = names.join('[');
				$(element).removeAttr('name');
				$(element).attr('name', name);
			}
		}
		var moving_items_price = copy_ele.find(`.title .text-justify .real_prc`).text();
		var moving_items_discount = copy_ele.find(`.title .text-justify .disc`).text();
		var real_prc = parseFloat(moving_items_price) - parseFloat(moving_items_discount);
		var price_field = $("#dataTable_backend").find(`.${move_to}`).find('.prices').children('span');
		var new_price = parseFloat(real_prc) + parseFloat(price_field.text());
		price_field.text(new_price);

		$("#dataTable_backend").find(`.${move_to}`).find('.prices').children('#product_price').val(new_price);
		$("#dataTable_backend").find(`.${move_to}`).find('.prices').children('#product_price').removeAttr('disabled');
		copy_ele.appendTo(app_to);

		var from_child_count = $(`.${from_id}`).find(`.line_items`).children('div');
		if (!from_child_count.length > 0) {
			$("#dataTable_backend").find(`.${from_id}`).remove();
		}
		$("#merge_order_box").modal('hide');
		$('input').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue',
		});
		return false;
	});

	$(document).on("click", ".geo_btn", function (e) {
		e.preventDefault();
		var address = $(this).data('address');
		var order_id = $(this).data('id');
		console.log('btn init ', order_id);
		var modal_title = 'Find Lat and Long';
		var body = `<div id="map_canvas" class="iframe-container"></div>
                    <input type="text" class="form-control" id="address" value="${address}"/>
                    <input type="hidden" class="form-control" id="data-order" value="${order_id}"/>
                    <div class="lat_long_html"></div>`;
		var btn_text = 'Find Geo Code';
		$('#geobox').on('show.bs.modal', function (e) {
			$(this).find('.modal-body').html(body);
			$(this).find('.modal-footer').children('.btn-primary').text(btn_text);
			$(this).find('.modal-footer').children('.action_btn').attr('id', 'geo_code');
		});
		$('#geobox').modal('show');
	});

	$(document).on('click', '#geo_code', function (e) {
		e.preventDefault();
		var address = $("#geobox").find('.modal-body #address').val();
		var order_id = $("#geobox").find('.modal-body #data-order').val();
		$.ajax({
			url: `https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=AIzaSyCybC8ESUTry3oYozpluxRPp1ZdLIG_tus`,
			type: 'get',
			beforeSend: function () {
				$("#geobox").find('.modal-body #loading').html('<div class="overlay"> <i class="fa fa-refresh fa-spin"></i></div>');
			},
			success: function (data) {
				if (data.status == 'OK') {
					var response = data.results;
					var output = '<div class="row">';
					response.forEach(element => {
						output += `<div class="col-sm-6 pull-left">
                                <p> formatted Address:- ${element.formatted_address} </p>
                                    </div>
                                <div class="col-sm-6 pull-right">
                                    <p> lat:${element.geometry.location.lat} and lang:${element.geometry.location.lng}</p>
                                    <a href="#" class="btn btn-primary btn-sm btn-text btn_grab_geocode" data-lat="${element.geometry.location.lat}"
                                     data-lang="${element.geometry.location.lng}" data-order="${order_id}"><i class="fa fa-map-marker" aria-hidden="true"></i> Add</a>
                                </div`;

						initialize(element.formatted_address, element.geometry.location.lat, element.geometry.location.lng);
						//initAutocomplete(element.geometry.location.lat, element.geometry.location.lng);
					});
					output += '</div>';
					$("#geobox").find('.modal-body .lat_long_html').html(output);
				} else if (data.status === "OVER_QUERY_LIMIT") {
					$("#geobox").find('.modal-body .lat_long_html').html(`<p class="alert alert-danger">${data.error_message}</p>`);
				} else {
					$("#geobox").find('.modal-body .lat_long_html').html('<p class="alert alert-danger">No Result Found with this Address Please Try Again with Another address </p>');
				}
				$('#merge_order_box').on('hide.bs.modal', function (e) {
					$(this).find('.modal-body').html();
				});
			},
			error: function (err) {
				console.log(err.responseText);
			}
		});
	});

	$(document).on("click", ".btn_grab_geocode", function (e) {
		e.preventDefault();
		var row_id = $(this).data('order');
		var line_class = row_id.split('_');
		var parent = $("#dataTable").find(`.item_${row_id}`).parent();
		var lat = $(this).data('lat');
		var long = $(this).data('lang');
		var geo_keys = {
			"lat": lat,
			"long": long
		};
		parent.children('div').each(function (index) {
			//console.log( $( this ) );
			var output = `<input type="hidden" disabled="" name="products[${line_class[0]}][items][${index}][lat]" value="${geo_keys.lat}" id="product_lat_${row_id}">
                <input type="hidden" disabled="" name="products[${line_class[0]}][items][${index}][long]" value="${geo_keys.long}" id="product_long_${row_id}">
                `;
			$(this).find(`.hidden_fields`).append(output);
		});
		parent.find(".inline").children('.geo_btn').hide();
		$('#geobox').on('hide.bs.modal', function (e) {
			$("#geobox").find('.modal-body .lat_long_html').html();
			$(this).find('.modal-footer').children('.action_btn').attr('data-order', "");
		});
		$("#geobox").modal("hide");
		return true;
	});


	$('.select2').select2({
		dropdownAutoWidth: true
	})

	//Date picker
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'dd/mm/YY',

	});
	setTimeout(function () {
		$(".alert-dismissable").remove();
	}, 5000);

	$('input').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue',
	});

	$(document).on("click", ".apply_uc", function (e) {
		e.preventDefault();
		var row_id = $(this).data('row');
		var uc = $(this).data('uc');
		var id = row_id.split('_');
		var line_child = $(`.${row_id}`).find(".line_items").children().children('.hidden_fields').append(`<input type="hidden" name="products[${id[1]}][uc]"  value="${uc}">`);
		//console.log(line_child);
		$(this).hide();
	});

	$(document).ajaxStart(function () {
		Pace.restart();
	});



});

// Speed up calls to hasOwnProperty
var hasOwnProperty = Object.prototype.hasOwnProperty;

function isEmpty(obj) {

	// null and undefined are "empty"
	if (obj == null) return true;

	// Assume if it has a length property with a non-zero value
	// that that property is correct.
	if (obj.length > 0) return false;
	if (obj.length === 0) return true;

	// If it isn't an object at this point
	// it is empty, but it can't be anything *but* empty
	// Is it empty?  Depends on your application.
	if (typeof obj !== "object") return true;

	// Otherwise, does it have any properties of its own?
	// Note that this doesn't handle
	// toString and valueOf enumeration bugs in IE < 9
	for (var key in obj) {
		if (hasOwnProperty.call(obj, key)) return false;
	}

	return true;
}

function initialize(address, let, long) {
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(let, long);
	var myOptions = {
		zoom: 15,
		center: latlng,
		mapTypeControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	if (geocoder) {
		geocoder.geocode({
			'address': address
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
					map.setCenter(results[0].geometry.location);

					var infowindow = new google.maps.InfoWindow({
						content: '<b>' + address + '</b>',
						size: new google.maps.Size(100, 50)
					});

					var marker = new google.maps.Marker({
						position: results[0].geometry.location,
						map: map,
						title: address
					});
					google.maps.event.addListener(marker, 'click', function () {
						infowindow.open(map, marker);
					});
				} else {
					alert("No results found");
				}
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}
}


function passToCourier(data, urls) {
	return new Promise((resolve, reject) => {
		$.ajax({
			url: baseURL + urls,
			type: 'POST',
			data: data,
			success: function (data) {
				resolve(data)
			},
			error: function (error) {
				reject(error)
			},
		})
	});
}

function fetch_balance() {
	$.ajax({
		url: baseURL + 'returns/balance',
		type: "get",
		success: function (data) {
			var dec_data = JSON.parse(data);
			$("#wallet_bal").html(' ' + dec_data.message);
		},
		error: function (err) {
			$("#wallet_bal").html(' ' + err.responseText);
		}
	});
	return true;
}

/** order helper funcs */

/** remove  Func*/
function remove(action_tag,order_dt) {
	$(document).on("click", ".remove_item", function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		var price = $(this).data('price');
		var qty = $(this).data('qty');
		var disc = $(this).data('disc');
		var weight = (qty * 0.8)
		var item_prc = (price * qty) - disc;
		e.preventDefault();
		alert('Do not Use Remove option because the table data will lose the that Item will lead to some cause');

		$.ajax({
			url: baseURL + action_tag + '/remove_order',
			type: "post",
			data: { id, price: item_prc, weight },
			beforeSend: function (data) {
				console.log('here');
			},
			success: function (data) {
				var dec_data = JSON.parse(data);

				if (dec_data.code == 200) {
					if(order_dt != ''){
						order_dt.DataTable().ajax.reload();
					}else{
						window.location.reload(true);
					}
				} else {
					console.log(dec_data);
				}
			},
			error: function (err) {
				console.log(err);
			}
		});
		return false;
	});
}

/** Split Func*/
function split(action_tag,order_dt) {
	$(document).on("click", ".split_item", function (e) {
		e.preventDefault();
		var id = $(this).data('order_id');
		id = id != undefined && id != "" ? id : null;
		if (id != null) {
			$.ajax({
				url: baseURL + action_tag + '/split',
				type: "POST",
				data: { id },
				success: function (data) {
					if (data != '') {
						var dec_data = JSON.parse(data);
						if (dec_data.code == 200) {
							if(order_dt != ''){
								order_dt.DataTable().ajax.reload();
							}else{
								window.location.reload(true);
							}
						}
					}
				},
				error: function (err) {
					console.log(err);
				}
			});
		}
		return false;
	});
}

/* merge func*/
function merge(action_tag) {
	$(document).on("click", ".merge_item", function (e) {
		e.preventDefault();
		var mythis = $(this);
		var cur_order_id = mythis.data('order_id');
		var cur_line_id = mythis.data('line_id');
		var cur_phone = mythis.data('phone');
		var customer_name = mythis.data('customer_name');
		if (cur_order_id != null && cur_line_id != null && cur_phone != null) {
			$.ajax({
				url: baseURL + action_tag + '/merge',
				type: "POST",
				data: { id: cur_order_id, line_id: cur_line_id, phone: cur_phone, customer_name },
				beforeSend: function () {
					$('#merge_order_box').on('show.bs.modal', function (e) {
						var body = `Please Wait While Loading`;
						$(this).find('.modal-body').html(body);
					});
					$("#merge_order_box").modal('show');
				},
				success: function (data) {
					if (data != '') {
						var dec_data = JSON.parse(data);
						body = dec_data.response;
						$('#merge_order_box').find('.modal-body').html(body);
						//console.log(dec_data);
					}
				},
				complete: function (data) {
					$("#merge_dynamic_table").dataTable();
				},
				error: function (err) {
					console.log(err);
				}
			});
		}
		return false;
	});
}

/* merge submit func*/
function merge_submit(action_tag,order_dt) {
	$(document).on('submit', "#move_line_item_form", function (event) {
		event.preventDefault();
		var form = $(this).serialize();
		$.ajax({
			url: baseURL + action_tag + '/submit_merge',
			data: form,
			type: 'post',
			success: function (data) {
				var new_data = JSON.parse(data);
				if (new_data.code == 200) {
					$('#merge_order_box').find('#merge_alter_box').html(`<p class="alert alert-success">${new_data.response}</p>`);
				} else {
					$('#merge_order_box').find('#merge_alter_box').html(`<p class="alert alert-danger">${new_data.response}</p>`);
				}

			},
			error: function (err) {
				$('#merge_order_box').find('#merge_alter_box').html(`<p class="alert alert-warning">${err.responseText}</p>`);
			},
			complete: function (data) {
				setTimeout(function () {
					if(order_dt != ''){
						order_dt.DataTable().ajax.reload();
					}else{
						window.location.reload(true)
					}
					$('#merge_order_box').modal('hide');
				}, 2500);
			}
		});
		/** end  */
	});
}

/** make check box enabled */

function toggle_checkbox(){
	$(document).on('ifToggled', "input", function (e) {
		var lineItemDiv = $(this).data('id');
		var lineItem = $(this).parent().parent().next().children();
		for (let index = 0; index < lineItem.length; index++) {
			const element = lineItem[index];
			if ($(element).attr('type') == 'hidden') {
				var check = $(element).attr('disabled');
				if ($(this).prop("checked")) {
					$(element).removeAttr('disabled');
				} else {
					$(element).attr('disabled', true);
				}
			}
		}
		var parent_id = $(this).parent().parent().parent().attr('class');
		parent_id = parent_id.split("_");
		$(this).parent().find(`.${lineItemDiv}`).children(`#order_price_${parent_id[1]}_${parent_id[2]}`).removeAttr('disabled');
		var weight_id = parent_id.length == 4 ? 'weight_' + parent_id[1] + '_' + parent_id[2] : 'weight_' + parent_id[1];
		var weight_check = $(`#${weight_id}`).attr("disabled");
		if (weight_check == "disabled") {
			$(`#${weight_id}`).removeAttr('disabled');
		}
		
	});
}