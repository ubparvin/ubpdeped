<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Productseries $productseries
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $productseries->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $productseries->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Productseries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productseries form content">
            <?= $this->Form->create($productseries) ?>
            <fieldset>
                <legend><?= __('Edit Productseries') ?></legend>
                <?php
                    echo $this->Form->control('product_id', ['options' => $products]);
                    echo $this->Form->control('series');
                    echo $this->Form->control('start');
                    echo $this->Form->control('end');
                    echo $this->Form->control('qty');
                    echo $this->Form->control('receive');
                    echo $this->Form->control('received_by');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
