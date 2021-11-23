
<div class="schoolitems index content">
    <div class="table-responsive">
        <table id="schoolitems" class="table table-condensed">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Program</th>
                    <th>Qty</th>
                    <th>Budget Year</th>
                    <th>Model</th>
                    <th>Cost</th>
                    <th>Acquisition</th>
                    <th>Warranty</th>
                   
               </tr>
            </thead>
            <tbody>
                <?php foreach ($schoolitems as $i): ?>
                <tr>
					<td><?php echo $i->series_no; ?>
						<div class="text-info"><?php echo $i->school->name; ?></div>
					</td>
					<td><?php echo $i->program; ?></td>
					<td><?php echo $i->qty; ?></td>
					<td><?php echo $i->budget_year; ?></td>
					<td><?php echo $i->brand_model; ?></td>
					<td><?php echo $i->acq_cost; ?></td>
					<td><?php echo $i->acq_date; ?></td>
					<td><?php echo $i->warranty_period; ?></td>
				</tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>
