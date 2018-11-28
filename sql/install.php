<?php 

// sql code to create table
$sql = "CREATE TABLE  '._DB_PREFIX_.'faq'(
        id INT(2)  PRIMARY KEY, 
        date_create DATETIME  NOT NULL,
        date_end DATETIME  NOT NULL ,
        question VARCHAR(255) NOT NULL,
        answer VARCHAR(255) NULL
        )";

?>