<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Logistic $logistic
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Logistics'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="logistics form content">
            <?= $this->Form->create($logistic) ?>
            <fieldset>
                <legend><?= __('Add Logistic') ?></legend>
                <?php
                    echo $this->Form->control('qrcode');
                    echo $this->Form->control('serial_no');
                    echo $this->Form->control('qty');
                    echo $this->Form->control('program_id', ['options' => $programs, 'empty' => true]);
                    echo $this->Form->control('budget_year');
                    echo $this->Form->control('inspection_date', ['empty' => true]);
                    echo $this->Form->control('vendor_id', ['options' => $vendors, 'empty' => true]);
                    echo $this->Form->control('brand_model');
                    echo $this->Form->control('acq_cost');
                    echo $this->Form->control('acq_date', ['empty' => true]);
                    echo $this->Form->control('pa_inspector');
                    echo $this->Form->control('inspect_date', ['empty' => true]);
                    echo $this->Form->control('pa_transit');
                    echo $this->Form->control('transit_date', ['empty' => true]);
                    echo $this->Form->control('school_id', ['options' => $schools, 'empty' => true]);
                    echo $this->Form->control('pa_school');
                    echo $this->Form->control('sreceived_date', ['empty' => true]);
                    echo $this->Form->control('warehouse_id', ['options' => $warehouses, 'empty' => true]);
                    echo $this->Form->control('pa_warehouse');
                    echo $this->Form->control('wreceived_date', ['empty' => true]);
                    echo $this->Form->control('warranty_period', ['empty' => true]);
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
