<?php 

// sql code to create table
//  Primary key need to auto increment
$sql = "CREATE TABLE "._DB_PREFIX_."faq(
        id INT(2)  PRIMARY KEY AUTO_INCREMENT , 
        date_add DATETIME   NULL,
        date_upd DATETIME   NULL ,
        question VARCHAR(255) NOT NULL,
        answer VARCHAR(255) NULL
        )";
?>