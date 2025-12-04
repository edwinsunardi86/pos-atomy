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
              <div class="card-header">
                <a href="{{ url('products/create') }}" class="btn btn-block bg-gradient-primary col-md-2"><i class="fas fa-plus"></i> Tambah Product</a>
              </div>
              <div class="card-body">
                <table id="product-table" class="table table-bordered table-striped" width="100%">
                  <thead>
                    <th>No</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<modal class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <p>Are you sure you want to delete the product <strong id="productInfo"></strong>?</p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" form="deleteForm" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</modal>

<script>
jQuery(document).ready(function(){
  function pickField(row, keys){
    for(let i=0;i<keys.length;i++){
      if(typeof row[keys[i]] !== 'undefined' && row[keys[i]] !== null) return row[keys[i]];
    }
    return '-';
  }

  var tbl = $('#product-table').DataTable({
    processing: true,
    serverSide: true,
     ajax: {
      url: '{{ route("products.dataTableProduct") }}',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
    columns:[
      {data:'DT_RowIndex', name:'DT_RowIndex'},
      {data:null, name:'product_code', render:function(data, type, row){
        return pickField(row, ['code','product_code','sku','barcode']);
      }},
      {data:null, name:'product_name', render:function(data, type, row){
        return pickField(row, ['name','product_name','title','product']);
      }},
      {data:null, name:'category_name', render:function(data, type, row){
        return pickField(row, ['category_name','category','cat_name','categories_name','name']);
      }},
      {data:null, name:'price', render:function(data, type, row){
        let p = pickField(row, ['price','selling_price','harga']);
        if(p === '-') return p;
        return Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(p);
      }},
      {data:'action', name:'action', orderable:false, searchable:false}
    ],
    error: function(xhr, status, err){
    console.log("AJAX ERROR", xhr.status, xhr.responseText);
},
    "columnDefs": [{
      "targets": 0,
      "orderable": false
    }]
  });

  $('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var productId = button.data('id'); // Extract info from data-* attributes
    var productCode = button.data('product_code');
    var productName = button.data('product_name');

    var modal = $(this);
    modal.find('#productInfo').text(productCode + ' - ' + productName);
    modal.find('#deleteForm').attr('action', '{{ url("products") }}/' + productId);
    $('#deleteForm').off('submit').on('submit', function(e){
      e.preventDefault();
      e.stopPropagation();
      let form = $(this);
      $.ajax({
        url: "{{ url('products') }}/" + productId,
        method: 'POST',
        data: form.serialize(),
        success: function(res){
          Toast.fire({
            icon: res.icon,
            title: res.message
          });
          $('#deleteModal').modal('hide');
          tbl.ajax.reload(null, false);
        },
        error: function(xhr){
          Toast.fire({
            icon: 'error',
            title: 'An error occurred while deleting the product.'
          });
        }
      });
    });
  });
});
</script>
@endsection
