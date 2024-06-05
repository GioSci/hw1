-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 01, 2024 alle 11:39
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studium`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `anno_accademico`
--

CREATE TABLE `anno_accademico` (
  `id` int(11) NOT NULL,
  `anni_accademici` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `anno_accademico`
--

INSERT INTO `anno_accademico` (`id`, `anni_accademici`) VALUES
(1, '2019/2020'),
(2, '2020/2021'),
(3, '2021/2022'),
(4, '2022/2023'),
(5, '2023/2024');

-- --------------------------------------------------------

--
-- Struttura della tabella `anno_facoltà`
--

CREATE TABLE `anno_facoltà` (
  `anno` int(11) DEFAULT NULL,
  `facoltà` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `anno_facoltà`
--

INSERT INTO `anno_facoltà` (`anno`, `facoltà`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(2, 1),
(2, 2),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, NULL),
(5, 22);

-- --------------------------------------------------------

--
-- Struttura della tabella `facoltà`
--

CREATE TABLE `facoltà` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `facoltà`
--

INSERT INTO `facoltà` (`id`, `nome`) VALUES
(1, 'Ingegneria'),
(2, 'Informatica'),
(3, 'Economia'),
(4, 'Giurisprudenza'),
(5, 'Lettere e Filosofia'),
(8, 'Fisica'),
(22, 'medicina');

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnamento`
--

CREATE TABLE `insegnamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `prof` varchar(255) DEFAULT NULL,
  `facoltà` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `insegnamento`
--

INSERT INTO `insegnamento` (`id`, `nome`, `prof`, `facoltà`) VALUES
(1, 'Analisi Matematica', 'Prof. Rossi', 1),
(2, 'Fisica I', 'Prof. Bianchi', 1),
(3, 'Programmazione I', 'Prof. Verdi', 2),
(4, 'Sistemi Operativi', 'Prof. Gialli', 2),
(5, 'Diritto Privato', 'Prof. Neri', 4),
(6, 'Filosofia del Diritto', 'Prof. Neri', 4),
(7, 'Letteratura Italiana', 'Prof. Esposito', 5),
(8, 'Storia dell Arte', 'Prof. Esposito', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizione`
--

CREATE TABLE `iscrizione` (
  `utente` int(11) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `iscrizione`
--

INSERT INTO `iscrizione` (`utente`, `anno`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 1),
(2, 2),
(3, 1),
(3, 3),
(4, 2),
(4, 4),
(5, 1),
(5, 5),
(6, 5),
(7, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipa`
--

CREATE TABLE `partecipa` (
  `utente` int(11) NOT NULL,
  `insegnamento` int(11) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `partecipa`
--

INSERT INTO `partecipa` (`utente`, `insegnamento`, `anno`) VALUES
(2, 1, 1),
(2, 3, 1),
(2, 2, 2),
(2, 4, 2),
(3, 3, 1),
(3, 8, 1),
(3, 5, 4),
(4, 5, 3),
(4, 7, 3),
(5, 4, 2),
(7, 7, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `matricola` int(11) NOT NULL,
  `cf` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`matricola`, `cf`, `password`, `nome`, `cognome`, `email`, `tipo`) VALUES
(1, 'sonoadmin', '$2y$10$U8fJA9/OgAzWHdi8lDzui.u5vQhSODC.yTeduktQOxqJMpsxGEIiG', 'Admin', 'Admin', 'admin.admin@studente.unina.it', 1),
(2, 'VRNCDFG32H78QWER', '$2y$10$U8fJA9/OgAzWHdi8lDzui.u5vQhSODC.yTeduktQOxqJMpsxGEIiG', 'Luigi', 'Verdi', 'luigi.verdi@studente.unina.it', 0),
(3, 'MNTYUIO98P76ERTY', '$2y$10$U8fJA9/OgAzWHdi8lDzui.u5vQhSODC.yTeduktQOxqJMpsxGEIiG', 'Giulia', 'Bianchi', 'giulia.bianchi@studente.unina.it', 0),
(4, 'QWERTYUIO123456', '$2y$10$U8fJA9/OgAzWHdi8lDzui.u5vQhSODC.yTeduktQOxqJMpsxGEIiG', 'Anna', 'Gialli', 'anna.gialli@studente.unina.it', 0),
(5, 'ASDFGHJK7890123', '$2y$10$U8fJA9/OgAzWHdi8lDzui.u5vQhSODC.yTeduktQOxqJMpsxGEIiG', 'Marco', 'Neri', 'marco.neri@studente.unina.it', 0),
(6, 'aaaaaaaaaaaaaaa1', '$2y$10$U8fJA9/OgAzWHdi8lDzui.u5vQhSODC.yTeduktQOxqJMpsxGEIiG', 'gio', 'vanni', 'gio@vanni.it', NULL),
(7, 'bbbbbbbbbbbbbbb1', '$2y$10$2VVR8WHRB7/9cQfXTfBqQu.8bh3zPiWQo9HRJ.YkPHIM0z61eriPi', 'gio', 'vanni', 'gio.vanni@g.com', NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `anno_accademico`
--
ALTER TABLE `anno_accademico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anni_accademici` (`anni_accademici`);

--
-- Indici per le tabelle `anno_facoltà`
--
ALTER TABLE `anno_facoltà`
  ADD KEY `ii` (`anno`),
  ADD KEY `i` (`facoltà`);

--
-- Indici per le tabelle `facoltà`
--
ALTER TABLE `facoltà`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `insegnamento`
--
ALTER TABLE `insegnamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i` (`facoltà`);

--
-- Indici per le tabelle `iscrizione`
--
ALTER TABLE `iscrizione`
  ADD PRIMARY KEY (`utente`,`anno`),
  ADD KEY `i` (`utente`),
  ADD KEY `ii` (`anno`);

--
-- Indici per le tabelle `partecipa`
--
ALTER TABLE `partecipa`
  ADD PRIMARY KEY (`utente`,`anno`,`insegnamento`),
  ADD KEY `I` (`utente`),
  ADD KEY `ii` (`insegnamento`),
  ADD KEY `iii` (`anno`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`matricola`),
  ADD UNIQUE KEY `cf` (`cf`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `anno_accademico`
--
ALTER TABLE `anno_accademico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la tabella `facoltà`
--
ALTER TABLE `facoltà`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `insegnamento`
--
ALTER TABLE `insegnamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `matricola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `anno_facoltà`
--
ALTER TABLE `anno_facoltà`
  ADD CONSTRAINT `anno_facoltà_ibfk_1` FOREIGN KEY (`anno`) REFERENCES `anno_accademico` (`id`),
  ADD CONSTRAINT `anno_facoltà_ibfk_2` FOREIGN KEY (`facoltà`) REFERENCES `facoltà` (`id`);

--
-- Limiti per la tabella `insegnamento`
--
ALTER TABLE `insegnamento`
  ADD CONSTRAINT `insegnamento_ibfk_1` FOREIGN KEY (`facoltà`) REFERENCES `facoltà` (`id`);

--
-- Limiti per la tabella `iscrizione`
--
ALTER TABLE `iscrizione`
  ADD CONSTRAINT `iscrizione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`matricola`),
  ADD CONSTRAINT `iscrizione_ibfk_2` FOREIGN KEY (`anno`) REFERENCES `anno_accademico` (`id`);

--
-- Limiti per la tabella `partecipa`
--
ALTER TABLE `partecipa`
  ADD CONSTRAINT `partecipa_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utente` (`matricola`),
  ADD CONSTRAINT `partecipa_ibfk_2` FOREIGN KEY (`insegnamento`) REFERENCES `insegnamento` (`id`),
  ADD CONSTRAINT `partecipa_ibfk_3` FOREIGN KEY (`anno`) REFERENCES `anno_accademico` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
