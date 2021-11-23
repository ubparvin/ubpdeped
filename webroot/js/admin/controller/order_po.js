	$(document).on("change", ".price, .qty", function(e){
			var id = $(this).attr("p-id");
			var qty = $(".qty_" + id).val();
			var price = $(".price_" + id).val().split(",").join("");
			
			var total = (parseInt(qty) * parseFloat(price));
			$(".amount_" + id).val(total);
			var sum = 0;
			 
			$(".amount").each(function() {
				sum += Number($(this).val());
			});
	});