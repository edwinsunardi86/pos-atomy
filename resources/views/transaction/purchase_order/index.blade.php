@extends('layouts.main')
@section('container')
<style>
  #purchase-order-table td{ padding:6px 8px; }
</style>
<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
		   <div class="row mb-2">
			   <div class="col-sm-6">
			      <h1>Purchase Order List</h1>
			   </div>
			   <div class="col-sm-6">
			      <ol class="breadcrumb float-sm-right">
				      <li class="breadcrumb-item"><a href="#">Purchase Order</a></li>
				      <li class="breadcrumb-item active">List</li>
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
                     <a href="{{ url('purchase_orders/create') }}" class="btn btn-block bg-gradient-primary col-md-2"><i class="fas fa-plus"></i> Add  Order</a>
                  </div>
			         <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tb_purchase_order">
                           <thead>
                              <th>No.</th>
                              <th>Order Number</th>
                              <th>Sales Date</th>
                              <th>Shipping Cost</th>
                              <th>Total Purchase Price</th>
                              <th>Action</th>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<script>
jQuery(document).ready(function(){
	function pickField(row, keys){
    for(let i=0;i<keys.length;i++){
      if(typeof row[keys[i]] !== 'undefined' && row[keys[i]] !== null) return row[keys[i]];
    }
    return '-';
  }
  
   var tbl = $('#tb_purchase_order').DataTable({
      processing:true,
      serverSide:true,
      ajax:{
         url:'{{ route("purchase_orders.dataTablePurchaseOrders") }}',
         type: 'POST',
         headers: {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
         },
      },
      columns:
      [
         {data:'DT_RowIndex', name:'DT_RowIndex'},
         { data:null, name:'order_number', render:function(data, type, row){
            return pickField(row, 'order_number')
         }},
         { data:null, name:'sales_date', render:function(data, type, row){
            return pickField(row, 'sales_date');
         }},
         { data:null, name:'shipping_costs', render:function(data, type, row){
            return pickField(row, 'shipping_costs');
         }},
         { data:null, name:'total_price', render: function(data, type, row){
            return pickField(row, 'total_price');
         }},
         { data:'action', name:'action', orderable:false, searchable:false },
      ],
      error: function(xhr, status, err){
         console.log("AJAX ERROR", xhr.status, xhr.responseText);
      },
      "columnDefs": [{
         "targets": 0,
         "orderable": false
      }]
   })
});
</script>
@endsection