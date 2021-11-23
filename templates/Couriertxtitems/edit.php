<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Couriertxtitem $couriertxtitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $couriertxtitem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $couriertxtitem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Couriertxtitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="couriertxtitems form content">
            <?= $this->Form->create($couriertxtitem) ?>
            <fieldset>
                <legend><?= __('Edit Couriertxtitem') ?></legend>
                <?php
                    echo $this->Form->control('couriercontract_id', ['options' => $couriercontracts]);
                    echo $this->Form->control('region');
                    echo $this->Form->control('division');
                    echo $this->Form->control('leg_district');
                    echo $this->Form->control('school_beis');
                    echo $this->Form->control('no_eas');
                    echo $this->Form->control('no_district');
                    echo $this->Form->control('recipient_district');
                    echo $this->Form->control('school');
                    echo $this->Form->control('address');
                    echo $this->Form->control('esp_tx');
                    echo $this->Form->control('esp_tm');
                    echo $this->Form->control('ar_tx');
                    echo $this->Form->control('ar_tm');
                    echo $this->Form->control('ma_tx');
                    echo $this->Form->control('ma_tm');
                    echo $this->Form->control('kg_ilokano');
                    echo $this->Form->control('kg_tagalog');
                    echo $this->Form->control('kg_pangasinan');
                    echo $this->Form->control('kg_ivatan');
                    echo $this->Form->control('kg_ibanag');
                    echo $this->Form->control('kg_kapampangan');
                    echo $this->Form->control('kg_sambal');
                    echo $this->Form->control('kg_bikol');
                    echo $this->Form->control('kg_binisaya');
                    echo $this->Form->control('kg_waray');
                    echo $this->Form->control('kg_hiligaynon');
                    echo $this->Form->control('kg_kinaraya');
                    echo $this->Form->control('kg_akeanon');
                    echo $this->Form->control('kg_chavacano');
                    echo $this->Form->control('kg_maguindanao');
                    echo $this->Form->control('kg_maranao');
                    echo $this->Form->control('kg_surigaonon');
                    echo $this->Form->control('kg_yakan');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
