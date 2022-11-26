-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 26, 2022 lúc 08:07 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `blog_website`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(4, 'Art', 'Description&#039;s art'),
(6, 'Food', 'Description&#039;s Food'),
(7, 'Wild life', 'Description&#039;s Wild life'),
(8, 'Uncategorized', 'This&#039;s Uncategorized&#039;s descript '),
(9, 'Music', 'Music&#039;s description'),
(10, 'Socials', 'Socials&#039;s desciption'),
(11, 'Travel', 'Travel&#039;s description\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int UNSIGNED DEFAULT NULL,
  `author_id` int UNSIGNED NOT NULL,
  `is_featured` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `thumbnail`, `date_time`, `category_id`, `author_id`, `is_featured`) VALUES
(17, 'Ho&agrave;n Hảo - B Ray', 'M&agrave;y lu&ocirc;n muốn một người ho&agrave;n hảo, nhưng bản th&acirc;n th&igrave; c&oacute; những g&igrave;?\r\nNếu kẻ n&agrave;o cũng muốn về nhất th&igrave; trong thế gian n&agrave;y ai về nh&igrave;?', '1669426430blog82.jpg', '2022-11-26 01:33:50', 9, 4, 0),
(20, 'Lorem ipsum is placeholder text commonly used in the graphic', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with:&#13;&#10;&#13;&#10;“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”&#13;&#10;The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn&#39;t distract from the layout. A practice not without controversy, laying out pages with meaningless filler text can be very useful when the focus is meant to be on design, not content.&#13;&#10;&#13;&#10;The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it&#39;s seen all around the web; on templates, websites, and stock designs. Use our generator to get your own, or read on for the authoritative history of lorem ipsum.', '1669431150blog1.jpg', '2022-11-26 02:52:31', 4, 4, 0),
(21, 'INTERPRETING NONSENSE', 'Don&#39;t bother typing “lorem ipsum” into Google translate. If you already tried, you may have gotten anything from &#34;NATO&#34; to &#34;China&#34;, depending on how you capitalized the letters. The bizarre translation was fodder for conspiracy theories, but Google has since updated its “lorem ipsum” translation to, boringly enough, “lorem ipsum”.&#13;&#10;&#13;&#10;One brave soul did take a stab at translating the almost-not-quite-Latin. According to The Guardian, Jaspreet Singh Boparai undertook the challenge with the goal of making the text “precisely as incoherent in English as it is in Latin - and to make it incoherent in the same way”. As a result, “the Greek &#39;eu&#39; in Latin became the French &#39;bien&#39; [...] and the &#39;-ing&#39; ending in &#39;lorem ipsum&#39; seemed best rendered by an &#39;-iendum&#39; in English.”&#13;&#10;&#13;&#10;Here is the classic lorem ipsum passage followed by Boparai&#39;s odd, yet mesmerizing version:&#13;&#10;&#13;&#10;“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit nisi sed sollicitudin pellentesque. Nunc posuere purus rhoncus pulvinar aliquam. Ut aliquet tristique nisl vitae volutpat. Nulla aliquet porttitor venenatis. Donec a dui et dui fringilla consectetur id nec massa. Aliquam erat volutpat. Sed ut dui ut lacus dictum fermentum vel tincidunt neque. Sed sed lacinia lectus. Duis sit amet sodales felis. Duis nunc eros, mattis at dui ac, convallis semper risus. In adipiscing ultrices tellus, in suscipit massa vehicula eu.”&#13;&#10;Boparai&#39;s version:&#13;&#10;&#13;&#10;“Rrow itself, let it be sorrow; let him love it; let him pursue it, ishing for its acquisitiendum. Because he will ab hold, uniess but through concer, and also of those who resist. Now a pure snore disturbeded sum dust. He ejjnoyes, in order that somewon, also with a severe one, unless of life. May a cusstums offficer somewon nothing of a poison-filled. Until, from a twho, twho chaffinch may also pursue it, not even a lump. But as twho, as a tank; a proverb, yeast; or else they tinscribe nor. Yet yet dewlap bed. Twho may be, let him love fellows of a polecat. Now amour, the, twhose being, drunk, yet twhitch and, an enclosed valley’s always a laugh. In acquisitiendum the Furies are Earth; in (he takes up) a lump vehicles bien.”&#13;&#10;Nick Richardson described the translation “like extreme Mallarmé, or a Burroughsian cut-up, or a paragraph of Finnegans Wake. Bits of it have surprising power: the desperate insistence on loving and pursuing sorrow, for instance, that is cheated out of its justification – an incomplete object that has been either fished for, or wished for.”', '1669431253blog62.jpg', '2022-11-26 02:54:13', 7, 15, 0),
(22, 'DIGITAL IPSUM', 'The decade that brought us Star Trek and Doctor Who also resurrected Cicero—or at least what used to be Cicero—in an attempt to make the days before computerized design a little less painstaking.&#13;&#10;&#13;&#10;The French lettering company Letraset manufactured a set of dry-transfer sheets which included the lorem ipsum filler text in a variety of fonts, sizes, and layouts. These sheets of lettering could be rubbed on anywhere and were quickly adopted by graphic artists, printers, architects, and advertisers for their professional look and ease of use.&#13;&#10;&#13;&#10;Aldus Corporation, which later merged with Adobe Systems, ushered lorem ipsum into the information age with its desktop publishing software Aldus PageMaker. The program came bundled with lorem ipsum dummy text for laying out page content, and other word processors like Microsoft Word followed suit. More recently the growth of web design has helped proliferate lorem ipsum across the internet as a placeholder for future text—and in some cases the final content (this is why we proofread, kids).', '1669431270blog52.jpg', '2022-11-26 02:54:30', 6, 15, 0),
(23, 'DESIGN OR (DIS)CONTENT', 'Among design professionals, there&#39;s a bit of controversy surrounding the filler text. Controversy, as in Death to Lorem Ipsum.&#13;&#10;&#13;&#10;The strength of lorem ipsum is its weakness: it doesn&#39;t communicate. To some, designing a website around placeholder text is unacceptable, akin to sewing a custom suit without taking measurements. Kristina Halvorson notes:&#13;&#10;&#13;&#10;“I’ve heard the argument that “lorem ipsum” is effective in wireframing or design because it helps people focus on the actual layout, or color scheme, or whatever. What kills me here is that we’re talking about creating a user experience that will (whether we like it or not) be DRIVEN by words. The entire structure of the page or app flow is FOR THE WORDS.”&#13;&#10;Lorem ipsum is so ubiquitous because it is so versatile. Select how many paragraphs you want, copy, paste, and break the lines wherever it is convenient. Real copy doesn&#39;t work that way.&#13;&#10;&#13;&#10;As front-end developer Kyle Fiedler put it:&#13;&#10;&#13;&#10;“When you are designing with Lorem Ipsum, you diminish the importance of the copy by lowering it to the same level as any other visual element. The text simply becomes another supporting role, serving to make other aspects more aesthetic. Instead of your design enhancing the meaning of the content, your content is enhancing your design.”&#13;&#10;But despite zealous cries for the demise of lorem ipsum, others, such as Karen McGrane, offer appeals for moderation:&#13;&#10;&#13;&#10;“Lorem Ipsum doesn’t exist because people think the content is meaningless window dressing, only there to be decorated by designers who can’t be bothered to read. Lorem Ipsum exists because words are powerful. If you fill up your page with draft copy about your client’s business, they will read it. They will comment on it. They will be inexorably drawn to it. Presented the wrong way, draft copy can send your design review off the rails.”&#13;&#10;And that’s why a 15th century typesetter might have scrambled a passage of Cicero; he wanted people to focus on his fonts, to imagine their own content on the pages. He wanted people to see, and to get them to see he had to keep them from reading.', '1669431289blog50.jpg', '2022-11-26 02:54:49', 7, 15, 0),
(24, 'FORM OVER FUNCTION', 'So when is it okay to use lorem ipsum? First, lorem ipsum works well for staging. It&#039;s like the props in a furniture store&mdash;filler text makes it look like someone is home. The same Wordpress template might eventually be home to a fitness blog, a photography website, or the online journal of a cupcake fanatic. Lorem ipsum helps them imagine what the lived-in website might look like.\r\n\r\nSecond, use lorem ipsum if you think the placeholder text will be too distracting. For specific projects, collaboration between copywriters and designers may be best, however, like Karen McGrane said, draft copy has a way of turning any meeting about layout decisions into a discussion about word choice. So don&#039;t be afraid to use lorem ipsum to keep everyone focused.\r\n\r\nOne word of caution: make sure your client knows that lorem ipsum is filler text. You don&#039;t want them wondering why you filled their website with a foreign language, and you certainly don&#039;t want anyone prematurely publishing it.', '1669431314blog102.jpg', '2022-11-26 02:55:14', 9, 15, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) VALUES
(4, 'Lê', 'Vũ', 'admin', 'admin@gmail.com', '$2y$10$nN3ar1ac2bHblGmLPOaFceq9qD1NHhWLCbWcQiaY5G9kZZsVjHqte', '1669174361avatar6.jpg', 1),
(15, 'T&acirc;m', 'Nguyen Van', 'taikhoan1108', 'leaddas@gmail.com', '$2y$10$TIKBaEqpTPRMvMzmgbvtP..wcoclH0LPRuAybWwZM7Rc8SlFdWKgy', '1669252276avatar1.jpg', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blog_category` (`category_id`),
  ADD KEY `FK_blog_author` (`author_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_blog_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
