-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2024 at 04:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BookingTour`
--

-- --------------------------------------------------------

--
-- Table structure for table `AdminUserImages`
--

CREATE TABLE `AdminUserImages` (
  `AdminUserImageID` int(11) NOT NULL,
  `AdminUserID` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `AdminUserRoles`
--

CREATE TABLE `AdminUserRoles` (
  `AdminUserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `AdminUsers`
--

CREATE TABLE `AdminUsers` (
  `AdminUserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `BookingAudit`
--

CREATE TABLE `BookingAudit` (
  `AuditID` int(11) NOT NULL,
  `BookingID` int(11) DEFAULT NULL,
  `ChangeType` varchar(50) NOT NULL,
  `ChangeDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ChangedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `BookingID` int(11) NOT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `TourID` int(11) DEFAULT NULL,
  `BookingDate` date NOT NULL,
  `CheckInDate` date DEFAULT NULL,
  `NumberOfPeople` int(11) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ClientUserImages`
--

CREATE TABLE `ClientUserImages` (
  `ClientUserImageID` int(11) NOT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ClientUsers`
--

CREATE TABLE `ClientUsers` (
  `ClientUserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ClientUsers`
--

INSERT INTO `ClientUsers` (`ClientUserID`, `Username`, `Password`, `FullName`, `Email`) VALUES
(2, 'tey', '$2y$10$NB9YBIOdB9iqPUxiz2HQUOU797Uk7I.8broeKTAGJrK2bJluyhly6', 'champ tey', 'kueprotocol11@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RoomBookingAudit`
--

CREATE TABLE `RoomBookingAudit` (
  `AuditID` int(11) NOT NULL,
  `RoomBookingID` int(11) DEFAULT NULL,
  `ChangeType` varchar(50) NOT NULL,
  `ChangeDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ChangedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RoomBookings`
--

CREATE TABLE `RoomBookings` (
  `RoomBookingID` int(11) NOT NULL,
  `ClientUserID` int(11) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `CheckInDate` date DEFAULT NULL,
  `CheckOutDate` date DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RoomImages`
--

CREATE TABLE `RoomImages` (
  `RoomImageID` int(11) NOT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Rooms`
--

CREATE TABLE `Rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomTypeID` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `PricePerNight` decimal(10,2) DEFAULT NULL,
  `SetAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RoomTypes`
--

CREATE TABLE `RoomTypes` (
  `RoomTypeID` int(11) NOT NULL,
  `RoomTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TourImages`
--

CREATE TABLE `TourImages` (
  `TourImageID` int(11) NOT NULL,
  `TourID` int(11) DEFAULT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Tours`
--

CREATE TABLE `Tours` (
  `TourID` int(11) NOT NULL,
  `TourTypeID` int(11) DEFAULT NULL,
  `TourName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `SetAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TourTypes`
--

CREATE TABLE `TourTypes` (
  `TourTypeID` int(11) NOT NULL,
  `TourTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AdminUserImages`
--
ALTER TABLE `AdminUserImages`
  ADD PRIMARY KEY (`AdminUserImageID`),
  ADD KEY `AdminUserID` (`AdminUserID`);

--
-- Indexes for table `AdminUserRoles`
--
ALTER TABLE `AdminUserRoles`
  ADD PRIMARY KEY (`AdminUserID`,`RoleID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `AdminUsers`
--
ALTER TABLE `AdminUsers`
  ADD PRIMARY KEY (`AdminUserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `BookingAudit`
--
ALTER TABLE `BookingAudit`
  ADD PRIMARY KEY (`AuditID`),
  ADD KEY `BookingID` (`BookingID`),
  ADD KEY `ChangedBy` (`ChangedBy`);

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `ClientUserID` (`ClientUserID`),
  ADD KEY `TourID` (`TourID`);

--
-- Indexes for table `ClientUserImages`
--
ALTER TABLE `ClientUserImages`
  ADD PRIMARY KEY (`ClientUserImageID`),
  ADD KEY `ClientUserID` (`ClientUserID`);

--
-- Indexes for table `ClientUsers`
--
ALTER TABLE `ClientUsers`
  ADD PRIMARY KEY (`ClientUserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- Indexes for table `RoomBookingAudit`
--
ALTER TABLE `RoomBookingAudit`
  ADD PRIMARY KEY (`AuditID`),
  ADD KEY `RoomBookingID` (`RoomBookingID`),
  ADD KEY `ChangedBy` (`ChangedBy`);

--
-- Indexes for table `RoomBookings`
--
ALTER TABLE `RoomBookings`
  ADD PRIMARY KEY (`RoomBookingID`),
  ADD KEY `ClientUserID` (`ClientUserID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `RoomImages`
--
ALTER TABLE `RoomImages`
  ADD PRIMARY KEY (`RoomImageID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `Rooms`
--
ALTER TABLE `Rooms`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `RoomTypeID` (`RoomTypeID`);

--
-- Indexes for table `RoomTypes`
--
ALTER TABLE `RoomTypes`
  ADD PRIMARY KEY (`RoomTypeID`),
  ADD UNIQUE KEY `RoomTypeName` (`RoomTypeName`);

--
-- Indexes for table `TourImages`
--
ALTER TABLE `TourImages`
  ADD PRIMARY KEY (`TourImageID`),
  ADD KEY `TourID` (`TourID`);

--
-- Indexes for table `Tours`
--
ALTER TABLE `Tours`
  ADD PRIMARY KEY (`TourID`),
  ADD KEY `TourTypeID` (`TourTypeID`);

--
-- Indexes for table `TourTypes`
--
ALTER TABLE `TourTypes`
  ADD PRIMARY KEY (`TourTypeID`),
  ADD UNIQUE KEY `TourTypeName` (`TourTypeName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AdminUserImages`
--
ALTER TABLE `AdminUserImages`
  MODIFY `AdminUserImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `AdminUsers`
--
ALTER TABLE `AdminUsers`
  MODIFY `AdminUserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BookingAudit`
--
ALTER TABLE `BookingAudit`
  MODIFY `AuditID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ClientUserImages`
--
ALTER TABLE `ClientUserImages`
  MODIFY `ClientUserImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ClientUsers`
--
ALTER TABLE `ClientUsers`
  MODIFY `ClientUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RoomBookingAudit`
--
ALTER TABLE `RoomBookingAudit`
  MODIFY `AuditID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RoomBookings`
--
ALTER TABLE `RoomBookings`
  MODIFY `RoomBookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RoomImages`
--
ALTER TABLE `RoomImages`
  MODIFY `RoomImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Rooms`
--
ALTER TABLE `Rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RoomTypes`
--
ALTER TABLE `RoomTypes`
  MODIFY `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TourImages`
--
ALTER TABLE `TourImages`
  MODIFY `TourImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tours`
--
ALTER TABLE `Tours`
  MODIFY `TourID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TourTypes`
--
ALTER TABLE `TourTypes`
  MODIFY `TourTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AdminUserImages`
--
ALTER TABLE `AdminUserImages`
  ADD CONSTRAINT `AdminUserImages_ibfk_1` FOREIGN KEY (`AdminUserID`) REFERENCES `AdminUsers` (`AdminUserID`);

--
-- Constraints for table `AdminUserRoles`
--
ALTER TABLE `AdminUserRoles`
  ADD CONSTRAINT `AdminUserRoles_ibfk_1` FOREIGN KEY (`AdminUserID`) REFERENCES `AdminUsers` (`AdminUserID`),
  ADD CONSTRAINT `AdminUserRoles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `Roles` (`RoleID`);

--
-- Constraints for table `BookingAudit`
--
ALTER TABLE `BookingAudit`
  ADD CONSTRAINT `BookingAudit_ibfk_1` FOREIGN KEY (`BookingID`) REFERENCES `Bookings` (`BookingID`),
  ADD CONSTRAINT `BookingAudit_ibfk_2` FOREIGN KEY (`ChangedBy`) REFERENCES `AdminUsers` (`AdminUserID`);

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `Bookings_ibfk_1` FOREIGN KEY (`ClientUserID`) REFERENCES `ClientUsers` (`ClientUserID`),
  ADD CONSTRAINT `Bookings_ibfk_2` FOREIGN KEY (`TourID`) REFERENCES `Tours` (`TourID`);

--
-- Constraints for table `ClientUserImages`
--
ALTER TABLE `ClientUserImages`
  ADD CONSTRAINT `ClientUserImages_ibfk_1` FOREIGN KEY (`ClientUserID`) REFERENCES `ClientUsers` (`ClientUserID`);

--
-- Constraints for table `RoomBookingAudit`
--
ALTER TABLE `RoomBookingAudit`
  ADD CONSTRAINT `RoomBookingAudit_ibfk_1` FOREIGN KEY (`RoomBookingID`) REFERENCES `RoomBookings` (`RoomBookingID`),
  ADD CONSTRAINT `RoomBookingAudit_ibfk_2` FOREIGN KEY (`ChangedBy`) REFERENCES `AdminUsers` (`AdminUserID`);

--
-- Constraints for table `RoomBookings`
--
ALTER TABLE `RoomBookings`
  ADD CONSTRAINT `RoomBookings_ibfk_1` FOREIGN KEY (`ClientUserID`) REFERENCES `ClientUsers` (`ClientUserID`),
  ADD CONSTRAINT `RoomBookings_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `Rooms` (`RoomID`);

--
-- Constraints for table `RoomImages`
--
ALTER TABLE `RoomImages`
  ADD CONSTRAINT `RoomImages_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `Rooms` (`RoomID`);

--
-- Constraints for table `Rooms`
--
ALTER TABLE `Rooms`
  ADD CONSTRAINT `Rooms_ibfk_1` FOREIGN KEY (`RoomTypeID`) REFERENCES `RoomTypes` (`RoomTypeID`);

--
-- Constraints for table `TourImages`
--
ALTER TABLE `TourImages`
  ADD CONSTRAINT `TourImages_ibfk_1` FOREIGN KEY (`TourID`) REFERENCES `Tours` (`TourID`);

--
-- Constraints for table `Tours`
--
ALTER TABLE `Tours`
  ADD CONSTRAINT `Tours_ibfk_1` FOREIGN KEY (`TourTypeID`) REFERENCES `TourTypes` (`TourTypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
