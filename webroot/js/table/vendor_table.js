	
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
					{bSortable: false, targets: [1,2,4,5]},
				
				  ],
				  "columns": [
					  { data: "name", width: "35%"},
					  { data: "manage", width: "20%"},
					  { data: "license", width: "10%"},
					  { data: "created", width: "10%"},
					  { data: "status", width: "5%"},
					  { data: "action", width: "20%"}
				  ],
				   // "scrollY": "430px",
					"scrollCollapse": false,
				   "lengthMenu": [[5, 25, 50, 100, -1], [5, 25, 50, 100, "All"]],
					"bStateSave": false, 
					"pagingType": "full_numbers",
					"fnDrawCallback": function(){

					}
		});
	}