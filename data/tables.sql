CREATE TABLE IF NOT EXISTS alunos(
  id VARCHAR(25) PRIMARY KEY,
  nome VARCHAR(100),
  nome_mae VARCHAR(100),
  ra VARCHAR(15),
  arquivado BOOLEAN,
  data_arquivado TIMESTAMP
);
