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
INSERT INTO "Users" VALUES (26, 'ipmirasol', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Ivy', 'Park', 'Mirasol', 'ipmirasol@test.com', NULL);
INSERT INTO "Users" VALUES (27, 'nfhernandez', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Nestine', 'Festine', 'Hernandez', 'nfhernandez@test.com', NULL);
INSERT INTO "Users" VALUES (28, 'hhadorna', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Henry', 'Hope', 'Adorna', 'hhadorna@test.com', NULL);


--
-- Data for Name: Admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Admins" VALUES (1, 2);


--
-- Data for Name: Experiments; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Faculty; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Faculty" VALUES (24, 19, true, 201131200);
INSERT INTO "Faculty" VALUES (26, 20, true, 20131208);
INSERT INTO "Faculty" VALUES (27, 21, true, 201422222);
INSERT INTO "Faculty" VALUES (28, 22, true, 201466666);


--
-- Data for Name: Graduates; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Graduates" VALUES (25, 6, 201100001, true);


--
-- Data for Name: Laboratories; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Laboratories" VALUES (19, 'NDSG', 1, '2014-02-20', NULL);


--
-- Data for Name: LaboratoryHeads; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "LaboratoryHeads" VALUES (24, 19);


--
-- Data for Name: Pages; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Questions; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Options; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Respondents; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: admins_aid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('admins_aid_seq', 2, true);


--
-- Data for Name: advise; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: answer; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: experiments_eid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('experiments_eid_seq', 25, true);


--
-- Data for Name: faculty_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: faculty_fid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faculty_fid_seq', 22, true);


--
-- Data for Name: faculty_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO faculty_member_of VALUES (19, 19, '2014-02-18', true);


--
-- Data for Name: graduates_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: graduates_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('graduates_gid_seq', 6, true);


--
-- Data for Name: graduates_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: laboratories_labid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratories_labid_seq', 19, true);


--
-- Name: laboratoryheads_lid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratoryheads_lid_seq', 19, true);


--
-- Data for Name: manage; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO manage VALUES (19, 19, '2014-02-18');


--
-- Name: options_oid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('options_oid_seq', 1, false);


--
-- Name: pages_pid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pages_pid_seq', 1, false);


--
-- Name: questions_qid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('questions_qid_seq', 1, false);


--
-- Name: respondents_rid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('respondents_rid_seq', 1, true);


--
-- Name: users_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_uid_seq', 28, true);


--
-- PostgreSQL database dump complete
--

