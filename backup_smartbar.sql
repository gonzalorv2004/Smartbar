--
-- PostgreSQL database dump
--

\restrict I1DP5Q6JAQCTkvg4jD0s2xeblpurhR9fvN4RwkcagRweI1l5iKnfvVh3x7beWgU

-- Dumped from database version 15.17 (Debian 15.17-1.pgdg13+1)
-- Dumped by pg_dump version 15.17 (Debian 15.17-1.pgdg13+1)

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: detalle_pedido; Type: TABLE; Schema: public; Owner: smartbar
--

CREATE TABLE public.detalle_pedido (
    id integer NOT NULL,
    id_pedido integer NOT NULL,
    id_producto integer NOT NULL,
    cantidad integer
);


ALTER TABLE public.detalle_pedido OWNER TO smartbar;

--
-- Name: detalle_pedido_id_seq; Type: SEQUENCE; Schema: public; Owner: smartbar
--

CREATE SEQUENCE public.detalle_pedido_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.detalle_pedido_id_seq OWNER TO smartbar;

--
-- Name: detalle_pedido_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smartbar
--

ALTER SEQUENCE public.detalle_pedido_id_seq OWNED BY public.detalle_pedido.id;


--
-- Name: pedidos; Type: TABLE; Schema: public; Owner: smartbar
--

CREATE TABLE public.pedidos (
    id integer NOT NULL,
    id_usuario integer,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    estado character varying(50),
    nombre_cliente character varying(100),
    telefono character varying(30),
    direccion character varying(200)
);


ALTER TABLE public.pedidos OWNER TO smartbar;


--
-- Name: pedidos_id_seq; Type: SEQUENCE; Schema: public; Owner: smartbar
--

CREATE SEQUENCE public.pedidos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pedidos_id_seq OWNER TO smartbar;

--
-- Name: pedidos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smartbar
--

ALTER SEQUENCE public.pedidos_id_seq OWNED BY public.pedidos.id;


--
-- Name: productos; Type: TABLE; Schema: public; Owner: smartbar
--

CREATE TABLE public.productos (
    id integer NOT NULL,
    nombre character varying(100),
    precio numeric(10,2),
    stock integer
);


ALTER TABLE public.productos OWNER TO smartbar;

--
-- Name: productos_id_seq; Type: SEQUENCE; Schema: public; Owner: smartbar
--

CREATE SEQUENCE public.productos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.productos_id_seq OWNER TO smartbar;

--
-- Name: productos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smartbar
--

ALTER SEQUENCE public.productos_id_seq OWNED BY public.productos.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: smartbar
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre character varying(100),
    email character varying(100),
    password character varying(100),
    rol character varying(50)
);


ALTER TABLE public.usuarios OWNER TO smartbar;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: smartbar
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_seq OWNER TO smartbar;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smartbar
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: detalle_pedido id; Type: DEFAULT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.detalle_pedido ALTER COLUMN id SET DEFAULT nextval('public.detalle_pedido_id_seq'::regclass);


--
-- Name: pedidos id; Type: DEFAULT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.pedidos ALTER COLUMN id SET DEFAULT nextval('public.pedidos_id_seq'::regclass);


--
-- Name: productos id; Type: DEFAULT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.productos ALTER COLUMN id SET DEFAULT nextval('public.productos_id_seq'::regclass);

--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Data for Name: detalle_pedido; Type: TABLE DATA; Schema: public; Owner: smartbar
--

COPY public.detalle_pedido (id, id_pedido, id_producto, cantidad) FROM stdin;
\.


--
-- Data for Name: pedidos; Type: TABLE DATA; Schema: public; Owner: smartbar
--

COPY public.pedidos (id, id_usuario, fecha, estado, nombre_cliente, telefono, direccion) FROM stdin;
14      4       2026-05-19 10:31:30.348265      servido Gonzalo         5687677 Avd.Queteden Porculo Nº 28-B
9       4       2026-05-15 19:48:35.253125      servido Maria   5687677a        Avd.Queteden Porculo Nº 28-B
8       4       2026-05-15 18:26:55.235701      servido Maria   5687677 Avd.Queteden Porculo Nº 28-B
6       4       2026-05-10 10:55:00.569751      servido Maria   5687677 Avd.Queteden Porculo Nº 28-B
5       1       2026-05-08 11:52:39.797772      servido Gonzalo 628496167       Avd. del Valle Nº 11
4       1       2026-05-08 11:16:52.22021       servido Gonzalo 628496167       Avd. del Valle Nº 11
7       4       2026-05-13 11:54:51.687707      servido Maria   5687677 Avd.Queteden Porculo Nº 28-B
3       1       2026-05-08 11:14:57.235342      servido Gonzalo 628496167       Avd. del Valle Nº 11
2       1       2026-05-06 12:34:48.776339      servido Gonzalo 628496167       Avd. del Valle Nº 11
1       1       2026-05-06 08:44:44.25611       servido Gonzalo 628496167       Avd. del Valle Nº 11
10      4       2026-05-15 19:55:00.828455      servido Gonzalo         628496167       Avd. del Valle Nº 11
11      4       2026-05-16 11:53:26.561465      servido Esperanza       121213  Avd. del Valle Nº 11
12      4       2026-05-18 09:25:01.73093       servido Pepa    666666666       a
13      2       2026-05-18 09:25:10.493193      servido Gonzalo         5687677 Avd. del Valle Nº31
\.

--
-- Data for Name: productos; Type: TABLE DATA; Schema: public; Owner: smartbar
--

COPY public.productos (id, nombre, precio, stock) FROM stdin;
1       Cerveza 2.50    100
2       Coca Cola       2.00    100
3       Fanta de Naranja        2.00    100
4       Fanta de Limon  2.00    100
5       Aquarius        2.50    100
6       Aquarius de Naranja     2.50    100
7       Colacacao       4.00    100
8       Cafe    4.50    100
9       Perritos Calientes      6.00    50
10      Montaditos      6.50    50
11      Hamburguesa     8.00    50
12      Pizza   8.50    50
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: smartbar
--

COPY public.usuarios (id, nombre, email, password, rol) FROM stdin;
1       Gonzalo gonzalo@smartbar.com    1234    admin
2       Antonio Carlos  ac@smartbar.com 1234    camarero
4       Diego   diego@smartbar.com      1234    camarero
3       Alejandro       smartbar        1234    cocina
5       Juan Pedro      smartbar        1234    cocina
6       Pablo   pablo@smartbar.com      1234    cocina
7       Esperanza       espe@smartbar.com       1234    camerero
\.


--
-- Name: detalle_pedido_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smartbar
--

SELECT pg_catalog.setval('public.detalle_pedido_id_seq', 1, false);

--
-- Name: pedidos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smartbar
--

SELECT pg_catalog.setval('public.pedidos_id_seq', 14, true);


--
-- Name: productos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smartbar
--

SELECT pg_catalog.setval('public.productos_id_seq', 12, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smartbar
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 7, true);


--
-- Name: detalle_pedido detalle_pedido_pkey; Type: CONSTRAINT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_pkey PRIMARY KEY (id);


--
-- Name: pedidos pedidos_pkey; Type: CONSTRAINT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_pkey PRIMARY KEY (id);


--
-- Name: productos productos_pkey; Type: CONSTRAINT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (id);

--
-- Name: detalle_pedido detalle_pedido_id_pedido_fkey; Type: FK CONSTRAINT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_id_pedido_fkey FOREIGN KEY (id_pedido) REFERENCES public.pedidos(id);


--
-- Name: detalle_pedido detalle_pedido_id_producto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_id_producto_fkey FOREIGN KEY (id_producto) REFERENCES public.productos(id);


--
-- Name: pedidos pedidos_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: smartbar
--

ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id);


--
-- PostgreSQL database dump complete
--

\unrestrict I1DP5Q6JAQCTkvg4jD0s2xeblpurhR9fvN4RwkcagRweI1l5iKnfvVh3x7beWgU
