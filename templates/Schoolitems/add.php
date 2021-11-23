<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schoolitem $schoolitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Schoolitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schoolitems form content">
            <?= $this->Form->create($schoolitem) ?>
            <fieldset>
                <legend><?= __('Add Schoolitem') ?></legend>
                <?php
                    echo $this->Form->control('school_id', ['options' => $schools]);
                    echo $this->Form->control('product_id', ['options' => $products]);
                    echo $this->Form->control('qty');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
