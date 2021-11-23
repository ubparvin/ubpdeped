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
            <?= $this->Html->link(__('Edit Productimage'), ['action' => 'edit', $productimage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Productimage'), ['action' => 'delete', $productimage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productimage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Productimages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Productimage'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productimages view content">
            <h3><?= h($productimage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $productimage->has('product') ? $this->Html->link($productimage->product->name, ['controller' => 'Products', 'action' => 'view', $productimage->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productimage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Added') ?></th>
                    <td><?= h($productimage->added) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($productimage->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('File') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($productimage->file)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
