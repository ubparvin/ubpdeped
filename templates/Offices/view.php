<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Office $office
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Office'), ['action' => 'edit', $office->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Office'), ['action' => 'delete', $office->id], ['confirm' => __('Are you sure you want to delete # {0}?', $office->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Offices'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Office'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="offices view content">
            <h3><?= h($office->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($office->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Barangay') ?></th>
                    <td><?= $office->has('barangay') ? $this->Html->link($office->barangay->id, ['controller' => 'Barangays', 'action' => 'view', $office->barangay->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= $office->has('city') ? $this->Html->link($office->city->id, ['controller' => 'Cities', 'action' => 'view', $office->city->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Province') ?></th>
                    <td><?= $office->has('province') ? $this->Html->link($office->province->id, ['controller' => 'Provinces', 'action' => 'view', $office->province->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Region') ?></th>
                    <td><?= $office->has('region') ? $this->Html->link($office->region->id, ['controller' => 'Regions', 'action' => 'view', $office->region->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Mobile No') ?></th>
                    <td><?= h($office->mobile_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tel No') ?></th>
                    <td><?= h($office->tel_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact Person') ?></th>
                    <td><?= h($office->contact_person) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($office->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Added') ?></th>
                    <td><?= h($office->added) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($office->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($office->address)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Receivables') ?></h4>
                <?php if (!empty($office->receivables)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Refid') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('School Id') ?></th>
                            <th><?= __('Office Id') ?></th>
                            <th><?= __('Estimated Delivery') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($office->receivables as $receivables) : ?>
                        <tr>
                            <td><?= h($receivables->id) ?></td>
                            <td><?= h($receivables->refid) ?></td>
                            <td><?= h($receivables->user_id) ?></td>
                            <td><?= h($receivables->order_id) ?></td>
                            <td><?= h($receivables->school_id) ?></td>
                            <td><?= h($receivables->office_id) ?></td>
                            <td><?= h($receivables->estimated_delivery) ?></td>
                            <td><?= h($receivables->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Receivables', 'action' => 'view', $receivables->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Receivables', 'action' => 'edit', $receivables->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Receivables', 'action' => 'delete', $receivables->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receivables->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Receives') ?></h4>
                <?php if (!empty($office->receives)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Refid') ?></th>
                            <th><?= __('Receiveable Id') ?></th>
                            <th><?= __('School Id') ?></th>
                            <th><?= __('Office Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Received Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($office->receives as $receives) : ?>
                        <tr>
                            <td><?= h($receives->id) ?></td>
                            <td><?= h($receives->refid) ?></td>
                            <td><?= h($receives->receiveable_id) ?></td>
                            <td><?= h($receives->school_id) ?></td>
                            <td><?= h($receives->office_id) ?></td>
                            <td><?= h($receives->user_id) ?></td>
                            <td><?= h($receives->received_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Receives', 'action' => 'view', $receives->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Receives', 'action' => 'edit', $receives->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Receives', 'action' => 'delete', $receives->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receives->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($office->users)) : ?>
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
                        <?php foreach ($office->users as $users) : ?>
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
