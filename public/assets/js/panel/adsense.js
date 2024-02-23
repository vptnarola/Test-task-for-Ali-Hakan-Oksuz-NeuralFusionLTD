function adsenseSave( adsense_id ) {
	"use strict";

	document.getElementById( "adsense_button" ).disabled = true;
	document.getElementById( "adsense_button" ).innerHTML = "Please Wait...";


	var formData = new FormData();

    if ( adsense_id != 'undefined' ) {
        formData.append( 'adsense_id', adsense_id );
	} else {
		formData.append( 'adsense_id', null );
	}
	formData.append( 'name', $( "#name" ).val() );
	formData.append( 'url', $( "#url" ).val() );
	// formData.append( 'position', $( "#position" ).val() );
    formData.append( 'status', $( "#status" ).is(":checked") ? 1 : 0 );

	formData.append( 'banner_width', $( "#banner-width" ).val().length ? $( "#banner-width" ).val() : 0 );
	formData.append( 'banner_height', $( "#banner-height" ).val().length ? $( "#banner-height" ).val() : 0 );
    if ( $( '#banner-image' ).val() != 'undefined' ) {
    	formData.append( 'banner_image', $( '#banner-image' ).prop( 'files' )[ 0 ] );
    }

	$.ajax( {
		type: "post",
		url: "/dashboard/adsense/save",
		data: formData,
		contentType: false,
		processData: false,
		success: function ( data ) {
			if ( data.status ) {
				toastr.success( 'Adsense Saved Succesfully. Redirecting...' );
				document.getElementById( "adsense_button" ).disabled = false;
				document.getElementById( "adsense_button" ).innerHTML = "Save";

				setTimeout( function () {
					location.href = `/dashboard/adsense`;
				}, 1000 );
			}
		},
		error: function ( data ) {
			var err = data.responseJSON.errors;
			$.each( err, function ( index, value ) {
				toastr.error( value );
			} );
			document.getElementById( "adsense_button" ).disabled = false;
			document.getElementById( "adsense_button" ).innerHTML = "Save";
		}
	} );
	return false;
}

function search(input) {
	$.ajax({
		url: '/dashboard/adsense',
		type: 'get',
		dataType: 'json',
		data: {
			q: input.value
		},
		success: function(data) {
			if ( data.status ) {
				document.getElementById('table-adsense').innerHTML = data.data.view;
				document.getElementById('pagination-wrapper').innerHTML = data.data.links;
			}
		}
	});
	
}

document.addEventListener('DOMContentLoaded', function () {
	// for add / edit form
	if ( document.getElementById('adsense_form') ) {
		const imageInput = document.getElementById('banner-image');
		const imagePreview = document.getElementById('banner-image-preview');
		const bannerImageWrapper = document.getElementById('banner-image-wrapper');

		const bannerWidth = document.getElementById('banner-width');
		const bannerHeight = document.getElementById('banner-height');

		imageInput.addEventListener('change', function() {
			const file = this.files[0];
			const reader = new FileReader();

			reader.onload = function(e) {
				const image = new Image();
				image.src = e.target.result;

				image.onload = function() {
					if ( bannerWidth.value && bannerHeight.value ) {
						if (bannerWidth.value >= image.width && bannerHeight.value >= image.height) {
							imagePreview.src = e.target.result;
							bannerImageWrapper.parentNode.classList.remove('hidden');
						} else {
							alert(`Image width and height must be ${bannerWidth.value}x${bannerHeight.value} pixels`);
							bannerImageWrapper.parentNode.classList.add('hidden');
							imageInput.value = ''; // Clear input
						}
					} else {
						imagePreview.src = e.target.result;
						bannerImageWrapper.parentNode.classList.remove('hidden');
					}
				};
			};

			if (file) {
				reader.readAsDataURL(file);
			}
		});
	}
}, false);
