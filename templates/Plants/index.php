<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Plant> $plants
 */
?>
<div class="plants index content">
    <?= $this->Html->link(__('New Plant'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Plants Management') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nome') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('stock') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plants as $plant): ?>
                <tr>
                    <td><?= $this->Number->format($plant->id) ?></td>
                    <td><?= h($plant->nome) ?></td>
                    <td>R$ <?= $this->Number->format($plant->price) ?></td>
                    <td><?= $plant->stock === null ? '' : $this->Number->format($plant->stock) ?></td>
                    <td>
                        <?php
                            if (!empty($plant->image)) {
                                $imagePath = '/img/plants/' . $plant->image;
                                echo $this->Html->image($imagePath, ['style' => 'width: 60px;']);
                            }
                        ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $plant->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $plant->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $plant->id],
                            ['confirm' => __('Are you sure you want to delete # {0}?', $plant->id)]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>