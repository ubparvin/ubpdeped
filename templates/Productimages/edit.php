<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Productimage $productimage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $productimage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $productimage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Productimages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productimages form content">
            <?= $this->Form->create($productimage) ?>
            <fieldset>
                <legend><?= __('Edit Productimage') ?></legend>
                <?php
                    echo $this->Form->control('product_id', ['options' => $products]);
                    echo $this->Form->control('file');
                    echo $this->Form->control('added');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
