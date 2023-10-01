CREATE TABLE users (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	date_of_birth DATE NOT NULL,
	gender VARCHAR(10),
	country_id int REFERENCES country(id),
	reg_date TIMESTAMP
);

CREATE TABLE movies (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(200) NOT NULL,
	slug varchar(200),
	description text,
	release_date DATE NOT NULL,
	price INT,
	reg_date TIMESTAMP
);

CREATE TABLE genre (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE user_rating (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
	user_id INT REFERENCES users(id),
    movie_id INT REFERENCES movies(id),
    rating FLOAT
);

CREATE TABLE search_history (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT REFERENCES users(id),
    search_query VARCHAR(200),
    search_date DATE
);

CREATE TABLE country (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(50)
);

CREATE TABLE orders (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT REFERENCES users(id),
    movie_id INT REFERENCES movies(id),
    price DECIMAL,
	order_date DATE,
    address VARCHAR(255)
);

CREATE TABLE genre_movie (
	genre_id INT REFERENCES genre(id) is not null,
    movie_id INT REFERENCES movie(id) is not null,
    PRIMARY KEY	(genre_id, movie_id)
),