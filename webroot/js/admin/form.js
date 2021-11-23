$(function(){
    // file for custom js code

    // Ajax csrf token setup
   /* $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "test_token" // this is defined in app.php as a js variable
        }
    });*/
	
	function inputMasking(){
		$(".letters_only").inputmask({
			regex			: "[a-zA-Z\\s]+",
			casing 			: "upper",
			leftAlign		: true,
			placeholder		: ""
		});
		
		$(".numbers_only").inputmask({
			regex			: "[0-9]*",
			casing 			: "upper",
			leftAlign		: true,
			placeholder		: ""
		});
		
		$(".numbers_and_letters").inputmask({
			regex			: "[a-zA-Z0-9._-\\s]+",
			casing 			: "upper",
			leftAlign		: true,
			placeholder		: ""
		});
		
		
	}
	
    $(document).on("shown.bs.modal", "#form_content", function(){
		inputMasking();
	
		$("#default_form").on("submit", function(e){
			var postdata = $("#default_form").serialize();
			var url		 = $("#default_form").attr("action");
		
		
			$("#form_content").modal("hide");
			e.preventDefault();
		
			$.ajax({
				url: url,
				data: postdata,
				type: "JSON",
				method: "post",
				beforeSend: function(){
					$("#m_loading").modal("show");
				},
				success:function(resp){
					var res = JSON.parse(resp);
					//console.log(res);
					
					if(res.resp=="1"){
						$("#m_success").modal("show");
						$(".m_resp").html(res.msg);
						$('#default_form').trigger("reset");
						
					}else{
						$("#m_error").modal("show");
						$(".m_resp").html(res.msg);
						
						setTimeout( function(){
							$("#m_error").modal("hide");
							$("#form_content").modal("show");
						}, 3000);
					}
					
				},
				error: function(e1, e2, e3){
					$("#m_error").modal("show");
					
				},
				complete: function(){
					$("#m_loading").modal("hide");
				}
				
			});
		});

	});
	
	$(document).on("shown.bs.modal", "#form_content_with_place", function(){
		inputMasking();
		//getRegionList();
		getProvinceList();
		getCityList();
		getBarangayList();
		generateAddress();
		
		//$("#default_form").on("submit", function(e){
		$("#btnsubmit").on("click", function(e){	
			var form	=  $(this).attr("form");
			var postdata = $(form).serialize();
			var url		 = $(this).attr("url"); //$("#default_form").attr("action");
			var action   = $(this).attr("action");
			
			$(this).prop("disabled", true);	
		
			//$("#form_content_with_place").modal("hide");
			e.preventDefault();
		
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
		});

	});
	
    $(document).on("submit", "#frm-edit-student", function(){

        var postdata = $("#frm-edit-student").serialize();

        $.ajax({
            url: "/ajax-edit-student",
            data: postdata,
            type: "JSON",
            method: "post",
            success:function(response){
                
                window.location.href = '/list-students'
            }
        });
    });

    // ajax request to delete student
    $(document).on("click", ".modal_view", function(e){
		e.preventDefault();
		var url		 = $(this).attr("href");
		var title    = $(this).attr("title");
		var note    = $(this).attr("note");

		$.get(url, function(resp){
			$("#modal_content").html(resp);
			$("#modal_title").html(title);
			$("#note").html(note);
		});
									
	});
	
    $(document).on("click", ".btn-delete-student", function(){

        if(confirm("Are you sure want to delete ?")){

            var postdata = "student_id=" + $(this).attr("data-id");
            $.ajax({
                url: "/ajax-delete-student",
                data: postdata,
                type: "JSON",
                method: "post",
                success:function(response){
                    
                    window.location.href = '/list-students'
                }
            });
        }
    });
	
	function showLoading(type){
		if(type=="show"){
			$("#m_process").removeClass("nodisplay");
		}else{
			$("#m_process").addClass("nodisplay");
		}
	}
	
	function getRegionList(){
			
		_url = _webroot + "regions/getList/";
		getOptionList(_url, ".loc_region");
				
	}

	function getProvinceList(){
			$(".loc_region").change( function(){
				showLoading("show");
				var _sel = $(".loc_region option:selected").val();
				var _url = "";
				if(_sel===""){
					_error_message("show", "Please select Region.");
				}else{
					_url = _webroot + "provinces/getList/" + _sel;
					showLoading("hide");
					getOptionList(_url, ".loc_province");
				}
			});
	}
	
    function getCityList(){	
			$(".loc_province").change( function(){
				showLoading("show");
				var _sel = $(".loc_region option:selected").val();
				var _sel_pr = $(".loc_province option:selected").val();
				var _url = "";
				if(_sel===""){
					_error_message("show", "Please select Province.");
				}else{
					
					_url = _webroot + "cities/getList/" + _sel + "/" + _sel_pr;
					showLoading("hide");
					getOptionList(_url, ".loc_city");
				}
			});
	}

	function getBarangayList(){
			$(".loc_city").change( function(){
				showLoading("show");
				var _sel = $(".loc_region option:selected").val();
				var _sel_pr = $(".loc_province option:selected").val();
				var _sel_ct = $(".loc_city option:selected").val();
				var _url = "";
				if(_sel===""){
						$("#m_error").modal("show");
						$(".m_resp").html("Please select city");
						
						setTimeout( function(){
							$("#m_error").modal("hide");
							
						}, 3000);
				}else{
					_url = _webroot + "barangays/getList/" + _sel + "/" + _sel_pr + "/" + _sel_ct;
					showLoading("hide");
					getOptionList(_url, ".loc_barangay");
					
				}
			});
	}


	function generateAddress(){
		$(".sitio").keypress( function(){
			$(".address").val($(".sitio").val() + " " + $(".loc_barangay option:selected").text() + " " + $(".loc_city option:selected").text() + " " + $(".loc_province option:selected").text() + " " + $(".loc_region option:selected").text())
				
		});
	}
	
	function getOptionList(_url, optionid){
		
		$(optionid).empty();
		$.ajax({
				method		: "GET",
				url			: _url,
				cache		: false,				
				beforeSend	: function(){
					//_loading_message("show");
				},
				success		: function(resp){
							_data = JSON.parse(resp);
							
							if(_data.status===200){
								$(optionid).append($("<option>", { 
										value: "",
										text : "--Choose"
								}));
								
								$.each(_data.data, function (i, item) {
									$(optionid).append($("<option>", { 
										value: item.id,
										text : item.name 
									}));
								});
							}else{
								$(optionid).empty();
								$(optionid).append($("<option>", { 
										value: "",
										text : "--Choose"
								}));
								//_error_message("show", _data.message);
								alert(_data.message);
							}
						
				},
				error		: function(err1, err2, err3){
					//_error_message("show", "Opps! something went wrong, please try again.");
					alert("Opps! something went wrong, please try again.");
				
				},
				complete	: function(){
					//_loading_message("hide");
					
				},				
			});	
	}
	
		
});