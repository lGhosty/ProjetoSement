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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $plant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $plant->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Plants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="plants form content">
            <?= $this->Form->create($plant, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Plant') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('price');
                    echo $this->Form->control('stock');
                    echo $this->Form->control('image_file', ['type' => 'file', 'label' => 'Imagem da Planta']);

                    // Dentro do método edit(), logo após pegar a imagem:
                    $imageFile = $this->request->getData('image_file');
                    if (!empty($imageFile) && $imageFile->getError() === 0) {
                        // salvar nova imagem
                        $name = time() . '_' . $imageFile->getClientFilename();
                        $targetPath = WWW_ROOT . 'img' . DS . 'plants' . DS . $name;
                        $imageFile->moveTo($targetPath);
                        $plant->image = 'plants/' . $name;
                        } else {
                       // manter a imagem antiga
                        unset($plant->image);
                    }

                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
