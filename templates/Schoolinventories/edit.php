<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schoolinventory $schoolinventory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $schoolinventory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $schoolinventory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Schoolinventories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schoolinventories form content">
            <?= $this->Form->create($schoolinventory) ?>
            <fieldset>
                <legend><?= __('Edit Schoolinventory') ?></legend>
                <?php
                    echo $this->Form->control('school_id', ['options' => $schools]);
                    echo $this->Form->control('logistic_id', ['options' => $logistics]);
                    echo $this->Form->control('item_series');
                    echo $this->Form->control('qty');
                    echo $this->Form->control('received_by');
                    echo $this->Form->control('received_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
