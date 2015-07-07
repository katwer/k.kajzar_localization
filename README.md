Module localization based on Zend Framework 2
=======================

Introduction
------------
This is simple modul to create list of localizations.
This module is created as task in recruitment process.

Installation
---------------------------
To run project you need 

1. create database from files
\k.kajzar_localization\database_structure.sql
\k.kajzar_localization\database_data.sql

2. change database host and name in 
\k.kajzar_localization\config\autoload\global.php file

1. create file
\k.kajzar_localization\config\autoload\local.php
with code

 return array(
     'db' => array(
         'username' => 'xx',
         'password' => 'xx',
     ),
 );