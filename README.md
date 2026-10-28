# ✈️ Travel Company

Sistema web em PHP para venda e gerenciamento de passagens de viagem. Os clientes se cadastram, escolhem uma viagem e agendam a passagem. Já o administrador cadastra as viagens disponíveis e acompanha o que foi vendido.

> **Projeto de curso.** O Travel Company nasceu da **junção de dois sistemas separados**: o **site do usuário** e o **painel do administrador**. Tivemos **4 horas** para unir os dois, e o objetivo foi deixar tudo funcionando juntos **o mais rápido e o melhor possível** dentro desse prazo.

---

## 📌 Sobre o projeto

Antes da junção, cada parte existia por conta própria, com seu próprio código e sua própria conexão com o banco:

| Sistema | O que fazia |
|---|---|
| **Usuário** | Cadastro, login, listagem de viagens, agendamento e cancelamento de passagens |
| **Administrador** | Cadastro, consulta e exclusão de viagens |

Na integração, os dois passaram a usar o **mesmo banco de dados (`dp_viagens`)**. Assim, uma viagem cadastrada pelo administrador aparece automaticamente na página inicial dos clientes.

---

## ✨ Funcionalidades

### Área do cliente
- Cadastro de conta (nome, CPF, e-mail, telefone e senha)
- Login e logout
- Listagem de viagens com **filtro por origem e data**
- Agendamento de passagem, com confirmação dos dados do cliente
- Cancelamento das próprias passagens

### Painel do administrador
- Cadastro de viagens (nome, origem, destino, data, horário e motorista)
- Consulta das viagens cadastradas, com o motorista de cada uma
- Busca e exclusão de viagens (as passagens vendidas da viagem também são removidas)
- Acesso restrito, com verificação de sessão em todas as páginas do painel

---

## 🛠️ Tecnologias

- **PHP** (sessões e `mysqli`)
- **MySQL**
- **HTML5 e CSS3**
- **JavaScript** (filtros da listagem, sem recarregar a página)

---

## 📁 Estrutura do projeto

```
ViagensFinal/
├── index.html              # Cadastro de cliente
├── posIndex.php            # Processa o cadastro
└── assets/
    ├── index.php           # Página inicial: lista e filtra as viagens
    ├── login.php           # Processa o login
    ├── logout.php          # Encerra a sessão
    ├── agendado.php        # Confirma o agendamento
    ├── cancelamento.php    # Processa o cancelamento da passagem
    ├── conexao.php         # Conexão com o banco
    ├── css/                # Estilos do site do usuário
    ├── img/                # Imagens
    ├── pages/
    │   ├── login.html      # Tela de login
    │   ├── agendar.php     # Confirmação de dados e agendamento
    │   └── cancelamento.php# Lista as passagens do cliente
    └── Adm/                # Painel do administrador
        ├── index.php
        └── assets/
            ├── css/
            └── php/        # criar_viagem, salvar_viagem, consulta,
                            # cancelar, deletar, auth, conexao
```

---

## 🗄️ Banco de dados

Nome do banco: **`dp_viagens`**

Tabelas usadas pelo sistema:

| Tabela | Descrição |
|---|---|
| `usuarios` | Clientes cadastrados (nome, telefone, e-mail, CPF e senha) |
| `viagem` | Viagens disponíveis (nome, origem, destino, dia, horário e motorista) |
| `passagem` | Liga um cliente a uma viagem |
| `motorista` | Motoristas que podem ser associados às viagens |

---

## 🚀 Como executar

1. Instale um ambiente local com PHP e MySQL (por exemplo, o **XAMPP**).
2. Copie a pasta `ViagensFinal` para a pasta do servidor (`htdocs`, no XAMPP).
3. Crie o banco **`dp_viagens`** no MySQL e crie as tabelas listadas acima.
4. Confira os dados de conexão em `assets/conexao.php` e `assets/Adm/assets/php/conexao.php`. Por padrão, usam `localhost`, usuário `root` e senha vazia.
5. Acesse no navegador: `http://localhost/ViagensFinal/`

---

## ⏱️ Contexto de desenvolvimento

- **Prazo:** 4 horas.
- **Objetivo:** juntar o sistema do administrador e o do usuário num só projeto, compartilhando o mesmo banco de dados.
- **Prioridade:** entregar um fluxo completo e funcional (cadastro, agendamento, cancelamento e administração), com velocidade e qualidade.

Por causa do prazo curto, algumas decisões foram tomadas para entregar a tempo. Elas estão listadas abaixo como pontos de melhoria.

---

## 🔧 Melhorias futuras

- Usar *prepared statements* em todas as consultas ao banco
- Guardar senhas com `password_hash()` e conferir com `password_verify()`
- Criar um campo de perfil (administrador ou cliente) no lugar da verificação pelo nome do usuário
- Unificar os arquivos duplicados (`conexao.php`, `cancelamento.php`) e remover arquivos que sobraram dos sistemas originais
- Reorganizar as pastas, deixando `assets/` só para CSS, imagens e JS
- Criar a página "Sobre", que já está nos menus
- Guardar o valor da passagem no banco, em vez de fixo na tela de agendamento
- Esconder as viagens com data que já passou

---

## 👥 Autores

Projeto desenvolvido em grupo para atividade do curso.
