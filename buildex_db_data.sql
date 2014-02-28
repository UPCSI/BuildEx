--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- Data for Name: Users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Users" (uid, username, password, first_name, middle_name, last_name, email_ad, temp_password) FROM stdin;
1	buildex.admin	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Neil	Muchillas	Calabroso	nmcalabroso@up.edu.ph	\N
24	mtcarreon	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Mario	Luigi	Carreon	mtcarreon@test.com	\N
25	eqpineda	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Errol	lul	Pineda	eqpineda@test.com	\N
26	ipmirasol	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Ivy	Park	Mirasol	ipmirasol@test.com	\N
27	nfhernandez	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Nestine	Festine	Hernandez	nfhernandez@test.com	\N
28	hhadorna	$6$rounds=10000$iNt3ll3Q$vL7JO/sjCHyaL6HLfT3217UDZbvV5dTbGCPdDLYvzzQ73xyo362LP0dbZ6I2QUu29YvLCvfnlSmYApJq0DlFa/	Henry	Hope	Adorna	hhadorna@test.com	\N
29	meyagen	$6$rounds=10000$iNt3ll3Q$bo5TWo9jkuKntkGHirKH3DnMjl424qMx7KTjIv4AmlThDsbVT.Jjw7tEinIqbt/3lnQKzwmQVdv03pphWDRAq/	Mireya	Perez	Andres	mireyagenandres@gmail.com	\N
\.


--
-- Data for Name: Admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Admins" (uid, aid) FROM stdin;
1	2
\.


--
-- Data for Name: Experiments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Experiments" (eid, title, category, target_count, current_count, status, request_status, description, is_published, privacy, url) FROM stdin;
\.


--
-- Data for Name: Faculty; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Faculty" (uid, fid, account_status, faculty_num) FROM stdin;
24	19	t	201131200
26	20	t	20131208
27	21	t	201422222
28	22	t	201466666
\.


--
-- Data for Name: Graduates; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Graduates" (uid, gid, student_num, account_status) FROM stdin;
25	6	201100001	t
29	7	201101479	t
\.


--
-- Data for Name: Laboratories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Laboratories" (labid, name, members_count, since, description) FROM stdin;
19	NDSG	1	2014-02-20	\N
\.


--
-- Data for Name: LaboratoryHeads; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "LaboratoryHeads" (uid, lid) FROM stdin;
24	19
\.


--
-- Data for Name: Pages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Pages" (eid, pid, "order", template, "row", "column") FROM stdin;
\.


--
-- Data for Name: Questions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Questions" (pid, qid, label, is_required, x_pos, y_pos) FROM stdin;
\.


--
-- Data for Name: OptionGroups; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "OptionGroups" (ogid, type, x_pos, y_pos, qid) FROM stdin;
\.


--
-- Data for Name: Options; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Options" (oid, label, ogid) FROM stdin;
\.


--
-- Data for Name: Respondents; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Respondents" (rid, first_name, middle_name, last_name, email_ad, age, street_addr, barangay_addr, city_addr, nationality, birthdate, sex, gender, civil_status, eid, since, duration) FROM stdin;
\.


--
-- Data for Name: Responses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "Responses" (rid, ans_id, qid, oid, free_answer, duration) FROM stdin;
\.


--
-- Name: admins_aid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('admins_aid_seq', 1, false);


--
-- Data for Name: advise; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY advise (fid, eid, since, status) FROM stdin;
\.


--
-- Name: answers_ans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('answers_ans_id_seq', 1, false);


--
-- Name: experiments_eid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('experiments_eid_seq', 1, false);


--
-- Data for Name: faculty_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY faculty_conduct (fid, eid, since) FROM stdin;
\.


--
-- Name: faculty_fid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('faculty_fid_seq', 22, true);


--
-- Data for Name: faculty_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY faculty_member_of (fid, labid, since, status) FROM stdin;
19	19	2014-02-18	t
\.


--
-- Data for Name: graduates_conduct; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY graduates_conduct (gid, eid, since) FROM stdin;
\.


--
-- Name: graduates_gid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('graduates_gid_seq', 7, true);


--
-- Data for Name: graduates_member_of; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY graduates_member_of (gid, labid, since, status) FROM stdin;
\.


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

COPY manage (lid, labid, since) FROM stdin;
19	19	2014-02-18
\.


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

SELECT pg_catalog.setval('users_uid_seq', 29, true);


--
-- PostgreSQL database dump complete
--

