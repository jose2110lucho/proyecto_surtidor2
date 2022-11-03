PGDMP                     	    z            petcare    14.5    14.5 A    I           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            J           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            K           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            L           1262    16437    petcare    DATABASE     c   CREATE DATABASE petcare WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE petcare;
                postgres    false            �            1259    22471    clientes    TABLE     J  CREATE TABLE public.clientes (
    id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    apellido character varying(255) NOT NULL,
    telefono character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.clientes;
       public         heap    postgres    false            �            1259    22470    clientes_id_seq    SEQUENCE     x   CREATE SEQUENCE public.clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.clientes_id_seq;
       public          postgres    false    222            M           0    0    clientes_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.clientes_id_seq OWNED BY public.clientes.id;
          public          postgres    false    221            �            1259    22463 	   datafeeds    TABLE     '  CREATE TABLE public.datafeeds (
    id bigint NOT NULL,
    label character varying(255),
    data double precision,
    dataset_name smallint,
    data_type smallint DEFAULT '1'::smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.datafeeds;
       public         heap    postgres    false            �            1259    22462    datafeeds_id_seq    SEQUENCE     y   CREATE SEQUENCE public.datafeeds_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.datafeeds_id_seq;
       public          postgres    false    220            N           0    0    datafeeds_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.datafeeds_id_seq OWNED BY public.datafeeds.id;
          public          postgres    false    219            �            1259    22430    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    22429    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    215            O           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    214            �            1259    22482    mascotas    TABLE     �  CREATE TABLE public.mascotas (
    id bigint NOT NULL,
    cliente_id bigint NOT NULL,
    nombre character varying(255) NOT NULL,
    tipo character varying(255) NOT NULL,
    raza character varying(255),
    fecha_nacimiento date,
    latitud character varying(255),
    longitud character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.mascotas;
       public         heap    postgres    false            �            1259    22481    mascotas_id_seq    SEQUENCE     x   CREATE SEQUENCE public.mascotas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.mascotas_id_seq;
       public          postgres    false    224            P           0    0    mascotas_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.mascotas_id_seq OWNED BY public.mascotas.id;
          public          postgres    false    223            �            1259    22406 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    22405    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    210            Q           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    209            �            1259    22423    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         heap    postgres    false            �            1259    22442    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
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
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    22441    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    217            R           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    216            �            1259    22453    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    postgres    false            �            1259    22496    solicitudes    TABLE     �  CREATE TABLE public.solicitudes (
    id bigint NOT NULL,
    cliente_id bigint NOT NULL,
    mascota_id bigint NOT NULL,
    user_id bigint,
    tipo character varying(255) NOT NULL,
    fecha date NOT NULL,
    hora time(0) without time zone NOT NULL,
    latitud character varying(255) NOT NULL,
    longitud character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.solicitudes;
       public         heap    postgres    false            �            1259    22495    solicitudes_id_seq    SEQUENCE     {   CREATE SEQUENCE public.solicitudes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.solicitudes_id_seq;
       public          postgres    false    226            S           0    0    solicitudes_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.solicitudes_id_seq OWNED BY public.solicitudes.id;
          public          postgres    false    225            �            1259    22413    users    TABLE     @  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    current_team_id bigint,
    profile_photo_path character varying(2048),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    two_factor_secret text,
    two_factor_recovery_codes text,
    two_factor_confirmed_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    22412    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    212            T           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    211            �            1259    22520    visitas    TABLE     Q  CREATE TABLE public.visitas (
    id bigint NOT NULL,
    solicitude_id bigint NOT NULL,
    estado character varying(255) NOT NULL,
    hora_inicio time(0) without time zone,
    hora_fin time(0) without time zone,
    costo_total integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.visitas;
       public         heap    postgres    false            �            1259    22519    visitas_id_seq    SEQUENCE     w   CREATE SEQUENCE public.visitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.visitas_id_seq;
       public          postgres    false    228            U           0    0    visitas_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.visitas_id_seq OWNED BY public.visitas.id;
          public          postgres    false    227            �           2604    22474    clientes id    DEFAULT     j   ALTER TABLE ONLY public.clientes ALTER COLUMN id SET DEFAULT nextval('public.clientes_id_seq'::regclass);
 :   ALTER TABLE public.clientes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222            �           2604    22466    datafeeds id    DEFAULT     l   ALTER TABLE ONLY public.datafeeds ALTER COLUMN id SET DEFAULT nextval('public.datafeeds_id_seq'::regclass);
 ;   ALTER TABLE public.datafeeds ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    220    220            �           2604    22433    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    214    215    215            �           2604    22485    mascotas id    DEFAULT     j   ALTER TABLE ONLY public.mascotas ALTER COLUMN id SET DEFAULT nextval('public.mascotas_id_seq'::regclass);
 :   ALTER TABLE public.mascotas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    224    224            �           2604    22409    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    210    209    210            �           2604    22445    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    217    217            �           2604    22499    solicitudes id    DEFAULT     p   ALTER TABLE ONLY public.solicitudes ALTER COLUMN id SET DEFAULT nextval('public.solicitudes_id_seq'::regclass);
 =   ALTER TABLE public.solicitudes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    226    226            �           2604    22416    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    212    211    212            �           2604    22523 
   visitas id    DEFAULT     h   ALTER TABLE ONLY public.visitas ALTER COLUMN id SET DEFAULT nextval('public.visitas_id_seq'::regclass);
 9   ALTER TABLE public.visitas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    228    227    228            �           2606    22480    clientes clientes_email_unique 
   CONSTRAINT     Z   ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_email_unique UNIQUE (email);
 H   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_email_unique;
       public            postgres    false    222            �           2606    22478    clientes clientes_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.clientes DROP CONSTRAINT clientes_pkey;
       public            postgres    false    222            �           2606    22469    datafeeds datafeeds_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.datafeeds
    ADD CONSTRAINT datafeeds_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.datafeeds DROP CONSTRAINT datafeeds_pkey;
       public            postgres    false    220            �           2606    22438    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    215            �           2606    22440 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    215            �           2606    22489    mascotas mascotas_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.mascotas
    ADD CONSTRAINT mascotas_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.mascotas DROP CONSTRAINT mascotas_pkey;
       public            postgres    false    224            �           2606    22411    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    210            �           2606    22449 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    217            �           2606    22452 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    217            �           2606    22459    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            postgres    false    218            �           2606    22503    solicitudes solicitudes_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.solicitudes DROP CONSTRAINT solicitudes_pkey;
       public            postgres    false    226            �           2606    22422    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    212            �           2606    22420    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    212            �           2606    22525    visitas visitas_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.visitas
    ADD CONSTRAINT visitas_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.visitas DROP CONSTRAINT visitas_pkey;
       public            postgres    false    228            �           1259    22428    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public            postgres    false    213            �           1259    22450 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    217    217            �           1259    22461    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            postgres    false    218            �           1259    22460    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            postgres    false    218            �           2606    22490 $   mascotas mascotas_cliente_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.mascotas
    ADD CONSTRAINT mascotas_cliente_id_foreign FOREIGN KEY (cliente_id) REFERENCES public.clientes(id) ON DELETE RESTRICT;
 N   ALTER TABLE ONLY public.mascotas DROP CONSTRAINT mascotas_cliente_id_foreign;
       public          postgres    false    224    3248    222            �           2606    22504 *   solicitudes solicitudes_cliente_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_cliente_id_foreign FOREIGN KEY (cliente_id) REFERENCES public.clientes(id) ON DELETE RESTRICT;
 T   ALTER TABLE ONLY public.solicitudes DROP CONSTRAINT solicitudes_cliente_id_foreign;
       public          postgres    false    3248    222    226            �           2606    22509 *   solicitudes solicitudes_mascota_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_mascota_id_foreign FOREIGN KEY (mascota_id) REFERENCES public.mascotas(id) ON DELETE RESTRICT;
 T   ALTER TABLE ONLY public.solicitudes DROP CONSTRAINT solicitudes_mascota_id_foreign;
       public          postgres    false    224    226    3250            �           2606    22514 '   solicitudes solicitudes_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE RESTRICT;
 Q   ALTER TABLE ONLY public.solicitudes DROP CONSTRAINT solicitudes_user_id_foreign;
       public          postgres    false    3228    226    212            �           2606    22526 %   visitas visitas_solicitude_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.visitas
    ADD CONSTRAINT visitas_solicitude_id_foreign FOREIGN KEY (solicitude_id) REFERENCES public.solicitudes(id) ON DELETE CASCADE;
 O   ALTER TABLE ONLY public.visitas DROP CONSTRAINT visitas_solicitude_id_foreign;
       public          postgres    false    226    228    3252           