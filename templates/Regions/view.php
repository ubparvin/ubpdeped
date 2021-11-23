<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Region $region
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Region'), ['action' => 'edit', $region->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Region'), ['action' => 'delete', $region->id], ['confirm' => __('Are you sure you want to delete # {0}?', $region->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Regions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Region'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="regions view content">
            <h3><?= h($region->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('PsgcCode') ?></th>
                    <td><?= h($region->psgcCode) ?></td>
                </tr>
                <tr>
                    <th><?= __('RegCode') ?></th>
                    <td><?= h($region->regCode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($region->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('RegDesc') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($region->regDesc)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Offices') ?></h4>
                <?php if (!empty($region->offices)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Barangay Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Province Id') ?></th>
                            <th><?= __('Region Id') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Mobile No') ?></th>
                            <th><?= __('Tel No') ?></th>
                            <th><?= __('Contact Person') ?></th>
                            <th><?= __('Added') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($region->offices as $offices) : ?>
                        <tr>
                            <td><?= h($offices->id) ?></td>
                            <td><?= h($offices->name) ?></td>
                            <td><?= h($offices->barangay_id) ?></td>
                            <td><?= h($offices->city_id) ?></td>
                            <td><?= h($offices->province_id) ?></td>
                            <td><?= h($offices->region_id) ?></td>
                            <td><?= h($offices->address) ?></td>
                            <td><?= h($offices->mobile_no) ?></td>
                            <td><?= h($offices->tel_no) ?></td>
                            <td><?= h($offices->contact_person) ?></td>
                            <td><?= h($offices->added) ?></td>
                            <td><?= h($offices->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Offices', 'action' => 'view', $offices->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Offices', 'action' => 'edit', $offices->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Offices', 'action' => 'delete', $offices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offices->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Schools') ?></h4>
                <?php if (!empty($region->schools)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Barangay Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Province Id') ?></th>
                            <th><?= __('Region Id') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Mobile No') ?></th>
                            <th><?= __('Tel No') ?></th>
                            <th><?= __('Contact Person') ?></th>
                            <th><?= __('Added') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($region->schools as $schools) : ?>
                        <tr>
                            <td><?= h($schools->id) ?></td>
                            <td><?= h($schools->name) ?></td>
                            <td><?= h($schools->barangay_id) ?></td>
                            <td><?= h($schools->city_id) ?></td>
                            <td><?= h($schools->province_id) ?></td>
                            <td><?= h($schools->region_id) ?></td>
                            <td><?= h($schools->address) ?></td>
                            <td><?= h($schools->mobile_no) ?></td>
                            <td><?= h($schools->tel_no) ?></td>
                            <td><?= h($schools->contact_person) ?></td>
                            <td><?= h($schools->added) ?></td>
                            <td><?= h($schools->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Schools', 'action' => 'view', $schools->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Schools', 'action' => 'edit', $schools->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schools', 'action' => 'delete', $schools->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schools->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($region->users)) : ?>
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
                        <?php foreach ($region->users as $users) : ?>
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
            <div class="related">
                <h4><?= __('Related Vendors') ?></h4>
                <?php if (!empty($region->vendors)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Mobile No') ?></th>
                            <th><?= __('Tel No') ?></th>
                            <th><?= __('Contact Person') ?></th>
                            <th><?= __('Barangay Id') ?></th>
                            <th><?= __('City Id') ?></th>
                            <th><?= __('Province Id') ?></th>
                            <th><?= __('Region Id') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Added') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($region->vendors as $vendors) : ?>
                        <tr>
                            <td><?= h($vendors->id) ?></td>
                            <td><?= h($vendors->name) ?></td>
                            <td><?= h($vendors->mobile_no) ?></td>
                            <td><?= h($vendors->tel_no) ?></td>
                            <td><?= h($vendors->contact_person) ?></td>
                            <td><?= h($vendors->barangay_id) ?></td>
                            <td><?= h($vendors->city_id) ?></td>
                            <td><?= h($vendors->province_id) ?></td>
                            <td><?= h($vendors->region_id) ?></td>
                            <td><?= h($vendors->address) ?></td>
                            <td><?= h($vendors->added) ?></td>
                            <td><?= h($vendors->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Vendors', 'action' => 'view', $vendors->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Vendors', 'action' => 'edit', $vendors->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Vendors', 'action' => 'delete', $vendors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vendors->id)]) ?>
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
