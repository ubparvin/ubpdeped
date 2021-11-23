<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Group') ?></th>
                    <td><?= $user->has('group') ? $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('School') ?></th>
                    <td><?= $user->has('school') ? $this->Html->link($user->school->name, ['controller' => 'Schools', 'action' => 'view', $user->school->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Office') ?></th>
                    <td><?= $user->has('office') ? $this->Html->link($user->office->name, ['controller' => 'Offices', 'action' => 'view', $user->office->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Firstname') ?></th>
                    <td><?= h($user->firstname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Middlename') ?></th>
                    <td><?= h($user->middlename) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastname') ?></th>
                    <td><?= h($user->lastname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mobile No') ?></th>
                    <td><?= h($user->mobile_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Barangay') ?></th>
                    <td><?= $user->has('barangay') ? $this->Html->link($user->barangay->id, ['controller' => 'Barangays', 'action' => 'view', $user->barangay->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= $user->has('city') ? $this->Html->link($user->city->id, ['controller' => 'Cities', 'action' => 'view', $user->city->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Region') ?></th>
                    <td><?= $user->has('region') ? $this->Html->link($user->region->id, ['controller' => 'Regions', 'action' => 'view', $user->region->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Province') ?></th>
                    <td><?= $user->has('province') ? $this->Html->link($user->province->id, ['controller' => 'Provinces', 'action' => 'view', $user->province->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($user->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Added') ?></th>
                    <td><?= h($user->added) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Access') ?></th>
                    <td><?= h($user->last_access) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->address)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Orders') ?></h4>
                <?php if (!empty($user->orders)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Refid') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Vendor Id') ?></th>
                            <th><?= __('Vat') ?></th>
                            <th><?= __('Vatable Sales') ?></th>
                            <th><?= __('Amount Due') ?></th>
                            <th><?= __('Receiver Address') ?></th>
                            <th><?= __('Payment Address') ?></th>
                            <th><?= __('Estimated Delivery') ?></th>
                            <th><?= __('Payment Type') ?></th>
                            <th><?= __('Payment') ?></th>
                            <th><?= __('Payment Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Order Status') ?></th>
                            <th><?= __('Note') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->orders as $orders) : ?>
                        <tr>
                            <td><?= h($orders->id) ?></td>
                            <td><?= h($orders->refid) ?></td>
                            <td><?= h($orders->user_id) ?></td>
                            <td><?= h($orders->vendor_id) ?></td>
                            <td><?= h($orders->vat) ?></td>
                            <td><?= h($orders->vatable_sales) ?></td>
                            <td><?= h($orders->amount_due) ?></td>
                            <td><?= h($orders->receiver_address) ?></td>
                            <td><?= h($orders->payment_address) ?></td>
                            <td><?= h($orders->estimated_delivery) ?></td>
                            <td><?= h($orders->payment_type) ?></td>
                            <td><?= h($orders->payment) ?></td>
                            <td><?= h($orders->payment_status) ?></td>
                            <td><?= h($orders->created) ?></td>
                            <td><?= h($orders->modified) ?></td>
                            <td><?= h($orders->order_status) ?></td>
                            <td><?= h($orders->note) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $orders->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'edit', $orders->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Orders', 'action' => 'delete', $orders->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orders->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Payments') ?></h4>
                <?php if (!empty($user->payments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Refid') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Amount Paid') ?></th>
                            <th><?= __('Payment Type') ?></th>
                            <th><?= __('Added') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->payments as $payments) : ?>
                        <tr>
                            <td><?= h($payments->id) ?></td>
                            <td><?= h($payments->refid) ?></td>
                            <td><?= h($payments->user_id) ?></td>
                            <td><?= h($payments->order_id) ?></td>
                            <td><?= h($payments->amount_paid) ?></td>
                            <td><?= h($payments->payment_type) ?></td>
                            <td><?= h($payments->added) ?></td>
                            <td><?= h($payments->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Products') ?></h4>
                <?php if (!empty($user->products)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Subcategory Id') ?></th>
                            <th><?= __('Tagging Id') ?></th>
                            <th><?= __('Sku') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('On Hand') ?></th>
                            <th><?= __('Program') ?></th>
                            <th><?= __('Subitem') ?></th>
                            <th><?= __('Date Received') ?></th>
                            <th><?= __('Location') ?></th>
                            <th><?= __('Lifespan') ?></th>
                            <th><?= __('Warranty Expires') ?></th>
                            <th><?= __('Maintenance') ?></th>
                            <th><?= __('Added') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->products as $products) : ?>
                        <tr>
                            <td><?= h($products->id) ?></td>
                            <td><?= h($products->user_id) ?></td>
                            <td><?= h($products->category_id) ?></td>
                            <td><?= h($products->subcategory_id) ?></td>
                            <td><?= h($products->tagging_id) ?></td>
                            <td><?= h($products->sku) ?></td>
                            <td><?= h($products->name) ?></td>
                            <td><?= h($products->qty) ?></td>
                            <td><?= h($products->on_hand) ?></td>
                            <td><?= h($products->program) ?></td>
                            <td><?= h($products->subitem) ?></td>
                            <td><?= h($products->date_received) ?></td>
                            <td><?= h($products->location) ?></td>
                            <td><?= h($products->lifespan) ?></td>
                            <td><?= h($products->warranty_expires) ?></td>
                            <td><?= h($products->maintenance) ?></td>
                            <td><?= h($products->added) ?></td>
                            <td><?= h($products->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Receivables') ?></h4>
                <?php if (!empty($user->receivables)) : ?>
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
                        <?php foreach ($user->receivables as $receivables) : ?>
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
                <?php if (!empty($user->receives)) : ?>
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
                        <?php foreach ($user->receives as $receives) : ?>
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
        </div>
    </div>
</div>
