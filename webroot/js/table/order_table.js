	
	function showIndexTable(tableid, url){
		
		$(tableid).DataTable({
				   dom: 'Blfrtip',
				   buttons: [
						//'copy', 
						'csv', 'excel', 'pdf', 'print'
					],
				  "processing"		: true,
				  "serverSide"		: true,
				  //"serverMethod"	: "post",
				  "ajax": {
					  "url"			: url,
					  "method"		: "post",
					  "headers": {
						'X-CSRF-Token' : $('[name="_csrfToken"]').val()
					  },
				  },
				 
				  columnDefs: [
					{bSortable: false, targets: [0,11]},
				
				  ],
				  "columns": [
					  { data: "id", width: "5%"},
					  { data: "vendor", width: "25%"},
					  { data: "item", width: "5%"},
					  { data: "total", width: "5%"},
					  { data: "discount", width: "5%"},
					  { data: "due", width: "5%"},
					  { data: "paid", width: "5%"},
					  { data: "balance", width: "5%"},
					  { data: "payment", width: "10%"},
					  { data: "term", width: "10%"},
					  { data: "status", width: "10%"},
					  { data: "action", width: "10%"}
				  ],
				   // "scrollY": "430px",
					"scrollCollapse": false,
				   "lengthMenu": [[8, 25, 50, 100, -1], [8, 25, 50, 100, "All"]],
					"bStateSave": false, 
					"pagingType": "full_numbers",
					"fnDrawCallback": function(){

					}
		});
	}
	
	function showFilterTable(url){
		
		$("#pc_table").DataTable({
				   dom: 'Blfrtip',
				   buttons: [
						//'copy', 
						//'csv', 'excel', 'pdf', 'print'
					],
				  "processing"		: true,
				  "serverSide"		: true,
				  //"serverMethod"	: "post",
				  "ajax": {
					  "url"			: url,
					  "method"		: "post",
					  "headers": {
						'X-CSRF-Token' : $('[name="_csrfToken"]').val()
					  },
				  },
				 
				  columnDefs: [
					{bSortable: false, targets: [0,1,2]},
				
				  ],
				  "columns": [
					  { data: "id", width: "10%"},
					  { data: "name", width: "70%"},
					  { data: "action", width: "20%"}
				  ],
				   // "scrollY": "430px",
					"scrollCollapse": false,
				   "lengthMenu": [[8, 25, 50, 100, -1], [8, 25, 50, 100, "All"]],
					"bStateSave": false, 
					"pagingType": "full_numbers",
					"fnDrawCallback": function(){
					
							$(".add_order").on("click", function(e){
								e.preventDefault();
								$(this).addClass("nodisplay");
								var item = $(this).attr("item-id");
								//var qty  = $("#qty_" + item).val();
								var ids = $(".ids").val();
								if(ids==""){
									$(".ids").val(item);
								}else{
									$(".ids").val(ids +"," + item);
								}
							});
							
							
					}
		});
	}