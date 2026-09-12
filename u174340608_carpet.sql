-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2026 at 12:32 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u174340608_carpet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

CREATE TABLE `admin1` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin1`
--

INSERT INTO `admin1` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'mirzapur@123321gmail.com', '$2y$10$dvWl5ekgfwbZBga/u.LXpumY/ZW.RJu5nESpQrCNXi4sZJWdPd/bC', '2026-01-17 03:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `bamboobottels`
--

CREATE TABLE `bamboobottels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brassvessels`
--

CREATE TABLE `brassvessels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactme`
--

CREATE TABLE `contactme` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Mobile` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactme`
--

INSERT INTO `contactme` (`id`, `Name`, `Mobile`, `Email`, `Message`, `created_at`) VALUES
(1, 'Ranjeet', '8810842087', 'ranjitkumar123bind@gmail.com', 'hii', '2026-01-17 03:30:28'),
(2, 'Abhishek Patel', '7905709820', 'abhishek@gmail.com', 'Hiii mere jan', '2026-02-12 12:46:11'),
(3, 'Abhishek', '9451368779', 'abhishekyadav9451up@gmail.com', 'Hii', '2026-02-12 12:46:37'),
(4, 'Ranjeet Kumar', '8810842087', 'ranjitkumar123bind@gmail.com', 'hello raj', '2026-02-19 11:46:37'),
(5, 'Rajiv', '8819987876', 'ranjitkumar123bind@gmail.com', 'Hello how are you', '2026-02-25 03:51:51'),
(6, 'Ranjeet Kumar', '8810872088', 'rajkumar@123gmail.com', 'Rajkumar', '2026-02-25 03:53:57'),
(7, 'Manjeet', '8810842575', 'ranjitkumar123bind@gmail.com', 'Hello how are you 👋👋☺️☺️', '2026-03-05 13:26:11'),
(8, 'Ranjeet Kumar', '9810842087', 'ranjitkbind@gmail.com', 'Hello how are you', '2026-04-03 02:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `cushioncovers`
--

CREATE TABLE `cushioncovers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customizeyourown`
--

CREATE TABLE `customizeyourown` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `door`
--

CREATE TABLE `door` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fashionflooring`
--

CREATE TABLE `fashionflooring` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fashionflooring`
--

INSERT INTO `fashionflooring` (`id`, `name`, `price`, `image`, `created_at`) VALUES
(2, 'Rajkumar', 1000.00, '1769219329_5cfb55fbd2d8.jpg', '2026-01-24 01:48:49'),
(3, 'carpet2', 150.00, '1769219352_42e3261bf901.jpg', '2026-01-24 01:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `fineindiandurrys`
--

CREATE TABLE `fineindiandurrys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fineindianjute`
--

CREATE TABLE `fineindianjute` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fineindianjute`
--

INSERT INTO `fineindianjute` (`id`, `name`, `price`, `image`, `created_at`) VALUES
(1, 'carpet5', 1400.00, '1769219429_4f7489aa59ab.jpg', '2026-01-24 01:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `fineindianknotted`
--

CREATE TABLE `fineindianknotted` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fineindiarugs`
--

CREATE TABLE `fineindiarugs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forbighotel`
--

CREATE TABLE `forbighotel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `handmadepainting`
--

CREATE TABLE `handmadepainting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `handtufted`
--

CREATE TABLE `handtufted` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `handtuftedsaggy`
--

CREATE TABLE `handtuftedsaggy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homefashion`
--

CREATE TABLE `homefashion` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kitchennatural_wood`
--

CREATE TABLE `kitchennatural_wood` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knottedcarpets`
--

CREATE TABLE `knottedcarpets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `qty` int(11) DEFAULT 1,
  `status` varchar(50) DEFAULT 'ordered',
  `order_date` datetime DEFAULT current_timestamp(),
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'fashion_flooring',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `product_id`, `product_name`, `name`, `total_amount`, `qty`, `status`, `order_date`, `mobile`, `address`, `city`, `pincode`, `product_image`, `category`, `created_at`, `updated_at`) VALUES
(7, 'manjeet123@gmail.com', '3', '', 'carpet2', 1500.00, 1, 'ordered', '2026-03-05 13:24:02', '8810842087', 'Kamapur kalan vijaypur mirzapur ', 'Mirzapur', '231303', '1769219352_42e3261bf901.jpg', 'fashion_flooring', '2026-03-05 13:24:02', '2026-03-05 13:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `organiccarpets`
--

CREATE TABLE `organiccarpets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organicyarns`
--

CREATE TABLE `organicyarns` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poojadurryaasan`
--

CREATE TABLE `poojadurryaasan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `full_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Ranjeet Kumar', 'ranjitkumar123bind@gmail.com', '$2y$10$81CyOFJuW9n4dCIyQjZ6aOck5jBOH0s3mYM3eRBbtyx0crooE0pxO', '2025-12-13 03:42:41', '2025-12-13 03:42:41'),
(2, 'Rajat', 'rajat123bind@gmail.com', '$2y$10$f8LGO4xYOSucAK7YOzEpOuVhLPZP7.Hq/P33/set0ow/MlnUvvSa2', '2025-12-16 05:57:09', '2025-12-16 05:57:09'),
(3, 'Ranjeet Kumar', 'rajat123b@gmail.com', '$2y$10$d5R0.lQQoSdwXTXc/XKcq.IHSP.VseuigX2lFDl7QLRrPmCptFeaO', '2026-01-17 03:56:30', '2026-01-17 03:56:30'),
(4, 'Ranjeet', 'ranjit123bind@gmail.com', '$2y$10$7itjm514e8BY9fUdv/hlVuL8ucYNnCeC/.vga/K9/oJcxY4Jy1jcm', '2026-02-12 12:08:46', '2026-02-12 12:08:46'),
(5, 'Ranjeet', '', '$2y$10$z1RdYsu6mcTnhPL9HqEU5er2fBVfZmUvtuG7kk/YuHSHwpvHfqxK6', '2026-02-12 12:19:19', '2026-02-12 12:19:19'),
(6, 'Rakesh Kansal', 'mrkansal@gmail.com', '$2y$10$OZ6QxJnpaDMYGLkCr12Wae..99ciLIkQKXCTp8nO0W/BEUAtHIqXu', '2026-02-13 03:34:31', '2026-02-13 03:34:31'),
(7, 'Aditay', 'adityayadav3327@gmail.com', '$2y$10$soQrGFE03dEUB/strPwbZucvt0.37llvWz.DISlwn4FMFNEt3xT6G', '2026-02-13 06:28:07', '2026-02-13 06:28:07'),
(8, 'Rahul', 'Rahul@123gmail.com', '$2y$10$tT3X6ItvqmEfQc9bCfr7k.LcSdLqMEYjhv1HNTG5O2r5YuJWI53e2', '2026-02-16 10:04:06', '2026-02-16 11:39:45'),
(9, 'RITESH', 'ritesh123@gmail.com', '$2y$10$RjLQJz53xIw5JTdd4md32uh2hjRe//7cpaQiWx4MpfSGuO6dduZKW', '2026-02-26 11:50:23', '2026-02-26 11:53:12'),
(12, 'Manjeet', 'manjeet123@gmail.com', '$2y$10$VWveYtsfds9Y4tQAzLdbuuSwGDjiqrpSaxV/bKyj8TOAbIl9/AlmG', '2026-03-05 13:23:03', '2026-03-05 13:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin1`
--
ALTER TABLE `admin1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bamboobottels`
--
ALTER TABLE `bamboobottels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brassvessels`
--
ALTER TABLE `brassvessels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactme`
--
ALTER TABLE `contactme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cushioncovers`
--
ALTER TABLE `cushioncovers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customizeyourown`
--
ALTER TABLE `customizeyourown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `door`
--
ALTER TABLE `door`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fashionflooring`
--
ALTER TABLE `fashionflooring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fineindiandurrys`
--
ALTER TABLE `fineindiandurrys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fineindianjute`
--
ALTER TABLE `fineindianjute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fineindianknotted`
--
ALTER TABLE `fineindianknotted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fineindiarugs`
--
ALTER TABLE `fineindiarugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forbighotel`
--
ALTER TABLE `forbighotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handmadepainting`
--
ALTER TABLE `handmadepainting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handtufted`
--
ALTER TABLE `handtufted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handtuftedsaggy`
--
ALTER TABLE `handtuftedsaggy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homefashion`
--
ALTER TABLE `homefashion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitchennatural_wood`
--
ALTER TABLE `kitchennatural_wood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knottedcarpets`
--
ALTER TABLE `knottedcarpets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organiccarpets`
--
ALTER TABLE `organiccarpets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organicyarns`
--
ALTER TABLE `organicyarns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poojadurryaasan`
--
ALTER TABLE `poojadurryaasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin1`
--
ALTER TABLE `admin1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bamboobottels`
--
ALTER TABLE `bamboobottels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brassvessels`
--
ALTER TABLE `brassvessels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactme`
--
ALTER TABLE `contactme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cushioncovers`
--
ALTER TABLE `cushioncovers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customizeyourown`
--
ALTER TABLE `customizeyourown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `door`
--
ALTER TABLE `door`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fashionflooring`
--
ALTER TABLE `fashionflooring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fineindiandurrys`
--
ALTER TABLE `fineindiandurrys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fineindianjute`
--
ALTER TABLE `fineindianjute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fineindianknotted`
--
ALTER TABLE `fineindianknotted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fineindiarugs`
--
ALTER TABLE `fineindiarugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forbighotel`
--
ALTER TABLE `forbighotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `handmadepainting`
--
ALTER TABLE `handmadepainting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `handtufted`
--
ALTER TABLE `handtufted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `handtuftedsaggy`
--
ALTER TABLE `handtuftedsaggy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homefashion`
--
ALTER TABLE `homefashion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kitchennatural_wood`
--
ALTER TABLE `kitchennatural_wood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `knottedcarpets`
--
ALTER TABLE `knottedcarpets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `organiccarpets`
--
ALTER TABLE `organiccarpets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organicyarns`
--
ALTER TABLE `organicyarns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poojadurryaasan`
--
ALTER TABLE `poojadurryaasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
