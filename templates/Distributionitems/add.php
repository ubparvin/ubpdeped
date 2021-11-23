<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distributionitem $distributionitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Distributionitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="distributionitems form content">
            <?= $this->Form->create($distributionitem) ?>
            <fieldset>
                <legend><?= __('Add Distributionitem') ?></legend>
                <?php
                    echo $this->Form->control('distribution_id', ['options' => $distributions]);
                    echo $this->Form->control('product_id', ['options' => $products]);
                    echo $this->Form->control('program_id', ['options' => $programs]);
                    echo $this->Form->control('qty');
                    echo $this->Form->control('added');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
