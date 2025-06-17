<h2>Seu Carrinho de Compras</h2>

<table>
    <tr>
        <th>Planta</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($cartItems as $item): ?>
        <tr>
            <td><?= h($item->plant->name) ?></td>
            <td><?= h($item->quantity) ?></td>
            <td>
                <?= $this->Form->postLink('Remover', ['action' => 'delete', $item->id], ['confirm' => 'Tem certeza?']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
