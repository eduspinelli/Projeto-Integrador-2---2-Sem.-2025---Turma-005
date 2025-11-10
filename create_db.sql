CREATE DATABASE IF NOT EXISTS salao;
USE salao;
CREATE TABLE IF NOT EXISTS agendamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  telefone VARCHAR(20),
  servico VARCHAR(50),
  data_agendamento DATE,
  hora TIME
);