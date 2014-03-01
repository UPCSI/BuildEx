--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Data for Name: Users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Users" VALUES (1, 'buildex.admin', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Neil', 'Muchillas', 'Calabroso', 'nmcalabroso@up.edu.ph', NULL);
INSERT INTO "Users" VALUES (24, 'mtcarreon', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Mario', 'Luigi', 'Carreon', 'mtcarreon@test.com', NULL);
INSERT INTO "Users" VALUES (25, 'eqpineda', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Errol', 'lul', 'Pineda', 'eqpineda@test.com', NULL);
INSERT INTO "Users" VALUES (27, 'nfhernandez', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Nestine', 'Festine', 'Hernandez', 'nfhernandez@test.com', NULL);
INSERT INTO "Users" VALUES (28, 'hhadorna', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Henry', 'Hope', 'Adorna', 'hhadorna@test.com', NULL);
INSERT INTO "Users" VALUES (29, 'meyagen', '$6$rounds=10000$iNt3ll3Q$bo5TWo9jkuKntkGHirKH3DnMjl424qMx7KTjIv4AmlThDsbVT.Jjw7tEinIqbt/3lnQKzwmQVdv03pphWDRAq/', 'Mireya', 'Perez', 'Andres', 'mireyagenandres@gmail.com', NULL);
INSERT INTO "Users" VALUES (30, 'rnferia', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Feria', 'Rommel', 'None', 'rnferia@test.com', NULL);
INSERT INTO "Users" VALUES (31, 'snfestin', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Festin', 'Susan', 'None', 'snfestin@test.com', NULL);
INSERT INTO "Users" VALUES (32, 'cnfestin', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Cedric', 'None', 'Festin', 'cnfestin@test.com', NULL);
INSERT INTO "Users" VALUES (33, 'pnnaval', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Pros', 'None', 'Naval', 'pnnaval@test.com', NULL);
INSERT INTO "Users" VALUES (34, 'arvaldez', '$6$rounds=10000$iNt3ll3Q$Fzhjnn9v7ZYXvYMkcP7BkveosO6R/Pe8/x7LEj0jZr4d2vFQEMdrAJbNO3OdzowmR7qDpGgTvv8zV6ZlK28ZJ/', 'Adrian', 'Roy', 'Valdez', 'arvaldez@test.com', NULL);
INSERT INTO "Users" VALUES (35, 'ebbunao', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Earle', 'Randolph', 'Bunao', 'ebbunao@test.com', NULL);
INSERT INTO "Users" VALUES (36, 'kmmendoza', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Kristoff', 'Marion', 'Mendoza', 'kmmendoza@test.com', NULL);
INSERT INTO "Users" VALUES (37, 'rnmendoza', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Rowel', 'None', 'Mendoza', 'rnmendoza@test.com', NULL);
INSERT INTO "Users" VALUES (38, 'moshen', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Mara', 'Opana', 'Shen', 'moshen@test.com', NULL);


--
-- Data for Name: Admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Admins" VALUES (1, 2);


--
-- Data for Name: Experiments; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Experiments" VALUES (2, 'Sample02', '0', 30, 0, false, false, 'Sample', false, 0, 'MlNhbXBsZTAy');
INSERT INTO "Experiments" VALUES (3, 'Sample03', '0', 30, 0, false, false, 'HIHIHI', false, 0, 'M1NhbXBsZTAz');


--
-- Data for Name: Faculty; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Faculty" VALUES (24, 19, true, 201131200);
INSERT INTO "Faculty" VALUES (27, 21, true, 201422222);
INSERT INTO "Faculty" VALUES (28, 22, true, 201466666);
INSERT INTO "Faculty" VALUES (31, 24, false, 201400002);
INSERT INTO "Faculty" VALUES (33, 26, false, 201400004);
INSERT INTO "Faculty" VALUES (34, 27, false, 201400005);
INSERT INTO "Faculty" VALUES (30, 23, true, 201400001);
INSERT INTO "Faculty" VALUES (32, 25, true, 201400003);


--
-- Data for Name: Graduates; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Graduates" VALUES (25, 6, 201100001, true);
INSERT INTO "Graduates" VALUES (29, 7, 201101479, true);
INSERT INTO "Graduates" VALUES (35, 8, 199900001, true);
INSERT INTO "Graduates" VALUES (36, 9, 199900002, true);
INSERT INTO "Graduates" VALUES (37, 10, 199900003, true);


--
-- Data for Name: Laboratories; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Laboratories" VALUES (21, 'ACL', 1, '2014-03-01', 'Algorithm and Complexity Laboratory');
INSERT INTO "Laboratories" VALUES (22, 'WSG', 1, '2014-03-01', 'Web Science Group');
INSERT INTO "Laboratories" VALUES (23, 'NDSG', 2, '2014-03-01', 'Network and Datagram Systems Group');


--
-- Data for Name: LaboratoryHeads; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "LaboratoryHeads" VALUES (28, 21);
INSERT INTO "LaboratoryHeads" VALUES (30, 22);
INSERT INTO "LaboratoryHeads" VALUES (32, 23);


--
-- Data for Name: Pages; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Pages" VALUES (2, 2, 1, 0, 1, 1);


--
-- Data for Name: Questions; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Questions" VALUES (2, 6, NULL, false, 1135.44995117190001, 504.600006103520002);


--
-- Data for Name: OptionGroups; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Options; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Respondents; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Responses; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: admins_aid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('admins_aid_seq', 1, false);


--
-- Data for Name: advise; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: answers_ans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('answers_ans_id_seq', 1, false);


--
-- Name: experiments_eid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('experiments_eid_seq', 3, true);


--
-- Data for Name: faculty_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO faculty_conduct VALUES (19, 2, '2014-03-01');
INSERT INTO faculty_conduct VALUES (19, 3, '2014-03-01');


--
-- Name: faculty_fid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faculty_fid_seq', 27, true);


--
-- Data for Name: faculty_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO faculty_member_of VALUES (22, 21, '2014-03-01', true);
INSERT INTO faculty_member_of VALUES (23, 22, '2014-03-01', true);
INSERT INTO faculty_member_of VALUES (25, 23, '2014-03-01', true);
INSERT INTO faculty_member_of VALUES (19, 23, '2014-03-01', true);


--
-- Data for Name: graduates_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: graduates_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('graduates_gid_seq', 11, true);


--
-- Data for Name: graduates_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: laboratories_labid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratories_labid_seq', 23, true);


--
-- Name: laboratoryheads_lid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratoryheads_lid_seq', 23, true);


--
-- Data for Name: manage; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO manage VALUES (21, 21, '2014-03-01');
INSERT INTO manage VALUES (22, 22, '2014-03-01');
INSERT INTO manage VALUES (23, 23, '2014-03-01');


--
-- Name: optiongroups_ogid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('optiongroups_ogid_seq', 1, false);


--
-- Name: options_oid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('options_oid_seq', 1, false);


--
-- Name: pages_pid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pages_pid_seq', 2, true);


--
-- Name: questions_qid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('questions_qid_seq', 6, true);


--
-- Name: respondents_rid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('respondents_rid_seq', 1, true);


--
-- Name: users_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_uid_seq', 38, true);


--
-- PostgreSQL database dump complete
--

