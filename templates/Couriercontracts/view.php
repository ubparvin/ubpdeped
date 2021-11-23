<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Couriercontract $couriercontract
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Couriercontract'), ['action' => 'edit', $couriercontract->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Couriercontract'), ['action' => 'delete', $couriercontract->id], ['confirm' => __('Are you sure you want to delete # {0}?', $couriercontract->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Couriercontracts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Couriercontract'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="couriercontracts view content">
            <h3><?= h($couriercontract->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Courier') ?></th>
                    <td><?= $couriercontract->has('courier') ? $this->Html->link($couriercontract->courier->name, ['controller' => 'Couriers', 'action' => 'view', $couriercontract->courier->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Program') ?></th>
                    <td><?= $couriercontract->has('program') ? $this->Html->link($couriercontract->program->name, ['controller' => 'Programs', 'action' => 'view', $couriercontract->program->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Vendor') ?></th>
                    <td><?= $couriercontract->has('vendor') ? $this->Html->link($couriercontract->vendor->name, ['controller' => 'Vendors', 'action' => 'view', $couriercontract->vendor->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Level') ?></th>
                    <td><?= h($couriercontract->level) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($couriercontract->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contract Year') ?></th>
                    <td><?= h($couriercontract->contract_year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($couriercontract->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($couriercontract->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Couriertxtitems') ?></h4>
                <?php if (!empty($couriercontract->couriertxtitems)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Couriercontract Id') ?></th>
                            <th><?= __('Region') ?></th>
                            <th><?= __('Division') ?></th>
                            <th><?= __('Leg District') ?></th>
                            <th><?= __('School Beis') ?></th>
                            <th><?= __('No Eas') ?></th>
                            <th><?= __('No District') ?></th>
                            <th><?= __('Recipient District') ?></th>
                            <th><?= __('School') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Esp Tx') ?></th>
                            <th><?= __('Esp Tm') ?></th>
                            <th><?= __('Ar Tx') ?></th>
                            <th><?= __('Ar Tm') ?></th>
                            <th><?= __('Ma Tx') ?></th>
                            <th><?= __('Ma Tm') ?></th>
                            <th><?= __('Kg Ilokano') ?></th>
                            <th><?= __('Kg Tagalog') ?></th>
                            <th><?= __('Kg Pangasinan') ?></th>
                            <th><?= __('Kg Ivatan') ?></th>
                            <th><?= __('Kg Ibanag') ?></th>
                            <th><?= __('Kg Kapampangan') ?></th>
                            <th><?= __('Kg Sambal') ?></th>
                            <th><?= __('Kg Bikol') ?></th>
                            <th><?= __('Kg Binisaya') ?></th>
                            <th><?= __('Kg Waray') ?></th>
                            <th><?= __('Kg Hiligaynon') ?></th>
                            <th><?= __('Kg Kinaraya') ?></th>
                            <th><?= __('Kg Akeanon') ?></th>
                            <th><?= __('Kg Chavacano') ?></th>
                            <th><?= __('Kg Maguindanao') ?></th>
                            <th><?= __('Kg Maranao') ?></th>
                            <th><?= __('Kg Surigaonon') ?></th>
                            <th><?= __('Kg Yakan') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($couriercontract->couriertxtitems as $couriertxtitems) : ?>
                        <tr>
                            <td><?= h($couriertxtitems->id) ?></td>
                            <td><?= h($couriertxtitems->couriercontract_id) ?></td>
                            <td><?= h($couriertxtitems->region) ?></td>
                            <td><?= h($couriertxtitems->division) ?></td>
                            <td><?= h($couriertxtitems->leg_district) ?></td>
                            <td><?= h($couriertxtitems->school_beis) ?></td>
                            <td><?= h($couriertxtitems->no_eas) ?></td>
                            <td><?= h($couriertxtitems->no_district) ?></td>
                            <td><?= h($couriertxtitems->recipient_district) ?></td>
                            <td><?= h($couriertxtitems->school) ?></td>
                            <td><?= h($couriertxtitems->address) ?></td>
                            <td><?= h($couriertxtitems->esp_tx) ?></td>
                            <td><?= h($couriertxtitems->esp_tm) ?></td>
                            <td><?= h($couriertxtitems->ar_tx) ?></td>
                            <td><?= h($couriertxtitems->ar_tm) ?></td>
                            <td><?= h($couriertxtitems->ma_tx) ?></td>
                            <td><?= h($couriertxtitems->ma_tm) ?></td>
                            <td><?= h($couriertxtitems->kg_ilokano) ?></td>
                            <td><?= h($couriertxtitems->kg_tagalog) ?></td>
                            <td><?= h($couriertxtitems->kg_pangasinan) ?></td>
                            <td><?= h($couriertxtitems->kg_ivatan) ?></td>
                            <td><?= h($couriertxtitems->kg_ibanag) ?></td>
                            <td><?= h($couriertxtitems->kg_kapampangan) ?></td>
                            <td><?= h($couriertxtitems->kg_sambal) ?></td>
                            <td><?= h($couriertxtitems->kg_bikol) ?></td>
                            <td><?= h($couriertxtitems->kg_binisaya) ?></td>
                            <td><?= h($couriertxtitems->kg_waray) ?></td>
                            <td><?= h($couriertxtitems->kg_hiligaynon) ?></td>
                            <td><?= h($couriertxtitems->kg_kinaraya) ?></td>
                            <td><?= h($couriertxtitems->kg_akeanon) ?></td>
                            <td><?= h($couriertxtitems->kg_chavacano) ?></td>
                            <td><?= h($couriertxtitems->kg_maguindanao) ?></td>
                            <td><?= h($couriertxtitems->kg_maranao) ?></td>
                            <td><?= h($couriertxtitems->kg_surigaonon) ?></td>
                            <td><?= h($couriertxtitems->kg_yakan) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Couriertxtitems', 'action' => 'view', $couriertxtitems->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Couriertxtitems', 'action' => 'edit', $couriertxtitems->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Couriertxtitems', 'action' => 'delete', $couriertxtitems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $couriertxtitems->id)]) ?>
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
