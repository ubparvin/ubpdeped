	
	function showIndexTable(tableid, url){
		
		$(tableid).DataTable({
				   dom: "Blfrtip",
				   buttons: [
						//'copy', 
						//"csv", "excel", "pdf", "print"
						"pdf"
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
					{bSortable: false, targets: [2]},
				  ],
				  "columns": [
					  { data: "id",	 		width: "10%"},
					  { data: "name",	 	width: "75%"},
					  { data: "action", 	width: "15%"}
				  ],
				   // "scrollY": "430px",
					"scrollCollapse": false,
				   "lengthMenu": [[5, 25, 50, 100, -1], [5, 25, 50, 100, "All"]],
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