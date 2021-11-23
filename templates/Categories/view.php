<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="categories view content">
            <h3><?= h($category->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($category->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($category->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($category->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Products') ?></h4>
                <?php if (!empty($category->products)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Subcategory Id') ?></th>
                            <th><?= __('Tagging Id') ?></th>
                            <th><?= __('Sku') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('On Hand') ?></th>
                            <th><?= __('Program') ?></th>
                            <th><?= __('Subitem') ?></th>
                            <th><?= __('Date Received') ?></th>
                            <th><?= __('Location') ?></th>
                            <th><?= __('Lifespan') ?></th>
                            <th><?= __('Warranty Expires') ?></th>
                            <th><?= __('Maintenance') ?></th>
                            <th><?= __('Added') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($category->products as $products) : ?>
                        <tr>
                            <td><?= h($products->id) ?></td>
                            <td><?= h($products->user_id) ?></td>
                            <td><?= h($products->category_id) ?></td>
                            <td><?= h($products->subcategory_id) ?></td>
                            <td><?= h($products->tagging_id) ?></td>
                            <td><?= h($products->sku) ?></td>
                            <td><?= h($products->name) ?></td>
                            <td><?= h($products->qty) ?></td>
                            <td><?= h($products->on_hand) ?></td>
                            <td><?= h($products->program) ?></td>
                            <td><?= h($products->subitem) ?></td>
                            <td><?= h($products->date_received) ?></td>
                            <td><?= h($products->location) ?></td>
                            <td><?= h($products->lifespan) ?></td>
                            <td><?= h($products->warranty_expires) ?></td>
                            <td><?= h($products->maintenance) ?></td>
                            <td><?= h($products->added) ?></td>
                            <td><?= h($products->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
