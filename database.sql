--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.22
-- Dumped by pg_dump version 9.6.22

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


--
-- Name: produtos_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produtos_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produtos_sequence OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: produtos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produtos (
    id integer DEFAULT nextval('public.produtos_sequence'::regclass) NOT NULL,
    tipo_id integer NOT NULL,
    nome character varying(155) NOT NULL,
    descricao text,
    ativo boolean DEFAULT true NOT NULL,
    dh_cadastro timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.produtos OWNER TO postgres;

--
-- Name: tipos_produtos_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_produtos_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_produtos_sequence OWNER TO postgres;

--
-- Name: tipos_produtos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipos_produtos (
    id integer DEFAULT nextval('public.tipos_produtos_sequence'::regclass) NOT NULL,
    nome character varying(150) NOT NULL,
    descricao text,
    percentual_imposto numeric(10,2) NOT NULL,
    ativo boolean DEFAULT true NOT NULL,
    dh_cadastro timestamp(6) without time zone DEFAULT now()
);


ALTER TABLE public.tipos_produtos OWNER TO postgres;

--
-- Name: tipos_produtos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_produtos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_produtos_seq OWNER TO postgres;

--
-- Name: vendas_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendas_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vendas_sequence OWNER TO postgres;

--
-- Name: vendas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendas (
    id integer DEFAULT nextval('public.vendas_sequence'::regclass) NOT NULL,
    observacoes text,
    valor_total_compra numeric(10,2) NOT NULL,
    valor_total_imposto numeric(10,2) NOT NULL,
    dh_cadastro timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.vendas OWNER TO postgres;

--
-- Name: vendas_produtos_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendas_produtos_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vendas_produtos_sequence OWNER TO postgres;

--
-- Name: vendas_produtos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendas_produtos (
    id integer DEFAULT nextval('public.vendas_produtos_sequence'::regclass) NOT NULL,
    venda_id integer NOT NULL,
    produto_id integer NOT NULL,
    quantidade integer NOT NULL,
    valor_unitario numeric(10,2) NOT NULL,
    valor_total numeric(10,2) NOT NULL,
    percentual_imposto numeric(10,2),
    valor_total_imposto numeric(10,2)
);


ALTER TABLE public.vendas_produtos OWNER TO postgres;

--
-- Data for Name: produtos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produtos (id, tipo_id, nome, descricao, ativo, dh_cadastro) FROM stdin;
2	4	Smartwatch Amazfit GTS 2		t	2021-07-21 13:36:13
3	4	Smartwatch Apple Watch Serie 6		t	2021-07-21 13:36:23
4	2	Smartphone Samsung Galaxy S21		t	2021-07-21 13:36:43
5	2	Smartphone Apple iPhone 11		t	2021-07-21 13:36:53
6	2	Smartphone Motorola Moto G10		t	2021-07-21 13:37:04
7	1	Notebook Acer Aspire 5		t	2021-07-21 13:37:15
8	1	Notebook Lenovo Ideapad 330		t	2021-07-21 13:37:24
9	1	Notebook Dell Inspiron i15		t	2021-07-21 13:37:35
10	3	Monitor Gamer LG 25UM58G		t	2021-07-21 13:38:02
11	3	Monitor Gamer Full HD 24.5 Lenovo		t	2021-07-21 13:38:41
12	3	Monitor Gamer Aoc Sniper		t	2021-07-21 13:38:57
1	4	Smartwatch Samsung Galaxy Watch Active		t	2021-07-21 13:35:59
\.


--
-- Name: produtos_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produtos_sequence', 12, true);


--
-- Data for Name: tipos_produtos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipos_produtos (id, nome, descricao, percentual_imposto, ativo, dh_cadastro) FROM stdin;
1	Notebook		11.00	t	2021-07-21 10:51:58
2	Smartphone	\N	13.50	t	2021-07-21 10:53:18.717975
3	Monitor	\N	12.75	t	2021-07-21 11:01:47.929968
4	Smartwatch		16.40	t	2021-07-21 11:02:02.259028
\.


--
-- Name: tipos_produtos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_produtos_seq', 2, true);


--
-- Name: tipos_produtos_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_produtos_sequence', 4, true);


--
-- Data for Name: vendas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendas (id, observacoes, valor_total_compra, valor_total_imposto, dh_cadastro) FROM stdin;
\.


--
-- Data for Name: vendas_produtos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendas_produtos (id, venda_id, produto_id, quantidade, valor_unitario, valor_total, percentual_imposto, valor_total_imposto) FROM stdin;
\.


--
-- Name: vendas_produtos_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendas_produtos_sequence', 1, false);


--
-- Name: vendas_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendas_sequence', 1, false);


--
-- Name: vendas venda_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT venda_pkey PRIMARY KEY (id);


--
-- Name: vendas_produtos vendas_produtos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas_produtos
    ADD CONSTRAINT vendas_produtos_pkey PRIMARY KEY (id);


--
-- Name: produtos_unique_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX produtos_unique_id ON public.produtos USING btree (id);


--
-- Name: tipos_produtos_unique_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX tipos_produtos_unique_id ON public.tipos_produtos USING btree (id);


--
-- Name: venda_id_unique; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX venda_id_unique ON public.vendas USING btree (id);


--
-- Name: vendas_produtos_id_unique; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX vendas_produtos_id_unique ON public.vendas_produtos USING btree (id);


--
-- Name: produtos produtos_tipo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_tipo_id_foreign FOREIGN KEY (tipo_id) REFERENCES public.tipos_produtos(id);


--
-- Name: vendas_produtos vendas_produtos_produto_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas_produtos
    ADD CONSTRAINT vendas_produtos_produto_id_foreign FOREIGN KEY (produto_id) REFERENCES public.produtos(id);


--
-- Name: vendas_produtos vendas_produtos_venda_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas_produtos
    ADD CONSTRAINT vendas_produtos_venda_id_foreign FOREIGN KEY (venda_id) REFERENCES public.vendas(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

