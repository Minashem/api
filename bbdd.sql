CREATE DATABASE IF NOT EXISTS product_store;
USE product_store;

CREATE TABLE products(
    id   int(255) auto_increment not null,
    name varchar(255),
    description text,
    price varchar(255),
    image varchar(255),
    CONSTRAINT pk_products PRIMARY KEY(id)
)ENGINE=InnoDb;