# Projeto Sementinha

Bem-vindo ao Projeto Sementinha! Este é um sistema de e-commerce simples para uma loja de plantas, construído com o framework CakePHP.

## Funcionalidades Principais

- **Vitrine de Produtos:** Visualização das plantas disponíveis para compra.
- **Carrinho de Compras:** Adicione, remova e atualize a quantidade de itens no carrinho.
- **Gerenciamento de Plantas:** Uma área administrativa para adicionar, editar e remover plantas do catálogo, incluindo o upload de imagens.
- **Controle de Estoque:** O sistema gerencia o estoque das plantas, impedindo a compra de itens indisponíveis.

## Como Executar o Projeto Localmente

1.  **Clone o repositório.**
2.  **Instale as dependências** com o Composer: `composer install`.
3.  **Configure o banco de dados:** Copie `config/app_local.example.php` para `config/app_local.php` e adicione suas credenciais do banco de dados.
4.  **Crie as tabelas:** Execute os scripts SQL necessários para criar as tabelas `plants` e `cart_items`.
5.  **Inicie o servidor local** do CakePHP: `bin/cake server`.
6.  Acesse `http://localhost:8765` no seu navegador.