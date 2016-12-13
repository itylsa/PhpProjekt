--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2016-12-05 17:29:38

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

DROP DATABASE "phpProject";
--
-- TOC entry 1974 (class 1262 OID 1298952)
-- Name: phpProject; Type: DATABASE; Schema: -; Owner: admin
--

CREATE DATABASE "phpProject" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'German_Germany.1252' LC_CTYPE = 'German_Germany.1252';


ALTER DATABASE "phpProject" OWNER TO admin;

\connect "phpProject"

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 5 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: admin
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO admin;

--
-- TOC entry 1975 (class 0 OID 0)
-- Dependencies: 5
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: admin
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 175 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 1977 (class 0 OID 0)
-- Dependencies: 175
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 172 (class 1259 OID 1298959)
-- Name: annonce; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE annonce (
    "column" character varying,
    text character varying,
    "annonceId" bigint NOT NULL,
    "fsUser" bigint
);


ALTER TABLE public.annonce OWNER TO admin;

--
-- TOC entry 174 (class 1259 OID 1298965)
-- Name: label; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE label (
    type character varying,
    text character varying,
    language character varying,
    "idLabel" bigint NOT NULL
);


ALTER TABLE public.label OWNER TO admin;

--
-- TOC entry 171 (class 1259 OID 1298956)
-- Name: ort; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE ort (
    "oId" bigint NOT NULL,
    plz integer,
    "ortName" character varying
);


ALTER TABLE public.ort OWNER TO admin;

--
-- TOC entry 173 (class 1259 OID 1298962)
-- Name: picture; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE picture (
    "dataName" character varying,
    label character varying,
    "idPicture" bigint NOT NULL,
    "fsAnnonce" bigint
);


ALTER TABLE public.picture OWNER TO admin;

--
-- TOC entry 170 (class 1259 OID 1298953)
-- Name: user; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE "user" (
    "userId" bigint NOT NULL,
    "eMail" character varying,
    password character varying,
    "lastName" character varying,
    "firstName" character varying,
    "streetNumber" bigint,
    "fsOid" bigint
);


ALTER TABLE public."user" OWNER TO admin;

--
-- TOC entry 1967 (class 0 OID 1298959)
-- Dependencies: 172
-- Data for Name: annonce; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY annonce ("column", text, "annonceId", "fsUser") FROM stdin;
\.


--
-- TOC entry 1969 (class 0 OID 1298965)
-- Dependencies: 174
-- Data for Name: label; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY label (type, text, language, "idLabel") FROM stdin;
\.


--
-- TOC entry 1966 (class 0 OID 1298956)
-- Dependencies: 171
-- Data for Name: ort; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY ort ("oId", plz, "ortName") FROM stdin;
\.


--
-- TOC entry 1968 (class 0 OID 1298962)
-- Dependencies: 173
-- Data for Name: picture; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY picture ("dataName", label, "idPicture", "fsAnnonce") FROM stdin;
\.


--
-- TOC entry 1965 (class 0 OID 1298953)
-- Dependencies: 170
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY "user" ("userId", "eMail", password, "lastName", "firstName", "streetNumber", "fsOid") FROM stdin;
\.


--
-- TOC entry 1848 (class 2606 OID 1298993)
-- Name: AnnonceId; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY annonce
    ADD CONSTRAINT "AnnonceId" PRIMARY KEY ("annonceId");


--
-- TOC entry 1854 (class 2606 OID 1298988)
-- Name: label_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY label
    ADD CONSTRAINT label_pkey PRIMARY KEY ("idLabel");


--
-- TOC entry 1846 (class 2606 OID 1298977)
-- Name: ort_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY ort
    ADD CONSTRAINT ort_pkey PRIMARY KEY ("oId");


--
-- TOC entry 1852 (class 2606 OID 1299004)
-- Name: picture_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY picture
    ADD CONSTRAINT picture_pkey PRIMARY KEY ("idPicture");


--
-- TOC entry 1844 (class 2606 OID 1298972)
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY ("userId");


--
-- TOC entry 1850 (class 1259 OID 1299010)
-- Name: fki_fsAnnoce; Type: INDEX; Schema: public; Owner: admin; Tablespace: 
--

CREATE INDEX "fki_fsAnnoce" ON picture USING btree ("fsAnnonce");


--
-- TOC entry 1849 (class 1259 OID 1298999)
-- Name: fki_fsUser; Type: INDEX; Schema: public; Owner: admin; Tablespace: 
--

CREATE INDEX "fki_fsUser" ON annonce USING btree ("fsUser");


--
-- TOC entry 1842 (class 1259 OID 1298983)
-- Name: fki_oId; Type: INDEX; Schema: public; Owner: admin; Tablespace: 
--

CREATE INDEX "fki_oId" ON "user" USING btree ("fsOid");


--
-- TOC entry 1857 (class 2606 OID 1299005)
-- Name: fsAnnoce; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY picture
    ADD CONSTRAINT "fsAnnoce" FOREIGN KEY ("fsAnnonce") REFERENCES annonce("annonceId");


--
-- TOC entry 1856 (class 2606 OID 1298994)
-- Name: fsUser; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY annonce
    ADD CONSTRAINT "fsUser" FOREIGN KEY ("fsUser") REFERENCES "user"("userId");


--
-- TOC entry 1855 (class 2606 OID 1298978)
-- Name: oId; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT "oId" FOREIGN KEY ("fsOid") REFERENCES ort("oId");


--
-- TOC entry 1976 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: admin
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-12-05 17:29:38

--
-- PostgreSQL database dump complete
--

