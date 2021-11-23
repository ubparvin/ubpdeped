<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barangay $barangay
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $barangay->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $barangay->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Barangays'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barangays form content">
            <?= $this->Form->create($barangay) ?>
            <fieldset>
                <legend><?= __('Edit Barangay') ?></legend>
                <?php
                    echo $this->Form->control('brgyCode');
                    echo $this->Form->control('brgyDesc');
                    echo $this->Form->control('regCode');
                    echo $this->Form->control('provCode');
                    echo $this->Form->control('citymunCode');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
