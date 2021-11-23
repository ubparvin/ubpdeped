<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orders view content">
            <h3><?= h($order->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Refid') ?></th>
                    <td><?= h($order->refid) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $order->has('user') ? $this->Html->link($order->user->id, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Vendor') ?></th>
                    <td><?= $order->has('vendor') ? $this->Html->link($order->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $order->vendor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Type') ?></th>
                    <td><?= h($order->payment_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment') ?></th>
                    <td><?= h($order->payment) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Status') ?></th>
                    <td><?= h($order->payment_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Status') ?></th>
                    <td><?= h($order->order_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($order->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vat') ?></th>
                    <td><?= $this->Number->format($order->vat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vatable Sales') ?></th>
                    <td><?= $this->Number->format($order->vatable_sales) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount Due') ?></th>
                    <td><?= $this->Number->format($order->amount_due) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estimated Delivery') ?></th>
                    <td><?= h($order->estimated_delivery) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($order->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($order->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Receiver Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($order->receiver_address)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Payment Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($order->payment_address)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Note') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($order->note)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Payments') ?></h4>
                <?php if (!empty($order->payments)) : ?>
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
                        <?php foreach ($order->payments as $payments) : ?>
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
                <h4><?= __('Related Purchases') ?></h4>
                <?php if (!empty($order->purchases)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Refid') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Qty') ?></th>
                            <th><?= __('Total Price') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->purchases as $purchases) : ?>
                        <tr>
                            <td><?= h($purchases->id) ?></td>
                            <td><?= h($purchases->refid) ?></td>
                            <td><?= h($purchases->order_id) ?></td>
                            <td><?= h($purchases->product_id) ?></td>
                            <td><?= h($purchases->price) ?></td>
                            <td><?= h($purchases->qty) ?></td>
                            <td><?= h($purchases->total_price) ?></td>
                            <td><?= h($purchases->created) ?></td>
                            <td><?= h($purchases->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Purchases', 'action' => 'view', $purchases->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Purchases', 'action' => 'edit', $purchases->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Purchases', 'action' => 'delete', $purchases->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchases->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Receivables') ?></h4>
                <?php if (!empty($order->receivables)) : ?>
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
                        <?php foreach ($order->receivables as $receivables) : ?>
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
        </div>
    </div>
</div>
