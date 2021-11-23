<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roles view content">
            <h3><?= h($role->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($role->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($role->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Added') ?></th>
                    <td><?= h($role->added) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($role->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($role->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Group Id') ?></th>
                            <th><?= __('Role Id') ?></th>
                            <th><?= __('School Id') ?></th>
                            <th><?= __('Office Id') ?></th>
                            <th><?= __('Firstname') ?></th>
                            <th><?= __('Middlename') ?></th>
                            <th><?= __('Lastname') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Mobile No') ?></th>
                            <th><?= __('Barangay Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Region Id') ?></th>
                            <th><?= __('Province Id') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Added') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Last Access') ?></th>
                            <th><?= __('Status') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->group_id) ?></td>
                            <td><?= h($users->role_id) ?></td>
                            <td><?= h($users->school_id) ?></td>
                            <td><?= h($users->office_id) ?></td>
                            <td><?= h($users->firstname) ?></td>
                            <td><?= h($users->middlename) ?></td>
                            <td><?= h($users->lastname) ?></td>
                            <td><?= h($users->email) ?></td>
                            <td><?= h($users->mobile_no) ?></td>
                            <td><?= h($users->barangay_id) ?></td>
                            <td><?= h($users->city_id) ?></td>
                            <td><?= h($users->region_id) ?></td>
                            <td><?= h($users->province_id) ?></td>
                            <td><?= h($users->address) ?></td>
                            <td><?= h($users->added) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td><?= h($users->last_access) ?></td>
                            <td><?= h($users->status) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
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
