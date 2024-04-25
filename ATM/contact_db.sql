CREATE DATABASE `contact_db`

CREATE TABLE `userdb` (
  `ID` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pas` varchar(100) NOT NULL,
  `email` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `userdb`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `userdb`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

select * from userdb;



/* contact to DATABASE [`contact_db`]*/
use `contact_db`;

/*CREATE TABLE `datatr`*/
CREATE TABLE `datatr` (

  `ID` int(100) NOT NULL,
  `nametr` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `numbrttr` int(100) NOT NULL,
  `numbrttr2` int(100) NOT NULL,
  `date` datetime NOT NULL
)
ALTER TABLE `datatr`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `datatr`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

select * from datatr;

/*CREATE TABLE `datatr`*/
CREATE TABLE `datatds` (

  `ID` int(100) NOT NULL,
  `nameds` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `numbrtds` int(100) NOT NULL,
  `numbrtds2` int(100) NOT NULL,
  `date` datetime NOT NULL
)
ALTER TABLE `datatr`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `datatr`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

select * from datatr;


/*CREATE TABLE `datataw`*/
CREATE TABLE `datataw` (

  `ID` int(100) NOT NULL,
  `nameaw` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `numbertaw` int(100) NOT NULL,
  `numbertaw2` int(100) NOT NULL,
  `date` datetime NOT NULL
)
ALTER TABLE `datataw`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `datataw`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

select * from datataw;