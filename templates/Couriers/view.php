<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Courier $courier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Courier'), ['action' => 'edit', $courier->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Courier'), ['action' => 'delete', $courier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courier->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Couriers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Courier'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="couriers view content">
            <h3><?= h($courier->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($courier->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($courier->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Couriercontracts') ?></h4>
                <?php if (!empty($courier->couriercontracts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Courier Id') ?></th>
                            <th><?= __('Program Id') ?></th>
                            <th><?= __('Vendor Id') ?></th>
                            <th><?= __('Level') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Contract Year') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($courier->couriercontracts as $couriercontracts) : ?>
                        <tr>
                            <td><?= h($couriercontracts->id) ?></td>
                            <td><?= h($couriercontracts->courier_id) ?></td>
                            <td><?= h($couriercontracts->program_id) ?></td>
                            <td><?= h($couriercontracts->vendor_id) ?></td>
                            <td><?= h($couriercontracts->level) ?></td>
                            <td><?= h($couriercontracts->name) ?></td>
                            <td><?= h($couriercontracts->description) ?></td>
                            <td><?= h($couriercontracts->contract_year) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Couriercontracts', 'action' => 'view', $couriercontracts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Couriercontracts', 'action' => 'edit', $couriercontracts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Couriercontracts', 'action' => 'delete', $couriercontracts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $couriercontracts->id)]) ?>
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
