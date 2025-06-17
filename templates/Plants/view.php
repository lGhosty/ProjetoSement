<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Plant $plant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Plant'), ['action' => 'edit', $plant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Plant'), ['action' => 'delete', $plant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Plants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Plant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="plants view content">
            <h3><?= h($plant->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('name') ?></th>
                    <td><?= h($plant->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?php if (!empty($plant->image)): ?>
                        <img src="<?= $this->Html->image('plants/' . h($plant->image), ['alt' => h($plant->name)]) ?>" style="max-width:200px;">
                            <?php endif; ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($plant->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($plant->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Stock') ?></th>
                    <td><?= $plant->stock === null ? '' : $this->Number->format($plant->stock) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($plant->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($plant->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($plant->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>