@extends('layouts.main')
@section('container')
<style>
   
</style>
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
		   <div class="row mb-2">
			   <div class="col-sm-6">
			      <h1>Purchase Order Create</h1>
			   </div>
			   <div class="col-sm-6">
			      <ol class="breadcrumb float-sm-right">
				      <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
				      <li class="breadcrumb-item active">Create</li>
			      </ol>
			   </div>
		   </div>
		</div><!-- /.container-fluid -->
	</section>
	  <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
		   <div class="row">
		      <div class="col-12">
			      <div class="card position-relative">
                  <form autocomplete="off" method="POST" class="form-purchase-order-create" novalidate>
                     <div class="card-body">
                        <div class="form-group row">
                           <label for="order_number" class="col-form-label col-sm-2">Order Number</label>
                           <div class="col-sm-4">
                              <input type="text" class="form-control header-form" id="order_number" required>
                              <div id="feedback-order_number" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="sales_date" class="col-form-label col-sm-2">Sales Date</label>
                           <div class="input-group col-sm-2" id="dt_sales_date" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input header-form" id="sales_date" data-target="#dt_sales_date" data-inputmask="'mask' : '99-99-9999'" data-mask required>
                              <div class="input-group-append" data-target="#dt_sales_date" data-toggle="datetimepicker">
                                 <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                              <div id="feedback-sales_date" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="table-responsive" style="width:100%">
                           <div class="d-flex justify-content-end p-3"><button class="btn btn-primary btn-md" type="button" id="add-item">Add Item</button></div>
                           <table class="table table-bordered table-striped" id="order-table">
                              <thead>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Point Value</th>
                                    <th>Total Point value</th>
                                    <th>Unit Price (Rp.)</th>
                                    <th>Total Price (Rp.)</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody class="order-body">
                                 <tr class="product-row">
                                    <td>
                                       <input type="hidden" name="product_code[]" class="col-product_code"/>
                                       <input type="text" name="product_name[]" class="product_search form-control" required>
                                       <div class="result_list border bg-white z-1 position-absolute col-4 d-none"></div>
                                    </td>
                                    <td>
                                       <div class="row py-2 col-description"></div>
                                    </td>
                                    <td>
                                       <input type="text" name="quantity[]" class="form-control inp_quantity" data-inputmask="'alias' : 'integer', 'groupSeparator' : ','" data-mask required>
                                    </td>
                                    <td>
                                       <div class="row py-2 col-point_value"></div>
                                    </td>
                                    <td>
                                       <div class="row py-2 col-total_point_value"></div>
                                    </td>
                                    <td>
                                       <div class="row py-2 col-price"></div>
                                    </td>
                                    <td>
                                       <div class="row py-2 col-total_price"></div>
                                    </td>
                                    <td>
                                       <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md">Submit</button>
                     </div>   
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
@section('script')
<script>
$(document).on('keyup','.product_search', function () {
   let this_el = $(this);
   let keyword = this_el.val();
   
   if (keyword.length < 1) {
      // $('.result_list').hide();
      this_el.closest('tr').find('.result_list').hide();
      return;
   }
   console.log("keyup:", keyword);
         // Jika mau AJAX manual (override bawaan select2)
   $.ajax({
      url: '{{ Route("purchase_orders.searchDataProduct") }}',
      type: 'GET',
      data: { product_name: keyword },
      success: function (res) {
         let html = '';
         this_el.closest('tr').find('.result_list').removeClass('d-none');
         res.forEach(item => {
            html += `
               <div class="border-bottom text-muted row p-2 result-item" data-product_code="${item.product_code}" data-point_value="${item.point_value}" data-price="${item.price}" data-description="${item.description}" style="cursor: pointer;">
                  ${item.product_name}
               </div>
            `;
         });
         this_el.closest('tr').find('.result_list').html(html).show();
      }
   });
});

$(document).on('click', '.result-item', function () {
   let row = $(this).closest('tr');
   let name = $(this).text();
   row.find('.product_search').val(name.trim());
   row.find('.col-product_code').val(String($(this).data('product_code')).trim());
   $('.result_list').hide();
   row.find('.col-description').html($(this).data('description'));
   row.find('.col-point_value').html($(this).data('point_value'));
   let total_pv =  $(this).data('point_value') * row.find('.inp_quantity');
   row.find('.col-total_point_value').html(total_pv);
   row.find('.col-price').html($(this).data('price'));
});

$(document).click(function(e){
    if(!$(e.target).closest('#client_name, .result_list').length){
        $('.result_list').hide();
    }
});

$(document).on('click','#add-item', function(){
   var newRow = `
      <tr class="order-row">
         <td>
            <input type="hidden" name="product_code[]" class="col-product_code"/>
            <input type="text" name="product_name[]" class="product_search form-control" required/>
            <div class="result_list border bg-white z-1 position-absolute col-4"></div>
         </td>
         <td>
            <div class="row py-2 col-description"></div>
         </td>
         <td>
            <input type="text" name="quantity[]" class="form-control inp_quantity" data-inputmask="'alias' : 'integer', 'groupSeparator' : ','" data-mask required>
         </td>
         <td>
            <div class="row py-2 col-point_value"></div>
         </td>
         <td>
            <div class="row py-2 col-total_point_value"></div>
         </td>
         <td>
            <div class="row py-2 col-price"></div>
         </td>
         <td>
            <div class="row py-2 col-total_price"></div>
         </td>
         <td>
            <button type="button" class="btn btn-danger btn-sm">Delete</button>
         </td>
      </tr>
   `;
   
   $('.order-body').append(newRow);
   $('[data-mask]').inputmask();
});

$(document).on('keyup', '.inp_quantity', function(){
   let row = $(this).closest('tr');

   let price_per_quantity = row.find('.result-item').data('price');
   let total_price = $(this).val() * price_per_quantity;
   row.find('.col-total_price').html(total_price);

   let point_value_per_quantity = row.find('.result-item').data('point_value'); 
   let total_point_value = $(this).val() * point_value_per_quantity;
   row.find('.col-total_point_value').html(total_point_value);
});

//Date picker
    $('#dt_sales_date').datetimepicker({
        format: 'DD-MM-YYYY'
    });


$(document).on('submit', '.form-purchase-order-create', function(e){
   e.preventDefault();
   let items = [];
   $('input[name="product_code[]"]').each(function(){
      let arr = {};
      arr['product_code'] = $(this).val();
      arr['product_name'] = $(this).closest('tr').find('input[name="product_name[]"]').val();
      arr['quantity'] = $(this).closest('tr').find('input[name="quantity[]"]').val();
      items.push(arr);
   });
   console.log(items);

   let form = $(this)[0];
   if(form.checkValidity() === false){
      $(this).addClass('was-validated');
      document.querySelectorAll('.header-form').forEach(function(input){
         let feedback = input.closest('.form-group').querySelector('#feedback-'+input.id);
         let label = input.closest('.form-group').querySelector('label[for='+input.id+']');
         if(!input.checkValidity())
         {
            input.classList.add('is-invalid');
            if(feedback){
               feedback.classList.add('invalid-feedback');
               feedback.textContent = 'Please provide a valid ' + label.innerText.toLowerCase() + '.';
            }
            feedback.classList.remove('d-none');
         }
         else
         {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
         }
      });
   }else{
      $('.feedback').addClass('d-none');
   }
});

</script>
@endsection