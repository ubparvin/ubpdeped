	
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
					  { data: "name", width: "20%"},
					  { data: "program", width: "20%"},
					  { data: "vendor", width: "20%"},
					  { data: "courier", width: "20%"},
					  { data: "level", width: "10%"},
					  { data: "action", width: "10%"}
				  ],
				   // "scrollY": "430px",
					"scrollCollapse": false,
				   "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					"bStateSave": false, 
					"pagingType": "full_numbers",
					"fnDrawCallback": function(){

					}
		});
	}