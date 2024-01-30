CREATE DATABASE IF NOT EXISTS homeworkdb;
USE homeworkdb;

CREATE TABLE if NOT EXISTS customers(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  email VARCHAR(100) ,
  age INT  ,
  password  VARCHAR(100) ,
  points INT ,
  username  VARCHAR(100) ,
  gender VARCHAR(1)
) ;
