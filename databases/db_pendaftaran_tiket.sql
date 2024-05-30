-- Create the 'konser' table
CREATE TABLE konser (
    konserId CHAR(10) PRIMARY KEY,
    bennerKonser VARCHAR(255),
    namaKonser VARCHAR(255),
    artist VARCHAR(255),
    waktu DATE,
    harga FLOAT,
    lokasi VARCHAR(255),
    deskripsi VARCHAR(255),
    qty INT
);

-- Create the 'user' table
CREATE TABLE user (
    userId CHAR(10) PRIMARY KEY,
    profilePicture VARCHAR(255) DEFAULT 'user.png',
    role ENUM('user', 'administrator'),
    nama VARCHAR(255),
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);

-- Create the 'bookedTicket' table
CREATE TABLE bookedTicket (
    bookedId CHAR(10) PRIMARY KEY,
    namaKonser VARCHAR(255),
    konserId CHAR(10),
    userBooked VARCHAR(255),
    userId CHAR,
    status ENUM('PAID', 'UNPAID') DEFAULT 'UNPAID',
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (konserId) REFERENCES konser(konserId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES user(userId) ON DELETE CASCADE
);

-- Create the 'keranjang' table
CREATE TABLE keranjang (
    userId CHAR(10),
    konserId CHAR(10),
    PRIMARY KEY (userId),
    FOREIGN KEY (userId) REFERENCES user(userId) ON DELETE CASCADE,
    FOREIGN KEY (konserId) REFERENCES konser(konserId) ON DELETE CASCADE
);

-- Create the 'tiket' table
CREATE TABLE tiket (
    tiketId CHAR(10) PRIMARY KEY,
    namaKonser VARCHAR(255),
    konserId CHAR(10),
    bookedId CHAR(10),
    userId CHAR,
    qr VARCHAR(255),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    userTicket VARCHAR(255),
    FOREIGN KEY (konserId) REFERENCES konser(konserId) ON DELETE CASCADE,
    FOREIGN KEY (bookedId) REFERENCES bookedTicket(bookedId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES user(userId) ON DELETE CASCADE
);

-- Create the 'deleteUnpaid' event
CREATE EVENT deleteUnpaid
ON SCHEDULE EVERY 1 DAY
COMMENT 'Delete unpaid tickets from bookedTicket table'
DO
BEGIN
    DELETE FROM bookedTicket WHERE status='UNPAID';
