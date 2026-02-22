-- Scripts SQL base para inicializar dados de teste

-- Tabelas de origem
INSERT INTO produtos_base (sku, nome, descricao, ativo, created_at, updated_at) VALUES
('PROD-SKU-001', '  Notebook Gamer  ', '  Notebook com processador Intel i7 e placa de vídeo RTX 3060  ', 1, datetime('now'), datetime('now')),
('PROD-SKU-002', 'Monitor 27"', 'Monitor LED Full HD 144Hz', 1, datetime('now'), datetime('now')),
('PROD-SKU-003', 'teclado mecânico', 'teclado mecânico RGB com switches gateron', 0, datetime('now'), datetime('now')),
('PROD-SKU-004', '  Mouse Logitech  ', NULL, 1, datetime('now'), datetime('now')),
('PROD-SKU-005', 'Webcam HD', 'Webcam 1080p com microfone integrado', 1, datetime('now'), datetime('now'));

INSERT INTO precos_base (sku, preco, moeda, ativo, created_at, updated_at) VALUES
('PROD-SKU-001', 4500.75, 'brl', 1, datetime('now'), datetime('now')),
('PROD-SKU-002', 1200.50, 'BRL', 1, datetime('now'), datetime('now')),
('PROD-SKU-003', 350.00, 'brl', 0, datetime('now'), datetime('now')),
('PROD-SKU-004', 150.25, 'BRL', 1, datetime('now'), datetime('now')),
('PROD-SKU-005', 280.90, 'brl', 1, datetime('now'), datetime('now'));
