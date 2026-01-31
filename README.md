# Sistema de Gestão de Chamados (Ticket System)

Este projeto é um **web app de gestão de chamados** desenvolvido como parte de um desafio técnico utilizando **Laravel** no backend e **Blade + jQuery** no frontend.

O sistema permite o cadastro e gerenciamento de **categorias** e **chamados (tickets)**, seguindo regras de negócio bem definidas e uma arquitetura MVC.

---

## Funcionalidades

### Categorias
- Criar categorias
- Listar categorias
- Deletar categorias
- Uma categoria **só pode ser deletada** se não houver chamados associados

### Chamados (Tickets)
- Criar chamados
- Editar chamados
- Listar chamados
- Filtrar chamados por **status** e **categoria**
- Status do chamado:
  - Aberto
  - Em progresso
  - Fechado
- Todo chamado **deve possuir uma categoria**

---

## Tecnologias Utilizadas

- **Backend:** Laravel
- **Frontend:** Blade + jQuery + Bootstrap 5
- **Banco de Dados:** SQLite
- **Estilo:** Design System fornecido no desafio
- **Arquitetura:** MVC

---

## Estrutura Geral do Projeto

- `app/Models` → Models (Category, Ticket)
- `app/Http/Controllers` → Controllers
- `database/migrations` → Migrations
- `database/seeders` → Seeders
- `routes/web.php` → Rotas de páginas
- `routes/api.php` → Rotas da API (JSON)
- `resources/views` → Views Blade
- `resources/js` → Scripts JavaScript (AJAX)

---

## Rotas Principais

### Web
- `/` → Redireciona para `/tickets`
- `/tickets` → Tela principal do sistema

### API
- `GET /api/categories`
- `POST /api/categories`
- `DELETE /api/categories/{id}`

- `GET /api/tickets`
- `GET /api/tickets/{id}`
- `POST /api/tickets`
- `PUT /api/tickets/{id}`
- `DELETE /api/tickets/{id}`

---

## Setup do Projeto

```bash
# Instalar dependências PHP
composer install

# Copiar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Criar banco SQLite
touch database/database.sqlite

# Rodar migrations
php artisan migrate

# Popular banco com dados fake
php artisan db:seed

# Subir servidor
php artisan serve
```

Acesse:
```
http://127.0.0.1:8000
```

---

## Testes

O projeto inclui:
- Testes unitários para regras de negócio
- Testes de integração para as rotas da API

Para rodar os testes:

```bash
php artisan test
```

---

## Observações

- O frontend consome exclusivamente a API via AJAX
- Algumas validações visuais e mensagens de erro podem ser aprimoradas

---
