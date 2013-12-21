--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: buildex_db; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE buildex_db IS 'BuildEx Database. University of the Philippines Diliman. Department of Psychology.';


--
-- Name: buildex_schema; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA buildex_schema;


ALTER SCHEMA buildex_schema OWNER TO postgres;

--
-- Name: SCHEMA buildex_schema; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA buildex_schema IS 'first draft schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = buildex_schema, pg_catalog;

--
-- Name: admins_aid_seq; Type: SEQUENCE; Schema: buildex_schema; Owner: postgres
--

CREATE SEQUENCE admins_aid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE buildex_schema.admins_aid_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Admins; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE "Admins" (
    uid integer NOT NULL,
    aid integer DEFAULT nextval('admins_aid_seq'::regclass) NOT NULL
);


ALTER TABLE buildex_schema."Admins" OWNER TO postgres;

--
-- Name: experiments_eid_seq; Type: SEQUENCE; Schema: buildex_schema; Owner: postgres
--

CREATE SEQUENCE experiments_eid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE buildex_schema.experiments_eid_seq OWNER TO postgres;

--
-- Name: Experiments; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE "Experiments" (
    eid integer DEFAULT nextval('experiments_eid_seq'::regclass) NOT NULL,
    title character varying(64),
    category character varying(32),
    target_count integer,
    current_count integer,
    status boolean DEFAULT false
);


ALTER TABLE buildex_schema."Experiments" OWNER TO postgres;

--
-- Name: faculty_fid_seq; Type: SEQUENCE; Schema: buildex_schema; Owner: postgres
--

CREATE SEQUENCE faculty_fid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE buildex_schema.faculty_fid_seq OWNER TO postgres;

--
-- Name: Faculty; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE "Faculty" (
    uid integer NOT NULL,
    fid integer DEFAULT nextval('faculty_fid_seq'::regclass) NOT NULL
);


ALTER TABLE buildex_schema."Faculty" OWNER TO postgres;

--
-- Name: graduates_gid_seq; Type: SEQUENCE; Schema: buildex_schema; Owner: postgres
--

CREATE SEQUENCE graduates_gid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE buildex_schema.graduates_gid_seq OWNER TO postgres;

--
-- Name: Graduates; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE "Graduates" (
    uid integer NOT NULL,
    gid integer DEFAULT nextval('graduates_gid_seq'::regclass) NOT NULL
);


ALTER TABLE buildex_schema."Graduates" OWNER TO postgres;

--
-- Name: respondents_rid_seq; Type: SEQUENCE; Schema: buildex_schema; Owner: postgres
--

CREATE SEQUENCE respondents_rid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE buildex_schema.respondents_rid_seq OWNER TO postgres;

--
-- Name: Respondents; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE "Respondents" (
    rid integer DEFAULT nextval('respondents_rid_seq'::regclass) NOT NULL,
    first_name character varying(32),
    middle_name character varying(32),
    last_name character varying(32),
    email_ad character varying(32),
    age integer,
    street_addr character varying(64),
    barangay_addr character varying(64),
    city_addr character varying(64),
    nationality character varying(32),
    birthdate date,
    sex boolean DEFAULT false,
    gender character varying(32),
    civil_status integer DEFAULT 0
);


ALTER TABLE buildex_schema."Respondents" OWNER TO postgres;

--
-- Name: users_uid_seq; Type: SEQUENCE; Schema: buildex_schema; Owner: postgres
--

CREATE SEQUENCE users_uid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE buildex_schema.users_uid_seq OWNER TO postgres;

--
-- Name: Users; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE "Users" (
    uid integer DEFAULT nextval('users_uid_seq'::regclass) NOT NULL,
    username character varying(16),
    password character varying(64),
    first_name character varying(32),
    middle_name character varying(32),
    last_name character varying(32),
    email_ad character varying(32)
);


ALTER TABLE buildex_schema."Users" OWNER TO postgres;

--
-- Name: TABLE "Users"; Type: COMMENT; Schema: buildex_schema; Owner: postgres
--

COMMENT ON TABLE "Users" IS 'General users table';


--
-- Name: advise; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE advise (
    fid integer,
    eid integer,
    since date DEFAULT ('now'::text)::date
);


ALTER TABLE buildex_schema.advise OWNER TO postgres;

--
-- Name: answer; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE answer (
    rid integer,
    eid integer,
    since date DEFAULT ('now'::text)::date
);


ALTER TABLE buildex_schema.answer OWNER TO postgres;

--
-- Name: conduct; Type: TABLE; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

CREATE TABLE conduct (
    uid integer,
    eid integer,
    since date DEFAULT ('now'::text)::date
);


ALTER TABLE buildex_schema.conduct OWNER TO postgres;

--
-- Data for Name: Admins; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Data for Name: Experiments; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Data for Name: Faculty; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Data for Name: Graduates; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Data for Name: Respondents; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Data for Name: Users; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Name: admins_aid_seq; Type: SEQUENCE SET; Schema: buildex_schema; Owner: postgres
--

SELECT pg_catalog.setval('admins_aid_seq', 1, false);


--
-- Data for Name: advise; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Data for Name: answer; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Data for Name: conduct; Type: TABLE DATA; Schema: buildex_schema; Owner: postgres
--



--
-- Name: experiments_eid_seq; Type: SEQUENCE SET; Schema: buildex_schema; Owner: postgres
--

SELECT pg_catalog.setval('experiments_eid_seq', 1, false);


--
-- Name: faculty_fid_seq; Type: SEQUENCE SET; Schema: buildex_schema; Owner: postgres
--

SELECT pg_catalog.setval('faculty_fid_seq', 1, false);


--
-- Name: graduates_gid_seq; Type: SEQUENCE SET; Schema: buildex_schema; Owner: postgres
--

SELECT pg_catalog.setval('graduates_gid_seq', 1, false);


--
-- Name: respondents_rid_seq; Type: SEQUENCE SET; Schema: buildex_schema; Owner: postgres
--

SELECT pg_catalog.setval('respondents_rid_seq', 1, false);


--
-- Name: users_uid_seq; Type: SEQUENCE SET; Schema: buildex_schema; Owner: postgres
--

SELECT pg_catalog.setval('users_uid_seq', 1, false);


--
-- Name: Experiments_pkey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Experiments"
    ADD CONSTRAINT "Experiments_pkey" PRIMARY KEY (eid);


--
-- Name: Respondents_pkey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Respondents"
    ADD CONSTRAINT "Respondents_pkey" PRIMARY KEY (rid);


--
-- Name: Users_email_ad_key; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_email_ad_key" UNIQUE (email_ad);


--
-- Name: Users_pkey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_pkey" PRIMARY KEY (uid);


--
-- Name: Users_username_key; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_username_key" UNIQUE (username);


--
-- Name: aid_ukey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Admins"
    ADD CONSTRAINT aid_ukey UNIQUE (aid);


--
-- Name: fid_ukey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Faculty"
    ADD CONSTRAINT fid_ukey UNIQUE (fid);


--
-- Name: gid_ukey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Graduates"
    ADD CONSTRAINT gid_ukey UNIQUE (gid);


--
-- Name: uid_aid_pkey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Admins"
    ADD CONSTRAINT uid_aid_pkey PRIMARY KEY (uid, aid);


--
-- Name: uid_fid_pkey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Faculty"
    ADD CONSTRAINT uid_fid_pkey PRIMARY KEY (uid, fid);


--
-- Name: uid_gid_pkey; Type: CONSTRAINT; Schema: buildex_schema; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Graduates"
    ADD CONSTRAINT uid_gid_pkey PRIMARY KEY (uid, gid);


--
-- Name: admins_ref_users; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY "Admins"
    ADD CONSTRAINT admins_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: advise_ref_experiments; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY advise
    ADD CONSTRAINT advise_ref_experiments FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: advise_ref_faculty; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY advise
    ADD CONSTRAINT advise_ref_faculty FOREIGN KEY (fid) REFERENCES "Faculty"(fid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: answer_ref_experiments; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY answer
    ADD CONSTRAINT answer_ref_experiments FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: answer_ref_respondents; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY answer
    ADD CONSTRAINT answer_ref_respondents FOREIGN KEY (rid) REFERENCES "Respondents"(rid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: conduct_ref_experiments; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY conduct
    ADD CONSTRAINT conduct_ref_experiments FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: conduct_ref_users; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY conduct
    ADD CONSTRAINT conduct_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: faculty_ref_users; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY "Faculty"
    ADD CONSTRAINT faculty_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: graduates_ref_users; Type: FK CONSTRAINT; Schema: buildex_schema; Owner: postgres
--

ALTER TABLE ONLY "Graduates"
    ADD CONSTRAINT graduates_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

