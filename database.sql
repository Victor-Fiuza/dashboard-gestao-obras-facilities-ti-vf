-- =====================================================
-- DASHBOARD ARENA  - SCRIPT DE BANCO DE DADOS
-- Execute este SQL no phpMyAdmin da Hostinger
-- =====================================================

-- Remove tabelas existentes (se houver)
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `manutencoes`;
DROP TABLE IF EXISTS `obras`;

SET FOREIGN_KEY_CHECKS = 1;

-- =====================================================
-- TABELA: MANUTENÇÕES
-- =====================================================
CREATE TABLE `manutencoes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `sistema` VARCHAR(255) NOT NULL,
  `ultima_manutencao` DATE NOT NULL,
  `status` ENUM('Bom','Atenção','Ruim') NOT NULL DEFAULT 'Bom',
  `observacao` TEXT DEFAULT NULL,
  `proxima_manutencao` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABELA: OBRAS
-- =====================================================
CREATE TABLE `obras` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `localizacao` VARCHAR(500) DEFAULT NULL,
  `fase` ENUM('Planejamento','Fundação','Estrutura','Acabamento','Concluída') NOT NULL DEFAULT 'Planejamento',
  `progresso` INT NOT NULL DEFAULT 0 CHECK (`progresso` >= 0 AND `progresso` <= 100),
  `data_inicio` DATE DEFAULT NULL,
  `previsao_entrega` DATE DEFAULT NULL,
  `responsavel` VARCHAR(255) DEFAULT NULL,
  `observacao` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- DADOS DE EXEMPLO - MANUTENÇÕES
-- =====================================================
INSERT INTO `manutencoes` (`sistema`, `ultima_manutencao`, `status`, `observacao`, `proxima_manutencao`) VALUES
('Ar Condicionado Central', '2026-01-15', 'Bom', 'Filtros trocados, gás recarregado. Sistema operando normalmente.', '2026-04-15'),
('Elevadores (3 unidades)', '2026-02-01', 'Atenção', 'Elevador 2 com ruído no motor. Peça de reposição encomendada, previsão 10 dias.', '2026-03-01'),
('Sistema Elétrico Geral', '2025-12-20', 'Bom', 'Quadros elétricos inspecionados. Sem anomalias detectadas.', '2026-06-20'),
('Rede Hidráulica', '2025-11-10', 'Ruim', 'Vazamento identificado no subsolo. Reparo emergencial necessário — aguardando equipe.', '2026-02-28'),
('Grupo Gerador', '2026-02-10', 'Bom', 'Teste de carga realizado com sucesso. Diesel abastecido.', '2026-05-10'),
('CFTV / Segurança', '2026-01-28', 'Atenção', '3 câmeras do estacionamento com imagem degradada. Substituição agendada.', '2026-03-28'),
('Sistema de Incêndio', '2025-10-05', 'Ruim', 'Bomba de incêndio com falha intermitente. Laudo técnico pendente.', '2026-02-25'),
('Cabeamento de Rede / TI', '2026-02-18', 'Bom', 'Switches atualizados. Rede operando a 1Gbps em todos os andares.', '2026-08-18');

-- =====================================================
-- DADOS DE EXEMPLO - OBRAS
-- =====================================================
INSERT INTO `obras` (`nome`, `localizacao`, `fase`, `progresso`, `data_inicio`, `previsao_entrega`, `responsavel`, `observacao`) VALUES
('Edifício Comercial Tower', 'Av. Paulista, 1500 — SP', 'Estrutura', 62, '2025-03-01', '2026-09-30', 'Eng. Carlos Mendes', 'Estrutura do 12° andar em execução. Prazo dentro do cronograma.'),
('Galpão Logístico CD-03', 'Rod. Anhanguera, km 42 — Jundiaí', 'Acabamento', 85, '2025-01-15', '2026-04-30', 'Eng. Ana Beatriz', 'Pintura e piso industrial em andamento. Entrega antecipada prevista.'),
('Residencial Parque das Flores', 'Rua das Acácias, 200 — Campinas', 'Fundação', 18, '2025-11-01', '2027-06-30', 'Eng. Roberto Lima', 'Fundação do bloco A iniciada. Sondagem do bloco B em andamento.'),
('Reforma Sede Administrativa', 'Rua XV de Novembro, 88 — Centro', 'Planejamento', 5, '2026-03-01', '2026-08-30', 'Arq. Juliana Costa', 'Projeto arquitetônico em aprovação. Licitação de materiais em breve.'),
('Ponte de Acesso Setor Norte', 'Distrito Industrial — Goiânia', 'Concluída', 100, '2024-08-01', '2025-12-15', 'Eng. Marcos Souza', 'Obra entregue e homologada. Dentro do orçamento previsto.');
