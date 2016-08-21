-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2016 at 03:50 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mendayinholland`
--
CREATE DATABASE IF NOT EXISTS `mendayinholland` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mendayinholland`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `change_contact`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `change_contact` (IN `street1` VARCHAR(30), IN `street2` VARCHAR(30), IN `city` VARCHAR(30), IN `county` VARCHAR(30), IN `zipcode` VARCHAR(30), IN `email` VARCHAR(100), IN `phone1` VARCHAR(15), IN `phone2` VARCHAR(15))  BEGIN

	UPDATE `contact` SET 
		`street1`=street1,
		`street2`=street2,
		`city`=city,
		`county`=county,
		`zipcode`=zipcode,
		`email`=email,
		`phone1`=phone1,
		`phone2`=phone2
	WHERE 
		`contact_id`=contact_id;

END$$

DROP PROCEDURE IF EXISTS `change_membership`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `change_membership` (IN `contact_id` VARCHAR(30), IN `contact_type` INT(11), IN `active` BOOLEAN)  BEGIN

	UPDATE `membership` 
	SET 
		`contact_type`=contact_type, 
		`active`=active 
	WHERE 
		`contact_id`=contact_id;

END$$

DROP PROCEDURE IF EXISTS `create_member`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_member` ()  BEGIN
  DECLARE lid_contact int;
  DECLARE lid_member int;
  DECLARE lid_person int;

  DECLARE exit handler for SQLEXCEPTION
    BEGIN
      ROLLBACK;
    END;
  DECLARE exit handler for SQLWARNING
    BEGIN
      ROLLBACK;
    END;

	CALL `MendayInHolland`.`insert_contact`(
		@id , 
		'street1', 
		'street', 
		'city', 
		'county', 
		'zipcode', 
		'email', 
		'phone1', 
		'phone2'
	);
    
	CALL `MendayInHolland`.`insert_contact_info`(
		@id, 
		'photo', 
		'name', 
		'surname', 
		'occupation', 
		'pob', 
		'married', 
		'hobbies', 
		'skills', 
		'qrcode', 
		'qrimage'
	);

	CALL `MendayInHolland`.`create_membership`(
		@id, 
		1, 
		1
	);	

SELECT LAST_INSERT_ID();
    
    
    
  COMMIT;


END$$

DROP PROCEDURE IF EXISTS `create_membership`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_membership` (INOUT `contact_id` INT(11), IN `contact_type` INT(11), IN `active` TINYINT(1))  NO SQL
BEGIN

    INSERT INTO `membership` ( 
        `contact_id`,
        `contact_type`,
        `active`)
    VALUES (
        contact_id,
        contact_type,
        active);
END$$

DROP PROCEDURE IF EXISTS `create_member_new`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_member_new` (INOUT `id` INT, IN `street1` VARCHAR(30), IN `street2` VARCHAR(30), IN `city` VARCHAR(30), IN `county` VARCHAR(30), IN `zipcode` VARCHAR(30), IN `email` VARCHAR(100), IN `phone1` VARCHAR(15), IN `phone2` VARCHAR(15), IN `photo` VARCHAR(20), IN `name` VARCHAR(20), IN `surname` VARCHAR(20), IN `occupation` VARCHAR(20), IN `pob` VARCHAR(20), IN `martial_status` VARCHAR(20), IN `hobbies` VARCHAR(20), IN `skills` VARCHAR(20), IN `qrcode` VARCHAR(20), IN `qrimage` VARCHAR(20), IN `country` VARCHAR(30))  NO SQL
    DETERMINISTIC
BEGIN
  DECLARE lid_contact int;
  DECLARE lid_member int;
  DECLARE lid_person int;

  DECLARE exit handler for SQLEXCEPTION
    BEGIN
      ROLLBACK;
    END;
  DECLARE exit handler for SQLWARNING
    BEGIN
      ROLLBACK;
    END;

	CALL `MendayInHolland`.`insert_contact`(
		@id, 
		street1, 
		street2, 
		city, 
		county,
		zipcode, 
		email, 
		phone1, 
		phone2,
        country        
	);
	
	CALL `MendayInHolland`.`insert_contact_info`(
		@id, 
		photo, 
		name, 
		surname, 
		occupation, 
		pob, 
		martial_status, 
		hobbies, 
		skills, 
		qrcode, 
		qrimage
	);

	CALL `MendayInHolland`.`create_membership`(
		@id, 
		1, 
		1
	);	

    SELECT LAST_INSERT_ID() as 'member_id';
    
  COMMIT;


END$$

DROP PROCEDURE IF EXISTS `insert_contact`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_contact` (INOUT `id` INT(11), IN `street1` VARCHAR(30), IN `street2` VARCHAR(30), IN `city` VARCHAR(30), IN `county` VARCHAR(30), IN `zipcode` VARCHAR(30), IN `email` VARCHAR(100), IN `phone1` VARCHAR(15), IN `phone2` VARCHAR(15), IN `country` VARCHAR(30))  NO SQL
BEGIN

    INSERT INTO `contact` ( 
        `id`,
        `street1`,
        `street2`,
        `city`,
        `county`,
        `zipcode`,
        `email`,
        `phone1`,
        `phone2`,
        `country`
    )
    VALUES (
        NULL,
        street1,
        street2,
        city,
        county,
        zipcode,
        email,
        phone1,
        phone2,
        country
    );
    SET id = LAST_INSERT_ID();

END$$

DROP PROCEDURE IF EXISTS `insert_contact_info`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_contact_info` (INOUT `id` INT(11), IN `photo` VARCHAR(20), IN `name` VARCHAR(20), IN `surname` VARCHAR(20), IN `occupation` VARCHAR(20), IN `place_of_birth` VARCHAR(20), IN `marital_status` VARCHAR(20), IN `hobbies` VARCHAR(20), IN `skills` VARCHAR(20), IN `qrcode` VARCHAR(20), IN `qrimage` VARCHAR(20))  NO SQL
BEGIN

    INSERT INTO `contact_info` (
		`id`,
		`photo`,
		`name`,
		`surname`,
		`occupation`,	
		`place_of_birth`,
		`marital_status`,
		`hobbies`, 
		`skills`, 
		`qrcode`,
		`qrimage`
	) VALUES (
		id,
		photo,
		name,
		surname,
		occupation,
		place_of_birth,
		marital_status,
		hobbies,
		skills,
		qrcode,
		qrimage
	);
END$$

DROP PROCEDURE IF EXISTS `read_member`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `read_member` (IN `id` INT(11))  BEGIN
	SELECT 
		c.id,
		c.street1,
		c.street2,
		c.city,
		c.county,
		c.zipcode,
		c.email,
		c.phone1,
		c.phone2,
		ci.photo,
		ci.`name`,
		ci.surname,
		ci.occupation,
		ci.place_of_birth,
		ci.marital_status,
		ci.hobbies,
		ci.skills,
		ci.qrcode,
		ci.qrimage,
		m.active,
        c.country        
	FROM 
		`contact` as c
	INNER JOIN (
		SELECT
			*
		FROM `contact_info`
	) as ci
	ON c.id=ci.id
	INNER JOIN (
		SELECT * FROM `membership`
	) as m
	WHERE m.contact_id=c.id
	AND c.id=id;
	
END$$

DROP PROCEDURE IF EXISTS `read_members`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `read_members` ()  BEGIN
	SELECT 
		m.contact_id,
		c.street1,
		c.street2,
		c.city,
		c.county,
		c.zipcode,
		c.email,
		c.phone1,
		c.phone2,
		ci.photo,
		ci.`name`,
		ci.surname,
		ci.occupation,
		ci.place_of_birth,
		ci.marital_status,
		ci.hobbies,
		ci.skills,
		ci.qrcode,
		ci.qrimage
	FROM 
		`membership` as m
	LEFT JOIN (
		SELECT
			id,
			street1,
			street2,
			city,
			county,
			zipcode,
			email,
			phone1,
			phone2
		FROM `contact`
	) as c
	ON m.contact_id=c.id
	LEFT JOIN (
		SELECT
			id,
			photo,
			`name`,
			surname,
			occupation,
			place_of_birth,
			marital_status,
			hobbies,
			skills,
			qrcode,
			qrimage
		FROM `contact_info`
	) as ci
	ON ci.id=c.id	
	WHERE
		m.`active`=1;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--
-- Creation: May 04, 2016 at 04:51 PM
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `street1` varchar(30) NOT NULL,
  `street2` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `county` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `contact`:
--

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `street1`, `street2`, `city`, `county`, `zipcode`, `email`, `phone1`, `phone2`, `country`) VALUES
(106, 'street1', 'street2', 'city', 'county', 'zipcode', 'email', 'phone1', 'phone2', 'country'),
(107, 'street1', 'street2', 'city', 'county', 'zipcode', 'email', 'phone1', 'phone2', 'country');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--
-- Creation: Mar 09, 2016 at 05:36 PM
--

DROP TABLE IF EXISTS `contact_info`;
CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `photo` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `occupation` varchar(20) NOT NULL,
  `place_of_birth` varchar(20) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `hobbies` varchar(20) NOT NULL,
  `skills` varchar(20) NOT NULL,
  `qrcode` varchar(20) NOT NULL,
  `qrimage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `contact_info`:
--   `id`
--       `contact` -> `id`
--

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `photo`, `name`, `surname`, `occupation`, `place_of_birth`, `marital_status`, `hobbies`, `skills`, `qrcode`, `qrimage`) VALUES
(106, 'photo', 'name', 'surname', 'occupation', 'pob', 'marital_status', 'hobbies', 'skills', 'qrcode', 'qrimage'),
(107, 'photo', 'name', 'surname', 'occupation', 'pob', 'marital_status', 'hobbies', 'skills', 'qrcode', 'qrimage');

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--
-- Creation: Mar 09, 2016 at 05:36 PM
--

DROP TABLE IF EXISTS `contact_type`;
CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `contact_type`:
--

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `description`) VALUES
(1, 'person', 'Member'),
(2, 'organisation', 'non-porfit organisations Church, NGO etc ...'),
(3, 'company', 'Commercial Organisation, goal is to make profit');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--
-- Creation: Mar 09, 2016 at 05:36 PM
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE `membership` (
  `contact_id` int(11) NOT NULL,
  `contact_type` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `membership`:
--   `contact_id`
--       `contact` -> `id`
--   `contact_type`
--       `contact_type` -> `id`
--

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`contact_id`, `contact_type`, `active`) VALUES
(106, 1, 1),
(107, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contact_type_fk` (`contact_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD CONSTRAINT `contact_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `contact_id_fk` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_type_fk` FOREIGN KEY (`contact_type`) REFERENCES `contact_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
