
<?php 
switch($contract_id){
			case 1:
				foreach($total as $i):
					echo "TX - ".number_format($i->total_tx, 0, ".", ",");
					
				endforeach;

			break;
			case 2:
				foreach($total as $i):
					echo "TX - ".number_format($i->total_tx, 0, ".", ",").'<br />';
					echo "TM - ".number_format($i->total_tm, 0, ".", ",");
				endforeach;
			break;
			case 3:
				foreach($total as $i):
					echo "ESP TX - ".number_format($i->total_esp_tx, 0, ".", ",").'<br />';
					echo "ESP TM - ".number_format($i->total_esp_tm, 0, ".", ",").'<br />';
					echo "AP TM - ".number_format($i->total_ap_tx, 0, ".", ",").'<br />';
					echo "AP TM - ".number_format($i->total_ap_tm, 0, ".", ",");
				endforeach;
			break;
			case 4:
				foreach($total as $i):
					echo "TOTAL - ".number_format($i->total_kg_total, 0, ".", ",").'<br />';
					
				endforeach;
			break;
			case 5:
				foreach($total as $i):
					echo "MA TX - ".number_format($i->total_ma_tx, 0, ".", ",").'<br />';
					echo "MA TM - ".number_format($i->total_ma_tm, 0, ".", ",");
				endforeach;
			break;
			case 6:
				foreach($total as $i):
					echo "TOTAL - ".number_format($i->total_kg_total, 0, ".", ",").'<br />';
					
				endforeach;
			break;
			default:
			
			break;
}
?>