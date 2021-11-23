	$(document).on("hidden.bs.modal", "#form_content_with_place", function(){
		var group_id = $(".group_id").val();
		
		$("#p_table").DataTable().ajax.url(getTheWebroot()  + "requests/indexajax/" + group_id).load();
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
				$(".modal-title").html(title);
				$(".modal-note").html(note);
			
				inputMasking();
				getRegionList();
				
				//allowEdit("#product_form");
				itemQty();
				
				//$("#default_form").on("submit", function(e){
				$("#btnpro").on("click", function(e){	
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
								//console.log(res.data);
								
								if(res.resp=="1"){
									//$("#m_success").modal("show");
									//$(".m_resp").html(res.msg);
									//alert(res.msg);
									if(action=="new"){
										$('#product_form').trigger("reset");
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
								$("#btnpro").prop("disabled", false);
								
							}
							
						});
					}else{
						e.preventDefault();
						return false;
					}
				});
				
				$("#add_more").click( function(e){
					e.preventDefault();
					
					var html ='<div class="row m-t-20 item_child"><div class="col-md-2 nopadding-right qty_wrapper"><input type="text" value="1" name="qty[]" maxlength="6" class="numbers_only qty input-group-item form-control noradius" /><div class="row m-t-5"><div class="col-md-6 nopadding-right"><span class="btn-block nopadding btn btn-primary btn-sm noradius dec"><i class="fa fa-minus-circle"></i></span></div><div class="col-md-6 nopadding-left"><span class="btn-block nopadding btn btn-primary btn-sm noradius inc"><i class="fa fa-plus-circle"></i></span></div></div></div><div class="col-md-10 nopadding-left"><i class="fa fa-minus-circle remove_item text-danger"></i><textarea class="form-control noradius numbers_and_letters" name="item[]" rows="2" placeholder="Item / Description ... " /></textarea></div></div>';
						
					$(".items").append(html).ready(function () {
						inputMasking();
						itemQty();
						
						$(".remove_item").click( function(){
							$(this).closest(".item_child").remove();
						});
						
					});
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
					var status 		= $("#status").val();
					if(status===""){ status = 0; }
					var url = "requests/indexajax/filter/" + status;
					$("#p_table").DataTable().ajax.url(getTheWebroot()  + url).load();
				});
				
			});
		});
									
	});
	