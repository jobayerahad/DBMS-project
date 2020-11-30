-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2020 at 12:27 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ja-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  `photo` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `bio`, `photo`, `user_id`) VALUES
(1, 'Mr. Admin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque id erat bibendum, fringilla est in, sagittis tellus. Morbi tincidunt metus congue odio gravida convallis.', 'upload/nathan_drake.webp', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`) VALUES
(2, 'Programming ', '2020-11-27 23:23:40'),
(3, 'Travel', '2020-11-28 20:12:39'),
(4, 'Food', '2020-11-28 20:12:50'),
(5, 'DIY', '2020-11-28 20:13:09'),
(6, 'Finance', '2020-11-28 20:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `excerpt` text NOT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `excerpt`, `thumbnail`, `featured`, `published`) VALUES
('20201128085528', 'How To Learn Easy Way', 'Sed quis consequat turpis. Donec lacinia auctor nisl at blandit. Aliquam id hendrerit quam. Nunc facilisis ligula sit amet vulputate pretium. Fusce a fermentum nisi. Curabitur vel augue eget justo finibus ullamcorper sed ac nulla. Aenean mollis dictum aliquam. Sed bibendum ipsum nec diam ullamcorper, a blandit mi molestie. Nunc nec eros auctor, molestie metus vitae, elementum nisl. Cras egestas risus at risus ornare, eu tempor libero ullamcorper. Sed blandit tellus ut mi vestibulum, at condimentum nisl imperdiet. Fusce non velit lectus.\r\n\r\nDuis ipsum orci, cursus congue augue non, consectetur interdum turpis. Suspendisse ultricies, ex vitae scelerisque venenatis, lectus nisi mattis ipsum, eget venenatis nulla elit a purus. Quisque vitae nisi gravida, aliquet dolor sagittis, ultrices velit. Phasellus non est tincidunt, faucibus elit volutpat, fringilla orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean risus dolor, sagittis in cursus id, commodo quis magna. Sed tristique magna tempor dui aliquam auctor.\r\n\r\nNam eu urna nec augue elementum sodales. In in ultricies mi. Vestibulum nec facilisis nibh. Nunc ut magna turpis. Suspendisse sagittis bibendum ultrices. Praesent et metus viverra, dignissim tellus ut, maximus orci. Aenean sollicitudin scelerisque nibh. Pellentesque ullamcorper lorem id tellus luctus gravida. Nullam aliquam at tellus quis iaculis. Sed vitae facilisis diam, dapibus pretium libero.\r\n\r\nSuspendisse fringilla, turpis in ullamcorper malesuada, arcu risus lacinia mauris, et molestie ex tortor sed dolor. Duis sodales, ante sed ultricies sollicitudin, risus turpis dictum quam, pretium convallis tortor mauris at lacus. Duis sodales magna orci, accumsan ullamcorper sapien gravida quis. Maecenas eget turpis sit amet lectus pellentesque egestas. Nunc consequat et ipsum id venenatis. Vivamus in congue nisl, sit amet blandit eros. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam maximus commodo dolor ac pretium. In ut placerat velit. Fusce ac augue at lorem ullamcorper euismod eu a enim. Aenean posuere nunc libero, tempor ullamcorper leo condimentum quis. Nam porttitor massa eget cursus faucibus. Duis non nunc vel neque efficitur mollis.\r\n\r\nMorbi vel nisl dictum, consectetur velit eget, dignissim nibh. In erat odio, lacinia at lectus ac, ullamcorper commodo nisl. Vivamus at elementum felis. Donec finibus massa non ante maximus, ut tincidunt quam sodales. In hac habitasse platea dictumst. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean rhoncus, elit a fermentum ultricies, tortor enim laoreet nunc, at sagittis elit mi vel justo. Quisque consequat sodales purus, sed feugiat neque condimentum vel. Mauris quis quam vitae sem consectetur lacinia. Duis ligula neque, semper consequat euismod in, faucibus et nisl. In dui odio, euismod vitae sagittis sed, fringilla vel enim. Nullam vitae maximus tellus. Mauris non velit a ipsum lobortis blandit. Pellentesque at sem in ex semper tincidunt in a risus. ', ' ultrices velit. Phasellus non est tincidunt, faucibus elit volutpat, fringilla orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean risus dolor, sagittis in cursus id, commodo quis magna. Sed tristique magna tempor dui aliquam auctor', 'upload/20201128085528.webp', 0, 1),
('20201128091847', '10 foods You must try ', 'Sed quis consequat turpis. Donec lacinia auctor nisl at blandit. Aliquam id hendrerit quam. Nunc facilisis ligula sit amet vulputate pretium. Fusce a fermentum nisi. Curabitur vel augue eget justo finibus ullamcorper sed ac nulla. Aenean mollis dictum aliquam. Sed bibendum ipsum nec diam ullamcorper, a blandit mi molestie. Nunc nec eros auctor, molestie metus vitae, elementum nisl. Cras egestas risus at risus ornare, eu tempor libero ullamcorper. Sed blandit tellus ut mi vestibulum, at condimentum nisl imperdiet. Fusce non velit lectus.\r\n\r\nDuis ipsum orci, cursus congue augue non, consectetur interdum turpis. Suspendisse ultricies, ex vitae scelerisque venenatis, lectus nisi mattis ipsum, eget venenatis nulla elit a purus. Quisque vitae nisi gravida, aliquet dolor sagittis, ultrices velit. Phasellus non est tincidunt, faucibus elit volutpat, fringilla orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean risus dolor, sagittis in cursus id, commodo quis magna. Sed tristique magna tempor dui aliquam auctor.\r\n\r\nNam eu urna nec augue elementum sodales. In in ultricies mi. Vestibulum nec facilisis nibh. Nunc ut magna turpis. Suspendisse sagittis bibendum ultrices. Praesent et metus viverra, dignissim tellus ut, maximus orci. Aenean sollicitudin scelerisque nibh. Pellentesque ullamcorper lorem id tellus luctus gravida. Nullam aliquam at tellus quis iaculis. Sed vitae facilisis diam, dapibus pretium libero.\r\n\r\nSuspendisse fringilla, turpis in ullamcorper malesuada, arcu risus lacinia mauris, et molestie ex tortor sed dolor. Duis sodales, ante sed ultricies sollicitudin, risus turpis dictum quam, pretium convallis tortor mauris at lacus. Duis sodales magna orci, accumsan ullamcorper sapien gravida quis. Maecenas eget turpis sit amet lectus pellentesque egestas. Nunc consequat et ipsum id venenatis. Vivamus in congue nisl, sit amet blandit eros. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam maximus commodo dolor ac pretium. In ut placerat velit. Fusce ac augue at lorem ullamcorper euismod eu a enim. Aenean posuere nunc libero, tempor ullamcorper leo condimentum quis. Nam porttitor massa eget cursus faucibus. Duis non nunc vel neque efficitur mollis.\r\n\r\nMorbi vel nisl dictum, consectetur velit eget, dignissim nibh. In erat odio, lacinia at lectus ac, ullamcorper commodo nisl. Vivamus at elementum felis. Donec finibus massa non ante maximus, ut tincidunt quam sodales. In hac habitasse platea dictumst. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean rhoncus, elit a fermentum ultricies, tortor enim laoreet nunc, at sagittis elit mi vel justo. Quisque consequat sodales purus, sed feugiat neque condimentum vel. Mauris quis quam vitae sem consectetur lacinia. Duis ligula neque, semper consequat euismod in, faucibus et nisl. In dui odio, euismod vitae sagittis sed, fringilla vel enim. Nullam vitae maximus tellus. Mauris non velit a ipsum lobortis blandit. Pellentesque at sem in ex semper tincidunt in a risus. ', 'Quisque vitae nisi gravida, aliquet dolor sagittis, ultrices velit. Phasellus non est tincidunt, faucibus elit volutpat, fringilla orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean risus dolor, sagittis in cursus id, commodo quis magna. Sed tristique magna tempor dui aliquam auctor. ', 'upload/20201128091847.webp', 1, 1),
('20201128094005', 'Choose Your Next Destination', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque imperdiet ipsum velit, ut consectetur nunc tempor vel. Donec cursus ipsum vel velit pretium aliquet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam cursus magna eu dignissim vulputate. Nunc sit amet rhoncus nulla. Nulla eget ipsum ut velit laoreet luctus. Curabitur eu risus ultrices, facilisis libero in, maximus nulla. Morbi et magna porta, laoreet erat nec, laoreet ante. Curabitur eu diam convallis, fringilla tellus ut, fringilla libero. Mauris ut sapien vel ipsum mattis luctus.\r\n\r\nNam tincidunt, justo vitae fringilla pulvinar, lectus mauris fermentum mi, a consectetur lectus felis nec dolor. Vivamus ut tellus tellus. Aliquam et nibh eu mauris sodales tincidunt. Aenean placerat aliquam venenatis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque ac lorem sed massa pharetra venenatis et non sapien. Duis libero ipsum, placerat quis justo ac, fringilla feugiat justo. Etiam quis tellus tortor. Aenean auctor tortor nisl. Sed quis lorem non lectus tempor mattis. Ut ac erat dui. Maecenas venenatis, felis vel faucibus suscipit, urna dolor posuere erat, at aliquet libero metus non metus. Praesent tortor ex, egestas feugiat aliquam sit amet, facilisis posuere purus.\r\n\r\nMorbi faucibus enim nisl, vitae pretium dolor consectetur eget. Nam quis justo in purus faucibus imperdiet at eget purus. Cras pharetra felis at commodo hendrerit. Phasellus dui purus, elementum non pharetra malesuada, ultrices ac nibh. Mauris egestas molestie augue, a feugiat mauris pellentesque at. Nulla et ipsum posuere ligula fringilla aliquet. Praesent non tincidunt dolor, et sagittis eros. Phasellus faucibus eu tortor et auctor. Praesent varius sapien ut arcu dapibus, a auctor magna porta. Nam luctus eu nunc in commodo.\r\n\r\nNulla lobortis dui neque, id dapibus enim sollicitudin a. Fusce at luctus eros. Mauris tincidunt dolor augue, sit amet consequat odio tincidunt in. Donec non nulla a turpis dignissim vestibulum. Duis euismod tincidunt eros ut commodo. Fusce faucibus turpis diam, quis lobortis erat consequat a. Aliquam vestibulum tincidunt condimentum. Vestibulum congue, libero non laoreet mattis, turpis leo imperdiet velit, at sagittis ex diam vel turpis.\r\n\r\nSuspendisse vel mauris libero. Integer suscipit euismod nibh, at eleifend nulla vehicula vel. Aenean sem nibh, eleifend eu est nec, semper placerat enim. Donec sagittis congue tempor. Vestibulum nisl enim, imperdiet pharetra massa at, finibus eleifend sapien. Praesent eleifend euismod mattis. Nulla lorem orci, aliquam dictum diam ut, dictum elementum nulla. Cras interdum vitae nisl quis condimentum. Integer eleifend, est eget commodo hendrerit, odio leo tempor dui, quis suscipit libero eros sed elit. Suspendisse potenti. Pellentesque malesuada tortor ut sapien consectetur pellentesque. Aenean bibendum pellentesque velit, in cursus nisl molestie a. Aenean sed auctor arcu. Phasellus imperdiet nibh ut tempor feugiat. Aenean sit amet augue sit amet augue vestibulum euismod. Aliquam blandit mi sit amet arcu eleifend, nec bibendum velit convallis. ', 'Aenean auctor tortor nisl. Sed quis lorem non lectus tempor mattis. Ut ac erat dui. Maecenas venenatis, felis vel faucibus suscipit, urna dolor posuere erat, at aliquet libero metus non metus. Praesent tortor ex, egestas feugiat aliquam sit amet, facilisis posuere purus. ', 'upload/20201128094005.webp', 1, 1),
('20201128094150', 'World\'s Heaven You Will Be Amazed!', 'Fusce bibendum purus vitae nibh mollis suscipit. Duis pharetra, risus ultrices consequat fermentum, ex ante bibendum nibh, in varius magna ante id massa. Sed nec est ante. Curabitur bibendum augue non lacus bibendum interdum. Morbi vitae semper augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus ut nibh eget massa consectetur laoreet in quis nisl. Pellentesque sit amet mattis ligula. Aenean cursus felis ut molestie dictum. Morbi in ultricies lectus. Mauris in lectus ac nibh accumsan mollis. Vestibulum in mi sit amet mauris dictum convallis. Donec et accumsan mauris. Suspendisse scelerisque tincidunt ultrices. Donec euismod tellus at mi efficitur ornare.rnrnDonec malesuada erat egestas sem laoreet eleifend in ac ex. Nullam porttitor elit maximus neque fermentum scelerisque. Sed ullamcorper bibendum arcu, nec elementum purus viverra a. Donec nec ex nulla. Curabitur efficitur commodo mi at mollis. Cras convallis euismod justo nec pretium. Maecenas ac lorem non lorem tempus lobortis non eu velit. Vivamus lacinia ante sit amet neque ornare, id sagittis diam gravida. Pellentesque rutrum, libero eu accumsan tincidunt, est turpis fermentum sem, ut elementum eros enim a magna. Quisque sagittis elit massa, ut ultrices eros fermentum nec. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sodales ultrices lorem. Phasellus in tincidunt purus, vitae mollis dui. Pellentesque magna ligula, pretium sed neque quis, consequat tristique massa. Cras rutrum feugiat tellus, a faucibus lorem malesuada ac.rnrnEtiam vehicula lacus sit amet porttitor iaculis. Nunc maximus enim vitae enim vulputate, a gravida arcu pulvinar. Maecenas ullamcorper pulvinar lectus, eget porta odio pulvinar ut. Suspendisse vel augue convallis, imperdiet erat quis, malesuada odio. Vivamus nec volutpat ligula. Nunc ac ex placerat, pharetra nisl eu, interdum augue. In consequat porta magna sit amet ultricies. Vivamus egestas ligula non sem maximus, vehicula venenatis mi lacinia. Vestibulum elementum orci eget odio fringilla sagittis. Quisque scelerisque massa ex, et feugiat nisl gravida dapibus. Nulla facilisi. Duis consectetur at turpis porttitor ultrices. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus.rnrnSed hendrerit nisi ut vulputate aliquet. Nullam sit amet sapien pulvinar, efficitur mi at, vehicula velit. Nam vestibulum a libero sit amet sagittis. Aliquam ex ante, rhoncus at imperdiet eu, tincidunt eu quam. Vivamus porta molestie ex, vel rhoncus nulla bibendum a. Aenean et dui metus. Nulla est turpis, imperdiet at libero vel, cursus auctor ligula. Quisque malesuada quam sed est porta ornare. Nulla porttitor pretium ante, eu pharetra tellus. Nulla vitae nulla nec eros commodo hendrerit. Aliquam erat volutpat. Praesent convallis efficitur odio, ut venenatis eros mattis at.rnrnQuisque porta nunc faucibus, feugiat dolor sed, eleifend turpis. Praesent hendrerit, augue et suscipit sollicitudin, justo erat egestas tellus, non molestie lectus dui id orci. Vestibulum sed purus fringilla, pulvinar mi ut, posuere lectus. Maecenas congue, nunc congue pellentesque ullamcorper, sapien libero maximus lectus, non facilisis augue risus suscipit leo. Ut tristique ultrices sapien placerat elementum. Pellentesque porttitor erat eu massa iaculis, et vulputate magna suscipit. Pellentesque condimentum efficitur neque, a mollis felis consequat et. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse non tortor dignissim, consequat ante non, placerat arcu.', 'orci eget odio fringilla sagittis. Quisque scelerisque massa ex, et feugiat nisl gravida dapibus. Nulla facilisi. Duis consectetur at turpis porttitor ultrices. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 'upload/20201128094150.webp', 1, 1),
('20201129011436', 'Give Your House & Mind A New Era!', 'rnrnLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel rhoncus enim. Pellentesque consectetur erat lectus, vel euismod sapien tempus in. Mauris maximus rutrum urna eget sagittis. Vestibulum luctus turpis nec lorem eleifend semper. Vivamus consectetur viverra felis consectetur vulputate. Vivamus aliquam hendrerit elit et dapibus. Sed vitae dapibus turpis. Nulla pellentesque turpis erat, nec ultricies ipsum auctor nec. Mauris non pulvinar purus, in venenatis risus. In placerat orci eget magna finibus, vel ornare urna condimentum. Nulla ullamcorper, odio vel vestibulum placerat, nisl nisl pulvinar eros, vitae gravida mi magna vel purus. Aliquam egestas lectus non neque dapibus, eu commodo ex imperdiet. Interdum et malesuada fames ac ante ipsum primis in faucibus.rnrnVestibulum congue pharetra massa, eu pretium mi eleifend hendrerit. Nunc in mi magna. Fusce suscipit hendrerit tellus, non iaculis ex elementum et. Proin ut eleifend neque, sed cursus nunc. Nullam tristique ex ut leo suscipit rutrum. Proin varius cursus enim, id egestas tellus. Donec vitae fermentum lacus. Pellentesque velit erat, egestas eu semper sit amet, faucibus nec tortor. Donec eu felis vulputate velit venenatis luctus. Vestibulum auctor, est tincidunt pulvinar hendrerit, tellus nunc congue libero, id gravida massa diam in dui. Praesent tempor odio vitae gravida fringilla.rnrnMorbi tincidunt nulla porta enim molestie ullamcorper. Etiam et orci turpis. Fusce interdum leo ante, nec laoreet leo pretium eu. Sed lacus nisl, efficitur sit amet nulla eu, sagittis imperdiet ipsum. Nunc volutpat ligula nibh, eget faucibus velit condimentum eu. Curabitur nec augue nibh. Proin quam massa, egestas lobortis mollis ac, lobortis nec ligula. Sed aliquet rutrum interdum. Sed sed lacinia ligula, et blandit ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ligula urna, tincidunt volutpat sem eget, varius luctus ante. Sed efficitur metus a eros commodo dapibus. Nam quis pharetra risus. Proin iaculis lacinia felis, eget blandit libero porttitor sed.rnrnQuisque interdum facilisis orci in fringilla. In viverra, mi ac commodo suscipit, massa erat dapibus tortor, eget fermentum orci erat id nisl. Ut ac dapibus libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin et feugiat quam, id blandit ipsum. Donec convallis, lorem ac malesuada euismod, metus dui sollicitudin nibh, at tristique nisi orci nec dolor. Nulla eleifend eros nec pellentesque egestas. Proin vestibulum sit amet tortor id congue. Vestibulum sit amet enim feugiat diam sagittis efficitur et sed nunc. Curabitur iaculis ipsum libero. Sed hendrerit imperdiet orci. Aliquam et lectus neque. In quis auctor est, sit amet faucibus neque. Sed posuere lacus et ipsum convallis, quis bibendum risus tristique. Nam diam purus, volutpat efficitur porttitor vel, placerat vel eros. Cras mattis lorem varius sem aliquam, maximus interdum quam feugiat.rnrnUt consequat efficitur laoreet. In vel ullamcorper justo, non feugiat ligula. Suspendisse lacus sapien, congue eu maximus sed, suscipit sed purus. Aenean malesuada molestie scelerisque. Fusce luctus, neque non luctus eleifend, risus dolor iaculis lacus, eu auctor sapien orci ac lacus. Suspendisse potenti. Ut porta dignissim sapien eu vehicula. Cras vel mauris facilisis, facilisis nunc ut, ornare massa. Donec a sem non lectus fermentum ornare facilisis nec dolor. Donec finibus vel odio eu maximus. Donec cursus rutrum risus. Quisque ultrices magna sed lacinia rutrum. Sed iaculis vehicula ex et molestie. Integer vel odio lobortis, eleifend dui sed, tincidunt dui. Aenean aliquet tortor sed tellus lacinia, at tristique est sollicitudin. Integer a purus tortor.', 'Vestibulum sit amet enim feugiat diam sagittis efficitur et sed nunc. Curabitur iaculis ipsum libero. Sed hendrerit imperdiet orci. Aliquam et lectus neque. In quis auctor est, sit amet faucibus neque. Sed posuere lacus et ipsum convallis, quis bibendum risus tristique. Nam diam purus, volutpat efficitur porttitor vel, placerat vel eros. Cras mattis lorem varius sem aliquam, maximus interdum quam feugiat', 'upload/20201129011436.webp', 1, 1),
('20201129012303', 'Be your own mechanic', 'Aliquam faucibus nec lacus in aliquam. Aenean luctus varius nulla, eu condimentum ex suscipit in. Maecenas ut ultricies turpis. Sed vehicula augue ut est bibendum bibendum. Aenean quis scelerisque augue, in consectetur elit. Aliquam vel vulputate ipsum. In tincidunt pellentesque urna tincidunt aliquam. Pellentesque lacinia neque bibendum ante tempus, sed hendrerit est fringilla. Phasellus et sem placerat, facilisis orci sed, accumsan massa. Phasellus dapibus hendrerit ornare.rnrnVivamus justo mi, placerat vitae varius quis, fringilla id tortor. Proin tempus efficitur odio eget feugiat. Quisque accumsan fermentum arcu non convallis. Nunc semper orci quis elementum sollicitudin. Etiam elementum sem quis risus condimentum, fermentum tempor purus luctus. Pellentesque porta sed risus ac semper. Nullam sagittis metus sit amet neque aliquet porttitor. Fusce volutpat efficitur ipsum, vel fermentum ex iaculis ut.rnrnCurabitur nec dolor non urna vulputate posuere. Sed et massa gravida, varius diam id, gravida sapien. Curabitur tincidunt nisi at turpis facilisis, ac tempor nisl euismod. Aenean neque arcu, posuere id justo vel, sodales ultricies erat. Phasellus mi massa, semper vestibulum placerat eu, rutrum nec turpis. Proin semper nulla sed pulvinar sodales. Quisque sit amet posuere felis. Etiam vulputate nulla non libero porta suscipit. Pellentesque arcu justo, blandit at massa sit amet, efficitur ullamcorper purus. Maecenas egestas mauris magna, et feugiat lacus gravida feugiat. Suspendisse ut lobortis nibh, sit amet euismod justo. Vestibulum at quam mattis augue tristique tempus. Etiam dignissim imperdiet posuere. Praesent id leo dui.rnrnCurabitur egestas volutpat odio ut rhoncus. Maecenas et rhoncus augue. Nam a tellus dapibus, cursus arcu a, fringilla lorem. Fusce viverra dignissim mauris, sit amet dapibus mauris vehicula pretium. Sed sollicitudin dolor dictum nunc elementum, sit amet rutrum ex mattis. Duis vitae interdum ex. Donec rutrum augue ut viverra volutpat. Aliquam neque magna, luctus in interdum in, bibendum in tellus. Nullam vestibulum convallis venenatis. Suspendisse feugiat dui purus, quis tincidunt quam ornare eu. Suspendisse facilisis nec leo a viverra. Pellentesque at turpis tincidunt, venenatis magna ut, blandit augue. Aliquam fermentum erat vitae massa cursus malesuada. Proin commodo odio et aliquet vehicula. Vestibulum sagittis eleifend lacus, et semper arcu aliquam vitae. Curabitur auctor ultricies dui sit amet hendrerit.rnrnInteger nec odio eget massa egestas posuere at vitae tortor. Aliquam ac placerat diam. Fusce odio eros, pulvinar ut lobortis eget, molestie quis metus. Nunc sollicitudin fermentum lorem, ut fringilla mi posuere quis. Ut ac nulla ac est volutpat ultricies non vel mi. Vestibulum blandit sodales sapien, eu laoreet eros posuere et. Fusce volutpat aliquam tincidunt. Integer scelerisque sollicitudin luctus. Nullam sed libero a diam fermentum malesuada vel ut arcu. Sed auctor ullamcorper ultrices. Vestibulum dignissim non purus nec dictum. Nullam sagittis iaculis metus sed consectetur. Donec convallis consectetur metus, luctus maximus massa malesuada auctor. Quisque sollicitudin nunc lorem, non aliquet purus porttitor sed.', 'Aliquam faucibus nec lacus in aliquam. Aenean luctus varius nulla, eu condimentum ex suscipit in. Maecenas ut ultricies turpis. Sed vehicula augue ut est bibendum bibendum. Aenean quis scelerisque', 'upload/20201129012303.webp', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts_meta`
--

CREATE TABLE `posts_meta` (
  `id` int(11) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts_meta`
--

INSERT INTO `posts_meta` (`id`, `post_id`, `category_id`, `author_id`, `created_at`) VALUES
(4, '20201128085528', 2, 1, '2020-11-28 19:55:28'),
(5, '20201128091847', 4, 1, '2020-11-28 20:18:47'),
(6, '20201128094005', 3, 1, '2020-11-28 20:40:05'),
(7, '20201128094150', 3, 1, '2020-11-28 20:41:50'),
(8, '20201129011436', 5, 1, '2020-11-29 00:14:36'),
(9, '20201129012303', 5, 1, '2020-11-29 00:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `permission_level` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `permission_level`, `created_at`) VALUES
(2, 'admin@domain.com', '21232f297a57a5a743894a0e4a801fc3', 3, '2020-11-26 15:18:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_meta`
--
ALTER TABLE `posts_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts_meta`
--
ALTER TABLE `posts_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
