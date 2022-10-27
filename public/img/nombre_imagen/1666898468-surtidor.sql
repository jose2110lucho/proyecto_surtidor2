--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5
-- Dumped by pg_dump version 14.3

-- Started on 2022-10-23 17:09:06

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
-- TOC entry 229 (class 1259 OID 29617)
-- Name: cliente_premio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cliente_premio (
    id bigint NOT NULL,
    cliente_id bigint NOT NULL,
    premio_id bigint NOT NULL,
    cantidad integer NOT NULL,
    puntos_canjeados integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.cliente_premio OWNER TO postgres;

CREATE SEQUENCE public.cliente_premio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.cliente_premio_id_seq OWNER TO postgres;
ALTER SEQUENCE public.cliente_premio_id_seq OWNED BY public.cliente_premio.id;

CREATE TABLE public.clientes (
    id bigint NOT NULL,
    ci character varying(255) NOT NULL,
    nombre character varying(255) NOT NULL,
    apellido character varying(255) NOT NULL,
    telefono character varying(255) NOT NULL,
    puntos integer,
    estado boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.clientes OWNER TO postgres;

CREATE SEQUENCE public.clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.clientes_id_seq OWNER TO postgres;
ALTER SEQUENCE public.clientes_id_seq OWNED BY public.clientes.id;

CREATE TABLE public.combustibles (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    und_medida character varying(255) NOT NULL,
    precio_venta double precision NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.combustibles OWNER TO postgres;

CREATE SEQUENCE public.combustibles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.combustibles_id_seq OWNER TO postgres;
ALTER SEQUENCE public.combustibles_id_seq OWNED BY public.combustibles.id;

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
)
ALTER TABLE public.failed_jobs OWNER TO postgres;

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
    
ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;
ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
ALTER TABLE public.migrations OWNER TO postgres;

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;
ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
ALTER TABLE public.password_resets OWNER TO postgres;

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.personal_access_tokens OWNER TO postgres;

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.personal_access_tokens_id_seq OWNER TO postgres;
ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;

CREATE TABLE public.premios (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    descripcion text,
    stock integer NOT NULL,
    puntos_requeridos integer NOT NULL,
    estado boolean NOT NULL,
    producto_id bigint,
    unidades_producto integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.premios OWNER TO postgres;

CREATE SEQUENCE public.premios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.premios_id_seq OWNER TO postgres;
ALTER SEQUENCE public.premios_id_seq OWNED BY public.premios.id;

CREATE TABLE public.producto (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    precio_compra numeric(8,2) NOT NULL,
    precio_venta numeric(8,2) NOT NULL,
    estado boolean DEFAULT true NOT NULL,
    cantidad integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    nombre_imagen character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.producto OWNER TO postgres;

CREATE SEQUENCE public.producto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.producto_id_seq OWNER TO postgres;
ALTER SEQUENCE public.producto_id_seq OWNED BY public.producto.id;

CREATE TABLE public.proveedor (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    telefono integer NOT NULL,
    correo character varying(255) NOT NULL,
    direccion character varying(255) NOT NULL,
    nit integer NOT NULL,
    descripcion character varying(255) NOT NULL,
    estado boolean DEFAULT true NOT NULL
);
ALTER TABLE public.proveedor OWNER TO postgres;

CREATE SEQUENCE public.proveedor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.proveedor_id_seq OWNER TO postgres;
ALTER SEQUENCE public.proveedor_id_seq OWNED BY public.proveedor.id;

CREATE TABLE public.tanques (
    id bigint NOT NULL,
    codigo character varying(255) NOT NULL,
    combustible character varying(255) NOT NULL,
    descripcion text,
    capacidad double precision NOT NULL,
    cantidad_disponible double precision NOT NULL,
    cantidad_min double precision,
    estado boolean NOT NULL,
    fecha_carga timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.tanques OWNER TO postgres;

CREATE SEQUENCE public.tanques_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER TABLE public.tanques_id_seq OWNER TO postgres;
ALTER SEQUENCE public.tanques_id_seq OWNED BY public.tanques.id;

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    direccion character varying(255) NOT NULL,
    telefono character varying(255) NOT NULL,
    estado boolean NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
ALTER TABLE public.users OWNER TO postgres;

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;

ALTER TABLE ONLY public.cliente_premio ALTER COLUMN id SET DEFAULT nextval('public.cliente_premio_id_seq'::regclass);

ALTER TABLE ONLY public.clientes ALTER COLUMN id SET DEFAULT nextval('public.clientes_id_seq'::regclass);

ALTER TABLE ONLY public.combustibles ALTER COLUMN id SET DEFAULT nextval('public.combustibles_id_seq'::regclass);

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);

ALTER TABLE ONLY public.premios ALTER COLUMN id SET DEFAULT nextval('public.premios_id_seq'::regclass);

ALTER TABLE ONLY public.producto ALTER COLUMN id SET DEFAULT nextval('public.producto_id_seq'::regclass);

ALTER TABLE ONLY public.proveedor ALTER COLUMN id SET DEFAULT nextval('public.proveedor_id_seq'::regclass);

ALTER TABLE ONLY public.tanques ALTER COLUMN id SET DEFAULT nextval('public.tanques_id_seq'::regclass);

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);

ALTER TABLE ONLY public.cliente_premio
    ADD CONSTRAINT cliente_premio_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.combustibles
    ADD CONSTRAINT combustibles_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);

ALTER TABLE ONLY public.premios
    ADD CONSTRAINT premios_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.producto
    ADD CONSTRAINT producto_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.tanques
    ADD CONSTRAINT tanques_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);

ALTER TABLE ONLY public.cliente_premio
    ADD CONSTRAINT cliente_premio_cliente_id_foreign FOREIGN KEY (cliente_id) REFERENCES public.clientes(id);

ALTER TABLE ONLY public.cliente_premio
    ADD CONSTRAINT cliente_premio_premio_id_foreign FOREIGN KEY (premio_id) REFERENCES public.premios(id);

ALTER TABLE ONLY public.premios
    ADD CONSTRAINT premios_producto_id_foreign FOREIGN KEY (producto_id) REFERENCES public.producto(id);