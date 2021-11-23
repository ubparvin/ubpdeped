	
	function showIndexTable(tableid, url){
		$(tableid).DataTable({
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
					{bSortable: false, targets: [1, 2]},
				
				  ],
				  "columns": [
					  { data: "name", width: "80%"},
					  { data: "stat", width: "10%"},
					  { data: "action", width: "10%"}
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