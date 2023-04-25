-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 04:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$K4Sw2LwUwRMXnGJjMpEJXelbOsNjkEbHf1JPAHl6vFSa38gkIFKPW');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Starbucks'),
(2, 'Trung Nguyên Legend'),
(3, 'Highlands Coffee'),
(4, 'G7'),
(5, 'The Coffee House'),
(6, 'Vinacafe');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Arabica'),
(2, 'Robusta'),
(3, 'Excelsa'),
(4, 'Liberica'),
(5, 'Maragogype'),
(6, 'Moka'),
(7, 'Typica');

-- --------------------------------------------------------

--
-- Table structure for table `orders_info`
--

CREATE TABLE `orders_info` (
  `order_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_pro_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_brand` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  `product_rating` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`, `product_rating`) VALUES
(1, 1, 1, 'Cà phê Starbucks Decaf rang xay sẵn 100% Arabica Coffee', 330000, 'Mỗi loại cà phê với một quá trình rang hơi khác nhau để đạt được đỉnh cao về hương thơm, độ chua, vị và hương vị. Chúng tôi phân loại cà phê của mình theo ba cấu hình rang, vì vậy việc tìm kiếm loại cà phê yêu thích của bạn thật dễ dàng.', '1682225258_1.jpg', 'starbucks decaf', 5),
(2, 1, 3, 'Gói 1kg Cà phê bột Truyền thống Highlands Coffee', 210000, 'Cà Phê Bột Truyền Thống Highlands Coffee  là sản phẩm được sản xuất theo công nghệ tiên tiến trên dây chuyền hiện đại. Nguyên liệu tạo nên sản phẩm được chọn lọc kĩ càng từ những vườn cà phê chất lượng nhất của Việt Nam. Quy trình chế biến khép kín đảm bảo an toàn vệ sinh thực phẩm và không gây hại với sức khỏe người tiêu dùng. Với công thức truyền thống đã qua nghiên cứu lâu năm, đem tới hương vị hấp dẫn.', '1682225269_2.jpg', 'ca phe bot truyen thong hl', 0),
(3, 1, 2, 'CÀ PHÊ CON SÓC XANH BỘT HỘP 500 GR', 125000, 'CÀ PHÊ CON SÓC XANH BỘT HỘP 500 gram 49,99% Arabica, 49,99% Robusta và Hazelut tổng hợp Khối lượng tịnh: 500gr Quy cách : Đóng gói trong 2 gói bạc xanh 250gr Đặc tính: hạt cà phê nhỏ, mịn, màu nâu, mùi thơm nồng, vị nhẹ.', '1682225280_3.jpg', 'con soc xanh', 0),
(4, 1, 2, 'Café Hòa Tan Trung Nguyên Legend Special Edition Hộp 450G', 109000, 'Hòa một gói Café Hòa Tan Trung Nguyên Legend Special Edition với 90ml nước nóng (80-100 độ C) nếu uống nóng, 50ml nước nóng (80-100 độ C) nếu uống với 100g đá lạnh. Khuấy đều và thưởng thức.', '1682225350_4.jpg', 'trung nguyen legend 450 arabica', 0),
(5, 1, 1, 'Combo gói Cà phê Arabica Xay Sẵn Pha Phin', 110000, '500g arabica nguyên chất Đà Lạt', '1682225362_5.jpg', 'arabica xay san pha phin', 0),
(6, 1, 3, 'HẠT CÀ PHÊ ARABICA CẦU ĐẤT PHA MÁY 20 KG', 3118400, 'Hạt Cà phê Arabica Đà Lạt có nguồn gốc xuất sứ từ Cầu Đất Đà Lạt , Lâm Đồng. Được tuyển chọn một cách kỹ lưỡng để hạt có độ thơm ngon và hoàn hảo nhất có thể. Tất cả các hạt đều đã được rang xay bằng công nghệ rang xay hiện đại nhất với những thợ rang cà phê lành nghề nhất để tạo ra sản phẩm tốt nhất tới tay người sử dụng.', '1682225375_6.jpg', 'arabica cau dat', 0),
(7, 1, 2, 'Cà phê hạt CF1 Arabica Origin 500g', 265000, 'Cà phê hạt CF1 ARABICA ORIGIN được tuyển chọn từ những hạt cà phê Arabica hảo hạng của Việt Nam cùng với bí quyết rang xay truyền thống tạo ra sản phẩm cà phê hạt thương hiệu CF1 với hương thơm nồng quyến rủ và vị đắng thanh, chua nhẹ đậm đà hấp dẫn.', '1682225400_7.jpg', 'ca phe hat cf1 arabica', 0),
(8, 1, 2, 'Cà Phê Drip 5 – Culi Arabica', 1150000, 'Cà Phê Drip 5 – Culi Arabica. Số lượng: 3kg.', '1682225415_8.jpg', 'drip 5', 0),
(9, 1, 5, 'Cà phê Arabica Cao Cấp Kantata', 109000, 'Hương vị: Hương vị phong phú, đắng nhẹ, chua thanh tạo nên cảm giác sảng khoái, là hương vị sang trọng, phù hợp với những khách hàng có gu thưởng thức cà phê sang trọng. Phù hợp sử dụng với pha máy, tạo nên các sản phẩm cà phê nổi tiếng trên thế giới như: Espresso Macchiato, Cappuccino, Espresso Corretto, Cafe Latte, Espresso Lungo, Espresso Ristretto, Latte macchiato, Cafe Americano, Cafe Freddo, Espresso Doppio.\r\n\r\n', '1682225431_9.jpg', 'arabica cao cap kantata', 0),
(10, 2, 2, 'CÀ PHÊ BAJALAND - ROBUSTA (500G)', 90000, 'Robusta là loại cà phê được trồng nhiều ở các tỉnh thuộc vùng Tây Nguyên có đất đỏ bazan như: Gia Lai, Đắk Lắk, Lâm Đồng,….Đây cũng là loại cà phê chiếm hơn 90% tổng sản lượng của cả nước hàng năm. Cà phê robusta đặc biệt được yêu thích bởi chúng có mùi thơm nồng nàn, độ cafein vừa đủ, không chua, ngọt dịu nhẹ và không quá đắng.', '1682225448_10.jpg', 'bajaland robusta', 0),
(11, 2, 3, 'Cafe Rang Xay Lion Robusta Highlands 500gr', 195000, 'Tại Việt Nam, cà phê có thành phần cà phê hạt Robusta có mặt khắp nơi, do đó cà phê Robusta Việt Nam đứng số 1 về số lượng xuất khẩu trên thế giới. Về chất lượng cà phê Robusta ở Việt Nam cũng thuộc loại ngon nhất so với các nước có trồng loại cà phê Robusta. Vị của chúng thường được diễn tả là giống như bột yến mạch. Khi ngửi thật kỹ giống như có mùi cao su bị đốt cháy.', '1682225462_11.jpg', 'ca phe rang xay lion robusta', 0),
(12, 2, 2, 'Cà phê Vối Robusta ( Bột)', 300000, 'Hàm lượng caffeine cao và Acidity thấp. Chất vị đắng đậm, một chút chua chua, hương thơm mạnh mẽ.', '1682225475_12.jpg', 'ca phe voi robusta', 0),
(13, 2, 2, 'Cà phê Robusta Cao Cấp Kantata', 1220000, 'Như cái tên Robusta mà nó thể hiện, nó rất robust, nghĩa là mạnh, chứa nhiều caffeine. Với thành phần đặc trưng trong từng hạt cà phê, Robusta phù hợp với đa số gu và khẩu vị của người ưa chuộng cà phê ở Việt Nam. Cà phê Robusta Cao Cấp Kantata được trải qua quy trình chế biến chuyên nghiệp, kỹ càng tới từng chi tiết, đảm bảo đáp ứng các tiêu chuẩn khắt khe tuyệt đối ở từng công đoạn, cho ra đời những hạt cà phê với phẩm chất tốt nhất. Cà phê Robusta Cao Cấp Kantata trải qua công đoạn phân loại chặt chẽ, trái cà phê sau khi thu hoạch được đem về địa điểm tiếp nhận và cho ngay vào bể đầy nước để phân loại.', '1682225498_13.jpg', 'robusta cao cap kantata', 0),
(14, 2, 3, 'Cà phê Robusta Đắk Lắk 1kg', 145000, 'Việt Nam là nước xuất khẩu cà phê Robusta đứng đầu thế giới và Robusta cũng chính là gu cafe yêu thích của người dân Việt. Đúng như từ robust (mạnh mẽ) trong tên Robusta, cafe Robusta rất đậm, mạnh, hương thơm nồng nên thích hợp gu cafe đá và cafe sữa đặc. Khi bạn đã quen với Robusta hàng ngày thì khi du lịch các nước khác, bạn sẽ thất vọng và có thể không tỉnh táo với gu cafe Arabica, vốn nhẹ hơn và lượng caffein cũng thấp hơn nhiều so với Robusta. Ngược lại, người nước ngoài hoặc người yếu tim sẽ choáng ngợp khi uống Robusta vì nó quá đậm và mạnh. Loại Robusta hàng đầu Việt Nam chính là ở vùng nguyên liệu nổi tiếng Đắk Lắk.', '1682225521_14.jpg', 'robusta daklak', 0),
(15, 2, 2, 'Cà Phê Robusta Không Bơ', 125000, 'Mô tả: Hạt Cafe Robusta nhỏ hơn Arabica, vị đắng gắt, nhiều cafeine, loại này uống phê hơn. Hạt cà phê Robusta hình bàn cầu tròn và thường là 2 hạt trong 1 trái. Trải qua quá trình chế biến trên dây chuyền thiết bị hiện đại với công nghệ cao tạo cho loại cà phê Robusta có mùi thơm dịu, vị đắng gắt, nước có màu nâu sánh, không chua, hàm lượng cafein vừa đủ đã tạo nên một loại cà phê đặc sắc phù hợp với khẩu vị của người dân Việt Nam.', '1682225563_15.jpg', 'ca phe robusta khong bo', 0),
(16, 3, 4, 'Excelsa Coffee', 150000, 'Although Excelsa has been recently re-classified as a member of the Liberica family, the two couldn’t be more different; it differs so much from Liberica that some members of the coffee community still think of it as a separate species. It was re-named as a genus of Liberica because it grows on large 20-30 ft trees like Liberica at similar altitudes and has a similar almond-like shape. Excelsa grows mostly in Southeast Asia and accounts for a mere 7% of the world’s coffee circulation. It is largely used in blends in order to give the coffee an extra boost of flavor and complexity, better affecting the middle and back palate. Excelsa is said to possess a tart and fruity body—which are flavors reminiscent of a light roast—that also somehow has dark, roasty notes. This mystery lures coffee drinkers from around the world to try and seek out the varietal. Excelsa plants are mainly found in Southeast Asia, and the beans are mostly used as blending coffee. Excelsa has a unique taste profile, somewhat mysterious; it has a flavor of both light roast and dark roast coffee—feels like tart, fruity, and somehow dark.', '1682418223_16.jpg', 'excelsa coffee', 0),
(17, 3, 5, 'The Coffee House Excelsa 500g ', 180000, 'Cực phẩm pha cà phê sữa', '1682418236_17.jpg', 'the coffee house excelsa', 0),
(18, 3, 1, 'Cà Phê Chùm Ngây Excelsa', 168000, 'Thành phần: Bột kem cà phê, đường, cà phê hoà tan (20%), bột chùm ngây hoà tan (20%), maltodextrin, sữa bột. Pha nóng: Hòa tan 1 gói cà phê với 80ml nước sôi tùy theo khẩu vị, khuấy đều và thưởng thức. Pha lạnh: Hòa tan 2 gói cà phê với 80ml nước sôi tùy theo khẩu vị, khuấy đều vừa nguội, thêm đá và thưởng thức.', '1682418247_18.jpg', 'ca phe chum ngay excelsa', 0),
(19, 3, 2, 'Cà Phê Rang Xay Trung Nguyên Legend - Hộp 250g ', 239000, 'Là di sản của cà phê Việt được tạo nên từ loại hạt Culi thượng hạng của 4 loại cà phê Arabica, Robusta, Excelsa &amp; Catimor bằng tình yêu và niềm đam mê của các chuyên gia cà phê TNI.', '1682418257_19.jpg', 'ca phe rang xay excelsa trung nguyen', 0),
(20, 3, 4, 'Cà phê EXCELSA (Bột -Hạt)', 99000, 'Excelsa là một dòng của giống cà phê Mít, hay còn gọi là cà phê Cherry. Đây là một giống cà phê không phổ biến tại Việt Nam. Do yêu cầu quy trình chăm sóc nghiêm ngặt cùng hương vị đặc biệt. Cà phê Excelsa được giới doanh nhân cực kỳ yêu thích vì mùi vị quyến rũ và hương thơm rất sang.', '1682418269_20.jpg', 'ca phe excelsa', 0),
(21, 4, 4, 'JOHOR, 100 % G7 LIBERICA', 790000, 'Libta coffee is one of the specialty Liberica coffee beans producer in Malaysia. Our company takes full control from farm to cup at own coffee plantation, processing mill, roastery, and an in house cafe that serves specialty Liberica coffee in Taman Perindustrian Ringan Naib Piee, off Jalan Salleh, Muar, Johor. This high quality coffee beans species single origin ( Malaysia Liberica ) is our favourite among all the liberica beans compare to Indonesia, Philippine, and other country. The honey sweetness is absolute lovely, smooth and easy drinking coffee. It is the biggest beans compare to robusta and arabica. The profile smoky, nutty, floral with hints of dark chocolate, ripe berry and spice. It`s smooth aftertaste and lingering taste of rich dark chocolate.', '1682418278_21.jpg', '100 g7 liberica', 0),
(22, 4, 6, 'Coffee Liberica - White Russian', 899000, 'Drink it in the morning for an intriguing start to your day. 100% Liberica coffee. ', '1682418286_22.jpg', 'coffee liberica white russian', 0),
(23, 4, 4, 'Mary Coffee&#039;s Energetic Death Wish-Liberica Coffee of 250 pouch (250)', 990000, 'Immerse yourself in a smooth, subtle, never-bitter cherry and chocolate flavor profile. We&#039;ve carefully selected and expertly ground premium Arabica and Robusta coffee beans from around the world to deliver you a dark roast ground coffee beverage with a bold taste you’ll instantly fall in love with.', '1682418473_23.jpg', 'mary coffee energetic', 0),
(24, 4, 6, 'Ark of Taste Coffee - Liberica', 599000, 'Get that satisfying taste of coffee that will soothe all moods and delight your taste buds. This Benguet Arabica blend is the first variety from Cordillera to be recognized by Ark of Taste. Ark of Taste is a listing of the world&#039;s food that is facing extinction. Farmers aren&#039;t planting new trees nor are they restoring old ones, which is causing the variety of blends to be endangered. Let&#039;s help preserve what remains in the farms and join forces with the community of growers to keep these distinct flavours and ancestral tastes alive.', '1682418481_24.jpg', 'ark of taste coffee liberica', 0),
(25, 4, 2, 'Liberica (500g)', 120000, 'Herby, smoky, nutty, dark chocolate notes with hints of Jackfruit', '1682418490_25.jpg', 'liberica 500', 0),
(26, 5, 1, 'Elefante Reserve Maragogype Coffee - Whole Bean', 400000, 'Elefante is suitably named after the Maragogype mega-beans roasted to make this unique coffee. The rare bean is grown in the &quot;cloud forest&quot; of Nicaragua (the high mountains) and is characterized by its natural creaminess.', '1682432597_26.jpg', 'elefante reserve maragogype coffee', 0),
(27, 5, 5, 'Vittoria Maragogype Coffee Capsules 10 Pack', 500000, 'The Maragogype, also known as &quot;The Elephant Bean&quot;, is one of the rarest coffee beans in the world. The Maragogype, also known as &quot;The Elephant Bean&quot;, is one of the rarest coffee beans in the world. The Maragogype bean – often referred to as the “Elephant Bean” for its enormous size has a sweet and delicate fruitiness, notes of spice and chocolate with a warm toasty finish. Compatible with Nespresso machines.', '1682432618_27.jpg', 'vittoria maragogype coffee', 0),
(28, 5, 2, 'Nicaragua Maragogype', 500000, 'Maragogype là tên của thị trấn Maragogype/ Maragogipe thuộc bang Bahia của vùng Đông Bắc Brazil – Nơi người ta tìm ra giống cà phê typica đột biến có quá trình sinh trưởng chậm, chiều cao cây và kích thước hạt rất lớn nhưng năng suất thấp (Vì kích thước lớn nên nó còn có tên gọi khác là Elephan coffee bean – hạt cà phê Voi). Maragogype có thể coi là một giống hiếm trong thế giới cà phê, được đánh giá khá tích cực bởi những người yêu cà phê.', '1682432630_28.jpg', 'nicaragua maragogype', 0),
(29, 5, 5, 'Bacha Coffee Maragogype', 657000, 'Grown on small “fincas” at an altitude of 1,500 metres in volcanic soil, these Maragogype beans are a true speciality, handpicked over eight harvests to guarantee only the ripest beans are picked each time. The Maragogype plants do not yield as many beans as other coffee varietals and so they are often neglected, but these fascinatingly large beans produce an infusion that bears no comparison. Spicy, yet almost creamy, this coffee will charm even the most demanding connoisseur.', '1682432641_29.jpg', 'bacha coffee maragogype', 0),
(30, 5, 4, 'GUATEMALA', 312000, 'The Arabica variety Maragogype, discovered for the first time in the Brazilian state of Bahia, is a natural mutation of the Typica that produces a very large bean, the largest in the world!', '1682432652_30.jpg', 'guatemala', 0),
(31, 6, 5, 'Cà Phê Rang Xay Moka', 140000, 'Với những người yêu thích và có tìm hiểu sơ qua về cà phê thì chắc chắn cà phê Moka là một cái tên gợi lên vẻ quý phái và sang trọng. Sở dĩ như vậy là vì Moka được xem là Hoàng Hậu trong vương quốc cà phê. Hương vị cà phê rang mộc moka: Mùi quyến rủ, vị ngọt nhẹ hài hòa, hậu sâu lắng. Thành phần cà phê moka: 100% cà phê Moka hạt thượng hạng, Moka cầu đất sàn 18.', '1682432663_31.jpg', 'ca phe rang xay moka', 0),
(32, 6, 1, 'Cà Phê Bột Starbucks - Moka Nguyên Chất cao cấp 500gr', 150000, 'Cà Phê Bột Moka Nguyên Chất cao cấp của Starbucks:Bột cà phê Robusta phù hợp với đại đa số Gu cà phê của người Việt Nam. Vị cà phê, chua dịu và đắng nhẹ. Trước khi đóng gói đã được loại bỏ hoàn toàn hạt đen, vỡ, các tạp chất khi thu hoạch ( đá, cành cây, cát,... ). Cà phê của Casa Coffee được rang với công nghệ Hot Air mang đến sự ổn định về hương vị sản phẩm. Đóng gói bao bì loại 500gr/gói, bao bì có màng đạt chuẩn vệ sinh an toàn thực phẩm. Bao bì có van thoát khí 1 chiều của Thuỵ Sĩ để lưu trữ và đảm bảo chất lượng cà phê tốt hơn các loại bao bì không có van. Dùng pha phin hoặc pha máy đều được. ', '1682432705_32.jpg', 'ca phe bot moka cao cap', 0),
(33, 6, 6, 'Cà phê hạt rang Moka 250g - Vinacafe', 190000, 'Hạt cà phê Moka- “nữ hoàng cà phê” được rang mộc không tẩm ướp, với lượng nhiệt vừa phải kết hợp cùng công nghệ tiên tiến tạo ra ly cà phê hoàn hảo hương thơm quyến rũ đặc biệt, thoang thoảng, vị chua thanh thoát đầy quý phái, sang trọng. Thử tách cà phê Moka rang mộc thật nồng nàn, vương giả và quý phái. Sức khỏe của bạn là  một trong những giá trị cốt lõi của chúng tôi. Rang từ tâm, nguyên liệu sạch từ gốc: không dùng chất tạo mùi, pha tạp chất, hiểu rõ từng hạt cà phê, chọn nhiệt độ thích hợp nhất. An toàn sức khỏe: với nguyên liệu chất lượng, công nghệ tiến tiến từ Châu Âu, rang mộc không pha tạp chất, các hương liệu tạo mùi.', '1682432720_33.jpg', 'ca phe hat rang moka', 0),
(34, 6, 1, 'Cà Phê Moka Chồn 500g', 81000, 'Thành phần: Robusta (67%), Moka (30%), bơ thực vật, hương cà phê tổng hợp. Nguyên Liệu: Buôn Ma Thuột - Daklak Cầu Đất - Lâm Đồng. Thưởng thức: Cà phê đen nóng/đá. Dụng cụ pha chế: Phin Việt Nam. Thơm dịu, vị đậm, hậu cân bằng, ủ men hương chồn.', '1682432728_34.jpg', 'ca phe moka chon', 0),
(35, 6, 3, 'Café Rang Xay Highlands Coffee Moka 200g', 89000, 'Với 100% hạt cà phê Moka thượng hạng trồng ở vùng cao nguyên của Việt Nam được rang và phối trộn theo công thức độc đáo tại Highlands Moka là loại hạt cà phê cao cấp nhất của Việt Nam, có giá trị dinh dưỡng và chất lượng tốt nhất Cà phê Highlands Coffee được đóng gói tiện lợi cho việc sử dụng và bảo quản. ', '1682432737_35.jpg', 'cafe rang xay hl coffee moka', 0),
(36, 7, 2, 'Cà Phê Legend Typica Trung Nguyên Túi 50 Gói x 17g', 125000, 'Hướng dẫn sử dụng: Hòa một gói cà phê hòa tan Trung Nguyên Legend Classic với 75ml nước nóng (80C-100C), khuấy đều và thưởng thức. Nếu dùng đá, sử dụng hai gói. Sản phẩm có chứa đạm sữa, đậu nành. Bột cà phê rang xay nhuyễn có thể lắng dưới đáy ly. Bảo quản ở nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp.', '1682432746_36.jpg', 'ca phe legend typica trung nguyen', 0),
(37, 7, 4, 'Cafe Typica Việt Nam – Rang Vừa', 530000, 'Arabica Typica – hay còn gọi là cafe moka – là một trong những giống cafe lâu đời nhất trên thế giới. Arabica Typica sở hữu vị ngọt và hương vị citrus thuần chủng khiến typica rất được ưa chuộng. Đây là một thành phần chính tạo nên mùi vị phong phú của những dòng cafe espresso ngon.', '1682432754_37.jpg', 'typica viet nam rang vua', 3),
(38, 7, 6, 'Cà phê hữu cơ nguyên hạt Typica 200g', 289000, 'Cà phê rang nguyên hạt hữu cơ , quy trình honey 100% rang nguyên hạt cà phê Typica hữu cơ, chế biến theo qui trình honey Loại: Cà phê hạt rang Thành phần: 100% Organic Typica. Độ rang: Vừa Hương vị: Sản phẩm Typica Fine Organic được chế biến theo phương pháp Honey mang mùi thơm của trái cây khô và hậu vị ngọt tự nhiên.', '1682432762_38.jpg', 'ca phe huu co nguyen hat typica', 0),
(39, 7, 5, 'Cà phê đặc biệt Typica', 250000, 'Ban đầu cảm giác mạnh rồi lắng dịu dần dần để lại một hậu vị thanh khuyết quyến rũ vô cùng, như thúc giục ta uống thêm nữa để rồi mọi thứ đam mê trong ta tưởng chừng đã ngũ quên nay lại được thức tỉnh.', '1682432769_39.jpg', 'ca phe dac biet typica', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'name',
  `star` int(11) NOT NULL,
  `comment` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES
(2, 'Đoàn ', 'Nhật Hoàng', 'hoang.doan2408.bk@gmail.com', '$2y$10$xNbzNLNimGINJJZuOJSvY.hWMzOie70Cq3Xq4zJTbZZPGxLEBSRm6', '0986925857', 'Thủ Đức', 'Khánh Hòa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders_info`
--
ALTER TABLE `orders_info`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_pro_id`),
  ADD KEY `product_id_idx` (`product_id`),
  ADD KEY `order_id_idx` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_brand_idx` (`product_brand`),
  ADD KEY `product_cat_idx` (`product_cat`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id_index` (`product_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders_info`
--
ALTER TABLE `orders_info`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders_info` (`order_id`),
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_brand` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `product_cat` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_prod_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
