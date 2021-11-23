<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Officeitem $officeitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $officeitem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $officeitem->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Officeitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="officeitems form content">
            <?= $this->Form->create($officeitem) ?>
            <fieldset>
                <legend><?= __('Edit Officeitem') ?></legend>
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
