--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: buildex_db; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE buildex_db IS 'BuildEx Database. University of the Philippines Diliman. Department of Psychology.';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: admins_aid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE admins_aid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.admins_aid_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: Admins; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Admins" (
    uid integer NOT NULL,
    aid integer DEFAULT nextval('admins_aid_seq'::regclass) NOT NULL
);


ALTER TABLE public."Admins" OWNER TO postgres;

--
-- Name: experiments_eid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE experiments_eid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.experiments_eid_seq OWNER TO postgres;

--
-- Name: Experiments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Experiments" (
    eid integer DEFAULT nextval('experiments_eid_seq'::regclass) NOT NULL,
    title character varying(64),
    category character varying(32) DEFAULT NULL::character varying,
    target_count integer DEFAULT 1,
    current_count integer DEFAULT 0,
    status boolean DEFAULT false,
    request_status boolean DEFAULT false,
    description character varying(256),
    is_published boolean DEFAULT false,
    privacy integer DEFAULT 0,
    url character varying(128)
);


ALTER TABLE public."Experiments" OWNER TO postgres;

--
-- Name: faculty_fid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE faculty_fid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.faculty_fid_seq OWNER TO postgres;

--
-- Name: Faculty; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Faculty" (
    uid integer NOT NULL,
    fid integer DEFAULT nextval('faculty_fid_seq'::regclass) NOT NULL,
    account_status boolean DEFAULT false,
    faculty_num integer
);


ALTER TABLE public."Faculty" OWNER TO postgres;

--
-- Name: graduates_gid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE graduates_gid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.graduates_gid_seq OWNER TO postgres;

--
-- Name: Graduates; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Graduates" (
    uid integer NOT NULL,
    gid integer DEFAULT nextval('graduates_gid_seq'::regclass) NOT NULL,
    student_num integer,
    account_status boolean DEFAULT true
);


ALTER TABLE public."Graduates" OWNER TO postgres;

--
-- Name: laboratories_labid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE laboratories_labid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.laboratories_labid_seq OWNER TO postgres;

--
-- Name: Laboratories; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Laboratories" (
    labid integer DEFAULT nextval('laboratories_labid_seq'::regclass) NOT NULL,
    name character varying(32),
    members_count integer DEFAULT 0,
    since date DEFAULT ('now'::text)::date,
    description character varying
);


ALTER TABLE public."Laboratories" OWNER TO postgres;

--
-- Name: laboratoryheads_lid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE laboratoryheads_lid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.laboratoryheads_lid_seq OWNER TO postgres;

--
-- Name: LaboratoryHeads; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "LaboratoryHeads" (
    uid integer NOT NULL,
    lid integer DEFAULT nextval('laboratoryheads_lid_seq'::regclass) NOT NULL
);


ALTER TABLE public."LaboratoryHeads" OWNER TO postgres;

--
-- Name: optiongroups_ogid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE optiongroups_ogid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.optiongroups_ogid_seq OWNER TO postgres;

SET default_with_oids = true;

--
-- Name: OptionGroups; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "OptionGroups" (
    ogid integer DEFAULT nextval('optiongroups_ogid_seq'::regclass) NOT NULL,
    type integer,
    x_pos integer,
    y_pos integer
);


ALTER TABLE public."OptionGroups" OWNER TO postgres;

--
-- Name: options_oid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE options_oid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.options_oid_seq OWNER TO postgres;

SET default_with_oids = false;

--
-- Name: Options; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Options" (
    qid integer,
    oid integer DEFAULT nextval('options_oid_seq'::regclass) NOT NULL,
    label character varying,
    ogid integer
);


ALTER TABLE public."Options" OWNER TO postgres;

--
-- Name: pages_pid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pages_pid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pages_pid_seq OWNER TO postgres;

--
-- Name: Pages; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Pages" (
    eid integer,
    pid integer DEFAULT nextval('pages_pid_seq'::regclass) NOT NULL,
    "order" integer,
    template integer DEFAULT 0,
    "row" integer DEFAULT 1,
    "column" integer DEFAULT 1
);


ALTER TABLE public."Pages" OWNER TO postgres;

--
-- Name: questions_qid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE questions_qid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.questions_qid_seq OWNER TO postgres;

--
-- Name: Questions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Questions" (
    pid integer,
    qid integer DEFAULT nextval('questions_qid_seq'::regclass) NOT NULL,
    label character varying(256),
    is_required boolean DEFAULT false,
    "order" integer,
    x_pos integer,
    y_pos integer
);


ALTER TABLE public."Questions" OWNER TO postgres;

--
-- Name: respondents_rid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE respondents_rid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.respondents_rid_seq OWNER TO postgres;

--
-- Name: Respondents; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public."Respondents" OWNER TO postgres;

--
-- Name: users_uid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_uid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_uid_seq OWNER TO postgres;

--
-- Name: Users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Users" (
    uid integer DEFAULT nextval('users_uid_seq'::regclass) NOT NULL,
    username character varying(16),
    password character varying(128),
    first_name character varying(32),
    middle_name character varying(32),
    last_name character varying(32),
    email_ad character varying(32),
    temp_password character varying(128)
);


ALTER TABLE public."Users" OWNER TO postgres;

--
-- Name: TABLE "Users"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE "Users" IS 'General users table';


--
-- Name: advise; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE advise (
    fid integer NOT NULL,
    eid integer NOT NULL,
    since date DEFAULT ('now'::text)::date,
    status boolean DEFAULT false
);


ALTER TABLE public.advise OWNER TO postgres;

--
-- Name: answer; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE answer (
    rid integer NOT NULL,
    eid integer NOT NULL,
    since date DEFAULT ('now'::text)::date
);


ALTER TABLE public.answer OWNER TO postgres;

--
-- Name: faculty_conduct; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE faculty_conduct (
    fid integer NOT NULL,
    eid integer NOT NULL,
    since date DEFAULT ('now'::text)::date
);


ALTER TABLE public.faculty_conduct OWNER TO postgres;

--
-- Name: faculty_member_of; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE faculty_member_of (
    fid integer NOT NULL,
    labid integer NOT NULL,
    since date DEFAULT ('now'::text)::date,
    status boolean DEFAULT false
);


ALTER TABLE public.faculty_member_of OWNER TO postgres;

--
-- Name: graduates_conduct; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE graduates_conduct (
    gid integer NOT NULL,
    eid integer NOT NULL,
    since date DEFAULT ('now'::text)::date
);


ALTER TABLE public.graduates_conduct OWNER TO postgres;

--
-- Name: graduates_member_of; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE graduates_member_of (
    gid integer NOT NULL,
    labid integer NOT NULL,
    since date DEFAULT ('now'::text)::date,
    status boolean DEFAULT false
);


ALTER TABLE public.graduates_member_of OWNER TO postgres;

--
-- Name: manage; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE manage (
    lid integer NOT NULL,
    labid integer NOT NULL,
    since date DEFAULT ('now'::text)::date
);


ALTER TABLE public.manage OWNER TO postgres;

--
-- Name: Experiments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Experiments"
    ADD CONSTRAINT "Experiments_pkey" PRIMARY KEY (eid);


--
-- Name: Groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "OptionGroups"
    ADD CONSTRAINT "Groups_pkey" PRIMARY KEY (ogid);


--
-- Name: Laboratories_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Laboratories"
    ADD CONSTRAINT "Laboratories_name_key" UNIQUE (name);


--
-- Name: Laboratories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Laboratories"
    ADD CONSTRAINT "Laboratories_pkey" PRIMARY KEY (labid);


--
-- Name: LaboratoryHeads_lid_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "LaboratoryHeads"
    ADD CONSTRAINT "LaboratoryHeads_lid_key" UNIQUE (lid);


--
-- Name: Respondents_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Respondents"
    ADD CONSTRAINT "Respondents_pkey" PRIMARY KEY (rid);


--
-- Name: Users_email_ad_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_email_ad_key" UNIQUE (email_ad);


--
-- Name: Users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_pkey" PRIMARY KEY (uid);


--
-- Name: Users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Users"
    ADD CONSTRAINT "Users_username_key" UNIQUE (username);


--
-- Name: advise_primary; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY advise
    ADD CONSTRAINT advise_primary PRIMARY KEY (fid, eid);


--
-- Name: aid_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Admins"
    ADD CONSTRAINT aid_ukey UNIQUE (aid);


--
-- Name: answer_primary; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY answer
    ADD CONSTRAINT answer_primary PRIMARY KEY (rid, eid);


--
-- Name: eid_pid_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Pages"
    ADD CONSTRAINT eid_pid_ukey UNIQUE (eid, pid);


--
-- Name: faculty_conduct_fid_eid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY faculty_conduct
    ADD CONSTRAINT faculty_conduct_fid_eid_pkey PRIMARY KEY (fid, eid);


--
-- Name: faculty_num_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Faculty"
    ADD CONSTRAINT faculty_num_ukey UNIQUE (faculty_num);


--
-- Name: fid_labid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY faculty_member_of
    ADD CONSTRAINT fid_labid_pkey PRIMARY KEY (fid, labid);


--
-- Name: fid_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Faculty"
    ADD CONSTRAINT fid_ukey UNIQUE (fid);


--
-- Name: gid_labid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY graduates_member_of
    ADD CONSTRAINT gid_labid_pkey PRIMARY KEY (gid, labid);


--
-- Name: gid_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Graduates"
    ADD CONSTRAINT gid_ukey UNIQUE (gid);


--
-- Name: graduates_conduct_gid_eid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY graduates_conduct
    ADD CONSTRAINT graduates_conduct_gid_eid_pkey PRIMARY KEY (gid, eid);


--
-- Name: lid_labid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY manage
    ADD CONSTRAINT lid_labid_pkey PRIMARY KEY (lid, labid);


--
-- Name: oid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Options"
    ADD CONSTRAINT oid_pkey PRIMARY KEY (oid);


--
-- Name: pid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Pages"
    ADD CONSTRAINT pid_pkey PRIMARY KEY (pid);


--
-- Name: pid_qid_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Questions"
    ADD CONSTRAINT pid_qid_ukey UNIQUE (pid, qid);


--
-- Name: qid_oid_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Options"
    ADD CONSTRAINT qid_oid_ukey UNIQUE (qid, oid);


--
-- Name: qid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Questions"
    ADD CONSTRAINT qid_pkey PRIMARY KEY (qid);


--
-- Name: student_num_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Graduates"
    ADD CONSTRAINT student_num_ukey UNIQUE (student_num);


--
-- Name: uid_aid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Admins"
    ADD CONSTRAINT uid_aid_pkey PRIMARY KEY (uid, aid);


--
-- Name: uid_fid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Faculty"
    ADD CONSTRAINT uid_fid_pkey PRIMARY KEY (uid, fid);


--
-- Name: uid_gid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Graduates"
    ADD CONSTRAINT uid_gid_pkey PRIMARY KEY (uid, gid);


--
-- Name: uid_lid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "LaboratoryHeads"
    ADD CONSTRAINT uid_lid_pkey PRIMARY KEY (uid, lid);


--
-- Name: url_ukey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Experiments"
    ADD CONSTRAINT url_ukey UNIQUE (url);


--
-- Name: admins_ref_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Admins"
    ADD CONSTRAINT admins_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: advise_ref_experiments; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY advise
    ADD CONSTRAINT advise_ref_experiments FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: advise_ref_faculty; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY advise
    ADD CONSTRAINT advise_ref_faculty FOREIGN KEY (fid) REFERENCES "Faculty"(fid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: answer_ref_experiments; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY answer
    ADD CONSTRAINT answer_ref_experiments FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: answer_ref_respondents; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY answer
    ADD CONSTRAINT answer_ref_respondents FOREIGN KEY (rid) REFERENCES "Respondents"(rid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: conduct_ref_experiments; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY faculty_conduct
    ADD CONSTRAINT conduct_ref_experiments FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: faculty_conduct_fid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY faculty_conduct
    ADD CONSTRAINT faculty_conduct_fid_fkey FOREIGN KEY (fid) REFERENCES "Faculty"(fid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: faculty_member_of_ref_faculty; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY faculty_member_of
    ADD CONSTRAINT faculty_member_of_ref_faculty FOREIGN KEY (fid) REFERENCES "Faculty"(fid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: faculty_member_of_ref_laboratories; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY faculty_member_of
    ADD CONSTRAINT faculty_member_of_ref_laboratories FOREIGN KEY (labid) REFERENCES "Laboratories"(labid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: faculty_ref_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Faculty"
    ADD CONSTRAINT faculty_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: graduates_conduct_ref_experiments; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY graduates_conduct
    ADD CONSTRAINT graduates_conduct_ref_experiments FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: graduates_conduct_ref_graduates; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY graduates_conduct
    ADD CONSTRAINT graduates_conduct_ref_graduates FOREIGN KEY (gid) REFERENCES "Graduates"(gid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: graduates_member_of_ref_graduates; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY graduates_member_of
    ADD CONSTRAINT graduates_member_of_ref_graduates FOREIGN KEY (gid) REFERENCES "Graduates"(gid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: graduates_member_of_ref_laboratories; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY graduates_member_of
    ADD CONSTRAINT graduates_member_of_ref_laboratories FOREIGN KEY (labid) REFERENCES "Laboratories"(labid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: graduates_ref_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Graduates"
    ADD CONSTRAINT graduates_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: laboratoryheads_ref_users; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "LaboratoryHeads"
    ADD CONSTRAINT laboratoryheads_ref_users FOREIGN KEY (uid) REFERENCES "Users"(uid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: manage_ref_laboratories; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY manage
    ADD CONSTRAINT manage_ref_laboratories FOREIGN KEY (labid) REFERENCES "Laboratories"(labid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: manage_ref_laboratoryheads; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY manage
    ADD CONSTRAINT manage_ref_laboratoryheads FOREIGN KEY (lid) REFERENCES "LaboratoryHeads"(lid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ogid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Options"
    ADD CONSTRAINT ogid FOREIGN KEY (ogid) REFERENCES "OptionGroups"(ogid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: options_ref_questions_qid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Options"
    ADD CONSTRAINT options_ref_questions_qid FOREIGN KEY (qid) REFERENCES "Questions"(qid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pages_ref_experiments_eid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Pages"
    ADD CONSTRAINT pages_ref_experiments_eid FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: questions_ref_pages_pid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Questions"
    ADD CONSTRAINT questions_ref_pages_pid FOREIGN KEY (pid) REFERENCES "Pages"(pid) ON UPDATE CASCADE ON DELETE CASCADE;


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

