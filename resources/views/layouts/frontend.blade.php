<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <!-- Favicon -->
    @php
        $logo = get_setting('site_favicon');
    @endphp
    @if($logo != null)
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(get_setting('site_favicon')->value ?? 'null') }}" />
    @else
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" />
    @endif
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- front awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Sweetalert css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/slider-range.css ')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css?v=5.3')}}" />
    <!-- Toastr css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- front awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('frontend/css/app.css')}}" />
    <!-- Sweetalert css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.css">
    <!-- Toastr css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    
    @stack('css')
</head>

<body>
    @yield('content-frontend-model')
   
    <!-- Header -->
    @include('frontend.body.header')
    <!--/ Header -->

    <!-- Main -->
	<main class="main">
		@yield('content-frontend')
	</main>
	<!--/ Main -->

    <!-- Footer -->
    @include('frontend.body.footer')
    <!--/ Footer -->

    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{asset('frontend/assets/imgs/theme/loading.gif')}}" alt="" />
                </div>
            </div>
        </div>
    </div> -->
    <!-- Vendor JS-->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/slider-range.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/isotope.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <!-- Toastr js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Sweetalert js -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template  JS -->
    <script src="{{asset('frontend/assets/js/main.js?v=5.3')}}"></script>
    <script src="{{asset('frontend/assets/js/shop.js?v=5.3')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('frontend/js/app.js')}}"></script>

    <!-- Image Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    
    <!-- sweetalert js-->
    <script type="text/javascript">
        $(function(){
            $(document).on('click','#delete',function(e){
                e.preventDefault();
                var link = $(this).attr("href");
    
                Swal.fire({
                  title: 'Are you sure?',
                  text: "Delete This Data!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = link
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
            })
  
          });
        });
    </script>

    <!-- all toastr message show  Update-->
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
        }
        @endif 
    </script>

    <!-- all toastr message show  old-->
    <script type="text/javascript">
        @if(Session::has('success'))
          toastr.success("{{Session::get('success')}}");
        @endif
    </script>
    
    <!-- Start Ajax Setup -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        function selectAttribute(id, value, pid){
            $('#'+id).val(value);

            var varient = '';
            var total = $('#total_attributes').val();
            for(var i=1; i<=total; i++){
                var varnt = $('.attr_value_'+i).val();
                if(varnt != ''){
                    if(i==1){
                        varient += varnt;
                    }else{
                        varient += '-'+varnt;
                    }
                }
            }

            $.ajax({
            type:'GET',
            url:'/varient-price/'+pid+'/'+varient,
            dataType:'json',
                success:function(data){
                    //console.log(data);
                    if(data && data != 'na'){
                        //$('.current-price').text('৳'+data);
                        var discount = $('#discount_amount').val();
                        if(discount>0){
                            $('.current-price').text('৳'+(data-discount));
                            $('.old-price').text('৳'+data);
                            $('#product_price').val(data-discount);
                        }else{
                            $('.current-price').text('৳'+data);
                            $('#product_price').val(data);
                        }
                        $('#pvarient').val(varient);
                        //alert(discount);
                    }
                }
            });
        }

        function selectAttributeModal(id){
            const idArray = id.split("_");

            var value = idArray[2];
            var pid = $('#product_id').val();
            $('#'+idArray[1]).val(value);
            
            $('.attr_val_li_'+idArray[1]).removeClass("active");
            $('#attr_val_li_'+idArray[1]+'_'+idArray[2]).addClass("active");

            var varient = '';
            var total = $('#total_attributes').val();
            for(var i=1; i<=total; i++){
                var varnt = $('.attr_value_'+i).val();
                if(varnt != ''){
                    if(i==1){
                        varient += varnt;
                    }else{
                        varient += '-'+varnt;
                    }
                }
            }

            //alert(varient);

            $.ajax({
            type:'GET',
            url:'/varient-price/'+pid+'/'+varient,
            dataType:'json',
                success:function(data){
                    //console.log(data);
                    if(data && data != 'na'){
                        //$('.current-price').text('৳'+data);
                        var discount = $('#discount_amount').val();
                        if(discount>0){
                            $('#pprice').text(data-discount);
                            $('#oldprice').text(data);
                            $('#product_price').val(data-discount);
                        }else{
                            $('#pprice').text(data);
                            $('#product_price').val(data);
                        }
                        $('#pvarient').val(varient);
                        //alert(discount);
                    }
                }
            });
            
        }

        /* ============= Start Product View With Modal ========== */
        function productView(id){
            // alert(id)
            $.ajax({
                type:'GET',
                url: '/product/view/modal/'+id,
                dataType:'json',
                success:function(data){
                    $('#product_name').text(data.product.name_en);
                    $('#pname').val(data.product.name_en);
                    $('#product_id').val(id);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.name_en);
                    $('#pbrand').text(data.product.brand.name_en);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);

                    $('#pavailable').hide();
                    $('#pstockout').hide();

                    /* =========== Start Product Price ========= */
                    var discount = 0;
                    if(data.product.discount_price>0){
                        if(data.product.discount_type==1){
                            discount = data.product.discount_price;
                            $('#pprice').text(data.product.regular_price - discount);
                            $('#oldprice').text(data.product.regular_price);
                        }else if(data.product.discount_type==2){
                            discount = data.product.discount_price*data.product.regular_price/100;
                            $('#pprice').text(data.product.regular_price - discount);
                            $('#oldprice').text(data.product.regular_price);
                        }
                    }else{
                        $('#pprice').text(data.product.regular_price);
                        $('#oldprice').text('');
                    }

                    $('#discount_amount').val(discount);

                    if(data.product.stock_qty > 0){
                        $('#pavailable').show();
                    }else{
                        $('#pstockout').show();
                    }
                    /* =========== End Product Price ========= */

                    /* ============ Start Color ============= */ 
                    /* ============ Color empty ============= */
                    // $('select[name ="color"]').empty();
                    //console.log(data.attributes);
                    var i = 0;
                    var html = '';
                    $.each(data.attributes, function(key,value){
                        i++;
                        //console.log(value.name);
                        // html += '<div class="form-group col-lg-6">';
                        // html += '<input type="hidden" name="attribute_ids[]" id="attribute_id_'+key+'" value="'+value.id+'">';
                        // html += '<input type="hidden" name="attribute_names[]" id="attribute_name_'+key+'" value="'+value.name+'">';
                        // html += '    <label style=" font-weight:bold;color: black;">Chose '+value.name+' <span>**</span></label>';
                        // html += '    <select class="form-control" name="attribute_options[]" id="attr'+value.id+'" name="attrs[]" onchange="get_varient_price('+data.product.id+')">';
                        // html += '        <option value="">--Choose '+value.name+'--</option>';
                        // // for(var i=0; i<value.values; i++) {
                        // //     html += '        <option value="'+value.id+'">'+value.name+'</option>';
                        // // }
                        // $.each(value.values, function(key,attr_value){
                        //     html += '<option value="'+attr_value+'">'+attr_value+'</option>';
                        // });
                        // html += '    </select>';
                        // html += '</div>';


                        html +='<div class="attr-detail attr-size mb-30">';
                        html +=    '<strong class="mr-10">'+value.name+': </strong>';
                        html +=    '<input type="hidden" name="attribute_ids[]" id="attribute_id_'+i+'" value="'+value.id+'">';
                        html +=        '<input type="hidden" name="attribute_names[]" id="attribute_name_'+i+'" value="'+value.name+'">';
                        html +=    '<ul class="list-filter size-filter font-small">';
                        $.each(value.values, function(key,attr_value){
                            if(key==0){
                                html +=    '<li id="attr_val_li_'+value.id+value.name+'_'+attr_value+'" class="attr_val_li_'+value.id+value.name+'">';
                                html +=        '<a id="attr_'+value.id+value.name+'_'+attr_value+'" onclick="selectAttributeModal(this.id)" style="border: 1px solid #7E7E7E;">'+attr_value+'</a>';
                                html +=        '<input type="hidden" id="choice_option_attr_'+value.id+value.name+'" value="'+attr_value+'">';
                                html +=    '</li>';
                            }else{
                                html +=    '<li id="attr_val_li_'+value.id+value.name+'_'+attr_value+'" class="attr_val_li_'+value.id+value.name+'" style="margin-left: 5px;">';
                                html +=        '<a id="attr_'+value.id+value.name+'_'+attr_value+'" onclick="selectAttributeModal(this.id)" style="border: 1px solid #7E7E7E;">'+attr_value+'</a>';
                                html +=        '<input type="hidden" id="choice_option_attr_'+value.id+value.name+'" value="'+attr_value+'">';
                                html +=    '</li>';
                            }
                            
                        });
                        html +='<input type="hidden" name="attribute_options[]" id="'+value.id+value.name+'" class="attr_value_'+i+'">';
                        html +='</ul>';
                        html +='</div>';
                    });
                    html += '<input type="hidden" id="total_attributes" value="'+data.attributes.length+'">';
                    $('#attributes').html(html);

                    //console.log(data.attributes.length);
                    
                    // for(i = 0; i<data.attributes.length; i++;){
                  
                    // };
                    /* ========== End Color ============= */

                    /* ========== Start Size ============= */
                    /* ========== Size empty ============= */
                    // $('select[name ="size"]').empty();

                    // $.each(data.size, function(key,value){
                    //     $('select[name="size"]').append(' <option value="">--Choose Size--</option>')
                    //     $('select[name="size"]').append('<option value =" '+value+' "> '+value+'</option>')
                    // })

                    /* =========== Data size show hide ============ */
                    // if(data.size == ""){
                    //     $('#sizeArea').hide();
                    // }else{
                    //     $('#sizeArea').show();
                    // }

                    // if(data.color == ""){
                    //     $('#colorArea').hide();
                    // }else{
                    //     $('#colorArea').show();
                    // }
                    /* ========== End Size ============= */

                    /* ========== Start Stock Option ========= */
                    if(data.product.product_qty > 0){
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('aviable');

                    }else{
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    }
                    /* ========== End Stock Option ========== */

                    /* ========= Start Add To Cart Product id ======== */
                    $('#product_id').val(id);
                    $('#qty').val(1);
                    /* ========== End Add To Cart Product id ======== */
                }
            });
        }
        /* ============= End Product View With Modal ========== */

        /* ============= Start AddToCart View With Modal ========== */
        function buyNow(){
            addToCart();
            window.location = '/checkout';
        }
        function addToCart(){
            $('.size-filter li').removeClass("active");
            var product_name = $('#pname').val();
            var id = $('#product_id').val();
            var price = $('#product_price').val();
            var color = $('#color option:selected').val();
            var size = $('#size option:selected').val();
            var quantity = $('#qty').val();
            var varient = $('#pvarient').val();

            // alert(varient);

            var options = $('#choice_form').serializeArray();
            var jsonString = JSON.stringify(options);
            //console.log(options);

            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 1200
            });

            $.ajax({
            type:'POST',
            url:'/cart/data/store/'+id,
            dataType:'json',
            data:{
              color:color,size:size,quantity:quantity,product_name:product_name,product_price:price,product_varient:varient,options:jsonString,
            },
                success:function(data){
                    // console.log(data);
                    miniCart();
                    $('#closeModel').click();

                    // Start Sweertaleart Message
                    const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                          type:'success',
                          title: data.success
                        })
                    }else{
                        Toast.fire({
                          type:'error',
                          title: data.error
                        })
                    }
                    // Start Sweertaleart Message


                }
            });
        }

        /* =========== Add to cart direct ============ */
        function addToCartDirect(id){
            var product_name = $('#'+id+'-product_pname').val();
            //var id = $('#product_product_id').val();
            //alert(id);
            // var color = $('#color option:selected').val(); 
            // var size = $('#size option:selected').val();
            var quantity = 1;

            // alert(product_name);

            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 1200
            });

            $.ajax({
            type:'POST',
            url:'/cart/data/store/'+id,
            dataType:'json',
            data:{
              quantity:quantity,product_name:product_name
            },
                success:function(data){
                    // console.log(data);
                    miniCart();
                    $('#closeModel').click();

                    // Start Sweertaleart Message
                    const Toast = Swal.mixin({
                        toast:true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                          type:'success',
                          title: data.success
                        })
                    }else{
                        Toast.fire({
                          type:'error',
                          title: data.error
                        })
                    }
                    // Start Sweertaleart Message


                }
            });
        }
        /* ============= Start AddToCart View With Modal ========== */
    </script>

    <script type="text/javascript">
        /* ============= Start MiniCart Add ========== */ 
        function miniCart(){
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType:'json',
                success:function(response){
                    // alert(response);
                    checkout();
                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('.cartQty').text(Object.keys(response.carts).length);
                    $('#total_cart_qty').text(Object.keys(response.carts).length);

                    var miniCart = "";

                    if(Object.keys(response.carts).length > 0){
                        $.each(response.carts, function(key,value){
                            var slug = value.options.slug;
                            var base_url = window.location.origin;
                          miniCart += `
                            <ul>
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="#"><img alt="" src="/${value.options.image}" /></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                        <h4><a href="${base_url}/product-details/${slug}">${value.name}</a></h4>
                                        <h4 class="align-items-center d-flex">
                                        <div class="d-inline-flex flex-column">

                                            <span>
                                                <button type="submit" class="minicart_btn minicart_btn_success" id="${value.rowId}" onclick="cartIncrement(this.id)" ><i class="fa-solid fa-plus"></i>
                                                </button>
                                            </span>
                                        ${value.qty > 1
                                            ? `<span>
                                                <button type="submit" class="minicart_btn minicart_btn_danger" id="${value.rowId}" onclick="cartDecrement(this.id)" ><i class="fa-solid fa-minus"></i>
                                                </button>
                                             </span>`

                                            :`<span>
                                                <button type="submit" class="minicart_btn minicart_btn_danger disabled" ><i class="fa-solid fa-minus"></i>
                                                </button>
                                            </span>`
                                        }
                                        </div>
                                        <span>${value.qty} × </span>
                                        ${value.price}
                                        </h4>
                                    </div>
                                    <div class="shopping-cart-delete">
                                        <a  id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li>
                            </ul>
                            <div class="cartBottom">
                               
                            </div>`
                        });

                        $('#miniCart').html(miniCart);
                        $('#miniCart_empty_btn').hide();
                        $('#miniCart_btn').show();
                    }else{
                        html = '<h4 class="text-center">Cart empty!</h4>';
                        $('#miniCart').html(html);
                        $('#miniCart_btn').hide();
                        $('#miniCart_empty_btn').show();
                    }
                }
            });
        }
        /* ============ Function Call ========== */
        miniCart();

        /* ==================== Start MiniCart Remove =============== */
        function miniCartRemove(rowId){
            $.ajax({
               type:'GET',
               url: '/minicart/product-remove/' +rowId,
               dataType: 'json',
               success:function(data){

                miniCart();
                cart();

                // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 2000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message
               }
            });
          }
  /* ==================== End MiniCart Remove =============== */ 

    function cart(){
      $.ajax({
          type: 'GET',
          url: '/get-cart-product',
          dataType:'json',
          success:function(response){
            // console.log(response);
          var rows = "";
          // alert(Object.keys(response.carts).length);
          $('#total_cart_qty').text(Object.keys(response.carts).length);
          if(Object.keys(response.carts).length > 0){
              $.each(response.carts, function(key,value){
                        var slug = value.options.slug;
                        var base_url = window.location.origin;
                  rows += `
                            <tr class="pt-30">
                                <td class="custome-checkbox pl-30">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"></label>
                                </td>
                                <td class="image product-thumbnail pt-40"><img src="/${value.options.image}" alt="#"></td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="${base_url}/product-details/${slug}">${value.name}</a></h6>`;
                  $.each(value.options.attribute_names, function(index,val){
                    rows +=               `<span>`+val+`: `+value.options.attribute_values[index]+`</span><br/>`;
                  });
                  rows +=       `</td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-body">৳${value.price} </h4>
                                </td>
                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="align-items-center d-flex justify-content-center">

                                        ${value.qty > 1

                                          ? `<button type="submit" style="margin-right: 5px; background-color: #2dc5cc !important; font-size: 12px;" class="btn btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button>`

                                          : `  <button type="submit" style="margin-right: 5px;" class="btn btn-danger btn-sm" disabled >-</button> `

                                        }
                                            
                                        <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width: 36px; height:40px; text-align: center; padding-left:0px;">

                                        <button type="submit" style="margin-left: 5px; font-size: 12px;" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="price text-center" width="100px;" data-title="Price">
                                    <h4 class="text-brand">৳${value.subtotal} </h4>
                                </td>
                                <td class="action text-center" data-title="Remove"><a  id="${value.rowId}" onclick="cartRemove(this.id)" class="text-body"><i class="fi-rs-trash"></i></a></td>
                            </tr>`;
                });

              $('#cartPage').html(rows);

            }else{
                html = '<tr><td class="text-center" colspan="6" style="font-size: 18px; font-weight: bold;">Cart empty!</td></tr>';
                $('#cartPage').html(html);
            }
        }
      });
    }
    cart();

    /* ================ Start My Cart Checkout  =========== */
    function checkout(){
        $.ajax({
              type: 'GET',
              url: '/checkout-product',
              dataType:'json',
              success:function(response){
                // console.log(response);
              var rows = "";

                // cart();
                // miniCart();
                //alert(Object.keys(response.carts).length);
                $('#total_cart_qty').text(Object.keys(response.carts).length);

                if(Object.keys(response.carts).length > 0){
                    $.each(response.carts, function(key,value){
                        var slug = value.options.slug;
                        var base_url = window.location.origin;
                        rows += `
                                <tr>
                                    <td class="image product-thumbnail"><img src="/${value.options.image}" alt="#"></td>
                                    <td>
                                        <h6 class="w-160 mb-5"><a href="${base_url}/product-details/${slug}" class="text-heading">${value.name}</a></h6></span>`;
                                    $.each(value.options.attribute_names, function(index,val){
                    rows +=               `<span>`+val+`: `+value.options.attribute_values[index]+`</span><br/>`;
                  });
                  rows +=       `</td>
                                <td>
                                        <h6 class="text-muted pl-20 pr-20">x ${value.qty}</h6>
                                    </td>
                                    <td>
                                        <h4 class="text-brand">৳${value.subtotal}</h4>
                                    </td>
                                </tr>
                            `
                    });

                  $('#cartCheckout').html(rows);
                }else{
                    html = '<h3 class="text-center text-danger" style="font-size:18px; font-weight:bold;">Cart empty!</h3>';
                    $('#cartCheckout').html(html);
                }
            }
        });
    }
    checkout();
    /* ================ End My Cart Checkout =========== */

    /* ================ Start My Cart Remove Product =========== */
    function cartRemove(id){
        $.ajax({
            type: 'GET',
            url: '/cart-remove/'+id,
            dataType:'json',
            success:function(data){
            cart();
            miniCart();


            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 2000
                })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success
                })
            }else{
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error
                })
            }
            // End Message 
            }
        });
    }

/* ==================== End My Cart Remove Product ================== */

  /* ==================== Start  cartIncrement ================== */
    function cartIncrement(rowId){
      $.ajax({
          type:'GET',
          url: "/cart-increment/"+rowId,
          dataType:'json',
          success:function(data){
            // console.log(data)
            cart();
            miniCart();
          }
      });
    }
    /* ==================== End  cartIncrement ================== */

    /* ==================== Start  Cart Decrement ================== */
        function cartDecrement(rowId){
          $.ajax({
              type:'GET',
              url: "/cart-decrement/"+rowId,
              dataType:'json',
              success:function(data){
                // console.log(data)
                //console.log(data);
                // if(data == 2){
                //     alert("#"+rowId);
                //     $("#"+rowId).attr("disabled", "true");
                // }
                cart();
                miniCart();
              }
          });
        }
    /* ==================== End  Cart Decrement ================== */

    function addToCompare(id){
        $.post('{{ route('compare.addToCompare') }}', {"_token": "{{ csrf_token() }}","id": id },function(data){
            $('#compare').html(data);
            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 1200
            });
            // $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
        });
    }
   
    </script>
    @stack('footer-script')
</body>

</html>