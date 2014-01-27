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

INSERT INTO "Users" VALUES (2, 'buildex.admin', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Neil', 'Muchillas', 'Calabroso', 'nmcalabroso@up.edu.ph', NULL);
INSERT INTO "Users" VALUES (3, 'mtcarreon', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Mario', 'Car', 'Carreon', 'mtcarreon@gmail.com', NULL);
INSERT INTO "Users" VALUES (4, 'ebbernardino', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'Emmargel', 'Bartolome', 'Bernardino', 'ebbernardino@test.com', NULL);


--
-- Data for Name: Admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Admins" VALUES (2, 2);


--
-- Data for Name: Experiments; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: Faculty; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Faculty" VALUES (3, 2, false, NULL);


--
-- Data for Name: Graduates; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Graduates" VALUES (4, 2, NULL, false);


--
-- Data for Name: Laboratories; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: LaboratoryHeads; Type: TABLE DATA; Schema: public; Owner: postgres
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

SELECT pg_catalog.setval('experiments_eid_seq', 1, false);


--
-- Data for Name: faculty_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: faculty_fid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faculty_fid_seq', 2, true);


--
-- Data for Name: faculty_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: graduates_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: graduates_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('graduates_gid_seq', 2, true);


--
-- Data for Name: graduates_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: laboratories_labid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratories_labid_seq', 1, true);


--
-- Name: laboratoryheads_lid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratoryheads_lid_seq', 1, true);


--
-- Data for Name: manage; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: respondents_rid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('respondents_rid_seq', 1, true);


--
-- Name: users_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_uid_seq', 4, true);


--
-- PostgreSQL database dump complete
--

