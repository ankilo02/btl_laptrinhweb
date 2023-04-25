-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: onlineshop
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_info`
--

DROP TABLE IF EXISTS `admin_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_info` (
  `admin_id` int NOT NULL,
  `admin_name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `admin_email` varchar(300) COLLATE utf8mb3_unicode_ci NOT NULL,
  `admin_password` varchar(300) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_info`
--

LOCK TABLES `admin_info` WRITE;
/*!40000 ALTER TABLE `admin_info` DISABLE KEYS */;
INSERT INTO `admin_info` VALUES (1,'admin','admin@gmail.com','$2y$10$xNbzNLNimGINJJZuOJSvY.hWMzOie70Cq3Xq4zJTbZZPGxLEBSRm6');
/*!40000 ALTER TABLE `admin_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_title` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Nhã Nam'),(2,'Kim Đồng'),(3,'Trẻ'),(4,'MCBooks'),(5,'O’Reilly'),(6,'1980 Books');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_title` text COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Tiểu thuyết'),(2,'Truyện tranh'),(3,'Ngoại ngữ'),(4,'Kỹ năng sống'),(5,'Lập trình'),(6,'Khoa học'),(7,'Kinh điển');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_products` (
  `order_pro_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int DEFAULT NULL,
  PRIMARY KEY (`order_pro_id`),
  KEY `product_id_idx` (`product_id`),
  KEY `order_id_idx` (`order_id`),
  CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders_info` (`order_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_info`
--

DROP TABLE IF EXISTS `orders_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_info` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `date` varchar(45) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_info`
--

LOCK TABLES `orders_info` WRITE;
/*!40000 ALTER TABLE `orders_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_cat` int NOT NULL,
  `product_brand` int NOT NULL,
  `product_title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_price` int NOT NULL,
  `product_desc` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_image` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_keywords` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_rating` float DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `product_brand_idx` (`product_brand`),
  KEY `product_cat_idx` (`product_cat`),
  CONSTRAINT `product_brand` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`),
  CONSTRAINT `product_cat` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,'Cây cam ngọt của tôi',108000,'Hãy làm quen với Zezé, cậu bé tinh nghịch siêu hạng đồng thời cũng đáng yêu bậc nhất, với ước mơ lớn lên trở thành nhà thơ cổ thắt nơ bướm. Chẳng phải ai cũng công nhận khoản “đáng yêu” kia đâu nhé. Bởi vì, ở cái xóm ngoại ô nghèo ấy, nỗi khắc khổ bủa vây đã che mờ mắt người ta trước trái tim thiện lương cùng trí tưởng tượng tuyệt vời của cậu bé con năm tuổi.\n        Có hề gì đâu bao nhiêu là hắt hủi, đánh mắng, vì Zezé đã có một người bạn đặc biệt để trút nỗi lòng: cây cam ngọt nơi vườn sau. Và cả một người bạn nữa, bằng xương bằng thịt, một ngày kia xuất hiện, cho cậu bé nhạy cảm khôn sớm biết thế nào là trìu mến, thế nào là nỗi đau, và mãi mãi thay đổi cuộc đời cậu.\n        Mở đầu bằng những thanh âm trong sáng và kết thúc lắng lại trong những nốt trầm hoài niệm, Cây cam ngọt của tôi khiến ta nhận ra vẻ đẹp thực sự của cuộc sống đến từ những điều giản dị như bông hoa trắng của cái cây sau nhà, và rằng cuộc đời thật khốn khổ nếu thiếu đi lòng yêu thương và niềm trắc ẩn. Cuốn sách kinh điển này bởi thế không ngừng khiến trái tim người đọc khắp thế giới thổn thức, kể từ khi ra mắt lần đầu năm 1968 tại Brazil.','caycamngotcuatoi.jpg','cay cam ngot cua toi',0),(2,1,3,'Cho tôi xin một vé đi tuổi thơ',80000,'Truyện Cho tôi xin một vé đi tuổi thơ là sáng tác mới nhất của nhà văn Nguyễn Nhật Ánh. Nhà văn mời người đọc lên chuyến tàu quay ngược trở lại thăm tuổi thơ và tình bạn dễ thương của 4 bạn nhỏ. Những trò chơi dễ thương thời bé, tính cách thật thà, thẳng thắn một cách thông minh và dại dột, những ước mơ tự do trong lòng… khiến cuốn sách có thể làm các bậc phụ huynh lo lắng rồi thở phào. Không chỉ thích hợp với người đọc trẻ, cuốn sách còn có thể hấp dẫn và thực sự có ích cho người lớn trong quan hệ với con mình.','chotoixinmotvedituoitho.jpg','cho toi xin mot ve di tuoi tho',0),(3,1,2,'Gambit Hậu',125000,'Gambit Hậu là câu chuyện về cuộc đời của Elizabeth Harmon, một thần đồng cờ vua nước Mĩ. Từ sau khi học được trò chơi này thông qua người lao công của trại trẻ mồ côi, cô bé Beth 8 tuổi đã bắt đầu phát triển tình yêu và sự say mê vô tận với những ván cờ phức tạp trong tâm trí. Khi lớn lên, tài năng của Beth ngày càng nở rộ thông qua các chuyến du đấu. Một cô bé mười ba tuổi quyết liệt giành chiến thắng trước những đấu thủ người lớn có đẳng cấp kiện tướng. Một cô gái bé nhỏ nhưng kiên cường trong thế giới cờ vua của đàn ông tràn ngập phân biệt giới tính.\n        Nhưng Gambit Hậu không chỉ là những trận cờ kịch tính mà còn là câu chuyện đời xúc động của Beth. Khi không còn ánh sáng sân khấu, ống kính phóng viên hay khán giả theo dõi, Beth chìm trong bóng tối của sự cô độc, bầu bạn cùng thuốc an thần và men rượu. Gambit Hậu hấp dẫn với những ván cờ căng não để chờ xem quân Trắng hay Đen giành chiến thắng, song song đó, còn là “ván cờ” đầy thăng trầm của riêng mình Beth.\n        Liệu ý chí hay sự tự hủy hoại bản thân của cô sẽ giành chiến thắng? Hãy cùng lật mở cuốn sách này để bước vào câu chuyện cuộc đời của thiên tài cờ vua Elizabeth Harmon, bạn nhé!','queengambit.jpg','queen gambit',0),(4,1,1,'Phía sau nghi can X',109000,'Khi nhấn chuông cửa nhà nghi can chính của một vụ án mới, điều tra viên Kusanagi không biết rằng anh sắp phải đương đầu với một thiên tài ẩn dật. Kusanagi càng không thể ngờ rằng, chỉ một câu nói vô thưởng vô phạt của anh đã kéo người bạn thân, Manabu Yukawa, một phó giáo sư vật lý tài năng, vào vụ án. Và điều làm sững sờ nhất, đó là vụ án kia chẳng qua cũng chỉ như một bài toán cấp ba đơn giản, tuy nhiên ấn số X khi được phơi bày ra lại không đem đến hạnh phúc cho bất cứ ai…\n        Với một giọng văn tỉnh táo và dung dị, Higashino Keigo đã đem đến cho độc giả hơn cả một cuốn tiểu thuyết trinh thám. Mô tả tội ác không phải điều hấp dẫn nhất ở đây, mà còn là những giằng xé nội tâm thầm kín, những nhân vật bình dị, và sự quan tâm sâu sa tới con người. Tác phẩm đã đem lại cho Higashino Keigo Giải Naoki lần thứ 134, một  giải thưởng văn học lâu đời sánh ngang giải Akutagawa tại Nhật.','phiasaunghicanx.jpg','phia sau nghi can x',0),(5,1,1,'Điều Kỳ Diệu Của Tiệm Tạp Hóa NAMIYA',105000,'Một đêm vội vã lẩn trốn sau phi vụ khoắng đồ nhà người, Atsuya, Shota và Kouhei đã rẽ vào lánh tạm trong một căn nhà hoang bên con dốc vắng người qua lại. Căn nhà có vẻ khi xưa là một tiệm tạp hóa với biển hiệu cũ kỹ bám đầy bồ hóng, khiến người ta khó lòng đọc được trên đó viết gì. Định bụng nghỉ tạm một đêm rồi sáng hôm sau chuồn sớm, cả ba không ngờ chờ đợi cả bọn sẽ là một đêm không ngủ, với bao điều kỳ bí bắt đầu từ một phong thư bất ngờ gửi đến…\n\n        Tài kể chuyện hơn người đã giúp Keigo khéo léo thay đổi các mốc dấu thời gian và không gian, chắp nối những câu chuyện tưởng chừng hoàn toàn riêng rẽ thành một kết cấu chặt chẽ, gây bất ngờ từ đầu tới cuối.','namiya.jpg','dieu ki dieu cua tiem tap hoa namiya',0),(6,1,3,'Cánh đồng bất tận',68400,'Cánh đồng bất tận\" bao gồm những truyện hay nhất của nhà văn Nguyễn Ngọc Tư. Đây là tác phẩm đang gây xôn xao trong đời sống văn học, bởi ở đó người ta tìm thấy sự dữ dội, khốc liệt của đời sống thôn dã qua cái nhìn của một cô gái. Bi kịch về nỗi mất mát, sự cô đơn được đẩy lên đến tận cùng, khiến người đọc có lúc cảm thấy nhói','canhdongbattan.png','canh dong bat tan',0),(7,1,2,'Giữ gìn 36 phố phường',65000,'Riêng đối với Hà Nội, sự nghiệp văn chương của Tô Hoài là một kho báu. Nhờ Tô Hoài, một người chưa biết Hà Nội chỉ đọc các sách của ông về chốn kinh thành này thôi đã đủ để hiểu Hà Nội là gì và thế nào. Nhờ ông, các thế hệ mai sau muốn tìm hiểu, muốn phục dựng, muốn làm lịch sử, nghệ thuật về Hà Nội đều có tư liệu của một chứng nhân đáng tin cậy. Nhờ ông, phần xác và phần hồn của Hà Nội hiện tại không bị cắt lìa với quá khứ và những ai biết đọc ông sẽ hiểu Hà Nội hơn, yêu Hà Nội hơn và biết đối xử với Hà Nội có văn hóa hơn. (Phạm Xuân Nguyên)','giugin36phophuong.jpg','giu gin 36 pho phuong',0),(8,1,1,'Rừng Nauy',150000,'Câu chuyện bắt đầu từ một chuyến bay trong ngày mưa ảm đạm, một người đàn ông 37 tuổi chợt nghe thấy bài hát gắn liền với hình ảnh người yêu cũ, thế là quá khứ ùa về xâm chiếm thực tại. Mười tám năm trước, người đàn ông ấy là chàng Toru Wanatabe trẻ trung, mỗi chủ nhật lại cùng nàng Naoko lang thang vô định trên những con phố Tokyo. Họ sánh bước bên nhau để thấy mình còn sống, còn tồn tại, và gắng gượng tiếp tục sống, tiếp tục tồn tại sau cái chết của người bạn cũ Kizuki. Cho đến khi Toru nhận ra rằng mình thực sự yêu và cần có Naoko thì cũng là lúc nàng không thể chạy trốn những ám ảnh quá khứ, không thể hòa nhập với cuộc sống thực tại và trở về dưỡng bệnh trong một khu trị liệu khép kín. Toru, bên cạnh giảng đường vô nghĩa chán ngắt, bên cạnh những đêm chơi bời chuyển từ cảm giác thích thú đến uể oải, ghê tởẫn kiên nhẫn chờ đợi và hy vọng vào sự hồi phục của Naoko. Cuối cùng, những lá thư, những lần thăm hỏi, hồi ức về lần ân ái duy nhất của Toru không thể níu Naoko ở lại, nàng chọn cái chết như một lối đi thanh thản. Từ trong mất mát, Toru nhận ra rằng mình cần tiếp tục sống và bắt đầu tình yêu mới với Midori.','rungnauy.jpg','rung nauy',0),(9,1,1,'Chiến binh cầu vồng',109000,'Trong ngày khai giảng, nhờ sự xuất hiện vào phút chót của cậu bé thiểu năng trí tuệ Harun, trường Muhammadiyah may mắn thoát khỏi nguy cơ đóng cửa. Nhưng ước mơ dạy và học trong ngôi trường Hồi giáo ấy liệu sẽ đi về đâu, khi ngôi trường xập xệ dường như sẵn sàng sụp xuống bất cứ lúc nào, khi lời đe dọa đóng cửa từ viên thanh tra giáo dục luôn lơ lửng trên đầu, khi những cỗ máy xúc hung dữ đang chực chờ xới tung ngôi trường để dò mạch thiếc…? Và liệu niềm đam mê học tập của những Chiến binh Cầu vồng đó có đủ sức chinh phục quãng đường ngày ngày đạp xe bốn mươi cây số, rồi đầm cá sấu lúc nhúc bọn ăn thịt người, chưa kể sự mê hoặc từ những chuyến phiêu lưu chết người theo tiếng gọi của ngài pháp sư bí ẩn trên đảo Hải Tặc, cùng sức cám dỗ khôn cưỡng từ những đồng tiền còm kiếm được nhờ công việc cu li toàn thời gian\n\n        Chiến binh Cầu vồng có cả tình yêu trong sáng tuổi học trò lẫn những trò đùa tinh quái, cả nước mắt lẫn tiếng cười, một bức tranh chân thực về hố sâu ngăn cách giàu nghèo, một tác phẩm văn học cảm động truyền tải sâu sắc nhất ý nghĩa đích thực của việc làm thầy, việc làm trò và việc học.','chienbinhcauvong.jpg','chien binh cau vong',0),(10,2,2,'One Piece Tập 1: Romance Dawn - Bình Minh Của Cuộc Phiêu Lưu',25000,'One Piece (Vua Hải Tặc) bộ truyện thuộc thể loại truyện tranh hành động kể về một cậu bé tên Monkey D. Luffy, giong buồm ra khơi trên chuyến hành trình tìm kho báu huyền thoại One Piece và trở thành Vua hải tặc. Để làm được điều này, cậu phải đến được tận cùng của vùng biển nguy hiểm và chết chóc nhất thế giới: Grand Line (Đại Hải Trình). Luffy đội trên đầu chiếc mũ rơm như một nhân chứng lịch sử vì chiếc mũ rơm đó đã từng thuộc về hải tặc hùng mạnh: Hải tặc vương Gol. D. Roger và tứ hoàng Shank \"tóc đỏ\". Luffy lãnh đạo nhóm hải tặc Mũ Rơm qua East Blue (Biển Đông) và rồi tiến đến Grand Line. Cậu theo dấu chân của vị vua hải tặc quá cố Gol. D. Roger, chu du từ đảo này sang đảo khác để đến với kho báu vĩ đại.','onepiece1.jpg','one piece 1',0),(11,2,3,'Tokyo Revengers Tập 1',115000,'Tokyo Manji là băng nhóm tội phạm khét tiếng, đến cảnh sát cũng phải bó tay. Băng này đã cướp đi mạng sống của Hinata, người bạn gái thời cấp hai, cũng là người yêu duy nhất trong cuộc đời Takemichi.\n\n        Takemichi sống trong căn phòng trọ tường mỏng rớt, bị quản lý ít tuổi hơn sai phái đủ đường, đã thế còn chưa thoát kiếp trai tân… Và cái chết của người bạn gái cũ đã đưa cậu du hành thời gian về 12 năm trước!\n\n        Để cứu Hinata, đồng thời thay đổi cuộc đời phải trốn chạy liên miên, Takemichi thề sẽ trả thù “băng nhóm hiểm ác nhất vùng Kanto”, Tokyo Manji!','tokyorevenger1.jpg','tokyo revengers 1',0),(12,2,2,'Chú Thuật Hồi Chiến: Tập 1',30000,'Itadori Yuji là một học sinh cấp Ba sở hữu năng lực thể chất phi thường. Hằng ngày cậu thường tới bệnh viện chăm người ông đang ốm liệt giường. Nhưng một ngày nọ, phong ấn của “chú vật” vốn ngủ yên trong trường bị phá giải, quái vật xuất hiện. Để cứu hai anh chị khóa trên đang gặp nguy hiểm, Itadori đã xông vào trường và Phần chính truyện của CHÚ THUẬT HỒI CHIẾN - Series bom tấn đã bán ra hơn 30 triệu bản tại Nhật năm 2021, bắt đầu…!!','jujutsukaisen1.jpg','chu thuat hoi chien jujutsu kaisen 1',0),(13,2,2,'Thám Tử Lừng Danh Conan Tập 1',20000,'Kudo Shinichi, 17 tuổi, là một thám tử học sinh trung học phổ thông rất nổi tiếng, thường xuyên giúp cảnh sát phá các vụ án khó khăn. Trong một lần khi đang theo dõi một vụ tống tiền, cậu đã bị thành viên của Tổ chức Áo đen bí ẩn phát hiện. Chúng đánh gục Kudo Shinichi, làm cậu bất tỉnh và ép cậu uống loại thuốc độc APTX - 4869 mà Tổ chức vừa điều chế nhằm bịt đầu mối. Tuy vậy, thứ thuốc ấy không giết chết cậu mà lại gây ra tác dụng phụ khiến cậu teo nhỏ thành một đứa trẻ khoảng 6 tuổi. Sau đó, cậu tự xưng là Edogawa Conan và được Mori Ran - cô bạn thân thời thơ ấu của cậu khi còn là Kudo Shinichi - nhận nuôi và mang về văn phòng thám tử của bố cô là Mori Kogoro. Xuyên suốt series, Conan đã âm thầm hỗ trợ ông Mori phá các vụ án. Đồng thời cậu cũng phải nhập học lớp 1 Tiểu học, nhờ đó mà kết thân với nhiều người và lập ra Đội thám tử nhí.','conan1.jpg','conan 1',0),(14,2,3,'Anh Em Phi Hành Gia Tập 1',45000,'Từ nhỏ, hai anh em Mutta và Hibito đã có niềm đam mê bất tận đối với vũ trụ. Trong những lần quan sát bầu trời đêm, họ đã cùng nhau ước mơ trở thành những phi hành gia, đặt chân lên những vì sao xa xôi đầy huyền ảo trên kia.\n\n        Cũng như bao ước mơ khác, giấc mộng thám hiểm vũ trụ đòi hỏi một niềm khát khao cùng nỗ lực phi thường. Vậy nên xuyên suốt bộ truyện là một thông điệp duy nhất: “Con đường đến với vinh quang chỉ được dựng nên bởi mồ hôi và nước mắt”.','anhemphihanhgia1.jpeg','anh em phi hanh gia 1',0),(15,2,2,'SPY X FAMILY TẬP 1',25000,'Nhằm ngăn chặn âm mưu gây chiến, giữ vững nền hòa bình Đông - Tây, điệp viên hàng đầu của Westalis, Twilight phải xây dựng một gia đình và cho con theo học tại học viện danh giá nhất\r\n\r\n        Ostania hòng tiếp cận yếu nhân cầm đầu phe chủ chiến của đất nước này: Desmon Donavan! Và thật tình cờ, đứa trẻ mà Twilight nhận làm &quot;con&quot; ở cô nhi viện, Anya, lại có khả năng đọc suy nghĩ của người khác. Chưa kể &quot;người vợ&quot; anh buộc phải chọn lựa trong lúc vội vàng, Yor, lại là một… sát thủ!! Ba người với lí do riêng để che giấu thân phận đã cùng chung sống với nhau dưới một mái nhà. Từ đây câu chuyện siêu hấp dẫn và hài hước về gia đình điệp viên chính thức mở !!','1670377865_spyxfamily.jpg','gia',0),(16,3,4,'Tiếng Hàn tổng hợp dành cho người Việt Nam Sơ cấp 1',150000,'2 cuốn sách trong bộ Sơ cấp được xây dựng với 30 bài khóa và bảng chữ cái. Trong đó quyển 1 gồm phần bảng chữ cái và 15 bài đầu. Học hết quyển 1, bạn sẽ học đến quyển sơ cấp 2 với 15 bài còn lại.','korean1.jpg','giao trinh tieng han so cap 1',0),(17,3,4,'Combo Giáo Trình Hán Ngữ Tập 1 (Quyển Thượng Và Quyển Hạ)',180000,'Giáo trình Hán ngữ tập 1 Quyển Thượng bao gồm 15 bài học, mỗi bài học bao gồm: bài khóa, từ mới, chú thích, ngữ pháp, ngữ âm và luyện tập những kiến thức đã học.\n        Giáo trình Hán ngữ tập 1- Quyển Hạ cũng gồm 15 bài học, nhưng có độ khó cao hơn so với quyển Thượng.','china.jpg','giao trinh tieng trung 1',0),(18,3,4,'Mindmap English Grammar - Ngữ Pháp Tiếng Anh Bằng Sơ Đồ Tư Duy',210000,'Bạn cũng biết rằng ngữ pháp tiếng Anh là nền tảng cho các kỹ năng nghe - nói -đọc -viết, nhưng lại thật khó nhớ vì ngữ pháp có quá nhiều kiến thức khô khan, cấu trúc cứng nhắc, giải thích dài dòng. Giờ đây với cuốn sách bạn đang cầm trên tay, bạn sẽ được trải nghiệm một phương pháp học ngữ pháp rất dễ dàng và thú vị. Toàn bộ kiến thức ngữ pháp được thiết kế dưới dạng sơ đồ tư duy Mind map kết hợp với hình ảnh sinh động, giải thích cách sử dụng qua những từ khóa chính giúp bạn ghi nhớ nhanh và hiệu quả hơn. Cuốn sách không chỉ giúp bạn chinh phục ngữ pháp tiếng anh cấp tốc mà còn giúp bạn phát triển khả năng tư duy sáng tạo. Hãy học tập và trải nghiệm!','english.jpg','tieng anh english so do tu duy',0),(19,3,4,'The True IELTS Guide - Lộ Trình Học Ielts Cho Người Mới Bắt Đầu',239000,'Cuốn sách The True IELTS Guide 1 là cuốn sách hướng dẫn lộ trình học IELTS cho người mới bắt đầu. Dù bạn là người đã từng hay chưa từng học Tiếng Anh, đã biết hay chưa hiểu rõ về kỳ thi IELTS đều có thể tìm thấy những kiến thức hữu ích từ cuốn sách này.\n\n        Cuốn sách này nằm trong bộ sách được đặt tên là “The True Self-Study Guide for IELTS” vì chúng tôi muốn đem lại cho bạn một lộ trình tự học THẬT nhất có thể. Chúng tôi KHÔNG tin có bất cứ một con đường tắt nào trong việc chinh phục kỳ thi IELTS bởi nếu IELTS là một kỳ thi mà chỉ cần có mẹo là được điểm cao thì có lẽ nó đã không được tin tưởng để trở thành thước đo đánh giá trình độ Tiếng Anh trên toàn thế giới như hiện nay.','ielts.jpg','ielts guide cho nguoi moi bat dau',0),(20,3,4,'Joyful Chinese - Vui Học Tiếng Trung - Giao Tiếp',120000,'Tiếng Trung đang ngày càng được sử dụng phổ biến trong cuộc sống hàng ngày, trong công việc và giảng dạy tại nhiều trường học trên cả nước. Tuy nhiên, không giống như tiếng Anh, hầu hết các bạn học tiếng Trung đều bắt đầu học khi đã lớn và gặp không ít những khó khăn trong quá trình phát âm và giao tiếp tiếng Trung.','china2.jpg','vui hoc tieng trung joyful chinese',0),(21,4,6,'Tư duy logic',110000,'Tư Duy Logic Kanbe - nhân vật chính trong cuốn sách TƯ DUY LOGIC, vào những năm cuối tuổi 20 của cuộc đời, một ngày cô chợt nhận ra, trong khi các bạn cùng trang lứa với cô đã và đang gặt hái nhiều thành công thì bản thân cô đang dần chững lại trong sự nghiệp. Sau một thời gian suy nghĩ, cô quyết định từ bỏ công việc hiện tại, đi học thêm bằng MBA và đầu quân cho một công ty. Một chương mới tươi sáng hơn được mở ra, và tất cả bắt nguồn từ việc thay đổi nhận thức và tư duy của cô gái trẻ. Cuốn sách đã cho bạn đọc nhận thấy, sức mạnh của tư duy là chìa khóa phát triển cá nhân và hoạch định công việc hiệu quả.','tuduylogic.jpeg','tu duy logic',0),(22,4,6,'Rèn Luyện Tư Duy Phản Biện',99000,'Như bạn có thể thấy, chìa khóa để trở thành một người có tư duy phản biện tốt chính là sự tự nhận thức. Bạn cần phải đánh giá trung thực những điều trước đây bạn nghĩ là đúng, cũng như quá trình suy nghĩ đã dẫn bạn tới những kết luận đó. Nếu bạn không có những lý lẽ hợp lý, hoặc nếu suy nghĩ của bạn bị ảnh hưởng bởi những kinh nghiệm và cảm xúc, thì lúc đó hãy cân nhắc sử dụng tư duy phản biện! Bạn cần phải nhận ra được rằng con người, kể từ khi sinh ra, rất giỏi việc đưa ra những lý do lý giải cho những suy nghĩ khiếm khuyết của mình. Nếu bạn đang có những kết luận sai lệch này thì có một sự thật là những đức tin của bạn thường mâu thuẫn với nhau và đó thường là kết quả của thiên kiến xác nhận, nhưng nếu bạn biết điều này, thì bạn đã tiến gần hơn tới sự thật rồi!','tuduyphanbien.jpg','tu duy phan bien',0),(23,4,3,'Tư duy sáng tạo',110000,'Nếu bạn là một thiên tài với óc sáng tạo phi thường thì xin chúc mừng; quyển sách này không dành cho bạn. Nhưng nếu bạn không phải là thiên tài như thế thì có lẽ đây là quyển sách bạn cần đấy. \"Tư duy sáng tạo: Làm chủ 6 kỹ năng khơi nguồn đổi mới\" phù hợp với tất cả đối tượng độc giả, từ những cá nhân đang tìm cách thay đổi cuộc sống đến những nhà lãnh đạo muốn truyền năng lượng cho người khác bằng các công cụ và phương pháp sáng tạo để tạo nên sự đổi mới. Tất cả chúng ta đều có thể học cách trở nên sáng tạo. Từ kế toán đến nhà động vật học, tất cả đều có thể sử dụng \"Tư duy sáng tạo\" như một tấm bản đồ cá nhân, một cẩm nang thực địa bổ ích. Trong quyển sách này, cùng với những bài thực hành lý thú, bạn sẽ được giới thiệu 6 kỹ năng tư duy sáng tạo cần thiết mà ai cũng có thể dễ dàng thành thạo và ghi nhớ gồm Làm rõ, Sao chép, Mở rộng, Liên tưởng, Chuyển đổi, Đánh giá. Đây là sáu thuật ngữ đã được cẩn thận lựa chọn để làm chìa khóa mở cửa tư duy sáng tạo. Chúng là tấm bản đồ dẫn lối bạn từ chỗ đề ra sáng kiến đến đạt được kết quả. Sáu kỹ năng này là thành quả từ sự đúc kết, tổng hợp, giản lược công trình nghiên cứu về tư duy sáng tạo, cộng với 30 năm hoạt động thực tế trong các tổ chức tân tiến hàng đầu thế giới.','tuduysangtao.jpg','tu duy sang tao',0),(24,4,6,'Quản lý năng lượng cá nhân trong công việc',159000,'Trong cuốn sách này, Marc Effron - chuyên gia về quản lý tài năng và tác giả sác bán chạy, với cách tiếp cận đặc trưng vô cùng đơn giản lấy khoa học làm nền tảng, xác định những yếu tố quan trọng nhất và chỉ cho chúng ta thấy làm thế nào để tận dụng tối ưu thời gian và năng lượng cá nhân để cải thiện và đẩy bật hiệu suất. Rõ ràng hiệu suất cao là kết quả cuối cùng từ tổng hợp nhiều yếu tố, và một vài yếu tố trong đó nằm ngoài khả năng kiểm soát hay thay đổi của chúng ta. Effon chỉ ra 8 yếu tố và từ đó khuyến khích chúng ta tạo thành 8 thói quen để kiểm soát và thực hành những phương pháp thực tế và hữu dụng để chúng ta có cải thiện những yếu tố nằm trong khả năng kiểm soát của chúng ta.','quanlinangluong.png','quan li nang luong ca nhan trong cong viec',0),(25,4,3,'Tôi tự học',120000,'Cuốn sách này tuy đã được xuất bản từ rất lâu nhưng giá trị của sách vẫn còn nguyên vẹn. Những tư tưởng, chủ đề của sách vẫn phù hợp và có thể áp dụng trong đời sống hiện nay. Thiết nghĩ, cuốn sách này rất cần cho mọi đối tượng bạn đọc vì không có giới hạn nào cho việc truy tầm kiến thức, việc học là sự nghiệp lâu dài của mỗi con người. Đặc biệt, cuốn sách là một tài liệu quý để các bạn học sinh – sinh viên tham khảo, tổ chức lại việc học của mình một cách hợp lý và khoa học. Các bậc phụ huynh cũng cần tham khảo sách này để định hướng và tư vấn cho con em mình trong quá trình học tập.','toituhoc.jpg','toi tu hoc',0),(26,5,5,'Fluent Python, 2nd Edition',500000,'Don\'t waste time bending Python to fit patterns you\'ve learned in other languages. Python\'s simplicity lets you become productive quickly, but often this means you aren\'t using everything the language has to offer. With the updated edition of this hands-on guide, you\'ll learn how to write effective, modern Python 3 code by leveraging its best ideas.','python.png','fluent python',0),(27,5,5,'Head First Java: A Brain-Friendly Guide 3rd Edition',500000,'Head First Java is a complete learning experience in Java and object-oriented programming. With this book, you\'ll learn the Java language with a unique method that goes beyond how-to manuals and helps you become a great programmer. Through puzzles, mysteries, and soul-searching interviews with famous Java objects, you\'ll quickly get up to speed on Java\'s fundamentals and advanced topics including lambdas, streams, generics, threading, networking, and the dreaded desktop GUI. If you have experience with another programming language, Head First Java will engage your brain with more modern approaches to coding--the sleeker, faster, and easier to read, write, and maintain Java of today.','java.png','headfirst java',0),(28,5,5,'Fundamentals of Data Engineering',500000,'Data engineering has grown rapidly in the past decade, leaving many software engineers, data scientists, and analysts looking for a comprehensive view of this practice. With this practical book, you\'ll learn how to plan and build systems to serve the needs of your organization and customers by evaluating the best technologies available through the framework of the data engineering lifecycle.','data.jpg','Fundamentals of Data Engineering',0),(29,5,5,'Learning SQL 3rd Edition',500000,'As data floods into your company, you need to put it to work right away―and SQL is the best tool for the job. With the latest edition of this introductory guide, author Alan Beaulieu helps developers get up to speed with SQL fundamentals for writing database applications, performing administrative tasks, and generating reports. You’ll find new chapters on SQL and big data, analytic functions, and working with very large databases.','sql.jpg','learning sql 3rd edition',0),(30,5,5,'JavaScript: The Definitive Guide 7th Edition',500000,'JavaScript is the programming language of the web and is used by more software developers today than any other programming language. For nearly 25 years this best seller has been the go-to guide for JavaScript programmers. The seventh edition is fully updated to cover the 2020 version of JavaScript, and new chapters cover classes, modules, iterators, generators, Promises, async/await, and metaprogramming. You’ll find illuminating and engaging example code throughout.','javascript.jpg','javaScript the definitive guide 7th edition',0),(31,6,6,'Tâm Lý Học Về Tiền',189000,'Tiền bạc có ở khắp mọi nơi, nó ảnh hưởng đến tất cả chúng ta, và khiến phần lớn chúng ta bối rối. Mọi người nghĩ về nó theo những cách hơi khác nhau một chút. Nó mang lại những bài học có thể được áp dụng tới rất nhiều lĩnh vực trong cuộc sống, như rủi ro, sự tự tin, và hạnh phúc. Rất ít chủ đề cung cấp một lăng kính phóng to đầy quyền lực giúp giải thích vì sao mọi người lại hành xử theo cách họ làm hơn là về tiền bạc. Đó mới là một trong những chương trình hoành tráng nhất trên thế giới.','tamlihocvetien.jpg','tam li hoc ve tien',0),(32,6,3,'Chúa trời có phải là nhà toán học?',135000,'Tiền bạc có ở khắp mọi nơi, nó ảnh hưởng đến tất cả chúng ta, và khiến phần lớn chúng ta bối rối. Mọi người nghĩ về nó theo những cách hơi khác nhau một chút. Nó mang lại những bài học có thể được áp dụng tới rất nhiều lĩnh vực trong cuộc sống, như rủi ro, sự tự tin, và hạnh phúc. Rất ít chủ đề cung cấp một lăng kính phóng to đầy quyền lực giúp giải thích vì sao mọi người lại hành xử theo cách họ làm hơn là về tiền bạc. Đó mới là một trong những chương trình hoành tráng nhất trên thế giới.','chuatroi.jpg','chua troi co phai la nha toan hoc',0),(33,6,2,'Cẩm nang phòng chống thiên tai',65000,'Do điều kiện khí hậu và phần lớn diện tích là đồi núi, cao nguyên, sông suối dày đặc, Việt Nam thường xuyên phải đối mặt với thiên tai gây thiệt hại lớn về người và tài sản. Thêm vào đó, do ảnh hưởng của biến đổi khí hậu, thiên tai tại Việt Nam ngày càng diễn biến phức tạp hơn với sự gia tăng về tần suất và cường độ. Thiên tai đã, đang và sẽ tiếp tục tác động tiêu cực đến cuộc sống của người dân Việt Nam, đặc biệt là trẻ em.','thientai.jpg','cam nang phong chong thien tai',0),(34,6,6,'NFT - Cuộc cách mạng công nghệ nối tiếp Blockchain và Kỷ nguyên tiền điện tử',159000,'Chúng ta sẽ khám phá cách mà NFT có thể tạo ra một loại tài sản hoàn toàn mới cũng như các cơ hội đầu tư chưa từng có. NFT đã và đang được ứng dụng trong giới mỹ thuật, lĩnh vực game, thể thao, âm nhạ và khiến những nhóm người tưởng như không mấy quan tâm đến các cải tiến về công nghệ cũng sẵn sàng thay đổi để đón nhận làn gió mới. Bên cạnh những con số khổng lồ xoay quanh các thương vụ NFT, chúng ta sẽ còn phải choáng ngợp trước sự hữu ích không thể chối cãi mà NFT đem lại. Nếu như được sử dụng đúng cách, NFT sẽ là chiếc chìa khóa giải quyết vô số vấn đề về bảo mật và giả mạo, làm những rủi ro thường gắn liền với tài sản chỉ còn là câu chuyện quá khứ. Bên cạnh đó, NFT còn hứa hẹn sẽ cải thiện vượt bậc hiệu suất vận hành của chính phủ và các tổ chức, doanh nghiệp, cũng như cắt giảm được những khoản phí đắt đỏ, khi nó giúp các giao dịch có thể diễn ra nhanh chóng và đáng tin cậy, loại bỏ sự tham gia của các bên trung gian.','blockchain.jpg','blockchain nft tien dien tu',0),(35,6,6,'Kỹ Thuật Phân Tích Đầu Tư Chứng Khoán',169000,'Là giáo trình chứng khoán do chuyên gia đầu tư hàng đầu Nhật Bản biên soạn, “Kỹ thuật phân tích đầu tư chứng khoán” sẽ trang bị cho bạn những kiến thức cơ bản nhất về đầu tư, từ đó có thể đưa ra những sự lựa chọn hợp lý để thu được lợi nhuận tối đa. Đây là cuốn sách mà mọi nhà đầu tư, dù mới vào nghề hay đã có kinh nghiệm lâu năm, đều nên tìm đọc.','chungkhoan.jpg','ky thuat dau tu chung khoan',0),(36,7,1,'Đồi Gió Hú',108000,'Đồi gió hú, câu chuyện cổ điển về tình yêu ngang trái và tham vọng chiếm hữu, cuốn tiểu thuyết dữ dội và bí ẩn về Catherine Earnshaw, cô con gái nổi loạn của gia đình Earnshaw, với gã đàn ông thô ráp và điên rồ mà cha cô mang về nhà rồi đặt tên là Heathcliff, được trình diễn trên cái nền những đồng truông, quả đồi nước Anh cô quạnh và ban sơ không kém gì chính tình yêu của họ. Từ nhỏ đến lớn, sự gắn bó của họ ngày càng trở nên ám ảnh. Gia đình, địa vị xã hội, và cả số phận rắp tâm chống lại họ, bản tính dữ dội và ghen tuông tột độ cũng hủy diệt họ, vậy nên toàn bộ thời gian hai con người yêu nhau đó đã sống trong thù hận và tuyệt vọng, mà cái chết chỉ có ý nghĩa khởi đầu. Một khởi đầu mới để hai linh hồn mãnh liệt đó được tự do tái ngộ, khi những cơn gió hoang vắng và điên cuồng tràn về quanh các lâu đài trong Đồi gió hú...','doigiohu.jpg','doi gio hu',0),(37,7,2,'Không gia đình',150000,'“KHÔNG GIA ĐÌNH kể chuyện về cuộc đời của cậu bé Rémi. Từ nhỏ, Rémi đã bị bắt cóc, rồi bị bố nuôi bán cho một đoàn xiếc thú. Em đã theo đoàn xiếc ấy đi lưu lạc khắp nước Pháp.\n        Rémi đã lớn lên trong gian khổ và lao động để sống. Lúc đầu em được sự dạy bảo của cụ Vitalis, về sau thì tự lập. Không những lo cho mình, em còn lo việc biểu diễn và kiếm sống cho cả một gánh hát rong… Nhưng dù ở đâu, trong cảnh ngộ nào, em vẫn noi theo nếp rèn dạy của cụ Vitalis giữ phẩm chất làm người. Đó là lòng yêu lao động, tự trọng, ngay thẳng, biết nhớ ơn nghĩa và luôn luôn muốn làm người có ích.','khonggiadinh.jpg','khong gia dinh',3),(38,7,1,'Bắt Trẻ Đồng Xanh',88000,'Holden Caulfield, 17 tuổi, đã từng bị đuổi học khỏi ba trường, và trường dự bị đại học Pencey Prep là ngôi trường thứ tư. Và rồi cậu lại trượt 4 trên 5 môn học và nhận được thông báo đuổi học. Câu chuyện kể về chuỗi ngày tiếp theo sau đó của Holden, với ánh nhìn cay độc, giễu cợt vào một cuộc đời tẻ nhạt, xấu xa, trụy lạc và vô phương hướng của một thanh niên trẻ.','battredongxanh.jpg','bat tre dong xanh',0),(39,7,3,'Những người khốn khổ',145000,'Những người khốn khổ là một tác phẩm chứa chan tinh thần lãng mạn cách mạng. Những nhân vật chính diện đều sáng ngời đức hào hiệp, hy sinh. Tác phẩm ghi lại những nét hiện thực về xã hội Pháp vào khoảng 1830. Cái xã hội tư sản tàn bạo được phản ánh trong những nhân vật phản diện như Javert, Thénardier. Tình trạng cùng khổ của người dân lao động cũng được mô tả bằng những cảnh thương tâm của một người cố nông sau trở thành tù phạm, một người mẹ, một đứa trẻ sống trong cảnh khủng khiếp của cuộc đời tối tăm, ngạt thở. Dưới ngòi bút của Hugo, Paris ngày cách mạng 1832 đã sống dậy, tưng bừng, anh dũng, một Paris nghèo khổ nhưng thiết tha yêu tự do','nhungnguoikhonkho.jpg','nhung nguoi khon kho',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'name',
  `star` int NOT NULL,
  `comment` varchar(300) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `product_id_index` (`product_id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `review_prod_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_info` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb3_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address1` varchar(300) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address2` varchar(11) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-08 22:08:31
