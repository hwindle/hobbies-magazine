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
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: contents; Type: TABLE; Schema: public; Owner: steve; Tablespace: 
--

CREATE TABLE contents (
    id integer NOT NULL,
    contents character varying(50),
    page numeric(3,0),
    category character varying(30),
    mag_id integer
);


ALTER TABLE contents OWNER TO steve;

--
-- Name: contents_id_seq; Type: SEQUENCE; Schema: public; Owner: steve
--

CREATE SEQUENCE contents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE contents_id_seq OWNER TO steve;

--
-- Name: contents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: steve
--

ALTER SEQUENCE contents_id_seq OWNED BY contents.id;


--
-- Name: hobbies; Type: TABLE; Schema: public; Owner: steve; Tablespace: 
--

CREATE TABLE hobbies (
    id integer NOT NULL,
    date character varying(10) NOT NULL,
    vol numeric(4,0),
    issue numeric(5,0),
    folder character varying(10)
);


ALTER TABLE hobbies OWNER TO steve;

--
-- Name: hobbies_id_seq; Type: SEQUENCE; Schema: public; Owner: steve
--

CREATE SEQUENCE hobbies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE hobbies_id_seq OWNER TO steve;

--
-- Name: hobbies_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: steve
--

ALTER SEQUENCE hobbies_id_seq OWNED BY hobbies.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: steve
--

ALTER TABLE ONLY contents ALTER COLUMN id SET DEFAULT nextval('contents_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: steve
--

ALTER TABLE ONLY hobbies ALTER COLUMN id SET DEFAULT nextval('hobbies_id_seq'::regclass);


--
-- Data for Name: contents; Type: TABLE DATA; Schema: public; Owner: steve
--

COPY contents (id, contents, page, category, mag_id) FROM stdin;
1	Dolls kitchen cabinet	241	doll houses	1
2	Hobbies correspondence club	243	letters	1
3	An adjustable electric fan	244	electronics	1
4	Maze competition	245	competitions	1
5	A wind harp	246	music	1
6	Making a variable resistance	247	electronics	1
7	How to polish turned work	249	wood working	1
8	A simple garden fountain	250	gardening	1
9	Dolls kitchen cabinet patterns	253	doll houses	1
10	Dutch figure clock	255	fretwork	1
11	Preparing the tent	257	camping	1
12	Plastic wood inlay	258	wood working	1
13	Keep fit with swimming	259	misc	1
14	Fitting a winding type doorbell	260	DIY	1
15	Novelty pencil holder	289	fretwork	2
16	Cage for fancy mice	291	pets	2
17	Use of glasspaper	292	wood working	2
18	Folding campbed and washstand	293	camping	2
19	A fish cage	295	pets	2
20	A garden tree seat	296	gardening	2
21	viking ship fireplace screen	297	fretwork	2
22	small toy wheelbarow	298	toys	2
23	fretwork notes	303	fretwork	2
24	hints on mitre joints	305	wood working	2
25	British legion shield key rack	306	fretwork	2
26	Hanging vase holder	265	fretwork	3
27	Home chemistry	267	chemistry	3
28	Novel silhouette stud box	269	fretwork	3
29	Model railway inspection pit	270	railway	3
30	Magazine stand in oak	272	furniture	3
31	small scale model aircraft	273	models	3
32	Garden dolls house	275	toys	3
33	Small gothic clock case	278	fretwork	3
34	storing photo negatives	279	photography	3
\.


--
-- Name: contents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: steve
--

SELECT pg_catalog.setval('contents_id_seq', 34, true);


--
-- Data for Name: hobbies; Type: TABLE DATA; Schema: public; Owner: steve
--

COPY hobbies (id, date, vol, issue, folder) FROM stdin;
1	11/06/1938	86	2225	A
2	25/06/1938	86	2227	
3	18/06/1938	86	2226	
\.


--
-- Name: hobbies_id_seq; Type: SEQUENCE SET; Schema: public; Owner: steve
--

SELECT pg_catalog.setval('hobbies_id_seq', 3, true);


--
-- Name: contents_pkey; Type: CONSTRAINT; Schema: public; Owner: steve; Tablespace: 
--

ALTER TABLE ONLY contents
    ADD CONSTRAINT contents_pkey PRIMARY KEY (id);


--
-- Name: hobbies_pkey; Type: CONSTRAINT; Schema: public; Owner: steve; Tablespace: 
--

ALTER TABLE ONLY hobbies
    ADD CONSTRAINT hobbies_pkey PRIMARY KEY (id);


--
-- Name: contents_mag_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: steve
--

ALTER TABLE ONLY contents
    ADD CONSTRAINT contents_mag_id_fkey FOREIGN KEY (mag_id) REFERENCES hobbies(id);


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

