	
	
	
	$(document).on("hidden.bs.modal", "#form_content_with_place", function(){
		
		//$("#p_table").DataTable().ajax.url(getTheWebroot()  + "vendors/indexajax").load();
	});
	
	
	$(document).on("click", ".modal_view", function(e){
		e.preventDefault();
		var url		 = $(this).attr("href");
		var title    = $(this).attr("title");
		var note    = $(this).attr("note");
		$(".modal-body").html("");
		showLoadingModal("show");
		$.get(url, function(resp){
			$(".modal-body").html(resp).promise().done( function(){
				showLoadingModal("hide");
				inputMasking();
				//getRegionList();
				//getProvinceList();
				//getCityList();
				//getBarangayList();
				//generateAddress();
				allowEdit("#default_form");
				
				showFilterTable(getTheWebroot()  + "products/requestsupplyajax");
				
				$("#continue_btn").click( function(){
					var ids = $(".ids").val();
					var _conf = confirm("You are about to submit the information. Please click OK to confirm.");
					
					if(_conf){
						showLoading("show");
						//save the data then redirect for update
						$.post(getTheWebroot() + "orders/saveajax", $( "#order_form" ).serialize(), function(resp){
							var resp = JSON.parse(resp);
							console.log(resp);
							if(resp.resp==1){
								//redirect the page
								window.location.href = getTheWebroot() + "orders/updateorder/" + resp.refid; 
							}else{
								alert(resp.msg);
							}
							
							showLoading("hide");
						});
					}
				});
				
				$("#show_item").on("click", function(e){
					var category_id 		= $("#category_id").val();
					var tagging_id 			= $("#tagging_id").val();
					var vendor_id			= $("#vendor_id").val();
					var program_id 			= $("#program_id").val();
					var subcategory_id 		= $("#subcategory_id").val();
					
					if(category_id===""){ category_id = 0; }
					if(tagging_id===""){ tagging_id = 0; }
					if(vendor_id===""){ vendor_id = 0; }
					if(program_id===""){ program_id = 0; }
					if(subcategory_id===""){ subcategory_id = 0; }
			
					var url = "products/requestsupplyajax/filter/" + program_id + "/" + category_id + "/" + vendor_id + "/" + tagging_id + "/" + subcategory_id + "/for_order";
					
					$("#pc_table").DataTable().ajax.url(getTheWebroot()  + url).load();
					
					//showFilterTable(getTheWebroot()  + url);
					
				});
				
				
				
				$("#btnsubmit").on("click", function(e){	
					var _conf = confirm("You are about to submit the information. Please click OK to confirm.");
					
					if(_conf){
						
						var form	=  $(this).attr("form");
						var postdata = $(form).serialize();
						var url		 = $(this).attr("url"); //$("#default_form").attr("action");
						var action   = $(this).attr("action");
						
						$(this).prop("disabled", true);	
					
						//$("#form_content_with_place").modal("hide");
						
					
						$.ajax({
							url: url,
							data: postdata,
							type: "JSON",
							method: "post",
							beforeSend: function(){
								//$("#m_loading").modal("show");
								showLoading("show");
							},
							success:function(resp){
								var res = JSON.parse(resp);
								//console.log(res);
								
								if(res.resp=="1"){
									//$("#m_success").modal("show");
									//$(".m_resp").html(res.msg);
									//alert(res.msg);
									if(action=="new"){
										$('#default_form').trigger("reset");
									}
									//showLoading("hide");
								}
								//}else{
									//$("#m_error").modal("show");
									//$(".m_resp").html(res.msg);
									
									/*setTimeout( function(){
										$("#m_error").modal("hide");
										$("#form_content_with_place").modal("show");
									}, 1000);*/
									
									
								//}
								alert(res.msg);
								showLoading("hide");
								
							},
							error: function(e1, e2, e3){
								//$("#m_error").modal("show");
								alert("Unable to process your request at the moment. Please try again in a short while");
								showLoading("hide");
							},
							complete: function(){
								//$("#m_loading").modal("hide");
								$("#btnsubmit").prop("disabled", false);
								
							}
							
						});
					}else{
						e.preventDefault();
						return false;
					}
				});
				
			});
			
			
		});
									
	});
	
	$(document).on("click", ".modal_view_sub", function(e){
		e.preventDefault();
		var url		 = $(this).attr("href");
		var title    = $(this).attr("title");
		var note    = $(this).attr("note");
		$(".modal-body-sub").html("");
		showLoadingModal("show");
		$.get(url, function(resp){
			
			$(".modal-body-sub").html(resp).promise().done( function(){
				
				showLoadingModal("hide");
				$(".modal-title-sub").html(title);
				$(".modal-note-sub").html(note);
				
				
				
				$("#btnfilter").click( function(e){
					//var form	=  $(this).attr("form");
					//var postdata = $(form).serialize();
					//var url		 = $(this).attr("url"); //$("#default_form").attr("action");
					//var action   = $(this).attr("action");
					
					
					var category_id 		= $("#category_id").val();
					var tagging_id 			= $("#tagging_id").val();
					var vendor_id			= $("#vendor_id").val();
					var program_id 			= $("#program_id").val();
					var subcategory_id 		= $("#subcategory_id").val();
					
					if(category_id===""){ category_id = 0; }
					if(tagging_id===""){ tagging_id = 0; }
					if(vendor_id===""){ vendor_id = 0; }
					if(program_id===""){ program_id = 0; }
					if(subcategory_id===""){ subcategory_id = 0; }

					
					var url = "products/indexajax/filter/" + program_id + "/" + category_id + "/" + vendor_id + "/" + tagging_id + "/" + subcategory_id
					
					$("#p_table").DataTable().ajax.url(getTheWebroot()  + url).load();
					
				});
				
			});
		});
									
	});
	
