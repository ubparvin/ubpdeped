<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Province $province
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Provinces'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="provinces form content">
            <?= $this->Form->create($province) ?>
            <fieldset>
                <legend><?= __('Add Province') ?></legend>
                <?php
                    echo $this->Form->control('psgcCode');
                    echo $this->Form->control('provDesc');
                    echo $this->Form->control('regCode');
                    echo $this->Form->control('provCode');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
