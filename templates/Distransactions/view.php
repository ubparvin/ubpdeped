<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distransaction $distransaction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Distransaction'), ['action' => 'edit', $distransaction->int], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Distransaction'), ['action' => 'delete', $distransaction->int], ['confirm' => __('Are you sure you want to delete # {0}?', $distransaction->int), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Distransactions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Distransaction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="distransactions view content">
            <h3><?= h($distransaction->int) ?></h3>
            <table>
                <tr>
                    <th><?= __('Distribution') ?></th>
                    <td><?= $distransaction->has('distribution') ? $this->Html->link($distransaction->distribution->id, ['controller' => 'Distributions', 'action' => 'view', $distransaction->distribution->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($distransaction->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Int') ?></th>
                    <td><?= $this->Number->format($distransaction->int) ?></td>
                </tr>
                <tr>
                    <th><?= __('Userid') ?></th>
                    <td><?= $this->Number->format($distransaction->userid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received') ?></th>
                    <td><?= h($distransaction->received) ?></td>
                </tr>
                <tr>
                    <th><?= __('Release') ?></th>
                    <td><?= h($distransaction->release) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
