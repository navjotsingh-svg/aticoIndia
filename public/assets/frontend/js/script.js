// document.onreadystatechange = function () {
//  var state = document.readyState;
//     if (state == 'complete') {
//     }
//  }

var authType = false;

$(document).ready(function(){

    hideLoader();
    initCartForm();
    initSearchAutocomplete();
    initSearchAutocompleteNew();

    $('#sign-in-form, #sign-up-form').submit(function(e){
        e.preventDefault();
        submitForm($(this), authSuccess);
    });

    $('#signin').on('shown.bs.modal', function(e){
        authType = $(e.relatedTarget).data('auth-type') ? $(e.relatedTarget).data('auth-type') : false;
        $('#signup').modal('hide');
    });

    $('#signup').on('shown.bs.modal', function(e){
        $('#signin').modal('hide');
    });

    $('.subscribe-form').submit(function(e){
        e.preventDefault();
        submitForm($(this), successSubscribe);
    });     

    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 

    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 

    /*$(window).scroll(function() {    
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            $("#myNavbar").addClass("sticky");
            $("body").addClass("sticky_body");
        } else if (scroll >= 0) {
            $("#myNavbar").removeClass("sticky");
            $("body").removeClass("sticky_body");
        }
    });*/

    $('#signin').on('hidden.bs.modal', function(){
        removeInputsNErrors('#sign-in-form');
    });
    
    $('#signup').on('hidden.bs.modal', function(){
        removeInputsNErrors('#sign-up-form');
    })
});

function openNav()
{
    document.getElementById("mySidenav").style.width = "300px";
}

function closeNav()
{
    document.getElementById("mySidenav").style.width = "0";
}

function submitForm(_form, successFunc)
{
    removeErrors();
    showLoader();
    var data = {
     '_token' : $("input[name='_token']").val()
    };
    console.log(data);

    //var data = {'_token' : $('meta[name="csrf_token"]').attr('content')};
    console.log(data);
    _form.ajaxSubmit({  
        type: 'POST',
        data: data,
        success: function(response){
            console.log(response);
            hideLoader();
            successFunc(response);
        },
        error: function(response){
            console.log(response);
            showErrors(response, _form);
            hideLoader();
        }
    });
}

function showErrors(response, _form)
{
    toggleLoader(false);
    if (typeof response.responseJSON == 'undefined') {
        // swal('');
        alert('error occured');
    } else if (typeof response.responseJSON.error != 'undefined') {
        $("#modal_failure_message").html( response.responseJSON.error );
        $('#failureModal').modal('show');
        //swal('Error:', response.responseJSON.error, 'error');
    } else {
        for (i in response.responseJSON.errors) {
            var fieldName = i;
            _form.find('[name="'+ fieldName +'"]').parent().addClass('err');
            _form.find('[name="'+ fieldName +'"]').parent().append('<span class="custom-validate-error-item">'+ response.responseJSON.errors[i][0] +'</span>');
        }
    }
}

function authSuccess(response)
{
    if (typeof response.intended != 'undefined' ) {
        if (authType == 'blog_comment') {
            window.location = response.intended + '#comments-reply';
            location.reload();
        } else {
            window.location = response.intended;
        }
    }
}

function removeErrors()
{
    $('.err').removeClass('err');
    $('.custom-validate-error-item').remove();
}

function removeInputsNErrors(formSelector)
{
    removeErrors();

    if (typeof formSelector != 'undefined') {
        $( formSelector ).find('input, select').val('');
        $( formSelector ).find('textarea').val('');
    }
}

function sendRequest(params = {})
{
    var data = {
     '_token' : $("input[name='_token']").val()
    };
    console.log(data);
    /*var data = {
        '_token' : $('meta[name="csrf_token"]').attr('content')
    };*/

    for (i in params) {
        data[i] = params[ i ];
    }

    showLoader();

    $.ajax({
        url: addToCartUrl,
        data: data,
        type: 'POST',
        success: function(response) {
            hideLoader();
            if (typeof response['count'] != 'undefined') {
                $('.itm-count').text(response['count']);
                $('#add_to_cart_sec').addClass('d-block');
                smoothScrollTo('#add_to_cart_sec', 1500, 200);
                $('#product').html(response['product']); 
                $('#price').html(response['price']); 
                $('#qty').html(response['quantity']); 
                $('#total_price').html(response['total_price']); 
                $('#image').html('<img src='+ response.image_path +' class="img-fluid mx-auto d-block">'); 
                /*swal("Added to cart", 'Product: ' + response['product'], "success")*/
            }
        },
        error: function(response){
            hideLoader();
            var msg = (typeof response.responseJSON.error != 'undefined') ? response.responseJSON.error : 'Something went wrong!';
            $("#modal_failure_message").html( "Product not added to cart" );
            $('#failureModal').modal('show');
            //swal("Product not added to cart", msg, "error");
        }
    });
}

function successSubscribe(response)
{
    if (typeof response.success != 'undefined' ) {
        $("#modal_success_message").html(response.success);
        $('#successModal').modal('show');
        //swal('Successful', response.success, 'success');
    }
}

function hideLoader()
{
    $("#preloader").delay(5).fadeOut("slow");
}

function showLoader()
{
    $("#preloader").delay(5).fadeIn("slow");
}

function initCartForm()
{
    if ( $('.cart-form').length ) {
        $('body').on('submit', '.cart-form', function(e){
            e.preventDefault();
            $('#reviews').modal('hide');            
            var quantity = $(this).find('[name="quantity"]').length ? $(this).find('[name="quantity"]').val() : 1 ;
            sendRequest({ 'product' : $(this).find('[name="product"]').val(),'products' : $(this).find('[name="product[]"]').val(), 'price' : $(this).find('[name="price"]').val(), 'quantity' : quantity });
        });
    }
}

function smoothScrollTo(selector, time, fromTop)
{
    $('html, body').animate({
        scrollTop: $(selector).offset().top - fromTop
    }, time);
}

function getProfilePic(input, destinationElementSelector)
{
  if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $( destinationElementSelector ).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function initSearchAutocomplete()
{
    $('.main-search').each(function(){
        $(this)
            .autocomplete({
                source: products,
                select: function( event, ui ) {
                    window.location = productDetailPageUrl.replace( 'product_slug', ui.item.slug );
                    return false;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a class='myclass' product='" + item.slug + "'>" + item.label + "</a>" )
                    .appendTo( ul );
           };
    });
}

function initSearchAutocompleteNew()
{
    $('.main-search-new').each(function(){
        $(this)
            .autocomplete({
                source: productss,
                select: function( event, ui ) {
                    window.location = productDetailPageUrls.replace( 'product_slug', ui.item.slug );
                    return false;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a class='myclass' product='" + item.slug + "'>" + item.label + "</a>" )
                    .appendTo( ul );
           };
    });
}

$(document).ready(function() {

    $('input[type=password]').keyup(function() {
        // set password variable
        var pswd = $(this).val();
        //validate the length
        if ( pswd.length < 8 ) {
            $('#length').removeClass('valid_new').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid_new');
        }
        //validate letter
        if ( pswd.match(/[A-z]/) ) {
            $('#letter').removeClass('invalid').addClass('valid_new');
        } else {
            $('#letter').removeClass('valid_new').addClass('invalid');
        }

        //validate capital letter
        if ( pswd.match(/[A-Z]/) ) {
            $('#capital').removeClass('invalid').addClass('valid_new');
        } else {
            $('#capital').removeClass('valid_new').addClass('invalid');
        }

        //validate number
        if ( pswd.match(/\d/) ) {
            $('#number').removeClass('invalid').addClass('valid_new');
        } else {
            $('#number').removeClass('valid_new').addClass('invalid');
        }
    }).focus(function() {
        $('#pswd_info').show();
    }).blur(function() {
        $('#pswd_info').hide();
    });

    $('input[type=password]').keyup(function() {
        // set password variable
        var pswd = $(this).val();
        //validate the length
        if ( pswd.length < 8 ) {
            $('#length_1').removeClass('valid_new').addClass('invalid');
        } else {
            $('#length_1').removeClass('invalid').addClass('valid_new');
        }
        //validate letter
        if ( pswd.match(/[A-z]/) ) {
            $('#letter_1').removeClass('invalid').addClass('valid_new');
        } else {
            $('#letter_1').removeClass('valid_new').addClass('invalid');
        }

        //validate capital letter
        if ( pswd.match(/[A-Z]/) ) {
            $('#capital_1').removeClass('invalid').addClass('valid_new');
        } else {
            $('#capital_1').removeClass('valid_new').addClass('invalid');
        }

        //validate number
        if ( pswd.match(/\d/) ) {
            $('#number_1').removeClass('invalid').addClass('valid_new');
        } else {
            $('#number_1').removeClass('valid_new').addClass('invalid');
        }
    }).focus(function() {
        $('#pswd_info_register').show();
    }).blur(function() {
        $('#pswd_info_register').hide();
    });




});



/*$( "#sign-in-form" ).validate({
  rules: {
    field: {
      required: true,
      email: true
    }
  }
});
*/
/*$( "#sign-up-form" ).validate({
  rules: {
    field: {
      required: true,
      email: true
    }
  }
});*/


$(document).ready(function() {
    $('html, body').hide();

    if (window.location.hash) {
        setTimeout(function() {
            $('html, body').scrollTop(0).show();
            $('html, body').animate({
                scrollTop: $(window.location.hash).offset().top - 300
                }, 2000)
        }, 0);
    }
    else {
        $('html, body').show();
    }
    });

    $("#email_key_up").keyup(function(){
         var email = $("#email_key_up").val();
         var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         if (!filter.test(email)) {
           //alert('Please provide a valid email address');
           $("#error_email").text(email+" is not a valid email");
           email.focus;
           //return false;
        } else {
            $("#error_email").text("");
        }
     });

    $("#reg_email_key_up").keyup(function(){
         var email = $("#reg_email_key_up").val();
         var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         if (!filter.test(email)) {
           //alert('Please provide a valid email address');
           $("#reg_error_email").text(email+" is not a valid email");
           email.focus;
           //return false;
        } else {
            $("#reg_error_email").text("");
        }
     });

  function startDictation() {
    $('#speak_icon').addClass('red_speak_icon');
    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }
  }


function increaseValue(id) {
    var value = parseInt(document.getElementById(id).value, 10);
    value = isNaN(value) ? 1 : value;
    value++;
    document.getElementById(id).value = value;
}
function decreaseValue(id) {
    var value = parseInt(document.getElementById(id).value, 10);
    value = isNaN(value) ? 1 : value;
    value-- <= 1 ? value = 1 : '';
    // value--;
    document.getElementById(id).value = value;
}


function generateHtml(data)
{
    $('#categories').html('');

    for (category in data.categories) {
        var dummyCat = dummyCategory.clone();

        if (typeof data.categories[category]['products'] != 'undefined') {
            for (product in data.categories[category]['products']) {
                var productData = data.categories[category]['products'][product];
                var prod = dummyProduct.clone();
                prod.attr('id', '');
                prod.find('.prod-name').text(productData['name']);
                prod.find('.prod-image').attr('src', productData['image']);
                prod.find('price').text(productData['price']);
                prod.find('.prod-url').attr('href', productDetailUrl.replace('product_slug', productData['slug']))

                if (productData['quantity']) {
                    html = '<form method="post" class="cart-form">';
                    html += '<input type="hidden" name="product" value="' + productData['id'] + '">';
                    html += '<button class="btn text-capitalize" href="#"><i class="fa fa-shopping-cart"></i> add to cart</button>';
                    html += '</form>';
                } else {
                    html = '<label href="javascript:void(0)" class="btn sold">Out of Stock</label>';
                }

                prod.find('.prod-add-to-cart').html( html );
                dummyCat.find('.products').append(prod);
            }
        }

        dummyCat.attr('id', 'category-products-' + data.categories[category]['name']);
        //$('[href*="category-products-' + data.categories[category]['id'] + '"]').addClass('m-select');
        //alert('category-products-' + data.categories[category]['id']);
        dummyCat.find('.category-name').attr( 'id', 'cat-'+ data.categories[category]['id'] );
        dummyCat.find('.category-name').text( data.categories[category]['name'] );
        $('#categories').append(dummyCat);



    }

    initCartForm();
}

    $(document).ready(function(){
        $('.rating.selection span').click(function(){
            $('.rating span.active').each(function(){
                $(this).removeClass('active');
            });
            
            $(this).addClass('active');
            var rating = 5 - $(this).index();
            $(this)('#rating-field').val(rating);
        });
    });

// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
  e = e || window.event;
  if (e.preventDefault)
      e.preventDefault();
  e.returnValue = false;  
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

function disableScroll() {
  if (window.addEventListener) // older FF
      window.addEventListener('DOMMouseScroll', preventDefault, false);
  window.onwheel = preventDefault; // modern standard
  window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
  window.ontouchmove  = preventDefault; // mobile
  document.onkeydown  = preventDefaultForScrollKeys;
}

function enableScroll() {
    if (window.removeEventListener)
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.onmousewheel = document.onmousewheel = null; 
    window.onwheel = null; 
    window.ontouchmove = null;  
    document.onkeydown = null;  
}


function toggleLoader(showLoader)
{
    if (showLoader) {
        $(".backDrop").fadeIn( 100, "linear" );
        $(".loader").fadeIn( 100, "linear" );
        disableScroll();
    } else {
        $(".backDrop").fadeOut( 100, "linear" );
        $(".loader").fadeOut( 100, "linear" );
        enableScroll();
    }
}