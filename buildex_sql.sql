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

COPY "Users" (uid, username, password, first_name, middle_name, last_name, email_ad) FROM stdin;
1	admin	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Neil Francis	Muchillas	Calabroso	nmcalabroso@up.edu.ph
3	ebbernardino	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Emmargel	Bartolome	Bernardino	ebbernardino@feu.edu.ph
8	gardevior411	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Earl	R.	Bunao	gardevior_erb411@yahoo.com
\.


--
-- Data for Name: Admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Admins" (uid, aid) FROM stdin;
1	1
\.


--
-- Data for Name: Experiments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Experiments" (eid, title, category, target_count, current_count, status, request_status, description) FROM stdin;
6	2nd Experiment	0	0	0	f	f	2nd trial
7	Faculty experiment	0	10	0	f	f	1st trial
5	1st Experiment	0	10	0	f	f	Trial
\.


--
-- Data for Name: Faculty; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Faculty" (uid, fid) FROM stdin;
8	1
\.


--
-- Data for Name: Graduates; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Graduates" (uid, gid) FROM stdin;
3	2
\.


--
-- Data for Name: Respondents; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Respondents" (rid, first_name, middle_name, last_name, email_ad, age, street_addr, barangay_addr, city_addr, nationality, birthdate, sex, gender, civil_status) FROM stdin;
5	toff	l	mendoza	toofi@yahoo.com	\N	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- Name: admins_aid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('admins_aid_seq', 1, true);


--
-- Data for Name: advise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY advise (fid, eid, since) FROM stdin;
\.


--
-- Data for Name: answer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY answer (rid, eid, since) FROM stdin;
\.


--
-- Data for Name: conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY conduct (uid, eid, since) FROM stdin;
3	4	2014-01-05
3	5	2014-01-05
3	6	2014-01-05
8	7	2014-01-05
\.


--
-- Name: experiments_eid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('experiments_eid_seq', 7, true);


--
-- Name: faculty_fid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faculty_fid_seq', 2, true);


--
-- Name: graduates_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('graduates_gid_seq', 2, true);


--
-- Name: respondents_rid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('respondents_rid_seq', 4, true);


--
-- Name: users_uid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_uid_seq', 5, true);


--
-- PostgreSQL database dump complete
--

