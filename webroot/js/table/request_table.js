	
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
					{bSortable: false, targets: [1,2,3,5,6]},
				
				  ],
				  "columns": [
					  { data: "id", width: "5%"},
					  { data: "requestor", width: "30%"},
					  { data: "items", width: "20%"},
					  { data: "address", width: "30%"},
					  { data: "added", width: "5%"},
					  { data: "status", width: "5%"},
					  { data: "action", width: "5%"}
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