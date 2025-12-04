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
				         <form method="POST" class="form-product-create" novalidate>
				            <div class="form-group row">
				               <label for="product_code" class="col-form-label col-sm-2">Product Code</label>
                           <div class="col-sm-3">
                              <input type="text" class="form-control" id="product_code" required>
                              <div id="feedback-product_code" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
				               <label for="product_name" class="col-form-label col-sm-2">Product Name</label>
                           <div class="col-sm-4">
						            <input type="text" class="form-control" id="product_name" required>
                              <div id="feedback-product_name" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
				               <label for="category_name" class="col-form-label col-sm-2">Category</label>
                           <div class="col-sm-3">
                              <select class="form-control" id="category_name" required>
                                 <option value="">-- Select Category --</option>
                                 @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                 @endforeach
                              </select>
                              <div id="feedback-category_name" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
				               <label for="point_value" class="col-form-label col-sm-2">PV (Point Value)</label>
                           <div class="col-sm-3">
						            <input type="text" class="form-control" id="point_value" data-inputmask="'alias' : 'integer', 'groupSeparator' : ','" data-mask required>
                              <div id="feedback-point_value" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
				               <label for="price" class="col-form-label col-sm-2">Price</label>
                           <div class="col-sm-3">
						            <input type="text" class="form-control" id="price" data-inputmask="'alias' : 'decimal', 'groupSeparator' : ','" data-mask required>
                              <div id="feedback-price" class="feedback d-none"></div>
                           </div>
                        </div>
                        <div class="form-group row">
				               <label for="price" class="col-form-label col-sm-2">Description</label>
                           <div class="col-sm-4">
						            <textarea type="text" class="form-control" id="description" rows="7"></textarea>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
      $('.form-product-create').on('submit', function(e){
         e.preventDefault();
         e.stopPropagation();
         let form = $(this)[0];
         if(form.checkValidity() === false){
            $(this).addClass('was-validated');
            document.querySelectorAll('.form-control').forEach(function(input) {
               let feedback = input.closest('.form-group').querySelector('#feedback-' + input.id);
               let label = input.closest('.form-group').querySelector('label[for="' + input.id + '"]');
               // feedback.classList.remove('d-none');
               if(!input.checkValidity()){
                  input.classList.add('is-invalid');
                  if(feedback){
                     feedback.classList.add('invalid-feedback')
                     feedback.textContent = 'Please provide a valid ' + label.innerText.toLowerCase() + '.';
                  }
                  feedback.classList.remove('d-none');
               }else{
                  if(feedback){
                     input.classList.remove('is-invalid');
                     input.classList.add('is-valid');
                  }
               }
            })
         } else {
            $('.feedback').addClass('d-none');
            $.ajax({
               url:'{{ url("master/products") }}',
               method:'POST',
               data:{
                  product_code  : $('#product_code').val(),
                  product_name  : $('#product_name').val(),
                  category_id   : $('#category_name').val(),
                  point_value   : $('#point_value').val().replace(',',''),
                  price         : $('#price').val().replace(',',''),
                  description   : $('#description').val(),
                  _token        : '{{ csrf_token() }}'
               },
               success:function(res){
                  Toast.fire({
                     icon:res.icon,
                     title:res.message
                  });
                  document.querySelectorAll('.form-control').forEach(function(input){
                     input.classList.remove('is-invalid');
                     input.classList.remove('is-valid');
                     input.value = '';
                  })
               },
               error:function(err){
                  Toast.fire({
                     icon:'error',
                     title:'An error occurred while saving the product.'
                  });
               }
            })
         }
      });
   })
</script>
@endsection