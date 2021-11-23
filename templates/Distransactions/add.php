<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distransaction $distransaction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Distransactions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="distransactions form content">
            <?= $this->Form->create($distransaction) ?>
            <fieldset>
                <legend><?= __('Add Distransaction') ?></legend>
                <?php
                    echo $this->Form->control('distribution_id', ['options' => $distributions]);
                    echo $this->Form->control('received');
                    echo $this->Form->control('release', ['empty' => true]);
                    echo $this->Form->control('type');
                    echo $this->Form->control('userid');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
