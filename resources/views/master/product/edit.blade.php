@extends('layouts.main')
@section('container')
<style>
  #product-table td{ padding:6px 8px; }
</style>
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
		   <div class="row mb-2">
			   <div class="col-sm-6">
			      <h1>Product list</h1>
			   </div>
			   <div class="col-sm-6">
			      <ol class="breadcrumb float-sm-right">
				      <li class="breadcrumb-item"><a href="#">Product</a></li>
				      <li class="breadcrumb-item active">Product List</li>
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
			      <div class="card">
			         <div class="card-body">
                     <form method="POST" class="form-product-edit" novalidate>
                        <div class="form-group row">
                           <label for="product_code" class="col-form-label col-sm-2">Product</label>
                           <div class="col-sm-3">
                              <input type="text" class="form-control" id="product_code" value="{{ $product->product_code }}" required>
                              <div id="feedback-product_code" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="product_name" class="col-form-label col-sm-2">Product Name</label>
                           <div class="col-sm-4">
                              <input type="text" class="form-control" id="product_name" value="{{ $product->product_name }}" required>
                              <div id="feedback-product_name" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="category_name" class="col-form-label col-sm-2">Category</label>
                           <div class="col-sm-3">
                              <select class="form-control" id="category_name" required>
                                 <option value="">-- Select Category --</option>
                                 @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                 @endforeach
                              </select>
                              <div id="feedback-category_name" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="point_value" class="col-form-label col-sm-2">PV (Point Value)</label>
                           <div class="col-sm-3">
                              <input type="text" class="form-control" id="point_value" data-inputmask="'alias' : 'integer', 'groupSeparator' : ','" data-mask value="{{ number_format($product->point_value,0,'',',') }}" required>
                              <div id="feedback-point_value" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
				               <label for="price" class="col-form-label col-sm-2">Price</label>
                           <div class="col-sm-3">
						            <input type="text" class="form-control" id="price" data-inputmask="'alias' : 'decimal', 'groupSeparator' : ','" data-mask value="{{ number_format($product->price,0,'',',') }}" required>
                              <div id="feedback-price" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
				               <label for="price" class="col-form-label col-sm-2">Description</label>
                           <div class="col-sm-4">
						            <textarea type="text" class="form-control" id="description" rows="7">{{ $product->description }}</textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-sm-2"></div>
                           <div class="col-sm-10">
                              <button type="submit" class="btn btn-primary btn-submit">Save Changes</button>
                              <a href="{{ url('products') }}" class="btn btn-secondary">Cancel</a>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script>
   jQuery(document).ready(function(){
      $('.form-product-edit').on('submit', function(e){
         e.preventDefault();
         e.stopPropagation();
         let form = $(this)[0];
         let btnSubmit = $(this).find('.btn-submit');
         btnSubmit.prop('disabled', true);
         // clear previous feedback
         $(form).find('.feedback').addClass('d-none').html('');
         $(form).find('.form-control').removeClass('is-invalid');
         let formData = {
            product_code: $('#product_code').val(),
            product_name: $('#product_name').val(),
            category_id: $('#category_name').val(),
            point_value: $('#point_value').inputmask('unmaskedvalue'),
            price: $('#price').inputmask('unmaskedvalue'),
            description: $('#description').val()
         };
         jQuery.ajax({
            url: '{{ url("products/".$product->id) }}',
            method: 'PUT',
            data: formData,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
               Toast.fire({
                  icon: response.icon,
                  title: response.message
               });
               window.location.href = '{{ url("products") }}';
            },
            error: function(xhr){
               if(xhr.status === 422){
                  let errors = xhr.responseJSON.errors;
                  for(let key in errors){
                     let feedbackEl = $('#feedback-'+key);
                     feedbackEl.removeClass('d-none').html(errors[key][0]);
                     $('#'+key).addClass('is-invalid');
                  }
               } else {
                  alert('An error occurred while updating the product. Please try again.');
               }
            },
            complete: function(){
               btnSubmit.prop('disabled', false);
            }
         });
      });
      $('[data-mask]').inputmask();
   });
</script>
@endsection
                           