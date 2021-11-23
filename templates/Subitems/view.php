<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subitem $subitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Subitem'), ['action' => 'edit', $subitem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Subitem'), ['action' => 'delete', $subitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subitem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Subitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Subitem'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="subitems view content">
            <h3><?= h($subitem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($subitem->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($subitem->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($subitem->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
