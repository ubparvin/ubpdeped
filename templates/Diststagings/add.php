<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diststaging $diststaging
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Diststagings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diststagings form content">
            <?= $this->Form->create($diststaging) ?>
            <fieldset>
                <legend><?= __('Add Diststaging') ?></legend>
                <?php
                    echo $this->Form->control('code');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
