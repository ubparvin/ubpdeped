<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Receife $receife
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Receife'), ['action' => 'edit', $receife->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Receife'), ['action' => 'delete', $receife->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receife->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Receives'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Receife'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="receives view content">
            <h3><?= h($receife->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Refid') ?></th>
                    <td><?= h($receife->refid) ?></td>
                </tr>
                <tr>
                    <th><?= __('School') ?></th>
                    <td><?= $receife->has('school') ? $this->Html->link($receife->school->name, ['controller' => 'Schools', 'action' => 'view', $receife->school->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Office') ?></th>
                    <td><?= $receife->has('office') ? $this->Html->link($receife->office->name, ['controller' => 'Offices', 'action' => 'view', $receife->office->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $receife->has('user') ? $this->Html->link($receife->user->id, ['controller' => 'Users', 'action' => 'view', $receife->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($receife->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Receiveable Id') ?></th>
                    <td><?= $this->Number->format($receife->receiveable_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received Date') ?></th>
                    <td><?= h($receife->received_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
