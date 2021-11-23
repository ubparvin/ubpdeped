<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Region $region
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $region->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $region->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Regions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="regions form content">
            <?= $this->Form->create($region) ?>
            <fieldset>
                <legend><?= __('Edit Region') ?></legend>
                <?php
                    echo $this->Form->control('psgcCode');
                    echo $this->Form->control('regDesc');
                    echo $this->Form->control('regCode');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
