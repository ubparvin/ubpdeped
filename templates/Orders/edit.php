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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="orders form content">
            <?= $this->Form->create($order) ?>
            <fieldset>
                <legend><?= __('Edit Order') ?></legend>
                <?php
                    echo $this->Form->control('refid');
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('vendor_id', ['options' => $vendors]);
                    echo $this->Form->control('vat');
                    echo $this->Form->control('vatable_sales');
                    echo $this->Form->control('amount_due');
                    echo $this->Form->control('receiver_address');
                    echo $this->Form->control('payment_address');
                    echo $this->Form->control('estimated_delivery', ['empty' => true]);
                    echo $this->Form->control('payment_type');
                    echo $this->Form->control('payment');
                    echo $this->Form->control('payment_status');
                    echo $this->Form->control('order_status');
                    echo $this->Form->control('note');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
