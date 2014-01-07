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

INSERT INTO "Users" VALUES (4, 'admin', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'administrator', 'earl', 'bunao', '', NULL);
INSERT INTO "Users" VALUES (8, 'gardevior411', '$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/', 'larssen', '.', 'bunao', 'gardevior_erb411@yahoo.com', NULL);


--
-- Data for Name: Admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Admins" VALUES (4, 3);


--
-- Data for Name: Experiments; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Experiments" VALUES (2, '1st Experiment', '0', 10, 0, false, false, '1st trial', false, NULL);


--
-- Data for Name: Faculty; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Faculty" VALUES (8, 3, true, NULL);


--
-- Data for Name: Graduates; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Graduates" VALUES (8, 5, NULL, false);


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

SELECT pg_catalog.setval('admins_aid_seq', 3, true);


--
-- Data for Name: advise; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: answer; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO conduct VALUES (8, 2, '2014-01-06');


--
-- Name: experiments_eid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('experiments_eid_seq', 2, true);


--
-- Name: faculty_fid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faculty_fid_seq', 3, true);


--
-- Name: graduates_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('graduates_gid_seq', 5, true);


--
-- Name: laboratories_labid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratories_labid_seq', 1, false);


--
-- Name: laboratoryheads_lid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('laboratoryheads_lid_seq', 1, false);


--
-- Data for Name: manage; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: request; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: respondents_rid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('respondents_rid_seq', 1, true);


--
-- Name: users_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_uid_seq', 8, true);


--
-- PostgreSQL database dump complete
--

