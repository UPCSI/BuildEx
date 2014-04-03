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
-- Name: Buttons; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Buttons" (
    oid integer,
    button_id integer NOT NULL,
    text character varying(32),
    size character varying(8),
    go_to integer,
    type character varying(32) DEFAULT 'default'::character varying
);


ALTER TABLE public."Buttons" OWNER TO postgres;

--
-- Name: checkboxes_checkbox_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE checkboxes_checkbox_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.checkboxes_checkbox_id_seq OWNER TO postgres;

--
-- Name: Checkboxes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Checkboxes" (
    input_id integer,
    checkbox_id integer DEFAULT nextval('checkboxes_checkbox_id_seq'::regclass) NOT NULL,
    choices character varying(2048),
    orientation character varying(16)
);


ALTER TABLE public."Checkboxes" OWNER TO postgres;

--
-- Name: dropdown_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE dropdown_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dropdown_id_seq OWNER TO postgres;

--
-- Name: Dropdowns; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Dropdowns" (
    input_id integer,
    dropdown_id integer DEFAULT nextval('dropdown_id_seq'::regclass) NOT NULL,
    choices character varying(2048)
);


ALTER TABLE public."Dropdowns" OWNER TO postgres;

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
-- Name: buttons_button_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE buttons_button_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.buttons_button_id_seq OWNER TO postgres;

--
-- Name: Inputs; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Inputs" (
    oid integer,
    input_id integer DEFAULT nextval('buttons_button_id_seq'::regclass) NOT NULL,
    type character varying(32),
    helper character varying(512)
);


ALTER TABLE public."Inputs" OWNER TO postgres;

--
-- Name: labels_label_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE labels_label_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.labels_label_id_seq OWNER TO postgres;

--
-- Name: Labels; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Labels" (
    oid integer,
    label_id integer DEFAULT nextval('labels_label_id_seq'::regclass) NOT NULL,
    text character varying(2048),
    font character varying(64),
    font_size double precision DEFAULT 12,
    font_color character varying(6) DEFAULT 0
);


ALTER TABLE public."Labels" OWNER TO postgres;

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
-- Name: objects_oid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE objects_oid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.objects_oid_seq OWNER TO postgres;

--
-- Name: Objects; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Objects" (
    pid integer,
    oid integer DEFAULT nextval('objects_oid_seq'::regclass) NOT NULL,
    id character varying(32),
    type character varying(32),
    x_pos double precision,
    y_pos double precision
);


ALTER TABLE public."Objects" OWNER TO postgres;

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
-- Name: qbuttons_qbutton_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE qbuttons_qbutton_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.qbuttons_qbutton_id_seq OWNER TO postgres;

--
-- Name: QuestionButtons; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "QuestionButtons" (
    button_id integer,
    qbutton_id integer DEFAULT nextval('qbuttons_qbutton_id_seq'::regclass) NOT NULL,
    qid integer
);


ALTER TABLE public."QuestionButtons" OWNER TO postgres;

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
    oid integer,
    qid integer DEFAULT nextval('questions_qid_seq'::regclass) NOT NULL,
    is_required boolean DEFAULT false,
    input integer,
    label integer
);


ALTER TABLE public."Questions" OWNER TO postgres;

--
-- Name: radios_radio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE radios_radio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.radios_radio_id_seq OWNER TO postgres;

--
-- Name: Radios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Radios" (
    input_id integer,
    radio_id integer DEFAULT nextval('radios_radio_id_seq'::regclass) NOT NULL,
    choices character varying(2048),
    orientation character varying(16)
);


ALTER TABLE public."Radios" OWNER TO postgres;

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
    address character varying(256),
    nationality character varying(32),
    birthdate date,
    gender character varying(32),
    civil_status integer DEFAULT 0,
    eid integer,
    since date
);


ALTER TABLE public."Respondents" OWNER TO postgres;

--
-- Name: responses_response_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE responses_response_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.responses_response_id_seq OWNER TO postgres;

--
-- Name: Responses; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Responses" (
    rid integer NOT NULL,
    response_id integer DEFAULT nextval('responses_response_id_seq'::regclass) NOT NULL,
    qid integer,
    answer character varying(4096),
    duration double precision
);


ALTER TABLE public."Responses" OWNER TO postgres;

--
-- Name: slider_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE slider_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.slider_id_seq OWNER TO postgres;

--
-- Name: Sliders; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Sliders" (
    input_id integer,
    slider_id integer DEFAULT nextval('slider_id_seq'::regclass) NOT NULL,
    type character(16),
    min_num character varying(16),
    max_num character varying(16)
);


ALTER TABLE public."Sliders" OWNER TO postgres;

--
-- Name: texts_text_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE texts_text_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.texts_text_id_seq OWNER TO postgres;

--
-- Name: Texts; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Texts" (
    input_id integer,
    text_id integer DEFAULT nextval('texts_text_id_seq'::regclass) NOT NULL,
    length integer,
    orientation character varying(16)
);


ALTER TABLE public."Texts" OWNER TO postgres;

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
-- Name: Buttons_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Buttons"
    ADD CONSTRAINT "Buttons_pkey" PRIMARY KEY (button_id);


--
-- Name: Checkboxes_input_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Checkboxes"
    ADD CONSTRAINT "Checkboxes_input_id_key" UNIQUE (input_id);


--
-- Name: Checkboxes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Checkboxes"
    ADD CONSTRAINT "Checkboxes_pkey" PRIMARY KEY (checkbox_id);


--
-- Name: Dropdowns_input_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Dropdowns"
    ADD CONSTRAINT "Dropdowns_input_id_key" UNIQUE (input_id);


--
-- Name: Dropdowns_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Dropdowns"
    ADD CONSTRAINT "Dropdowns_pkey" PRIMARY KEY (dropdown_id);


--
-- Name: Experiments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Experiments"
    ADD CONSTRAINT "Experiments_pkey" PRIMARY KEY (eid);


--
-- Name: Inputs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Inputs"
    ADD CONSTRAINT "Inputs_pkey" PRIMARY KEY (input_id);


--
-- Name: Labels_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Labels"
    ADD CONSTRAINT "Labels_pkey" PRIMARY KEY (label_id);


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
-- Name: Objects_pid_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Objects"
    ADD CONSTRAINT "Objects_pid_id_key" UNIQUE (pid, id);


--
-- Name: Objects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Objects"
    ADD CONSTRAINT "Objects_pkey" PRIMARY KEY (oid);


--
-- Name: QuestionButtons_button_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "QuestionButtons"
    ADD CONSTRAINT "QuestionButtons_button_id_key" UNIQUE (button_id);


--
-- Name: QuestionButtons_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "QuestionButtons"
    ADD CONSTRAINT "QuestionButtons_pkey" PRIMARY KEY (qbutton_id);


--
-- Name: QuestionButtons_qid_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "QuestionButtons"
    ADD CONSTRAINT "QuestionButtons_qid_key" UNIQUE (qid);


--
-- Name: Radios_input_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Radios"
    ADD CONSTRAINT "Radios_input_id_key" UNIQUE (input_id);


--
-- Name: Radios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Radios"
    ADD CONSTRAINT "Radios_pkey" PRIMARY KEY (radio_id);


--
-- Name: Respondents_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Respondents"
    ADD CONSTRAINT "Respondents_pkey" PRIMARY KEY (rid);


--
-- Name: Responses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Responses"
    ADD CONSTRAINT "Responses_pkey" PRIMARY KEY (response_id);


--
-- Name: Responses_qid_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Responses"
    ADD CONSTRAINT "Responses_qid_key" UNIQUE (qid);


--
-- Name: Sliders_input_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Sliders"
    ADD CONSTRAINT "Sliders_input_id_key" UNIQUE (input_id);


--
-- Name: Sliders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Sliders"
    ADD CONSTRAINT "Sliders_pkey" PRIMARY KEY (slider_id);


--
-- Name: Texts_input_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Texts"
    ADD CONSTRAINT "Texts_input_id_key" UNIQUE (input_id);


--
-- Name: Texts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Texts"
    ADD CONSTRAINT "Texts_pkey" PRIMARY KEY (text_id);


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
-- Name: pid_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Pages"
    ADD CONSTRAINT pid_pkey PRIMARY KEY (pid);


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
-- Name: Buttons_oid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Buttons"
    ADD CONSTRAINT "Buttons_oid_fkey" FOREIGN KEY (oid) REFERENCES "Objects"(oid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Checkboxes_input_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Checkboxes"
    ADD CONSTRAINT "Checkboxes_input_id_fkey" FOREIGN KEY (input_id) REFERENCES "Inputs"(input_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Dropdowns_input_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Dropdowns"
    ADD CONSTRAINT "Dropdowns_input_id_fkey" FOREIGN KEY (input_id) REFERENCES "Inputs"(input_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Inputs_oid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Inputs"
    ADD CONSTRAINT "Inputs_oid_fkey" FOREIGN KEY (oid) REFERENCES "Objects"(oid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Labels_oid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Labels"
    ADD CONSTRAINT "Labels_oid_fkey" FOREIGN KEY (oid) REFERENCES "Objects"(oid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Objects_pid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Objects"
    ADD CONSTRAINT "Objects_pid_fkey" FOREIGN KEY (pid) REFERENCES "Pages"(pid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: QuestionButtons_button_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "QuestionButtons"
    ADD CONSTRAINT "QuestionButtons_button_id_fkey" FOREIGN KEY (button_id) REFERENCES "Buttons"(button_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: QuestionButtons_qid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "QuestionButtons"
    ADD CONSTRAINT "QuestionButtons_qid_fkey" FOREIGN KEY (qid) REFERENCES "Questions"(qid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Questions_input_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Questions"
    ADD CONSTRAINT "Questions_input_fkey" FOREIGN KEY (input) REFERENCES "Inputs"(input_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Questions_label_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Questions"
    ADD CONSTRAINT "Questions_label_fkey" FOREIGN KEY (label) REFERENCES "Labels"(label_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Questions_oid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Questions"
    ADD CONSTRAINT "Questions_oid_fkey" FOREIGN KEY (oid) REFERENCES "Objects"(oid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Radios_input_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Radios"
    ADD CONSTRAINT "Radios_input_id_fkey" FOREIGN KEY (input_id) REFERENCES "Inputs"(input_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Responses_qid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Responses"
    ADD CONSTRAINT "Responses_qid_fkey" FOREIGN KEY (qid) REFERENCES "Questions"(qid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Responses_rid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Responses"
    ADD CONSTRAINT "Responses_rid_fkey" FOREIGN KEY (rid) REFERENCES "Respondents"(rid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Sliders_input_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Sliders"
    ADD CONSTRAINT "Sliders_input_id_fkey" FOREIGN KEY (input_id) REFERENCES "Inputs"(input_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Texts_input_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Texts"
    ADD CONSTRAINT "Texts_input_id_fkey" FOREIGN KEY (input_id) REFERENCES "Inputs"(input_id) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: pages_ref_experiments_eid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Pages"
    ADD CONSTRAINT pages_ref_experiments_eid FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: respondents_ref_eid; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Respondents"
    ADD CONSTRAINT respondents_ref_eid FOREIGN KEY (eid) REFERENCES "Experiments"(eid) ON UPDATE CASCADE ON DELETE CASCADE;


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

