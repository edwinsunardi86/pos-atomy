$( document ).ready(function() {
	//untuk memanggil plugin select2
    $('#groupitem').select2({
	  	placeholder: 'Pilih Group Item',
	  	language: "id"
	});
	$('#namaitem').select2({
	  	placeholder: 'Pilih Item',
	  	language: "id"
	});
	

	//saat pilihan provinsi di pilih maka mengambil data di data-wilayah menggunakan ajax
	$("#groupitem").change(function(){
	      $("img#load1").show();
	      var id_provinces = $(this).val(); 
	      $.ajax({
	         type: "POST",
	         dataType: "html",
	         url: "cekauto.php?jenis=kota",
	         data: "id_provinces="+id_provinces,
	         success: function(msg){
	            $("select#namaitem").html(msg);                                                       
	            $("img#load1").hide();
	            getAjaxKota();                                                        
	         }
	      });                    
     });  

	$("#namaitem").change(getAjaxKota);
     function getAjaxKota(){
          $("img#load2").show();
          var id_regencies = $("#namaitem").val();
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "cekauto.php?jenis=kecamatan",
             data: "id_regencies="+id_regencies,
             success: function(msg){
                $("select#kecamatan").html(msg);                              
                $("img#load2").hide(); 
               getAjaxKecamatan();                                                    
             }
          });
     }

     $("#kecamatan").change(getAjaxKecamatan);
     function getAjaxKecamatan(){
          $("img#load3").show();
          var id_district = $("#kecamatan").val();
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "cekauto.php?jenis=kelurahan",
             data: "id_district="+id_district,
             success: function(msg){
                $("select#kelurahan").html(msg);                              
                $("img#load3").hide();                                                 
             }
          });
     }
});