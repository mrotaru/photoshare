--
-- WARNING:
-- This script will delete the imgshare database and remove the imgshare user
--

-- delete database
DROP DATABASE IF EXISTS imgshare;

-- remove db user
DROP USER 'imgshare'@'localhost';

-- run the initalisation script; assumes is run from the project's root folder
-- ( when the current directory has the 'sql' folder, which contains this script ).
SOURCE sql/init.sql
