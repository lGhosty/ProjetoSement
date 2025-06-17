<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Plant> $plants
 * @var int $cartItemCount
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Projeto Sementinha
    </title>
    <?= $this->Html->css('plataforma.css') ?>
</head>
<body>
    <header>
        <div class="container">
            <h1>Projeto Sementinha</h1>
            <div class="cart-icon">
                <a href="<?= $this->Url->build(['controller' => 'CartItems', 'action' => 'index']) ?>">
                    <img src="https://image.flaticon.com/icons/png/512/126/126510.png" alt="Carrinho">
                    <?php if ($cartItemCount > 0): ?>
                        <span class="cart-count"><?= $cartItemCount ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Nossas Plantinhas</h2>
        <div class="plants-grid">
            <?php foreach ($plants as $plant): ?>
                <div class="plant-card">
                    <?php
                        // Garante que o caminho da imagem seja seguro e aponta para um padrão se não houver imagem
                        $imageFile = $plant->image ?? 'default.jpg';
                        $imagePath = '/img/plants/' . $imageFile; // A barra no início é importante!
                        
                        // Exibe a imagem e usa a propriedade correta 'nome' para o texto alternativo
                        echo '<img src="' . h($imagePath) . '" alt="' . h($plant->nome) . '">';
                    ?>
                    
                    <h3><?= h($plant->nome) ?></h3>

                    <p><?= h($plant->description) ?></p>
                    <p class="price">R$ <?= h($plant->price) ?></p>

                    <?php if ($plant->stock > 0): ?>
                        <?= $this->Form->postLink(
                            'Adicionar ao carrinho',
                            ['controller' => 'CartItems', 'action' => 'add', $plant->id],
                            ['class' => 'add-to-cart-button']
                        ) ?>
                    <?php else: ?>
                        <span class="out-of-stock">Sem estoque</span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>