-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 22, 2019 lúc 10:56 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quiz`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_nm` varchar(255) DEFAULT NULL,
  `ans_correct` int(11) DEFAULT NULL,
  `del_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `answer`
--

INSERT INTO `answer` (`answer_id`, `question_id`, `answer_nm`, `ans_correct`, `del_flag`) VALUES
(1, 1, 'Ans 1A', 0, 0),
(2, 1, 'Ans 1B', 1, 0),
(3, 1, 'Ans 1C', 0, 0),
(4, 1, 'Ans 1D', 0, 0),
(5, 2, 'Ans 2.A', 0, 0),
(6, 2, 'Ans 2.B', 1, 0),
(7, 2, 'Ans 2.C', 0, 0),
(8, 2, 'Ans 2.D', 0, 0),
(9, 3, 'Ans 3.A', 0, 0),
(10, 3, 'Ans 3.B', 1, 0),
(11, 3, 'Ans 3.C', 0, 0),
(12, 3, 'Ans 3.D', 0, 0),
(13, 4, 'Ans 4.A', 0, 0),
(14, 4, 'Ans 4.B', 1, 0),
(15, 4, 'Ans 4.C', 0, 0),
(16, 4, 'Ans 4.D', 0, 0),
(17, 5, 'Ans 5.A', 0, 0),
(18, 5, 'Ans 5.B', 1, 0),
(19, 5, 'Ans 5.C', 0, 0),
(20, 5, 'Ans 5.D', 0, 0),
(21, 10, 'dap an 1', 0, 0),
(22, 10, 'dap an 2', 0, 0),
(23, 10, 'dap an 3', 0, 0),
(24, 10, 'dap an 4', 0, 0),
(25, 6, 'g1', 0, 0),
(26, 6, 'g2B', 1, 0),
(27, 6, 'g3', 0, 0),
(28, 6, 'g4', 0, 0),
(29, 7, 'df', 0, 0),
(30, 7, 'sdfsB', 1, 0),
(31, 7, 'cbxcbx', 0, 0),
(32, 7, 'cvxcv', 0, 0),
(33, 8, 'vfwe', 0, 0),
(34, 8, 'dsdfB', 1, 0),
(35, 8, 'outytertr', 0, 0),
(36, 8, 'sdf', 0, 0),
(37, 9, 'bmc', 0, 0),
(38, 9, 'nbB', 1, 0),
(39, 9, 'xvsd', 0, 0),
(40, 9, 'gxv', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assign`
--

CREATE TABLE `assign` (
  `assign_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `accept_email` int(11) DEFAULT NULL,
  `status_exam` int(11) DEFAULT NULL,
  `del_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `assign`
--

INSERT INTO `assign` (`assign_id`, `member_id`, `language_id`, `accept_email`, `status_exam`, `del_flag`) VALUES
(3, 2, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_nm` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `description` text,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `del_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `company`
--

INSERT INTO `company` (`id`, `company_nm`, `address`, `email`, `tel`, `description`, `facebook`, `instagram`, `logo`, `website`, `del_flag`) VALUES
(1, 'Saishunkan System Vietnam', '14FL., Hoa Binh Tower,106 Hoang Quoc Viet, Nghia Do Ward Cau Giay Dist., Viet Nam.  ', 'vantuant2@gmail.com', '+84.4.3212.1048', 'Saishunkan System Vietnam là công ty IT 100% vốn đầu tư từ Nhật Bản, được thành lập năm 2015. Công ty chúng tôi hoạt động trong lĩnh vực thiết kế và phát triển ứng dụng, website. Các ngôn ngữ chủ yếu là: Java, PHP, C#, Objective C, Swift.....\r\n\r\nQuy trình làm việc của chúng tôi là các chuyên gia đến từ Nhật Bản làm việc cùng với đội ngũ nhân viên từ khâu thiết kế, phát triển đến đảm bảo chất lượng, chúng tôi luôn cố gắng để đáp ứng các yêu cầu của khách hàng một cách nhanh nhất, chất lượng nhất.\r\n\r\nSong song với việc đầu tư vào công nghệ mới, cải tiến quy trình, chúng tôi có mong muốn hợp tác với các kỹ sư, lập trình viên ưu tú để có thể cung cấp những dịch vụ chất lượng nhất cho khách hàng.\r\n\r\nGia nhập Công ty chúng tôi, nhân viên có cơ hội được làm việc trong một môi trường trẻ trung, năng động, có tính xây dựng cao. Với phương châm “cùng hợp tác, cùng phát triển”.', 'https://www.facebook.com/saishunkansystem/', NULL, 'logo.jpg', 'http://vn.saishunkansys.com/', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `language`
--

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `language_nm` varchar(255) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `language_time` int(11) NOT NULL,
  `del_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `language`
--

INSERT INTO `language` (`language_id`, `language_nm`, `language_parent`, `language_time`, `del_flag`) VALUES
(1, 'PHP', 0, 3600, 0),
(2, 'Javascript', 0, 3600, 0),
(3, 'Ma de PHP 001', 1, 2500, 0),
(4, 'Ma de PHP 002', 1, 3600, 0),
(5, 'Ma de Javascript 001', 2, 3600, 0),
(6, 'Ma de Javascript 002', 2, 3600, 0),
(7, 'ngôn ngữ khác', 0, 3501, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address1` text,
  `address2` text,
  `gender` int(11) DEFAULT NULL,
  `shool` varchar(255) DEFAULT NULL,
  `education_year` varchar(255) DEFAULT NULL,
  `interview_start` date DEFAULT NULL,
  `interview_end` date DEFAULT NULL,
  `experience_year` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `del_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `member`
--

INSERT INTO `member` (`member_id`, `username`, `password`, `email`, `birthday`, `address1`, `address2`, `gender`, `shool`, `education_year`, `interview_start`, `interview_end`, `experience_year`, `role`, `del_flag`) VALUES
(1, 'tuan', '123', 'vantuant2@gmail.com', '2019-03-14', 'we', NULL, 0, NULL, '2016', NULL, NULL, NULL, 1, 0),
(2, 'chi', '123', 'chitran241296@gmail.com', '2019-03-22', 'sfs', 'sdf', 1, NULL, '2015', NULL, NULL, NULL, 2, 0),
(3, 'an', '123', 'vantuant2@gmail.com', '2019-03-12', NULL, NULL, 1, NULL, '2014', '1970-01-01', '1970-01-01', NULL, 2, 0),
(4, 'ok', '12345', NULL, NULL, '3453', NULL, 0, NULL, '2013', NULL, NULL, NULL, 2, 0),
(5, 'ngoc223', '89746', 'yuiyui22@gmail.com', '2019-03-24', 'yui32e', NULL, 1, NULL, '2012', '1970-01-01', '1970-01-01', NULL, 2, 0),
(27, 'fhfgh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 'vues', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question_nm` varchar(255) NOT NULL,
  `question_code` text,
  `language_id` int(11) NOT NULL,
  `del_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `question`
--

INSERT INTO `question` (`question_id`, `question_nm`, `question_code`, `language_id`, `del_flag`) VALUES
(1, 'Cau hoi 1', NULL, 3, 0),
(2, 'Câu hỏi 2', NULL, 3, 0),
(3, 'Câu hỏi 3', NULL, 1, 0),
(4, 'Câu hỏi 4', NULL, 1, 0),
(5, 'Câu hỏi số 5', '$.ajax({\n        url: \'/admin/assign/del_row\',\n        type: \'POST\',\n        dataType: \'json\',\n        data: {\n            assign_id: id\n        }\n    }).done(function(res) {\n       // debugger;\n        $.MessageBox({\n            //input    : true,\n            message  : &quot;Delete success&quot;\n        }).done(function(){\n            pos.parents(&quot;.exam&quot;).remove();\n        });\n    });', 3, 0),
(6, 'Câu hỏi 6: Trả lời đáp án dưới đây', '', 4, 0),
(7, 'Câu hỏi 7', '<label for=\"ans_{{ $i }}\">Câu trả lời {{ $i }}:</label>\r\n            <input type=\"text\" class=\"form-control\" id=\"ans_{{ $i }}\" name=\"ans[{{ $i }}][answer_nm]\" value=\"{{ isset($data[$i-1])?$data[$i-1]->answer_nm:\'\' }}\">\r\n            <div class=\"checkbox\">\r\n                <label><input type=\"checkbox\" value=\"0\" id=\"ans_correct_{{ $i }}\" name=\"ans[{{ $i }}][ans_correct]\"\r\n                              {{ (isset($data[$i-1]) && $data[$i-1]->ans_correct == 1)?\'checked\':\'\' }}>Đáp án đúng\r\n                </label>\r\n            </div>', 3, 0),
(8, 'cau hoi 8', '()-&gt;flash(\'alert-success\', \'Gửi email th&agrave;nh c&ocirc;ng!\');', 3, 0),
(9, 'ádasdas', '$data-&gt;question_nm      = $request-&gt;question_nm;\r\n            $data-&gt;question_code    = htmlentities($request-&gt;question_code);', 2, 0),
(10, 'câu hỏi 10', 'var data = getData(_obj);\r\n            data[\'gender\'] = $(\'#gender\').val();\r\n            data[\'education_year\'] = $(\'#education_year\').val();\r\n            data[\'role\'] = $(\'#role\').val();\r\n\r\n            $.ajax({\r\n                url: \'/admin/member/process_update\',\r\n                type: \'GET\',\r\n                dataType: \'json\',\r\n                data: data\r\n            }).done(function(res) {\r\n                location.href= &quot;member&quot;;\r\n            });', 3, 0),
(11, 'cau hoi javascrip 1', 'fsdfsd', 5, 0),
(12, 'cau hoi javascrip 2', '', 5, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `result`
--

CREATE TABLE `result` (
  `result_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `ans_correct` int(11) DEFAULT NULL,
  `answer_member` int(11) DEFAULT NULL,
  `del_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Chỉ mục cho bảng `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`assign_id`);

--
-- Chỉ mục cho bảng `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`);

--
-- Chỉ mục cho bảng `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Chỉ mục cho bảng `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Chỉ mục cho bảng `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `assign`
--
ALTER TABLE `assign`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
