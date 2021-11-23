<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Programseries $programseries
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Programseries'), ['action' => 'edit', $programseries->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Programseries'), ['action' => 'delete', $programseries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $programseries->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Programseries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Programseries'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="programseries view content">
            <h3><?= h($programseries->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Program') ?></th>
                    <td><?= $programseries->has('program') ? $this->Html->link($programseries->program->name, ['controller' => 'Programs', 'action' => 'view', $programseries->program->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Series') ?></th>
                    <td><?= h($programseries->series) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start') ?></th>
                    <td><?= h($programseries->start) ?></td>
                </tr>
                <tr>
                    <th><?= __('End') ?></th>
                    <td><?= h($programseries->end) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($programseries->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Start') ?></th>
                    <td><?= h($programseries->date_start) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date End') ?></th>
                    <td><?= h($programseries->date_end) ?></td>
                </tr>
                <tr>
                    <th><?= __('Added') ?></th>
                    <td><?= h($programseries->added) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
