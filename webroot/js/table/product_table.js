	
	function showIndexTable(tableid, url){
		
		$(tableid).DataTable({
				   dom: "Blfrtip",
				   buttons: [
						//'copy', 
						"csv", "excel", "pdf", "print"
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
					{bSortable: false, targets: [6]},
				  ],
				  "columns": [
					  { data: "proimg", 	width: "10%"},
					  { data: "name",	 	width: "25%"},
					  { data: "qty", 		width: "10%"},
					  { data: "registered", width: "10%"},
					  { data: "modified", 	width: "10%"},
					  { data: "status", 	width: "10%"},
					  { data: "action", 	width: "20%"}
				  ],
				   // "scrollY": "430px",
					"scrollCollapse": false,
				   "lengthMenu": [[4, 25, 50, 100, -1], [4, 25, 50, 100, "All"]],
					"bStateSave": false, 
					"pagingType": "full_numbers",
					"fnDrawCallback": function(){
						/* $(".modal_view").click(function(e){
							e.preventDefault();
							var url		 = $(this).attr("href");
							var title    = $(this).attr("title");
							
							$.get(url, function(resp){
								$("#modal_content").html(resp);
								$("#modal_title").html(title);
							});
														
						});*/
					}
		});
	}