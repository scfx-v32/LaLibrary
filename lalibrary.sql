-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 12:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `annee` int(4) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `titre`, `auteur`, `annee`, `isbn`, `description`, `photo`, `prix`, `quantite`, `category_id`) VALUES
(1, '1984 (FR)', 'George Orwell', 1949, '9780899663685', 'C\\\'est un roman qui dépeint le sort de l\\\'homme sous le totalitarisme. Il a été décrit comme l’un des commentaires les plus puissants sur ce qu’est la vie sans liberté.', 'images/1984.png', 100, 30, 3),
(3, 'كفاحي', 'Adolf Hitler', 1943, '-------------', 'كتاب كفاحي الذي كتبه أدولف هتلر خلال فترة سجنه عام 1924 بعد أول تصادم بين الحزب النازي وحكومة ألمانيا في ذلك الوقت وقبل وصوله للحكم بعشر سنوات تقريباً.', 'images/kifahi.jpg', 30, 99, 1),
(4, 'Métaphysique (FR)', 'Aristote ', 2016, '9782080705631', ' ', 'images/metaphysique.jpg', 70, 6, 2),
(5, 'Accelerated C++', 'Andrew Koenig, Barbara E. Moo', 2000, '9780201703535', 'The authors are widely considered to be among the world&#039;s foremost authorities on C++. What is perhaps even more important for the purposes of this review is that the authors are not only knowledgeable, but are also great teachers: they have used the material in this book for their professional-education course at Stanford University, and their pedagogic skills show on every page. It comes as no surprise, then, that &quot;Accelerated C++&quot; is consistently recommended to programmers who wish to learn C++', 'images/accelarated_c++).jpg', 125, 13, 11),
(6, 'بين الأساطير ', 'دعاء عبد الرحمن', 2017, '9786030465248', 'في زمنِ قد رحل وإندثر هُنالك شخص يُعاني من أجل إبنته وإعاده جسدها من قبل شيطانه مُقابل شرط منها يكاد يكون مُستحيلا بالنسبه له.', 'images/bayna_alasatir.jpg', 50, 10, 8),
(7, 'Learn Chinese The Fast And Fun Way', 'Lifei Ji', 1997, '9780812096897', 'This attractive and highly accessible book introduces readers to enough Mandarin Chinese to help them get around in typical travel situations. It opens with a pronunciation key, and goes on to emphasize the sounds of Chinese words and phrases. Sections that follow guide the reader through practice of often-used words, phrases, and sentences in typical travel situations that include arriving at a hotel, sightseeing, taking public transportation, and more. Also featured are vocabulary cards to improve students&#039; visual recognition of words and increase their word power in Chinese.', 'images/learn_chinese.jpg', 75, 19, 12),
(8, 'The Travels of Ibn Battuta: in the Near East, Asia and Africa, 1325–1354', 'Ibn Battuta, Samuel Lee', 2013, '9780486437651', 'The Arab equivalent of Marco Polo, Sheikh Ibn Battuta (1304-77) set out as a young man on a pilgrimage to Mecca that ended 27 years and 75,000 miles later.\r\nThe only medieval traveler known to have visited the lands of every Muslim ruler of his time, Ibn Battuta was born into a family of highly respected religious judges and educated as a theologian. Leaving his native city of Tangier in 1326, he traveled — over the next several years — to East Africa, Byzantium, Iraq, southern Russia, India, Ceylon, and China. His account of the journey, dictated on his return, not only provides vivid accounts of an odyssey that took him to exotic lands, but also describes in great detail Muslim maritime activities in the Middle and Far East, fascinating elements of foreign architecture, and agricultural activities of diverse cultures.\r\nA rare and important work covering the geography and history of the medieval Arab world, this primary sourcebook will be welcomed by students and scholars for its inherent historical value', 'images/ibnbattuta.jpg', 80, 10, 4),
(9, 'خوف', 'اسامه المسلم', 2015, '9789177877615', 'وهناك من يرى أن في أفكاري خطرًا كبيرًا على الجيل الصاعد وكأن هذا الجيل خلق ليصعد على سلم مبادئه فقط. حرية التفكير جزء لا يتجزأ من حرية التعبير لذلك كانت هذه «الرواية » ضمن مجموعة الخيال العلمي فهي بذلك ستكسب قبولً أكثر كونها مصنفة كمجرد أضغاث أفكار.', 'images/khawf.jpg', 40, 20, 8),
(11, 'L\\\'Alchimiste', 'Paulo Coelho', 2004, '9782843372575', ' Mon tueur craint de souffrir, dit le jeune homme à l\\\'alchimiste, une nuit qu\\\'ils regardaient le ciel sans lune. - Dis-lui que la crainte de la souffrance est pire que la souffrance elle-même. Et qu\\\'aucun cœur n\\\'a jamais souffert alors qu\\\'il était à la poursuite de ses rêves. L\\\'Alchimiste est le récit d\\\'une quête, celle de Santiago, un jeune berger andalou parti à la recherche d\\\'un trésor enfoui au pied des Pyramides. Dans le désert, initié par l\\\'alchimiste, il apprendra à écouter son cœur, à lire les signes du destin et, par-dessus tout, à aller au bout de son rêve. Destiné à l\\\'enfant que chaque être cache en soi, L\\\'Alchimiste est un merveilleux conte philosophique, due l\\\'on compare souvent, au Petit Prince, de Saint Exupéry, et à Jonathan Livingston le Goéland, de Richard Bach.', 'images/lalchimiste.jpg', 30, 15, 3),
(12, 'The Da Vinci Code', 'Dan Brown', 2003, '9780385504201', 'Harvard symbologist Robert Langdon and French cryptologist Sophie Neveu work to solve the murder of an elderly curator of the Louvre, a case which leads to clues hidden in the works of Da Vinci and a centuries-old secret society.', 'images/the_da_vinci_code.jpg', 70, 10, 3),
(13, 'The Orion Mystery', 'Bauval Robert, Gilbert Adrian', 1994, '9780307558862', 'The Orion Mystery: Unlocking the Secrets of the Pyramids.\r\nA revolutionary book that explains the most enigmatic and fascinating wonder of the ancient world: the Pyramids of Egypt.', 'images/the_orion_mystery.jpg', 40, 10, 4),
(14, 'تحفة النظار في غرائب الأمصار وعجائب الأسفار', 'ابن بطوطة', 1484, '-------------', 'يُعَدُّ هذا الكتابُ من أشهرِ كُتبِ الرِّحلاتِ في التاريخ؛ فقد عُرِفَ «ابن بطوطة» بكثرةِ أَسْفاره، وبسببِ شُهرتِه العالميةِ لقَّبَته «جمعيةُ كامبريدج» ﺑ «أمير الرحَّالةِ المُسلمِين». بدأَ «ابن بطوطة» رِحلتَه من «طنجة» مَسقطِ رأسِه؛ ناويًا حجَّ بيتِ اللهِ الحرام، ورحَلَ دونَ رفيقٍ ولا قَرِيب، واتخذَ في كلِّ مدينةٍ وقَفَ فيها صاحبًا، فحكى عنه وعن المدينةِ التي قابَلَه فيها. قُدِّرَ زمنُ رِحلاتِه بما يَقربُ من الثلاثينَ عامًا، وقد أَمْلى على «ابن جزي الكلبي» تَفاصيلَ تلكَ الرِّحلاتِ ونَوادرَها، وبعدَما انتهى منَ التدوينِ أطلَقَ على مؤلَّفِه هذا اسمَ: «تُحْفة النُّظَّارِ في غرائبِ الأَمْصارِ وعجائبِ الأَسْفار». لم يَكْتفِ «ابن بطوطة» بالوصفِ الخارجيِّ للأماكنِ التي زارَها، بل استفاضَ في الحديثِ عن مَداخلِ المدنِ ومَخارِجِها وطَبائعِ الشعوبِ المُختلِفةِ التي عاشَرَها، وسرَدَ العديدَ منَ الحِكاياتِ المشوِّقةِ التي جعَلَتْه من رُوَّادِ أدبِ الرحلاتِ في الأدبِ العربي، حتى إنَّنا لا نَستطيعُ الإشارةَ إلى شخصٍ كثيرِ التَّرْحالِ دونَ أن نلقِّبَه ﺑ «ابن بطوطة».', 'images/tohfat_nnidar_ibnBattuta.jpg', 60, 50, 4),
(15, 'Business Vocabulary in Use', 'Bill Mascull', 2017, '13166299881', 'Business Vocabulary in Use: Intermediate, 3rd Edition.\r\nThe words you need to communicate with confidence in business today.  Vocabulary explanations and practice for intermediate (B1 to B2) students and professionals looking to improve their knowledge and use of business English.', 'images/business_vocab_in_use.jpg', 40, 10, 6),
(16, 'Le Bourgeois gentilhomme', 'Molière', 1670, '9782253093619', 'Monsieur Jourdain prétend sortir de sa condition bourgeoise en singeant les manières d&#039;un noble. Mais, avec une naïveté qui n&#039;a d&#039;égale que sa prétention, il se laisse duper par l&#039;apparence d&#039;un hôte qu&#039;on lui présente comme le fils du Grand Turc et auquel il destine sa fille.', 'images/le_bourgeois_gentilhomme.jpg', 85, 30, 7),
(17, 'Prisoners of Geography', 'Tim Marshall', 2016, '9781783962433', 'Prisoners of Geography: Ten Maps That Tell You Everything You Need to Know About Global Politics', 'images/prisoners_of_geography.jpg', 90, 15, 9),
(18, 'Mao\\\'s Crusade', 'Alfred L. Chan', 2001, '9780199244065', 'Mao\\\'s Crusade: Politics and Policy Implementation in China\\\'s Great Leap Forward\r\nChan\\\'s exhaustive research, using new material made available in the post-Mao era as well as archives from the 1950s and 1960s, has yielded novel insights into Mao, central decision-making, and policy implementation in the communist hierarchy.', 'images/maos_crusade.jpg', 90, 10, 9),
(19, 'Tout couscous', 'Sophie Brissaud', 2009, '9782830711318', 'Le couscous est un plat d&#039;Afrique du Nord, d&#039;origine berbère, populaire dans de nombreux pays. Au sens strict, le couscous est la graine obtenue par agglomération de semoule de blé dur (fine, moyenne ou grosse). Il peut aussi accompagner ragoûts, sauces, rôtis, grillades, poissons, etc., ou être consommé &quot;sec&quot;, sucré, aromatisé, garni de fruits, d&#039;amandes ou de miel.Cet ouvrage présente un tour du monde des couscous : Maghreb, Afrique subsaharienne, pays arabes, Sardaigne, Brésil... à travers 30 recettes savoureuses à base de viande, de poisson ou de légumes : Couscous de blé complet aux petits pois et aux fèves, Cuscusù sicilien aux poissons et aux fruits de mer, Attiéké au poulet braisé... et le très original Couscous de chou-fleur à l&#039;orange et aux pignons à base de semoule... de chou-fleur !Sophie Brissaud livre 30 recettes faciles, conviviales, avec des ingrédients à portée de main. Simple et bon marché, le couscous ne manque pas de satisfaire à toutes les exigences de goût et de santé.', 'images/tout_couscous.jpg', 30, 20, 13),
(20, 'إقرأ', 'احمد بوكماخ', 1958, '-------------', 'اقرا ,لاحمد بوكماخ الجزء الاول', 'images/iqraa.jpg', 30, 30, 12),
(21, 'فيزياء المستحيل', 'Michio Kaku', 2013, '9780385520690', 'Physics of the Impossible: A Scientific Exploration Into the World of Phasers, Force Fields, Teleportation, and Time Travel\r\nكتاب فيزياء المستحيل تأليف ميتشيو كاكو، يبدأ ميشيو كاكو كتابه الممتع بهذه العبارة &quot;أي شيء غير مستحيل فهو ممكن !&quot;. يأخذنا المؤلف في هذا الكتاب في رحلة نستكشف فيها تلك المناطق الرمادية الأكثر إثارة في الفيزياء.\r\nصنف كاكو التقانات المستحيلة في الفيزياء إلى ثلاثة أصناف: تقانات مستحيلة اليوم لكنها لا تناقض القوانين المعروفة في الفيزياء، ومن ثم فهي ممكنة في هذا القرن أو الذي يليه، وهي تشمل النقل الفوري البعيد ومحركات مضاد المادة والتخاطر عن بُعد والتحريك بتأثير الدماغ والاحتجاب عن الرؤية.', 'images/fizya2_almostahil.jpg', 160, 40, 10);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `label` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `label`) VALUES
(1, 'biographie'),
(2, 'philosophie'),
(3, 'fiction'),
(4, 'histoire'),
(5, 'BD'),
(6, 'business'),
(7, 'comedie'),
(8, 'fantaisie'),
(9, 'politique'),
(10, 'science'),
(11, 'informatique'),
(12, 'education'),
(13, 'cuisine');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_c` datetime NOT NULL,
  `date_l` date NOT NULL,
  `prix_t` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `book_id`, `user_id`, `date_c`, `date_l`, `prix_t`) VALUES
(9, 7, 5, '2024-06-23 22:34:53', '2024-06-26', 75),
(11, 3, 3, '2024-06-23 22:47:51', '2024-06-26', 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` varchar(300) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `role_` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `adresse`, `tel`, `email`, `pwd`, `role_`) VALUES
(2, 'Zaki', 'Amina', 'Rue de la République, Lyon, France', '(33)600-112233', 'amounazaki18@gmail.com', '$2y$10$FA.Y4wPNVt6z0mOSvxp.NeN/JfFAA7ego2qzBFUJx9aGh3m/YDtOW', 'user'),
(3, 'Rajany', 'Aya', 'Projet BIRANZARAN IMM AS ETAGE3', '(212)626-332862', 'ayatyhany@gmail.com', '$2y$10$jL.dU6hKrJGrp33VPVDNYOHsFFaHRorSbPESVLIhnmTFlm/7BUAFW', 'user'),
(4, 'Admin', '1', 'madrasti lhilwa', '(212)697-0853', 'jesuis@admin.com', '$2y$10$1sdYfVmuYbbZKYJQN2hphOWwuHLp.mVMm2gQi2xKJCNqhBqwf.FR.', 'admin'),
(5, 'Elhamdani', 'Jihane', 'Bourgone Casablanca', '(212)649-442921', 'jihaneelhamdani@gmail.com', '$2y$10$.ZFuCxQsxLXFO5.e1Z8M4eYmIXAOAXKJsiURq.vdmOealUeH8fzom', 'user'),
(6, 'Monsieur', 'Propre', 'Mr Propre Land', '(212)646-325862', 'mrpropreest@admin.com', '$2y$10$pfPKLJEr1l9f3yY9e.aUc.QdYmDvaJTmnfJ.1YFqGcpUGapeJRBl2', 'admin'),
(7, 'Diyae', 'Rajany', 'Casablanca', '(212)697-085345', 'diyaeest@admin.com', '$2y$10$MSY63KYyyLa3RMQt.E2ej.cwU1PK2wLDIPC98VGqBR6JPu.CAh7SW', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
