<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diststaging $diststaging
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Diststaging'), ['action' => 'edit', $diststaging->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Diststaging'), ['action' => 'delete', $diststaging->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diststaging->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Diststagings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Diststaging'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="diststagings view content">
            <h3><?= h($diststaging->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= h($diststaging->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($diststaging->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($diststaging->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
