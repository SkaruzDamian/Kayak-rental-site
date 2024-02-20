CREATE DATABASE testy2;
USE testy2;

-- Tworzenie tabeli klienci
CREATE TABLE if not exists  kli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imie VARCHAR(50),
    nazwisko VARCHAR(50),
    telefon VARCHAR(20)
);

CREATE TABLE if not exists  rez (
    id INT AUTO_INCREMENT PRIMARY KEY,
    klient_id INT,
    data_wypozyczenia DATE,
    godzina_rezerwacji TIME,
    ilosc_kajakow_dwuosobowych INT,
    ilosc_kajakow_jednoosobowych INT,
    uwagi TEXT,
    FOREIGN KEY (klient_id) REFERENCES kli(id)
);


-- Dodaj kilka rekordów do tabeli klienci
INSERT INTO kli (imie, nazwisko, telefon) VALUES
    ('Jan', 'Kowalski', '123456789'),
    ('Anna', 'Nowak', '987654321');

-- Dodaj kilka rekordów do tabeli rezerwacje
INSERT INTO rez (klient_id, data_wypozyczenia, ilosc_kajakow_dwuosobowych, ilosc_kajakow_jednoosobowych, uwagi) VALUES
    (1, '2024-02-20', 2, 1, null),
    (2, '2024-02-21', 1, 0, null),
    (1, '2024-02-22', 0, 2, null);

-- Zapytanie zwracające liczbę wolnych kajaków na dane dni
SELECT 
    data_wypozyczenia,
    (20 - SUM(ilosc_kajakow_dwuosobowych)) AS wolne_kajaki_dwuosobowe,
    (20 - SUM(ilosc_kajakow_jednoosobowych)) AS wolne_kajaki_jednoosobowe
FROM
    rez
GROUP BY
    data_wypozyczenia;

SELECT * FROM rez;
alter table rez add column godzina_rezerwacji time;