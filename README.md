# Food Delivery Platform

Uma plataforma de entrega de alimentos robusta e escalável desenvolvida com CodeIgniter 4, oferecendo uma solução completa para gerenciamento de restaurantes, pedidos e entregas.

## 📋 Sumário

- [Visão Geral](#visão-geral)
- [Funcionalidades](#funcionalidades)
- [Stack Tecnológico](#stack-tecnológico)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Testes](#testes)
- [Documentação](#documentação)
- [Contribuindo](#contribuindo)
- [Licença](#licença)

## 🎯 Visão Geral

O Food Delivery é uma plataforma desenvolvida para facilitar o gerenciamento de entrega de alimentos, conectando restaurantes e clientes através de uma interface intuitiva e performática. O projeto foi construído com foco em segurança, escalabilidade e experiência do usuário.

## ✨ Funcionalidades

- **Gerenciamento de Usuários**: Autenticação segura com suporte a múltiplos perfis (cliente, restaurante, entregador)
- **Catálogo de Produtos**: Gestão completa de menus e itens de restaurantes
- **Sistema de Pedidos**: Criação, rastreamento e gerenciamento de pedidos em tempo real
- **Painel Administrativo**: Dashboard completo para administração do sistema
- **Notificações**: Sistema integrado de alertas e confirmações
- **Segurança**: Implementação de boas práticas de segurança web (CSRF, XSS, SQL Injection prevention)

## 🛠️ Stack Tecnológico

| Componente | Tecnologia | Versão |
|-----------|-----------|---------|
| **Framework** | CodeIgniter | 4.x |
| **Linguagem** | PHP | 8.2+ |
| **Database** | MySQL/MariaDB | 5.7+ |
| **Frontend** | HTML5, CSS3, JavaScript | - |
| **Package Manager** | Composer | - |

### Extensões PHP Necessárias

- `intl` - Internacionalização
- `mbstring` - Manipulação de strings multibyte
- `mysqlnd` - Driver MySQL nativo
- `curl` - Requisições HTTP
- `json` - Suporte a JSON (padrão)

## 📋 Pré-requisitos

Certifique-se de ter instalado em seu sistema:

- **PHP** 8.2 ou superior
- **Composer** 2.0 ou superior
- **MySQL** 5.7 ou superior (ou MariaDB equivalente)
- **Git** para controle de versão
- **Node.js** (opcional, para ferramentas de build)

## 🚀 Instalação

### 1. Clone o Repositório

```bash
git clone https://github.com/seu-usuario/food-delivery.git
cd food-delivery
```

### 2. Instale as Dependências

```bash
composer install
```

### 3. Configure o Ambiente

```bash
cp env .env
```

Edite o arquivo `.env` com suas configurações:

```bash
# Base URL
app.baseURL = 'http://localhost:8080'

# Database
database.default.hostname = localhost
database.default.database = food_delivery
database.default.username = root
database.default.password = seu_password
```

### 4. Gere a Chave de Criptografia

```bash
php spark key:generate
```

### 5. Execute as Migrations

```bash
php spark migrate
```

### 6. Seed do Banco de Dados (Opcional)

```bash
php spark db:seed SeedName
```

## ⚙️ Configuração

### Banco de Dados

O projeto utiliza migrations para versionamento do banco de dados. Todas as migrations estão localizadas em `app/Database/Migrations/`.

Para criar uma nova migration:

```bash
php spark make:migration CreateTableName
```

### Variáveis de Ambiente

Configurações importantes no arquivo `.env`:

- `APP_ENVIRONMENT`: Ambiente da aplicação (development, production)
- `DATABASE_*`: Credenciais do banco de dados
- `ENCRYPTION_KEY`: Chave de criptografia gerada automaticamente
- `CSRF_PROTECTION`: Ativar/desativar proteção CSRF

## 📁 Estrutura do Projeto

```
app/
├── Config/          # Arquivos de configuração
├── Controllers/     # Controllers da aplicação
├── Database/        # Migrations e Seeds
├── Entities/        # Entity models
├── Filters/         # HTTP Filters
├── Helpers/         # Funções auxiliares
├── Language/        # Arquivos de idioma
├── Libraries/       # Classes customizadas
├── Models/          # Database models
├── Views/           # Templates HTML
└── Exceptions/      # Exceções personalizadas

public/             # Webroot - apontado pelo servidor web
├── index.php        # Entry point
├── admin/           # Painel administrativo
└── css/, js/        # Assets estáticos

tests/              # Testes automatizados
├── unit/            # Testes unitários
├── database/        # Testes de banco de dados
└── session/         # Testes de sessão

vendor/             # Dependências do Composer
writable/           # Diretório para arquivos temporários
├── cache/           # Cache de aplicação
├── logs/            # Logs do sistema
├── session/         # Sessões de usuário
└── uploads/         # Arquivos enviados
```

## 🧪 Testes

O projeto utiliza PHPUnit para testes automatizados.

### Executar todos os testes

```bash
php spark test
```

### Executar testes específicos

```bash
php spark test --filter HealthTest
```

### Executar testes com cobertura

```bash
php spark test --coverage
```

## 📚 Documentação

Para mais informações sobre CodeIgniter 4, consulte a [documentação oficial](https://codeigniter.com/user_guide/).

### Recursos Úteis

- [Guia de Roteamento](https://codeigniter.com/user_guide/incoming/routing.html)
- [Controllers](https://codeigniter.com/user_guide/incoming/controllers.html)
- [Models](https://codeigniter.com/user_guide/models/index.html)
- [Validation](https://codeigniter.com/user_guide/libraries/validation.html)

## 🤝 Contribuindo

Contribuições são bem-vindas! Por favor, siga os passos abaixo:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

### Padrões de Código

- Siga os padrões PSR-12 de codificação PHP
- Adicione testes para novas funcionalidades
- Mantenha a documentação atualizada

## 📄 Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 📧 Suporte

Para dúvidas ou problemas, abra uma issue no repositório ou entre em contato com a equipe de desenvolvimento.

---

**Desenvolvido com ❤️ usando CodeIgniter 4**
