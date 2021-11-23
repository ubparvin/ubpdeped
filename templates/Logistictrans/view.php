<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Logistictran $logistictran
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Logistictran'), ['action' => 'edit', $logistictran->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Logistictran'), ['action' => 'delete', $logistictran->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logistictran->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Logistictrans'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Logistictran'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="logistictrans view content">
            <h3><?= h($logistictran->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Logistic') ?></th>
                    <td><?= $logistictran->has('logistic') ? $this->Html->link($logistictran->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $logistictran->logistic->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($logistictran->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pa Refid') ?></th>
                    <td><?= h($logistictran->pa_refid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pa Name') ?></th>
                    <td><?= h($logistictran->pa_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($logistictran->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($logistictran->date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
