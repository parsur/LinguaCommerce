-- MySQL dump 10.13  Distrib 8.0.11, for macos10.13 (x86_64)
--
-- Host: localhost    Database: sara_rajabi
-- ------------------------------------------------------
-- Server version	8.0.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `category_id` int NOT NULL,
  `subcategory_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  KEY `subCategory` (`subcategory_id`),
  KEY `category` (`category_id`),
  CONSTRAINT `articles_ibfk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articles_ibfk_subCategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'استرس چیست و چطور آن را مدیریت کنیم ؟','2021-05-02 09:49:59','2021-04-03 11:41:45',3,NULL);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `factor` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `course_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `course_id_UNIQUE` (`course_id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `course_ibfk_cart` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'دوره ها'),(2,'کتاب الکترونیکی'),(3,'مقالات'),(4,'ویدیو ها');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `commentable_id` int DEFAULT NULL,
  `commentable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'xdsad','sadasd','2021-03-21 18:28:57',1,'App\\Models\\Article');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultations`
--

DROP TABLE IF EXISTS `consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `consultations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_ibfk_consultation` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultations`
--

LOCK TABLES `consultations` WRITE;
/*!40000 ALTER TABLE `consultations` DISABLE KEYS */;
/*!40000 ALTER TABLE `consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` int NOT NULL COMMENT '0 = price | 1= percentage',
  `value` int DEFAULT NULL,
  `course_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_ibfk_coupon_idx` (`course_id`),
  CONSTRAINT `cart_ibfk_coupon` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (27,'سشیسشی',0,12000,1);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `courses` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '0 = Active\\n//\\n1 = Inactive',
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int DEFAULT NULL,
  `category_id` int NOT NULL,
  `subcategory_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `c_id` (`category_id`),
  KEY `sc_id` (`subcategory_id`),
  CONSTRAINT `course_ibfk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `course_ibfk_subCategory` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'چطور سر صحبت را باز کنیم ؟',NULL,1,NULL),(2,'دوره مقدماتی فن بیان',5000,1,NULL),(3,'dsadsad',12000,2,NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descriptions`
--

DROP TABLE IF EXISTS `descriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `descriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `description_description_type_description_id_index` (`description_type`,`description_id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descriptions`
--

LOCK TABLES `descriptions` WRITE;
/*!40000 ALTER TABLE `descriptions` DISABLE KEYS */;
INSERT INTO `descriptions` VALUES (1,'<p><span class=\"text-huge\"><strong>استرس چیست ؟</strong></span></p><figure class=\"image image_resized\" style=\"width:37.55%;\"><img src=\"https://cdn.steemitimages.com/DQmYrqgkuuTn8q5pDfR8cGfUrRNRW2oubThQucCKqLyRJE5/Stress.jpg\"></figure><p><span class=\"text-big\">همه‌ی ما <strong>احساس می‌کنیم</strong> به صورت شهودی می‌دانیم استرس چیست؟ چرا که همه گاهی آن را تجربه کرده‌ایم. استرس لزوما چیز بدی نیست و فقط به این بستگی دارد که شما چگونه دچار آن می‌شوید. استرسی که ناشی از کار خلاقانه‌ی چالش‌برانگیز باشد، مفید است در حالی‌که استرس ناشی از ناتوانی، احساس حقارت یا ضعف، زیان‌آور است. استرس احساسی است که هنگامی که فکر می‌کنیم کنترل‌ امور از دست‌مان خارج شده است، به ما دست می‌دهد. البته بخشی از استرس به وجود امده غریزی و بخشی دیگر به طرز فکر ما بستگی دارد ، برخی استرس را پاسخ غیراختصاصی بدن به هر موقعیتی می‌دانند که نیاز به سازگاری داشته باشد ، خواه موقعیت خوشایند باشد (ارتقای شغلی) و خواه ناخوشایند (اخراج ازکار) .&nbsp;استرس با سلامتی و عملکرد ارتباط دارد؛ مقادیر کم آن موجب بهبود سلامتی و عملکرد می‌شود و مقادیر زیاد آن سلامتی را به خطر انداخته و عملکرد را دچار اختلال می‌کند.</span></p><figure class=\"image image_resized\" style=\"width:27.62%;\"><img src=\"https://incentiveandmotivation.com/wp-content/uploads/2019/01/Stress-Office.jpg\"></figure><p><span class=\"text-big\" style=\"background-color:hsl(180, 75%, 60%);\"><strong>عوامل استرس زا</strong></span></p><p><span class=\"text-big\">&nbsp;هر روز با عوامل استرس‌زای مختلفی رو‌به‌رو هستیم. عوامل کوچکی که استرس و دل‌نگرانی‌های نامحسوس ولی آزاردهنده ایجاد می‌کنند و البته عوامل محسوسی که به جزئی جدانشدنی از زندگی امروزه تبدیل شده‌اند&nbsp;.&nbsp;عوامل ایجاد کننده استرس را می‌توان به دو دسته بیرونی و درونی تقسیم کرد؛ مهم‌ترین عوامل استرس زای بیرونی عبارتند از مشکلات زندگی (مشکلات اقتصادی، ناامنی شغلی، کار طاقت‌فرسا) و دگرگونی‌های زندگی.</span></p><p><span class=\"text-big\"><strong>1-محل کار</strong>: همه‌ی ما بیشتر ساعات روز را در محل کارمان می‌گذرانیم، پس عجیب نیست که در همین محل با یکی از بزرگ‌ترین عوامل استرس روبه‌رو شویم . برای رهایی از عوامل استرس‌زای موجود در محل کار باید برنامه‌ریزی دقیقی ترتیب بدهید که وظایف کاری‌ را از اوقات فراغت و وقت‌گذرانی با خانواده‌تان تفکیک کنید. اگر عوامل استرس‌زای کار شما به بخش جدانشدنی از شغل‌تان بدل شده‌اند و از شر آنها گریزی نیست، حداقل تلاش کنید این استرس به سایر بخش‌های زندگی‌تان وارد نشود.&nbsp;مثلا در زمان استراحت و خارج از وقت کاری، کار را تعطیل کنید و فکرتان را با مسائل مرتبط با آن مشغول نکنید.&nbsp;</span></p><p><span class=\"text-big\"><strong>2-ظاهر و قیافه </strong>: همه دوست دارند زیبا و جذاب باشند اما وقتی مسائل ظاهری به عوامل تولید استرس و دغدغه‌ی اصلی افراد تبدیل می‌شوند، باید فکری کرد . تمرینات ورزشی، تغذیه سالم و تغییر سبک زندگی تأثیر فوق‌العاده‌ای بر ظاهر و روحیه‌ی شما دارند. درست است که ورزش کردن باعث نمی‌شود بینی‌تان کوچک‌ تر یا قدتان بلندتر بشود اما به شما اندامی متناسب تقدیم می‌کند که شادابی و اعتماد به نفس‌تان را بالا می‌برد. ورزش در تمامی سنین به‌ویژه برای افراد میان‌سال مانند آبی است که آتش سوزان استرس و هیجانات کاذب را فرو می‌نشاند.&nbsp;</span></p><p><span class=\"text-big\"><strong>3-اجتماع</strong> : همه دوست دارند موفق باشند، روی دیگران تأثیر بگذارند و دیده و شنیده بشوند و این خواسته‌ای عادی و طبیعی است، اما اگر این خواسته از مسیر منطقی خود خارج شود چیزی جز استرس به همراه ندارد. همه تلاش می‌کنند خود را شبیه ایده‌آل‌های ارائه شده در تبلیغات تجاری و مدل‌های فشن و مد کنند. از قدیم گفته‌اند شنونده باید عاقل باشد. فشار و استرسی که از سوی محیط به افراد وارد می‌شود، عواقب مخرب و ماندگاری به دنبال دارد. نمونه‌ی دیگری از استرس محیطی که اجتماع به افراد تحمیل می‌کند، استرسی است که گروه‌های اقلیت در جوامع تجربه می‌کنند. انواع تبعیض‌های موجود در جوامع از جمله تبعیض نژادی استرس فراوانی تولید می‌کنند که اگر طولانی‌مدت باشد، صدمات جبران‌ناپذیری به فرد و جامعه وارد می‌کند.</span></p><p><span class=\"text-big\"><strong>4-رقابت</strong>: این نوع استرس افراد را به یادگیری، تمرین بیشتر و متعهد بودن تشویق می‌کند. استرس مفید همان اضطراب شیرینی است که در برخی ملاقات‌ها دچارش می‌شوید یا همان حس مطلوبی که برای شرکت در رقابت‌های سالم دارید.</span></p><p>&nbsp;</p><p><span class=\"text-big\"><strong>6-تغییرات</strong>:&nbsp;شروع یک کار جدید، آغاز زندگی مشترک، جابه‌جایی منزل و… تغییرات اجتناب‌ناپذیری هستند. خواه این تغییرات مثبت باشند یا منفی، باید خود را با شرایط جدید وفق داد و همین تلاش برای تطبیق پیدا کردن با موقعیت‌های جدید باعث ایجاد استرس می‌شود.</span></p><p><span class=\"text-big\"><strong>7-روابط</strong>:&nbsp;حتی شادترین روابط هم درجه‌ای از استرس را در خود پنهان دارند. هم‌زیستی در تمام شکل‌هایش مشکلاتی در پی دارد.&nbsp;تلاش برای کاهش اختلافات در روابط و درک متقابل افراد، راهکار ارزشمندی در جهت گریز از استرس و زندگی شادتر است.</span></p><p><span class=\"text-big\"><strong>9-رویداد های گذشته</strong>:&nbsp;بر اساس پژوهش‌ها مردان وحشت و استرس بیشتری را در زندگی تجربه می‌کنند چون سهم بیشتری در بروز حوادث دارند.&nbsp;برای داشتن آرامش و فرار از استرس باید در گام نخست عوامل ایجاد کننده‌ی آن را شناخت. تعریف مسئله مهم‌ترین بخش شروع درمان و حل مشکل است&nbsp;</span></p><p><span class=\"text-big\" style=\"background-color:hsl(120,75%,60%);\"><strong>فواید استرس</strong></span><span class=\"text-big\">&nbsp;</span></p><p><span class=\"text-big\">شاید هر کدام از ما با خواندن این قسمت از مقاله متعجب شویم. واقعیت آن است که ما همواره استرس را یک عامل می دانیم &nbsp;اما آنچه در مطالعات اخیر بر روی تاثیرات استرس بر بدن به دست آمده ، نشان می دهد که داشتن استرس به آن بدی هایی که در تصور ما وجود داشت نیست بلکه در مواردی می تواند مفید هم باشد.</span></p><figure class=\"image image_resized\" style=\"width:29.82%;\"><img src=\"https://revita.bg/blog/wp-content/uploads/2014/11/brain.jpg\"></figure><p><span class=\"text-big\"><strong>استرس می تواند سبب رشد مغزتان شود :</strong>&nbsp;</span></p><p><span class=\"text-big\">از قدیم گفته شده </span><span class=\"text-big\" style=\"background-color:hsl(270,75%,60%);color:hsl(60,75%,60%);\">آنچه نتواند تو را بکشد، قوی ترت خواهد کرد</span><span class=\"text-big\">. این مثل قدیمی می تواند در مورد استرس نیز کاربرد داشته باشد.</span></p><p>&nbsp;</p><blockquote><p><span class=\"text-big\">پژوهش های علمی نشان داده است که استرس کوتاه مدت می تواند سبب بهبود کارکرد مغز شود. دانشمندان این نتیجه را با انجام آزمایش هایی بر روی موش ها بدست آوردند. زمانی که موش ها چند ساعتی در قفس های شان در معرض استرس و خطر قرار گرفتند، این نتیجه به دست آمد که سلول های جدید مغزی در آنها ساخته شد.بعدها جوندگان هم نتیجه مشابهی را برای دانشمندان آشکار ساختند.</span></p></blockquote><p><span class=\"text-big\">&nbsp;پروفسور «دانیلا کوفر» در مصاحبه ای با «برکلی ولنِس» چنین می گوید:</span></p><p><span class=\"text-big\">انواعی از استرس از جمله آنچه قبل از امتحان یا یک سخنرانی مهم تجربه می شود می تواند باعث عملکرد شناختی بهتری در فرد شود.</span></p><p><span class=\"text-big\"><strong>استرس می تواند باعث بهبود وضعیت حافظه تان شود:</strong></span></p><p><span class=\"text-big\">پروفسور کوفر می گوید: “اگر حیوانی با یک صیاد مواجه شود و برای فرار از آن موقعیت برنامه ریزی کند، بسیار اهمیت دارد که بتواند به خاطر آورد که کجا و در چه زمانی با آن وضعیت خطر مواجه شده. در مورد خود شما هم همین طور است. به عنوان مثال اگر از یک کوچه ای عبور می کردید و کسی شما را در آنجا تهدید کرد، مهم است که به خاطر آورید دقیقا کجا این اتفاق افتاده تا بتوانید دفعات بعدی از آن پرهیز کنید. مغز همواره پاسخگوی استرس است.</span></p><figure class=\"image image_resized image-style-side\" style=\"width:36.76%;\"><img src=\"https://cdn2.omidoo.com/sites/default/files/imagecache/full/images/bydate/feb_17_2012_-_851am/shutterstock_74158678.jpg\"></figure><p><span class=\"text-big\"><strong>استرس می تواند به شما انرژی بدهد :</strong></span></p><p><span class=\"text-big\">استرس خصوصا در مواردی که از نوع مثبت آن باشد می تواند به شما انرژی بیشتری بدهد.&nbsp;استرس خوب می تواند باعث تحریک عصب ها شده و اندورفین سالم را ترشح کند. آنچه به عنوان استرس خوب از آن یاد می شود، استرس هایی چون، سخنرانی در جاهای عمومی، اجرا بر روی صحنه، داشتن فرزند یا نقل مکان به خانه جدید است.</span></p><p><span class=\"text-big\">فکر کردن در مورد مواردی این چنینی می تواند یک تمرین فیزیکی خوب به شمار آید. اگرچه چنین موقعیت هایی بدن را در وضعیت استرس قرار می دهند اما به جای آنکه بدن را تهی کند آن را مملو از اتفاقات مثبت هم می کند.</span></p><p><span class=\"text-big\"><strong>استرس سبب می شود که بتوانید از پس استرس های بیشتر و بزرگ تر برآیید:</strong></span></p><p><span class=\"text-big\">از دیدگاه روانشناسی با تحمل استرس، مدیریت آن در موارد بیشتر راحت تر خواهد بود.&nbsp;به عنوان مثال منجمان ناسا، ورزشکاران حرفه ای و افرادی که در اورژانس ها کار می کنند، تحت استرس های فراوانی مورد امتحان و آزمایش قرار می گیرند تا در صورت لزوم بتوانند از مهارت های بدست آمده استفاده کنند.</span></p><p><span class=\"text-big\">(مک گونیگال از استرس به عنوان فرصتی برای آموختن و رشد کردن یاد می کند.)</span></p><p><span class=\"text-big\"><strong>زندگی تان معنادار تر می شود:</strong></span></p><p><span class=\"text-big\">زمانی که استرس بیشتری را در زندگی متحمل می شوید به شما کمک می کند که قدر زندگی را بیشتر بدانید.&nbsp;دکتر مک گونیگال می گوید، این امکان وجود دارد افرادی که استرس بیشتری را در زندگی خود تحمل می کنند، برای کارها و روابط خود سرمایه گذاری بیشتری کرده باشند.</span></p><p><span class=\"text-big\">این موارد میتواند نگاه شما به استرس را به سمت و سویی مثبت بکشاند . زمانی که به کلمه استرس می اندیشید به این فکر کنید این کلمه همیشه مفهوم بدی ندارد در اکثر مواقع لذت زندگی کردن را در شما دوبرابر میکند .&nbsp;</span></p><figure class=\"image image_resized\" style=\"width:37.44%;\"><img src=\"https://wallpapertag.com/wallpaper/full/3/c/9/566602-beautiful-brain-anatomy-wallpaper-2560x1600.jpg\"></figure><p><span class=\"text-big\" style=\"background-color:hsl(0,75%,60%);\"><strong>ضرر های استرس&nbsp;</strong></span></p><p><span class=\"text-big\">استرس در کنار فوایدی که دارد اگر بیش از حد باشد موجب بیماری هایی از قبلی زخم معده و شامل تاثیراتی منفی که روی سیستم گوارش میگذارد . همچنین استرس&nbsp;درد معده ، ترش کردن ، سوزش معده، بادگلو، حالت تهوع و ... را به همراه دارد . در زنان و دختران باعث ریزش مو و سفیدی تار های مو شود اما نگران نباشید این مشکلات فقط در مواقعی به وجود می اید که استرس بیش از حد معمول باشد .</span></p><p><span class=\"text-big\" style=\"background-color:hsl(60,75%,60%);\"><i><strong>راهکار های غلبه بر استرس</strong></i></span></p><p><span class=\"text-big\"><strong>1-از تلاش برای حفظ خونسردی خود دست بردارید:</strong>&nbsp;</span></p><p><span class=\"text-big\">وحشت خود را به&nbsp; هیجان تبدیل کنید. افرادی که در هنگام سخنرانی، اعلام کردند که هیجان زده هستند، شایسته‌تر و مقتدرتر به نظر می‌رسیدند.</span></p><p><span class=\"text-big\"><strong>2-با خودتان حرف بزنید:</strong></span></p><p><span class=\"text-big\">هنگامی که به خود می‌گویید “سارا، تو می‌توانی!” ممکن است کمی عجیب به نظر برسد، اما تحقیقی در این زمینه نشان می‌دهد که افرادی که خود را با اسم، مورد خطاب قرار می‌دهند در هنگام سخنرانی در حضور جمع بهتر از افرادی عمل می‌کنند که از ضمیر “من” استفاده می کنند.</span></p><p><span class=\"text-big\">ممکن است دلیلش این باشد که هنگامی که فردی خود را با اسم، مورد خطاب قرار می‌دهد مانند این است که در حال نصیحت کردن یک دوست است و اینکار بسیار راحت تر از آن است که تلاش کنید اعتماد به نفس خود را بالا ببرید.</span></p><p><span class=\"text-big\"><strong>3-به خودتان برسید:</strong></span></p><p><span class=\"text-big\">مراقبت از خود، هم از جنبه‌ی فیزیکی و هم روحی، در کنترل سطوح اضطراب کمک‌تان می‌کند؛ به این صورت که باعث می‌شود وقتی زیر فشار استرس هستید، احساس راحتی کرده و مقداری از انرژی عصبی که تولید شده را در جهت مثبت استفاده کنید.&nbsp;</span></p><p><span class=\"text-big\"><strong>4-مثبت فکر کنید :</strong></span></p><p><span class=\"text-big\">زود قضاوت نکنید. شاید بعضی‌ها به ظاهر بی‌تفاوت یا بی‌علاقه به نظر برسند، اما در حقیقت روی گفته‌های شما تمرکز کرده‌اند.</span></p><p><span class=\"text-big\"><strong>5-جسمتان را اماده کنید :</strong></span></p><p><span class=\"text-big\">شب قبل از سخنرانی خوب بخوابید. طی روز آب کافی بنوشید و قبل از سخنرانی غذای سبکی میل کنید.</span></p><p><span class=\"text-big\"><strong>6-صبح روز سخنرانی خود ورزش کنید:</strong></span></p><p><span class=\"text-big\">اگر اجرای یک سخنرانی شما را وحشت‌زده می‌کند خود را در اتاقتان حبس نکنید و روی این ترس تمرکز نکنید، به جای اینکار از محیط بسته خارج شده و بدوید یا پیاده‌روی کنید تا فشار این تجربه‌ی اضطراب‌آور را کاهش دهید.</span></p><p><span class=\"text-big\">مقاله از سارا رجبی</span><br><a href=\"https://instagram.com/sararajabi.ir?igshid=jvrmivyxcg5r\"><span class=\"text-big\">اینستاگرام</span></a><br><a href=\"https://t.me/sara_rajabi\"><span class=\"text-big\">تلگرام</span></a></p>','App\\Models\\Article',1),(2,'<h3><span class=\"text-small\">تا حالا پیش اومده بخوای با یک نفر سر صحبت رو باز کنی اما ندونی که چجوری باید این کار رو انجام بدی ؟&nbsp;</span></h3><h2>تا پایان این دوره با من همراه باش&nbsp;</h2><p>چطور میشه سر صحبت رو باز کرد؟&nbsp;<br>بعضی وقت ها دوست داریم که با بعضی از آدمها ارتباط بگیریم و باهاشون صحبت کنیم اما نمیدونیم چجوری.&nbsp;<br>بیشتر وقتا ما با کسی که میخوایم، نمیتونیم ارتباط بگیریم چون نحوه باز کردن سر صحبت با بقیه رو بلد نیستیم.&nbsp;<br>توی این دوره قصد داریم چند روش جادویی و منحصر به فرد بهتون آموزش بدیم<br>&nbsp;تا با اون ها با هر کسی که خواستید ارتباط برقرار کنید<br>&nbsp;و در مورد موضوعی با اون حرف بزنید.&nbsp;</p><p><span class=\"text-big\" style=\"background-color:hsl(0,0%,100%);\"><mark class=\"marker-blue\"><strong>همراه ما باشید.</strong></mark></span></p>','App\\Models\\Course',1),(3,'<h2><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>اطلاعات&nbsp;دوره صحبت در جمع، سخنوری و فن بیان</strong></span></h2><p><span class=\"text-big\" style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>مدرس : سارا رجبی</strong></span></p><p><span class=\"text-big\" style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>محل برگزاری :</strong></span><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>هر جایی که شما دوست دارین&nbsp;</strong></span></p><p><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>مبلغ سرمایه گذاری : 50 هزار تومان&nbsp;</strong></span></p><h3><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>با ثبت نام در این دوره دریافت می‌کنید?</strong></span></h3><p><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>فایل های صوتی : شامل 5 فایل صوتی با کیفیت</strong></span></p><p><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>&nbsp;</strong></span></p><blockquote><p><span style=\"background-color:rgb(223,240,216);color:rgb(60,118,61);\">متأسفانه در بسیاری از کشور‌های پیشرفته و حتی در حال توسعه دنیا، مهارت‌های ارتباطی، سخنرانی و </span><strong>فن بیان</strong><span style=\"background-color:rgb(223,240,216);color:rgb(60,118,61);\">&nbsp; به عنوان یک ابزار بسیار کابردی و ضروری، در مدرسه‌ها آموزش داده می‌شود اما در کشور ما این گونه نیست بنابراین کسانی که در کشور ما این موضوعات را به صورت علمی و اصولی فرا می‌گیرند. </span><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>?</strong></span></p></blockquote><p>✅در بسیاری از موارد از دیگران جلوتر هستند.</p><p>✅بسیاری از مشکلات را به سادگی حل خواهند کرد.</p><p>✅در موقعیت‌هایی مثل صحبت در جمع و یا سخنرانی، نه تنها نگران و ناتوان نیستند، بلکه به سادگی توانمندی خود را بروز می‌دهند</p><p>&nbsp;پس خوشحالم که شما نیز با شرکت در این دوره، قصد دارید مهارت‌های بسیار پیشرفته ارتباطی را فرا بگیرید.</p><figure class=\"image image_resized\" style=\"width:23.65%;\"><img src=\"https://sararajabi.poshtiban.io/signed/58e9aeb98e94345341b81f2d8da457bc/1650284190/607c2317801cca4c161e83e8/IMG_20210418_164359_862.jpg\"></figure><h2 style=\"text-align:justify;\"><span style=\"background-color:transparent;color:rgb(0,0,0);\"><strong>این کلاس مناسب چه کسانی است؟</strong></span></h2><p style=\"text-align:justify;\">موضوع فن بیان ، سخنوری و سخنرانی آنقدر گسترده است که فرقی نمی‌کند که شما در کدامیک از مشاغل زیر باشید، بدون شک به فن بیان، قدرت سخنوری و سخنرانی و به طور کلی مهارت‌های خوب صحبت کردن و برقراری ارتباط با دیگران&nbsp;نیاز دارید… مدیران ارشد مسئولین و سرپرست بخش‌ها مسئولین روابط عمومی مدرسان و اساتید دانشجویان کارشناسی ارشد و دکتری کسانی که نیاز به ارائه گزاش در جمع دارند کسانی که به هر طریقی می‌خواهند مهارت‌های کلامی و ارتباطی آنها تقویت شود…</p><h3><strong>بهانه‌هایی برای شرکت نکردن در دوره فن بیان</strong></h3><h3><strong>?</strong></h3><p>⛔️ باشه یکم سرم که خلوت شد :(</p><p>⛔️&nbsp;الان کارهای مهم تری دارم!</p><p>⛔️ من درست بشو نیستم!</p><p>​⛔️&nbsp;خیلی گرونه، ارزشش رو نداره! (رایگانه که!!!!!)</p><p>⛔️ بعید می دونم اثری داشته باشه..</p><p>⛔️ دیگه از من که گذشته... من رو چه به مهارت آموزی آخه!</p><p>⛔️​ این چیزا با آموزش درست نمی شه! ذاتیه!</p><p>⛔️&nbsp;با آموزش که آدم تغییر نمی‌کنه! باید خودم تصمیم بگیرم تغییر کنم.</p><p>⛔️ اینا یه کیسه دوختن واسه جیب خودشون به فکر بقیه نیستن که (بابا رایگانه میگم!!!!)</p><p>⛔️​ من که نمی‌خوام آپولو هوا کنم، همین زندگی عادی که دارم خوبه دیگه!</p><p>⛔️ نتیجه نمیده فقط انگیزشیه!</p><p>⛔️ اعتماد ندارم!</p><h2><strong>مدرس کیه ؟&nbsp;</strong></h2><h4><span style=\"background-color:hsl(150,75%,60%);\"><strong>سارا رجبی</strong></span></h4><ol><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">مدرس فن بیان و مهارت های ارتباطی</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">مدرس تولید محتوا</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">مدرس مجموعه فرهنگی ، آموزشی گیلدا</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">برگزار کننده چندین دوره ی آنلاین فن بیان</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">مجری جشن ها و مراسم ها</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">مجری اولین همایش کشوری کودکان صلح و گفت و گو</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">مستر مجری جشنواره ی قصه گویی</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">دومین مجری جوان کشور در سال 1397</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">هنرجو دوره ی فن بیان حرفه ای</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">دارنده ی چکاوک سیمین جشنواره مجریان و هنرمندان صحنه ایران</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">دارنده ی گواهی معتبر از باشگاه ایرآنمجری</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">دارنده مدرک حرفه ای فن بیان و اجرا</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">دارنده گواهی معتبر سخنرانی حرفه ای&nbsp; از فنی حرفه ای</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">برگزیده جشنواره قصه گویی</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">نویسنده کتاب (( خدا ))</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">نویسنده کتاب (( ملکه باشیم ))</span></li><li style=\"text-align:justify;\"><span class=\"text-big\" style=\"color:black;\">نویسنده چندین مقاله در زمینه فن بیان و مهارت های ارتباطی</span></li></ol><p style=\"text-align:justify;\">&nbsp;</p><h2 style=\"text-align:center;\"><span class=\"text-big\" style=\"background-color:hsl(0,75%,60%);color:hsl(0,0%,100%);\">برای ثبت نام همین الان اقدام کنید</span></h2>','App\\Models\\Course',2),(155,'<p>سشیسشیسی</p>','App\\Models\\Course',3);
/*!40000 ALTER TABLE `descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `file_ibfk_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,'جلسه اول از دوره اموزشی چطور سر صحبت را باز کنیم ؟','https://www.aparat.com/v/HcCiX',1),(2,'جلسه دوم از دوره آموزشی چطور سر صحبت را باز کنیم ؟','https://www.aparat.com/v/e3Hc0',2);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '\n',
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL COMMENT '0 = image | 1 = video',
  `media_id` int NOT NULL,
  `media_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'IMG_20210418_164359_862.jpg',0,1,'App\\Models\\Course'),(2,'Puzzled-Man-Picture.png',0,1,'App\\Models\\Article');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_02_05_072248_create_admins_table',1),(34,'2021_02_05_140629_create_articles_table',2),(35,'2021_02_05_140629_create_cart_table',2),(36,'2021_02_05_140629_create_categories_table',2),(37,'2021_02_05_140629_create_comments_table',2),(38,'2021_02_05_140629_create_courses_table',2),(39,'2021_02_05_140629_create_home_settings_table',2),(40,'2021_02_05_140629_create_like_table',2),(41,'2021_02_05_140629_create_medias_table',2),(42,'2021_02_05_140629_create_orders_table',2),(43,'2021_02_05_140629_create_password_resets_table',2),(44,'2021_02_05_140629_create_subCategories_table',2),(45,'2021_02_05_140629_create_users_table',2),(46,'2021_02_05_140631_add_foreign_keys_to_orders_table',2),(47,'2021_02_05_140631_add_foreign_keys_to_subCategories_table',2),(48,'2021_02_05_142349_create_admins_table',3),(49,'2021_02_08_104109_create_description_table',4),(50,'2021_03_01_151409_create_articles_table',0),(51,'2021_03_01_151409_create_carts_table',0),(52,'2021_03_01_151409_create_categories_table',0),(53,'2021_03_01_151409_create_comments_table',0),(54,'2021_03_01_151409_create_courses_table',0),(55,'2021_03_01_151409_create_descriptions_table',0),(56,'2021_03_01_151409_create_files_table',0),(57,'2021_03_01_151409_create_home_settings_table',0),(58,'2021_03_01_151409_create_likes_table',0),(59,'2021_03_01_151409_create_orders_table',0),(60,'2021_03_01_151409_create_password_resets_table',0),(61,'2021_03_01_151409_create_posters_table',0),(62,'2021_03_01_151409_create_status_table',0),(63,'2021_03_01_151409_create_subCategories_table',0),(64,'2021_03_01_151409_create_users_table',0),(65,'2021_03_01_151410_add_foreign_keys_to_articles_table',0),(66,'2021_03_01_151410_add_foreign_keys_to_carts_table',0),(67,'2021_03_01_151410_add_foreign_keys_to_courses_table',0),(68,'2021_03_01_151410_add_foreign_keys_to_files_table',0),(69,'2021_03_01_151410_add_foreign_keys_to_orders_table',0),(70,'2021_03_01_151410_add_foreign_keys_to_subCategories_table',0),(71,'2021_03_28_160330_create_articles_table',0),(72,'2021_03_28_160330_create_carts_table',0),(73,'2021_03_28_160330_create_categories_table',0),(74,'2021_03_28_160330_create_comments_table',0),(75,'2021_03_28_160330_create_consultations_table',0),(76,'2021_03_28_160330_create_courses_table',0),(77,'2021_03_28_160330_create_descriptions_table',0),(78,'2021_03_28_160330_create_files_table',0),(79,'2021_03_28_160330_create_media_table',0),(80,'2021_03_28_160330_create_orders_table',0),(81,'2021_03_28_160330_create_password_resets_table',0),(82,'2021_03_28_160330_create_settings_table',0),(83,'2021_03_28_160330_create_status_table',0),(84,'2021_03_28_160330_create_subCategories_table',0),(85,'2021_03_28_160330_create_users_table',0),(86,'2021_03_28_160331_add_foreign_keys_to_articles_table',0),(87,'2021_03_28_160331_add_foreign_keys_to_carts_table',0),(88,'2021_03_28_160331_add_foreign_keys_to_consultations_table',0),(89,'2021_03_28_160331_add_foreign_keys_to_courses_table',0),(90,'2021_03_28_160331_add_foreign_keys_to_files_table',0),(91,'2021_03_28_160331_add_foreign_keys_to_orders_table',0),(92,'2021_03_28_160331_add_foreign_keys_to_subCategories_table',0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `factor` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int DEFAULT '0',
  `transaction_id` varchar(265) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Invoice transaction number',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `users_ibfk_order` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (6,'App\\Models\\User',1,'auth-token','66afde2917d0452bbc497672bb7f3fbc1c975bc7ec30cd14a643434de507a41b','[\"*\"]','2021-05-16 14:19:26','2021-05-16 13:45:20','2021-05-16 14:19:26');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'header','آموزش فن بیان و مهارت های ارتباطی'),(2,'subHeader','فن بیان'),(3,'description','اینجا بهت کمک می کنیم مهم ترین مهارت زندگی رو یاد بگیری ، خوب حرف بزنی ، ادم هارو متقاعد کنی ، جذاب باشی و ارتباطات عالی رو شکل بدی'),(4,'firstEvent',NULL),(5,'firstEventUrl',NULL),(6,'secondEvent',NULL),(7,'secondEventUrl',NULL),(8,'thirdEvent',NULL),(9,'thirdEventUrl',NULL),(10,'fourthEvent',NULL),(11,'fourthEventUrl',''),(13,'whyMe','<h3>سلام</h3><h4><span style=\"background-color:hsl(90, 75%, 60%);\">به وب سایت من خوش آمدید .</span></h4><p><span class=\"text-big\" style=\"background-color:rgb(255,255,255);color:hsl(0,0%,0%);\">ما در این وب سایت به آموزش مهارت‌های ارتباطی، فن بیان، سخنرانی می‌پردازیم که برای یک زندگی موثرتر و حرفه‌ای‌تر نیاز است.</span><br><span class=\"text-big\" style=\"background-color:rgb(255,255,255);color:hsl(0,0%,0%);\">&nbsp;با این آموزش‌ها می توانید بهتر و موثر تر ارتباط برقرار کنید و دوستی های پایداری رو شکل بدید</span><br><span class=\"text-big\" style=\"color:hsl(0,0%,0%);\">دوره ها در این وبسایت با یک قیمت عالی برگزار میشود شما می تونید با پرداخت کمترین قیمت بیشترین بازخورد و بازدهی رو بگیرید .</span></p><h4>مدرس این وب سایت :<br><span style=\"color:hsl(0,75%,60%);\">سارا رجبی</span><span style=\"color:hsl(0,0%,60%);\">&nbsp;</span></h4><p><span style=\"color:black;\">مدرس فن بیان و مهارت های ارتباطی</span><br><span style=\"color:black;\">مدرس تولید محتوا</span><br><span style=\"color:black;\">مدرس مجموعه فرهنگی ، آموزشی گیلدا</span><br><span style=\"color:black;\">برگزار کننده چندین دوره ی آنلاین فن بیان</span><br><span style=\"color:black;\">مجری جشن ها و مراسم ها</span><br><span style=\"color:black;\">مجری اولین همایش کشوری کودکان صلح و گفت و گو</span><br><span style=\"color:black;\">مستر مجری جشنواره ی قصه گویی</span><br><span style=\"color:black;\">دومین مجری جوان کشور در سال 1397</span><br><span style=\"color:black;\">هنرجو دوره ی فن بیان حرفه ای</span><br><span style=\"color:black;\">دارنده ی چکاوک سیمین جشنواره مجریان و هنرمندان صحنه ایران</span><br><span style=\"color:black;\">دارنده ی گواهی معتبر از باشگاه ایرآنمجری</span><br><span style=\"color:black;\">دارنده مدرک حرفه ای فن بیان و اجرا</span><br><span style=\"color:black;\">دارنده گواهی معتبر سخنرانی حرفه ای&nbsp; از فنی حرفه ای</span><br><span style=\"color:black;\">برگزیده جشنواره قصه گویی</span><br><span style=\"color:black;\">نویسنده کتاب (( <strong>خدا</strong> ))</span><br><span style=\"color:black;\">نویسنده کتاب (( <strong>ملکه باشیم</strong> ))</span><br><span style=\"color:black;\">نویسنده چندین مقاله در زمینه فن بیان و مهارت های ارتباطی</span></p><p>برای ارتباط بیشتر با مدرس از راه های ارتباطی زیر اقدام کنید :</p><p>شماره تماس : 09140734880<br>آیدی اینستاگرام سارا رجبی : <a href=\"https://www.instagram.com/sararajabi.ir/\">sararajabi.ir@</a><br>گروه آموزشی تلگرام : <a href=\"https://t.me/joinchat/UzdcLu101RM6DgAp\">sararajabi</a>&nbsp;<br>کانال تلگرام : <a href=\"https://t.me/sara_rajabi\">sara_rajabi@</a><br>ایمیل : <a href=\"mailto:sararajabiart3@gmail.com\">sararajabiart3@gmail.com</a></p><figure class=\"image image_resized image-style-side\" style=\"width:66.9%;\"><img src=\"https://sararajabi.poshtiban.io/signed/ebce1206007a5c9ec137baaf0ad3414a/1648720424/606446a971f4b257a6506aff/nwdn_file_temp_1617182145563.png\"></figure><p>&nbsp;</p>');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL COMMENT '0 = Visible | 1 = Invisible | 2 = Not_paid(order) | 3 = Paid(order)',
  `status_id` int NOT NULL,
  `status_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,0,1,'App\\Models\\Course'),(2,0,2,'App\\Models\\Course'),(3,0,1,'App\\Models\\Article'),(4,0,1,'App\\Models\\Category'),(5,0,2,'App\\Models\\Category'),(6,0,3,'App\\Models\\Category'),(7,0,4,'App\\Models\\Category'),(8,0,1,'App\\Models\\Subcategory\r\n'),(9,0,1,'App\\Models\\Subcategory'),(10,0,3,'App\\Models\\Course'),(11,0,25,'App\\Models\\Coupon'),(12,0,26,'App\\Models\\Coupon'),(13,0,27,'App\\Models\\Coupon'),(14,0,3,'App\\Models\\Subcategory');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `subcategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_ibfk_subCategory` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,'فن بیان',3),(3,'مهارت های ارتباطی',1);
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int NOT NULL DEFAULT '0' COMMENT '0 = User | 1 = Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Parsa Samandi','parsasamandizadeh@gmail.com','09375261250','2021-03-21 18:28:57','$2y$10$38FhAjcwMCl4LmH9zCYT2OoiY7Xf2EYA49ENgq8aF8i1eCjcAaWDC','dzfLQjwR4elFpplkZwKbYpaUdn7hJ3ckfrA3GN5GuqN3KY1SmITWzWUf2pHB',1,'2021-03-22 12:06:10','2021-03-22 12:06:10'),(2,'Parsa Samandi','parsa.barcaa@gmail.com','09123901996',NULL,'$2y$10$zauyv1Bm5xelXUtXPuzKmeXWA1nr4mOjSYnugaV5fBeRO9iqpt5Ze',NULL,0,'2021-04-18 15:09:39','2021-04-18 15:09:39'),(3,'oskol mahal','sjjzgamer@gmail.com','09306556042',NULL,'$2y$10$.oPaLZU9OfWt7.2atx3NlucKFJmo5hThjN/h4/avL7hEdcKScDWKm',NULL,0,'2021-04-27 11:08:59','2021-04-27 11:08:59'),(4,'عباس بوعزار','soroushjorjorzade@gmail.com','09306556042','2021-04-28 15:10:01','$2y$10$1rU/vGWiX.7l/uukJ295Ve0XvAeT6c2SuO.78al3vFn0rEB.Mn.Oa',NULL,0,'2021-04-27 12:11:33','2021-04-28 15:10:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-26 19:30:48
