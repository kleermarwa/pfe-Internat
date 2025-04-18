-------- students_users--------

INSERT INTO `students` (`cin`, `name`, `email`, `password`, `phone`, `photo`, `gender`, `room_id`) VALUES
('A123456789', 'Ali Benomar', 'ali.benomar@example.com', MD5('password1'), '0612345678', '/uploads/photos/ali.jpg', 'male', 1),
('B987654321', 'Sara El Mansouri', 'sara.mansouri@example.com', MD5('password2'), '0623456789', '/uploads/photos/sara.jpg', 'female', 2),
('C123987654', 'Mohamed Tazi', 'mohamed.tazi@example.com', MD5('password3'), '0634567890', '/uploads/photos/mohamed.jpg', 'male', 3),
('D789456123', 'Fatima Zahra', 'fatima.zahra@example.com', MD5('password4'), '0645678901', '/uploads/photos/fatima.jpg', 'female', 4),
('E654321987', 'Youssef Idrissi', 'youssef.idrissi@example.com', MD5('password5'), '0656789012', '/uploads/photos/youssef.jpg', 'male', 5),
('F321654987', 'Amal Berrada', 'amal.berrada@example.com', MD5('password6'), '0667890123', '/uploads/photos/amal.jpg', 'female', 6),
('G789123456', 'Omar Chraibi', 'omar.chraibi@example.com', MD5('password7'), '0678901234', '/uploads/photos/omar.jpg', 'male', 7),
('H456789123', 'Nadia Amrani', 'nadia.amrani@example.com', MD5('password8'), '0689012345', '/uploads/photos/nadia.jpg', 'female', 8),
('I852963741', 'Karim Loukili', 'karim.loukili@example.com', MD5('password9'), '0690123456', '/uploads/photos/karim.jpg', 'male', 9),
('J147258369', 'Salma Raji', 'salma.raji@example.com', MD5('password10'), '0601234567', '/uploads/photos/salma.jpg', 'female', 10);

INSERT INTO `student_photos` (`student_cin`, `photo_path`) VALUES
('A123456789', '/uploads/photos/ali.jpg'),
('B987654321', '/uploads/photos/sara.jpg'),
('C123987654', '/uploads/photos/mohamed.jpg'),
('D789456123', '/uploads/photos/fatima.jpg'),
('E654321987', '/uploads/photos/youssef.jpg'),
('F321654987', '/uploads/photos/amal.jpg'),
('G789123456', '/uploads/photos/omar.jpg'),
('H456789123', '/uploads/photos/nadia.jpg'),
('I852963741', '/uploads/photos/karim.jpg'),
('J147258369', '/uploads/photos/salma.jpg');

-------- admin_users--------

INSERT INTO `admin_users` (`username`, `email`, `password`) VALUES
('admin1', 'admin1@example.com', 'admin1'),
('admin2', 'admin2@example.com', MD5('password2'));


-------- dorm rooms boys--------

INSERT INTO `rooms` (`room_number`, `dorm_id`, `floor`, `capacity`, `occupied_slots`) VALUES
-- Floor 1
(100, 3, 1, 4, 0), (101, 3, 1, 4, 0), (102, 3, 1, 4, 0), (103, 3, 1, 4, 0), (104, 3, 1, 4, 0), 
(105, 3, 1, 4, 0), (106, 3, 1, 4, 0), (107, 3, 1, 4, 0), (108, 3, 1, 4, 0), (109, 3, 1, 4, 0),
(110, 3, 1, 4, 0), (111, 3, 1, 4, 0), (112, 3, 1, 4, 0), (113, 3, 1, 4, 0), (114, 3, 1, 4, 0),
(115, 3, 1, 4, 0), (116, 3, 1, 4, 0), (117, 3, 1, 4, 0), (118, 3, 1, 4, 0), (119, 3, 1, 4, 0),
(120, 3, 1, 4, 0), (121, 3, 1, 4, 0), (122, 3, 1, 4, 0), (123, 3, 1, 4, 0), (124, 3, 1, 4, 0),
(125, 3, 1, 4, 0), (126, 3, 1, 4, 0), (127, 3, 1, 4, 0), (128, 3, 1, 4, 0), (129, 3, 1, 4, 0),
(130, 3, 1, 4, 0),

-- Floor 2
(200, 3, 2, 4, 0), (201, 3, 2, 4, 0), (202, 3, 2, 4, 0), (203, 3, 2, 4, 0), (204, 3, 2, 4, 0),
(205, 3, 2, 4, 0), (206, 3, 2, 4, 0), (207, 3, 2, 4, 0), (208, 3, 2, 4, 0), (209, 3, 2, 4, 0),
(210, 3, 2, 4, 0), (211, 3, 2, 4, 0), (212, 3, 2, 4, 0), (213, 3, 2, 4, 0), (214, 3, 2, 4, 0),
(215, 3, 2, 4, 0), (216, 3, 2, 4, 0), (217, 3, 2, 4, 0), (218, 3, 2, 4, 0), (219, 3, 2, 4, 0),
(220, 3, 2, 4, 0), (221, 3, 2, 4, 0), (222, 3, 2, 4, 0), (223, 3, 2, 4, 0), (224, 3, 2, 4, 0),
(225, 3, 2, 4, 0), (226, 3, 2, 4, 0), (227, 3, 2, 4, 0), (228, 3, 2, 4, 0), (229, 3, 2, 4, 0),
(230, 3, 2, 4, 0),

--floor 3
(300, 3, 3, 4, 0), (301, 3, 3, 4, 0), (302, 3, 3, 4, 0), (303, 3, 3, 4, 0), (304, 3, 3, 4, 0),
(305, 3, 3, 4, 0), (306, 3, 3, 4, 0), (307, 3, 3, 4, 0), (308, 3, 3, 4, 0), (309, 3, 3, 4, 0),
(310, 3, 3, 4, 0), (311, 3, 3, 4, 0), (312, 3, 3, 4, 0), (313, 3, 3, 4, 0), (314, 3, 3, 4, 0),
(315, 3, 3, 4, 0), (316, 3, 3, 4, 0), (317, 3, 3, 4, 0), (318, 3, 3, 4, 0), (319, 3, 3, 4, 0),
(320, 3, 3, 4, 0), (321, 3, 3, 4, 0), (322, 3, 3, 4, 0), (323, 3, 3, 4, 0), (324, 3, 3, 4, 0),
(325, 3, 3, 4, 0), (326, 3, 3, 4, 0), (327, 3, 3, 4, 0), (328, 3, 3, 4, 0), (329, 3, 3, 4, 0),
(330, 3, 3, 4, 0),

-- Floor 4
(400, 3, 4, 4, 0), (401, 3, 4, 4, 0), (402, 3, 4, 4, 0), (403, 3, 4, 4, 0), (404, 3, 4, 4, 0),
(405, 3, 4, 4, 0), (406, 3, 4, 4, 0), (407, 3, 4, 4, 0), (408, 3, 4, 4, 0), (409, 3, 4, 4, 0),
(410, 3, 4, 4, 0), (411, 3, 4, 4, 0), (412, 3, 4, 4, 0), (413, 3, 4, 4, 0), (414, 3, 4, 4, 0),
(415, 3, 4, 4, 0), (416, 3, 4, 4, 0), (417, 3, 4, 4, 0), (418, 3, 4, 4, 0), (419, 3, 4, 4, 0),
(420, 3, 4, 4, 0), (421, 3, 4, 4, 0), (422, 3, 4, 4, 0), (423, 3, 4, 4, 0), (424, 3, 4, 4, 0),
(425, 3, 4, 4, 0), (426, 3, 4, 4, 0), (427, 3, 4, 4, 0), (428, 3, 4, 4, 0), (429, 3, 4, 4, 0),
(430, 3, 4, 4, 0),

-- Floor 5
(500, 3, 5, 4, 0), (501, 3, 5, 4, 0), (502, 3, 5, 4, 0), (503, 3, 5, 4, 0), (504, 3, 5, 4, 0),
(505, 3, 5, 4, 0), (506, 3, 5, 4, 0), (507, 3, 5, 4, 0), (508, 3, 5, 4, 0), (509, 3, 5, 4, 0),
(510, 3, 5, 4, 0), (511, 3, 5, 4, 0), (512, 3, 5, 4, 0), (513, 3, 5, 4, 0), (514, 3, 5, 4, 0),
(515, 3, 5, 4, 0), (516, 3, 5, 4, 0), (517, 3, 5, 4, 0), (518, 3, 5, 4, 0), (519, 3, 5, 4, 0),
(520, 3, 5, 4, 0), (521, 3, 5, 4, 0), (522, 3, 5, 4, 0), (523, 3, 5, 4, 0), (524, 3, 5, 4, 0),
(525, 3, 5, 4, 0), (526, 3, 5, 4, 0), (527, 3, 5, 4, 0), (528, 3, 5, 4, 0), (529, 3, 5, 4, 0),
(530, 3, 5, 4, 0);

-------- dorm rooms girls 1 --------

INSERT INTO `rooms` (`room_number`, `dorm_id`, `floor`, `capacity`, `occupied_slots`) VALUES
-- Floor 1
(100, 1, 1, 4, 0), (101, 1, 1, 4, 0), (102, 1, 1, 4, 0), (103, 1, 1, 4, 0), (104, 1, 1, 4, 0), 
(105, 1, 1, 4, 0), (106, 1, 1, 4, 0), (107, 1, 1, 4, 0), (108, 1, 1, 4, 0), (109, 1, 1, 4, 0),
(110, 1, 1, 4, 0), (111, 1, 1, 4, 0), (112, 1, 1, 4, 0), (113, 1, 1, 4, 0), (114, 1, 1, 4, 0),
(115, 1, 1, 4, 0), (116, 1, 1, 4, 0), (117, 1, 1, 4, 0), (118, 1, 1, 4, 0), (119, 1, 1, 4, 0),
(120, 1, 1, 4, 0), (121, 1, 1, 4, 0), (122, 1, 1, 4, 0), (123, 1, 1, 4, 0), (124, 1, 1, 4, 0),
(125, 1, 1, 4, 0), (126, 1, 1, 4, 0), (127, 1, 1, 4, 0),

-- Floor 2
(200, 1, 2, 4, 0), (201, 1, 2, 4, 0), (202, 1, 2, 4, 0), (203, 1, 2, 4, 0), (204, 1, 2, 4, 0),
(205, 1, 2, 4, 0), (206, 1, 2, 4, 0), (207, 1, 2, 4, 0), (208, 1, 2, 4, 0), (209, 1, 2, 4, 0),
(210, 1, 2, 4, 0), (211, 1, 2, 4, 0), (212, 1, 2, 4, 0), (213, 1, 2, 4, 0), (214, 1, 2, 4, 0),
(215, 1, 2, 4, 0), (216, 1, 2, 4, 0), (217, 1, 2, 4, 0), (218, 1, 2, 4, 0), (219, 1, 2, 4, 0),
(220, 1, 2, 4, 0), (221, 1, 2, 4, 0), (222, 1, 2, 4, 0), (223, 1, 2, 4, 0), (224, 1, 2, 4, 0),
(225, 1, 2, 4, 0), (226, 1, 2, 4, 0), (227, 1, 2, 4, 0),

-- Floor 3
(300, 1, 3, 4, 0), (301, 1, 3, 4, 0), (302, 1, 3, 4, 0), (303, 1, 3, 4, 0), (304, 1, 3, 4, 0),
(305, 1, 3, 4, 0), (306, 1, 3, 4, 0), (307, 1, 3, 4, 0), (308, 1, 3, 4, 0), (309, 1, 3, 4, 0),
(310, 1, 3, 4, 0), (311, 1, 3, 4, 0), (312, 1, 3, 4, 0), (313, 1, 3, 4, 0), (314, 1, 3, 4, 0),
(315, 1, 3, 4, 0), (316, 1, 3, 4, 0), (317, 1, 3, 4, 0), (318, 1, 3, 4, 0), (319, 1, 3, 4, 0),
(320, 1, 3, 4, 0), (321, 1, 3, 4, 0), (322, 1, 3, 4, 0), (323, 1, 3, 4, 0), (324, 1, 3, 4, 0),
(325, 1, 3, 4, 0), (326, 1, 3, 4, 0), (327, 1, 3, 4, 0),

-- Floor 4
(400, 1, 4, 4, 0), (401, 1, 4, 4, 0), (402, 1, 4, 4, 0), (403, 1, 4, 4, 0), (404, 1, 4, 4, 0),
(405, 1, 4, 4, 0), (406, 1, 4, 4, 0), (407, 1, 4, 4, 0), (408, 1, 4, 4, 0), (409, 1, 4, 4, 0),
(410, 1, 4, 4, 0), (411, 1, 4, 4, 0), (412, 1, 4, 4, 0), (413, 1, 4, 4, 0), (414, 1, 4, 4, 0),
(415, 1, 4, 4, 0), (416, 1, 4, 4, 0), (417, 1, 4, 4, 0), (418, 1, 4, 4, 0), (419, 1, 4, 4, 0),
(420, 1, 4, 4, 0), (421, 1, 4, 4, 0), (422, 1, 4, 4, 0), (423, 1, 4, 4, 0), (424, 1, 4, 4, 0),
(425, 1, 4, 4, 0), (426, 1, 4, 4, 0), (427, 1, 4, 4, 0);

-------- dorm rooms girls 2 --------

INSERT INTO `rooms` (`room_number`, `dorm_id`, `floor`, `capacity`, `occupied_slots`) VALUES
-- Floor 1
(100, 2, 1, 4, 0), (101, 2, 1, 4, 0), (102, 2, 1, 4, 0), (103, 2, 1, 4, 0), (104, 2, 1, 4, 0), 
(105, 2, 1, 4, 0), (106, 2, 1, 4, 0), (107, 2, 1, 4, 0), (108, 2, 1, 4, 0), (109, 2, 1, 4, 0),
(110, 2, 1, 4, 0), (111, 2, 1, 4, 0), (112, 2, 1, 4, 0), (113, 2, 1, 4, 0), (114, 2, 1, 4, 0),
(115, 2, 1, 4, 0), (116, 2, 1, 4, 0), (117, 2, 1, 4, 0), (118, 2, 1, 4, 0), (119, 2, 1, 4, 0),
(120, 2, 1, 4, 0), (121, 2, 1, 4, 0), (122, 2, 1, 4, 0), (123, 2, 1, 4, 0), (124, 2, 1, 4, 0),
(125, 2, 1, 4, 0), (126, 2, 1, 4, 0), (127, 2, 1, 4, 0),

-- Floor 2
(200, 2, 2, 4, 0), (201, 2, 2, 4, 0), (202, 2, 2, 4, 0), (203, 2, 2, 4, 0), (204, 2, 2, 4, 0),
(205, 2, 2, 4, 0), (206, 2, 2, 4, 0), (207, 2, 2, 4, 0), (208, 2, 2, 4, 0), (209, 2, 2, 4, 0),
(210, 2, 2, 4, 0), (211, 2, 2, 4, 0), (212, 2, 2, 4, 0), (213, 2, 2, 4, 0), (214, 2, 2, 4, 0),
(215, 2, 2, 4, 0), (216, 2, 2, 4, 0), (217, 2, 2, 4, 0), (218, 2, 2, 4, 0), (219, 2, 2, 4, 0),
(220, 2, 2, 4, 0), (221, 2, 2, 4, 0), (222, 2, 2, 4, 0), (223, 2, 2, 4, 0), (224, 2, 2, 4, 0),
(225, 2, 2, 4, 0), (226, 2, 2, 4, 0), (227, 2, 2, 4, 0);


INSERT INTO `rooms` (`room_id`, `room_number`, `dorm_id`, `floor`, `capacity`, `occupied_slots`) VALUES
('100-3', 100, 3, 1, 4, 0), ('101-3', 101, 3, 1, 4, 0), ('102-3', 102, 3, 1, 4, 0), ('103-3', 103, 3, 1, 4, 0), ('104-3', 104, 3, 1, 4, 0),
('105-3', 105, 3, 1, 4, 0), ('106-3', 106, 3, 1, 4, 0), ('107-3', 107, 3, 1, 4, 0), ('108-3', 108, 3, 1, 4, 0), ('109-3', 109, 3, 1, 4, 0),
('110-3', 110, 3, 1, 4, 0), ('111-3', 111, 3, 1, 4, 0), ('112-3', 112, 3, 1, 4, 0), ('113-3', 113, 3, 1, 4, 0), ('114-3', 114, 3, 1, 4, 0),
('115-3', 115, 3, 1, 4, 0), ('116-3', 116, 3, 1, 4, 0), ('117-3', 117, 3, 1, 4, 0), ('118-3', 118, 3, 1, 4, 0), ('119-3', 119, 3, 1, 4, 0),
('120-3', 120, 3, 1, 4, 0), ('121-3', 121, 3, 1, 4, 0), ('122-3', 122, 3, 1, 4, 0), ('123-3', 123, 3, 1, 4, 0), ('124-3', 124, 3, 1, 4, 0),
('125-3', 125, 3, 1, 4, 0), ('126-3', 126, 3, 1, 4, 0), ('127-3', 127, 3, 1, 4, 0), ('128-3', 128, 3, 1, 4, 0), ('129-3', 129, 3, 1, 4, 0),
('130-3', 130, 3, 1, 4, 0), ('200-3', 200, 3, 2, 4, 0), ('201-3', 201, 3, 2, 4, 0), ('202-3', 202, 3, 2, 4, 0), ('203-3', 203, 3, 2, 4, 0),
('204-3', 204, 3, 2, 4, 0), ('205-3', 205, 3, 2, 4, 0), ('206-3', 206, 3, 2, 4, 0), ('207-3', 207, 3, 2, 4, 0), ('208-3', 208, 3, 2, 4, 0),
('209-3', 209, 3, 2, 4, 0), ('210-3', 210, 3, 2, 4, 0), ('211-3', 211, 3, 2, 4, 0), ('212-3', 212, 3, 2, 4, 0), ('213-3', 213, 3, 2, 4, 0),
('214-3', 214, 3, 2, 4, 0), ('215-3', 215, 3, 2, 4, 0), ('216-3', 216, 3, 2, 4, 0), ('217-3', 217, 3, 2, 4, 0), ('218-3', 218, 3, 2, 4, 0),
('219-3', 219, 3, 2, 4, 0), ('220-3', 220, 3, 2, 4, 0), ('221-3', 221, 3, 2, 4, 0), ('222-3', 222, 3, 2, 4, 0), ('223-3', 223, 3, 2, 4, 0),
('224-3', 224, 3, 2, 4, 0), ('225-3', 225, 3, 2, 4, 0), ('226-3', 226, 3, 2, 4, 0), ('227-3', 227, 3, 2, 4, 0), ('228-3', 228, 3, 2, 4, 0),
('229-3', 229, 3, 2, 4, 0), ('230-3', 230, 3, 2, 4, 0), ('300-3', 300, 3, 3, 4, 0), ('301-3', 301, 3, 3, 4, 0), ('302-3', 302, 3, 3, 4, 0),
('303-3', 303, 3, 3, 4, 0), ('304-3', 304, 3, 3, 4, 0), ('305-3', 305, 3, 3, 4, 0), ('306-3', 306, 3, 3, 4, 0), ('307-3', 307, 3, 3, 4, 0),
('308-3', 308, 3, 3, 4, 0), ('309-3', 309, 3, 3, 4, 0), ('310-3', 310, 3, 3, 4, 0), ('311-3', 311, 3, 3, 4, 0), ('312-3', 312, 3, 3, 4, 0),
('313-3', 313, 3, 3, 4, 0), ('314-3', 314, 3, 3, 4, 0), ('315-3', 315, 3, 3, 4, 0), ('316-3', 316, 3, 3, 4, 0), ('317-3', 317, 3, 3, 4, 0),
('318-3', 318, 3, 3, 4, 0), ('319-3', 319, 3, 3, 4, 0), ('320-3', 320, 3, 3, 4, 0), ('321-3', 321, 3, 3, 4, 0), ('322-3', 322, 3, 3, 4, 0),
('323-3', 323, 3, 3, 4, 0), ('324-3', 324, 3, 3, 4, 0), ('325-3', 325, 3, 3, 4, 0), ('326-3', 326, 3, 3, 4, 0), ('327-3', 327, 3, 3, 4, 0),
('328-3', 328, 3, 3, 4, 0), ('329-3', 329, 3, 3, 4, 0), ('330-3', 330, 3, 3, 4, 0), ('400-3', 400, 3, 4, 4, 0), ('401-3', 401, 3, 4, 4, 0),
('402-3', 402, 3, 4, 4, 0), ('403-3', 403, 3, 4, 4, 0), ('404-3', 404, 3, 4, 4, 0), ('405-3', 405, 3, 4, 4, 0), ('406-3', 406, 3, 4, 4, 0),
('407-3', 407, 3, 4, 4, 0), ('408-3', 408, 3, 4, 4, 0), ('409-3', 409, 3, 4, 4, 0), ('410-3', 410, 3, 4, 4, 0), ('411-3', 411, 3, 4, 4, 0),
('412-3', 412, 3, 4, 4, 0), ('413-3', 413, 3, 4, 4, 0), ('414-3', 414, 3, 4, 4, 0), ('415-3', 415, 3, 4, 4, 0), ('416-3', 416, 3, 4, 4, 0),
('417-3', 417, 3, 4, 4, 0), ('418-3', 418, 3, 4, 4, 0), ('419-3', 419, 3, 4, 4, 0), ('420-3', 420, 3, 4, 4, 0), ('421-3', 421, 3, 4, 4, 0),
(116, 422, 3, 4, 4, 0), (117, 423, 3, 4, 4, 0), (118, 424, 3, 4, 4, 0), (119, 425, 3, 4, 4, 0), (120, 426, 3, 4, 4, 0),
(121, 427, 3, 4, 4, 0), (122, 428, 3, 4, 4, 0), (123, 429, 3, 4, 4, 0), (124, 430, 3, 4, 4, 0), (125, 500, 3, 5, 4, 0),
(126, 501, 3, 5, 4, 0), (127, 502, 3, 5, 4, 0), (128, 503, 3, 5, 4, 0), (129, 504, 3, 5, 4, 0), (130, 505, 3, 5, 4, 0),
(131, 506, 3, 5, 4, 0), (132, 507, 3, 5, 4, 0), (133, 508, 3, 5, 4, 0), (134, 509, 3, 5, 4, 0), (135, 510, 3, 5, 4, 0),
(136, 511, 3, 5, 4, 0), (137, 512, 3, 5, 4, 0), (138, 513, 3, 5, 4, 0), (139, 514, 3, 5, 4, 0), (140, 515, 3, 5, 4, 0),
(141, 516, 3, 5, 4, 0), (142, 517, 3, 5, 4, 0), (143, 518, 3, 5, 4, 0), (144, 519, 3, 5, 4, 0), (145, 520, 3, 5, 4, 0),
(146, 521, 3, 5, 4, 0), (147, 522, 3, 5, 4, 0), (148, 523, 3, 5, 4, 0), (149, 524, 3, 5, 4, 0), (150, 525, 3, 5, 4, 0),
(151, 526, 3, 5, 4, 0), (152, 527, 3, 5, 4, 0), (153, 528, 3, 5, 4, 0), (154, 529, 3, 5, 4, 0), (155, 530, 3, 5, 4, 0);

UPDATE rooms
SET room_id = CONCAT(room_number, '-', dorm_id);
