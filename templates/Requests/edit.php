<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $request->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $request->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Requests'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="requests form content">
            <?= $this->Form->create($request) ?>
            <fieldset>
                <legend><?= __('Edit Request') ?></legend>
                <?php
                    echo $this->Form->control('refid');
                    echo $this->Form->control('requestor');
                    echo $this->Form->control('details');
                    echo $this->Form->control('date');
                    echo $this->Form->control('school');
                    echo $this->Form->control('office');
                    echo $this->Form->control('delivery_address');
                    echo $this->Form->control('items');
                    echo $this->Form->control('modified_by');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
