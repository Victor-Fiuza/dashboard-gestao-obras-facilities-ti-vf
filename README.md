# 🏟️ Dashboard Arena BRB — Painel de Gestão da Diretoria

Sistema web de gestão interna desenvolvido para a **Arena BRB**, projetado para exibição em TVs de 50 a 70 polegadas na sala da diretoria, com painel administrativo acessível de qualquer dispositivo.

---

## 📋 Visão Geral

O dashboard centraliza o acompanhamento de **manutenções prediais** e **status de obras** em uma interface escura, responsiva e de alto contraste, otimizada para leitura à distância em telas grandes.

### Funcionalidades

- **Aba Manutenção** — Tabela com todos os sistemas monitorados, exibindo última manutenção, status visual (🟢 Bom / 🟡 Atenção / 🔴 Ruim), observações e data da próxima manutenção. Cards de resumo com contadores por status. Itens críticos são exibidos primeiro.

- **Aba Status das Obras** — Cards visuais com barra de progresso animada, fase atual (Planejamento → Fundação → Estrutura → Acabamento → Concluída), responsável, datas e observações.

- **Aba Administração** — Formulários completos para cadastrar, editar e excluir manutenções e obras. Acessível de qualquer dispositivo (celular, tablet, computador).

- **Atualização automática** — A tela da TV atualiza os dados a cada 30 segundos sem necessidade de recarregar a página.

- **Relógio em tempo real** — Data e hora exibidos no cabeçalho.

---

## 🗂️ Estrutura de Arquivos

```
public_html/
├── config.php      # Configuração de conexão com o banco de dados
├── api.php         # API REST (PHP) para operações CRUD
├── index.php       # Dashboard de visualização (somente leitura — ideal para TV)
├── admin.php       # Painel de administração (cadastrar, editar, excluir)
└── database.sql    # Script SQL para criação das tabelas e dados iniciais
```

---

## ⚙️ Requisitos

| Requisito         | Versão Mínima     |
|--------------------|-------------------|
| PHP                | 7.4+              |
| MySQL / MariaDB    | 5.7+ / 10.3+     |
| Hospedagem         | Hostinger (compartilhada) ou compatível |


---

## 🚀 Instalação

### 1. Configurar o Banco de Dados

Acesse o **phpMyAdmin** da Hostinger e selecione o banco de dados. Vá em **Importar** e faça upload do arquivo `database.sql`. O script irá:

- Remover tabelas existentes (se houver)
- Criar as tabelas `manutencoes` e `obras`
- Inserir dados de exemplo para demonstração

### 2. Upload dos Arquivos

Envie os seguintes arquivos para a pasta `public_html` via Gerenciador de Arquivos da Hostinger ou FTP:

- `config.php`
- `api.php`
- `index.php`
- `admin.php`

### 3. Verificar Credenciais

Abra o arquivo `config.php` e confirme que os dados de acesso ao banco estão corretos:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_senha');
define('DB_NAME', 'seu_banco');
```

### 4. Acessar

Abra o navegador e acesse o domínio configurado. O dashboard estará disponível imediatamente.

---

## 🖥️ Uso Recomendado

### Na TV da Diretoria

1. Abra o navegador da Smart TV (ou de um computador conectado via HDMI)
2. Acesse `seudominio.com/index.php` (ou apenas `seudominio.com`)
3. Coloque o navegador em **tela cheia** (F11)
4. Os dados atualizam automaticamente a cada 30 segundos
5. A tela exibe apenas os dashboards, sem opções de edição

### Para Alimentar Dados

1. Acesse `seudominio.com/admin.php` de qualquer dispositivo (celular, tablet, computador)
2. Escolha a aba **Manutenções** ou **Obras**
3. Preencha os formulários para cadastrar, editar ou excluir registros
4. As alterações aparecerão na TV em até 30 segundos
5. Use o botão **📊 Ver Dashboard** no topo para voltar à tela principal

---

## 🎨 Design

- **Tema escuro** de alto contraste, ideal para visualização em TVs
- **Responsivo** com breakpoints otimizados para resoluções Full HD (1920px) e 4K (2560px+)
- **Tipografia**: DM Sans (corpo) + Plus Jakarta Sans (títulos e números)
- **Status com código de cores**: verde (Bom), amarelo (Atenção), vermelho pulsante (Ruim)
- **Barras de progresso animadas** nas obras com cor adaptativa por faixa de percentual

---

## 🔌 API REST

O arquivo `api.php` expõe os seguintes endpoints:

### Manutenções

| Método   | URL                                        | Descrição                  |
|----------|--------------------------------------------|----------------------------|
| `GET`    | `api.php?resource=manutencoes`             | Listar todas               |
| `POST`   | `api.php?resource=manutencoes`             | Cadastrar nova             |
| `PUT`    | `api.php?resource=manutencoes&id={id}`     | Atualizar por ID           |
| `DELETE` | `api.php?resource=manutencoes&id={id}`     | Excluir por ID             |

### Obras

| Método   | URL                                        | Descrição                  |
|----------|--------------------------------------------|----------------------------|
| `GET`    | `api.php?resource=obras`                   | Listar todas               |
| `POST`   | `api.php?resource=obras`                   | Cadastrar nova             |
| `PUT`    | `api.php?resource=obras&id={id}`           | Atualizar por ID           |
| `DELETE` | `api.php?resource=obras&id={id}`           | Excluir por ID             |

### Exemplo de corpo JSON — Manutenção

```json
{
  "sistema": "Ar Condicionado Central",
  "ultima_manutencao": "2026-01-15",
  "status": "Bom",
  "observacao": "Filtros trocados, sistema operando normalmente.",
  "proxima_manutencao": "2026-04-15"
}
```

### Exemplo de corpo JSON — Obra

```json
{
  "nome": "Edifício Comercial Tower",
  "localizacao": "Av. Paulista, 1500 — SP",
  "fase": "Estrutura",
  "progresso": 62,
  "data_inicio": "2025-03-01",
  "previsao_entrega": "2026-09-30",
  "responsavel": "Eng. Carlos Mendes",
  "observacao": "Estrutura do 12° andar em execução."
}
```

---

## 🗄️ Estrutura do Banco de Dados

### Tabela `manutencoes`

| Coluna               | Tipo                              | Descrição                        |
|----------------------|-----------------------------------|----------------------------------|
| `id`                 | INT AUTO_INCREMENT                | Identificador único              |
| `sistema`            | VARCHAR(255)                      | Nome do sistema                  |
| `ultima_manutencao`  | DATE                              | Data da última manutenção        |
| `status`             | ENUM('Bom','Atenção','Ruim')      | Status atual do sistema          |
| `observacao`         | TEXT                              | Observações e detalhes           |
| `proxima_manutencao` | DATE                              | Data da próxima manutenção       |
| `created_at`         | TIMESTAMP                         | Data de criação do registro      |
| `updated_at`         | TIMESTAMP                         | Data da última atualização       |

### Tabela `obras`

| Coluna              | Tipo                                                          | Descrição                    |
|---------------------|---------------------------------------------------------------|------------------------------|
| `id`                | INT AUTO_INCREMENT                                            | Identificador único          |
| `nome`              | VARCHAR(255)                                                  | Nome da obra                 |
| `localizacao`       | VARCHAR(500)                                                  | Endereço / localização       |
| `fase`              | ENUM('Planejamento','Fundação','Estrutura','Acabamento','Concluída') | Fase atual            |
| `progresso`         | INT (0-100)                                                   | Percentual de progresso      |
| `data_inicio`       | DATE                                                          | Data de início               |
| `previsao_entrega`  | DATE                                                          | Previsão de entrega          |
| `responsavel`       | VARCHAR(255)                                                  | Engenheiro/Arquiteto responsável |
| `observacao`        | TEXT                                                          | Observações gerais           |
| `created_at`        | TIMESTAMP                                                     | Data de criação do registro  |
| `updated_at`        | TIMESTAMP                                                     | Data da última atualização   |

---

## 🔒 Segurança

- Conexão via **PDO** com prepared statements (proteção contra SQL Injection)
- Sanitização de saída HTML no frontend (`escapeHtml`)
- Senhas e credenciais isoladas no `config.php`

> **Recomendação:** Em produção, restrinja o acesso à aba Administração por IP ou implemente autenticação por senha.

---

## 📄 Licença

Projeto interno — Arena BRB. Todos os direitos reservados.
