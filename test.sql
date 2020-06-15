CREATE DATABASE IF NOT EXIST test;
USE test;

CREATE TABLE produk (
  nama_barang varchar(50) NOT NULL,
  harga int(11) NOT NULL,
  qty int(11) NOT NULL
);
