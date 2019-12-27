--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.18
-- Dumped by pg_dump version 11.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: unaccent; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS unaccent WITH SCHEMA public;


--
-- Name: EXTENSION unaccent; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION unaccent IS 'text search dictionary that removes accents';


SET default_with_oids = false;

--
-- Name: acl_classes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.acl_classes (
    id integer NOT NULL,
    class_type character varying(200) NOT NULL
);


--
-- Name: acl_classes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.acl_classes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: acl_classes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.acl_classes_id_seq OWNED BY public.acl_classes.id;


--
-- Name: acl_entries; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.acl_entries (
    id integer NOT NULL,
    class_id integer NOT NULL,
    object_identity_id integer,
    security_identity_id integer NOT NULL,
    field_name character varying(50) DEFAULT NULL::character varying,
    ace_order smallint NOT NULL,
    mask integer NOT NULL,
    granting boolean NOT NULL,
    granting_strategy character varying(30) NOT NULL,
    audit_success boolean NOT NULL,
    audit_failure boolean NOT NULL
);


--
-- Name: acl_entries_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.acl_entries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: acl_entries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.acl_entries_id_seq OWNED BY public.acl_entries.id;


--
-- Name: acl_object_identities; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.acl_object_identities (
    id integer NOT NULL,
    parent_object_identity_id integer,
    class_id integer NOT NULL,
    object_identifier character varying(100) NOT NULL,
    entries_inheriting boolean NOT NULL
);


--
-- Name: acl_object_identities_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.acl_object_identities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: acl_object_identities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.acl_object_identities_id_seq OWNED BY public.acl_object_identities.id;


--
-- Name: acl_object_identity_ancestors; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.acl_object_identity_ancestors (
    object_identity_id integer NOT NULL,
    ancestor_id integer NOT NULL
);


--
-- Name: acl_security_identities; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.acl_security_identities (
    id integer NOT NULL,
    identifier character varying(200) NOT NULL,
    username boolean NOT NULL
);


--
-- Name: acl_security_identities_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.acl_security_identities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: acl_security_identities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.acl_security_identities_id_seq OWNED BY public.acl_security_identities.id;


--
-- Name: agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.agendamento_manutencao_equipamento (
    id integer NOT NULL,
    titulo_agendamento_manutencao_equipamento_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    periodicidade integer NOT NULL,
    propriedade_equipamento integer
);


--
-- Name: agendamento_manutencao_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.agendamento_manutencao_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: agendamento_manutencao_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.agendamento_manutencao_equipamento_id_seq OWNED BY public.agendamento_manutencao_equipamento.id;


--
-- Name: agendamento_ordem_servico; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.agendamento_ordem_servico (
    id integer NOT NULL,
    os_id integer NOT NULL,
    solicitante_id integer NOT NULL,
    colaborador_id integer,
    colaborador_executor_id integer NOT NULL,
    dataagendada timestamp(0) without time zone NOT NULL,
    horaagendada time(0) without time zone NOT NULL,
    ocorrencia text NOT NULL,
    tem_relatorio boolean DEFAULT false,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: agendamento_ordem_servico_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.agendamento_ordem_servico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: agendamento_ordem_servico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.agendamento_ordem_servico_id_seq OWNED BY public.agendamento_ordem_servico.id;


--
-- Name: bairro; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bairro (
    id integer NOT NULL,
    cidade_id integer,
    nome character varying(100) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: bairro_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.bairro_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: bairro_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.bairro_id_seq OWNED BY public.bairro.id;


--
-- Name: cidade; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cidade (
    id integer NOT NULL,
    uf character varying(2) NOT NULL,
    nome character varying(100) NOT NULL,
    codigo_ibge character varying(10) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: cidade_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cidade_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: cidade_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cidade_id_seq OWNED BY public.cidade.id;


--
-- Name: classification__category; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.classification__category (
    id integer NOT NULL,
    parent_id integer,
    context character varying(255) DEFAULT NULL::character varying,
    media_id integer,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    slug character varying(255) NOT NULL,
    description character varying(255) DEFAULT NULL::character varying,
    "position" integer,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


--
-- Name: classification__category_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.classification__category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: classification__collection; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.classification__collection (
    id integer NOT NULL,
    context character varying(255) DEFAULT NULL::character varying,
    media_id integer,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    slug character varying(255) NOT NULL,
    description character varying(255) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


--
-- Name: classification__collection_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.classification__collection_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: classification__context; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.classification__context (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


--
-- Name: classification__tag; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.classification__tag (
    id integer NOT NULL,
    context character varying(255) DEFAULT NULL::character varying,
    name character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    slug character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


--
-- Name: classification__tag_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.classification__tag_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente (
    id integer NOT NULL,
    tipo_negocio_id integer,
    tipo_pessoa character varying(2) NOT NULL,
    nome character varying(120) NOT NULL,
    cpf_cnpj character varying(20) NOT NULL,
    razao_social character varying(120) DEFAULT NULL::character varying,
    horario_abertura time(0) without time zone DEFAULT NULL::time without time zone,
    horario_fechamento time(0) without time zone DEFAULT NULL::time without time zone,
    intervalo_almoco character varying(2) DEFAULT NULL::character varying,
    tipo_local character varying(2) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    filial_id integer,
    facilities_id integer
);


--
-- Name: cliente_documento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente_documento (
    cliente_id integer NOT NULL,
    documento_id integer NOT NULL
);


--
-- Name: cliente_endereco; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente_endereco (
    cliente_id integer NOT NULL,
    endereco_id integer NOT NULL
);


--
-- Name: cliente_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente_equipamento (
    id integer NOT NULL,
    equipamento_id integer NOT NULL,
    observacoes text NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    cliente_id integer,
    is_pmoc boolean DEFAULT false,
    data_inicio_pmoc timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    foto_id integer
);


--
-- Name: cliente_equipamento_agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente_equipamento_agendamento_manutencao_equipamento (
    cliente_equipamento_id integer NOT NULL,
    agendamento_manutencao_equipamento_id integer NOT NULL
);


--
-- Name: cliente_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cliente_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: cliente_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cliente_equipamento_id_seq OWNED BY public.cliente_equipamento.id;


--
-- Name: cliente_equipamento_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente_equipamento_propriedade_equipamento (
    cliente_equipamento_id integer NOT NULL,
    propriedade_equipamento_id integer NOT NULL
);


--
-- Name: cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cliente_id_seq OWNED BY public.cliente.id;


--
-- Name: cliente_responsavel_cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente_responsavel_cliente (
    cliente_id integer NOT NULL,
    responsavel_cliente_id integer NOT NULL
);


--
-- Name: cliente_telefone; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cliente_telefone (
    cliente_id integer NOT NULL,
    telefone_id integer NOT NULL
);


--
-- Name: colaborador; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.colaborador (
    id integer NOT NULL,
    funcao_id integer,
    user_id integer,
    tipo_colaborador character varying(10) NOT NULL,
    nome character varying(120) NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    sexo character varying(1) NOT NULL,
    data_nascimento date NOT NULL,
    cpf character varying(11) NOT NULL,
    rg character varying(20) NOT NULL,
    estado_civil character varying(2) NOT NULL,
    data_admissao date,
    data_recisao date,
    formacao character varying(255) DEFAULT NULL::character varying,
    nivel_escolaridade character varying(40) DEFAULT NULL::character varying,
    banco_conta character varying(10) DEFAULT NULL::character varying,
    banco_agencia character varying(10) DEFAULT NULL::character varying,
    banco_nome character varying(150) DEFAULT NULL::character varying,
    banco_ccorrente character varying(150) DEFAULT NULL::character varying,
    horario_entrada time(0) without time zone DEFAULT NULL::time without time zone,
    horario_saida time(0) without time zone DEFAULT NULL::time without time zone,
    intervalo_almoco character varying(2) DEFAULT NULL::character varying,
    status character varying(2) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    cra character varying(120) DEFAULT NULL::character varying,
    pathfoto character varying(255) DEFAULT NULL::character varying,
    grupo_usuario_id integer,
    artigo_crea character varying(120) DEFAULT NULL::character varying
);


--
-- Name: colaborador_documento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.colaborador_documento (
    colaborador_id integer NOT NULL,
    documento_id integer NOT NULL
);


--
-- Name: colaborador_endereco; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.colaborador_endereco (
    colaborador_id integer NOT NULL,
    endereco_id integer NOT NULL
);


--
-- Name: colaborador_filial_empresa; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.colaborador_filial_empresa (
    colaborador_id integer NOT NULL,
    filial_empresa_id integer NOT NULL
);


--
-- Name: colaborador_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.colaborador_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: colaborador_telefone; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.colaborador_telefone (
    colaborador_id integer NOT NULL,
    telefone_id integer NOT NULL
);


--
-- Name: contato; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.contato (
    id integer NOT NULL,
    nome character varying(90) NOT NULL,
    sobrenome character varying(100) NOT NULL,
    empresa character varying(150) NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: contato_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.contato_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: contato_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.contato_id_seq OWNED BY public.contato.id;


--
-- Name: contato_telefone; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.contato_telefone (
    contato_id integer NOT NULL,
    telefone_id integer NOT NULL
);


--
-- Name: documento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.documento (
    id integer NOT NULL,
    tipo_documento_id integer,
    titulo character varying(150) NOT NULL,
    data_emissao timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    data_validade timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    path_file character varying(255) NOT NULL,
    observacoes text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: documento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: documento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.documento_id_seq OWNED BY public.documento.id;


--
-- Name: endereco; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.endereco (
    id integer NOT NULL,
    tipo_id integer,
    bairro_id integer,
    logradouro character varying(150) NOT NULL,
    numero integer,
    cep character varying(8) NOT NULL,
    complemento character varying(255) DEFAULT NULL::character varying,
    referencia character varying(255) DEFAULT NULL::character varying,
    observacao text,
    cliente_id integer,
    colaborador_id integer,
    latitude character varying(150) DEFAULT NULL::character varying,
    longitude character varying(150) DEFAULT NULL::character varying,
    zoom_mapa character varying(2) DEFAULT NULL::character varying
);


--
-- Name: endereco_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.endereco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: endereco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.endereco_id_seq OWNED BY public.endereco.id;


--
-- Name: entrada_produto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.entrada_produto (
    id integer NOT NULL,
    colaborador_id integer NOT NULL,
    fornecedor_id integer NOT NULL,
    nota_xml_content text,
    id_nota character varying(255) DEFAULT NULL::character varying,
    observacoes text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: entrada_produto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.entrada_produto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: entrada_produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.entrada_produto_id_seq OWNED BY public.entrada_produto.id;


--
-- Name: entrada_produto_produto_saida; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.entrada_produto_produto_saida (
    entrada_produto_id integer NOT NULL,
    produto_saida_id integer NOT NULL
);


--
-- Name: equipamento_cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.equipamento_cliente (
    id integer NOT NULL,
    marca_equipamento_id integer NOT NULL,
    modelo_equipamento_id integer NOT NULL,
    especificacoes text NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    foto_id integer
);


--
-- Name: equipamento_cliente_agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.equipamento_cliente_agendamento_manutencao_equipamento (
    equipamento_cliente_id integer NOT NULL,
    agendamento_manutencao_equipamento_id integer NOT NULL
);


--
-- Name: equipamento_cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.equipamento_cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: equipamento_cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.equipamento_cliente_id_seq OWNED BY public.equipamento_cliente.id;


--
-- Name: execucao_de_procedimento_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.execucao_de_procedimento_equipamento (
    id integer NOT NULL,
    procedimento_pmoc_id integer NOT NULL,
    equipamento_cliente_id integer NOT NULL,
    os_id integer,
    observacao text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    data_agendada_execucao timestamp(0) without time zone NOT NULL
);


--
-- Name: execucao_de_procedimento_equipamento_foto_execucao_os; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.execucao_de_procedimento_equipamento_foto_execucao_os (
    execucao_de_procedimento_equipamento_id integer NOT NULL,
    foto_execucao_os_id integer NOT NULL
);


--
-- Name: execucao_de_procedimento_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.execucao_de_procedimento_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: execucao_de_procedimento_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.execucao_de_procedimento_equipamento_id_seq OWNED BY public.execucao_de_procedimento_equipamento.id;


--
-- Name: ferramenta_almoxarifado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ferramenta_almoxarifado (
    id integer NOT NULL,
    status boolean DEFAULT false NOT NULL,
    titulo character varying(255) NOT NULL,
    quantidade integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: ferramenta_almoxarifado_documento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ferramenta_almoxarifado_documento (
    ferramenta_almoxarifado_id integer NOT NULL,
    documento_id integer NOT NULL
);


--
-- Name: ferramenta_almoxarifado_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ferramenta_almoxarifado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ferramenta_almoxarifado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ferramenta_almoxarifado_id_seq OWNED BY public.ferramenta_almoxarifado.id;


--
-- Name: ficha_tecnica_produto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ficha_tecnica_produto (
    id integer NOT NULL,
    fabricante_id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    observacao text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    pathfoto character varying(255) DEFAULT NULL::character varying,
    os_id integer
);


--
-- Name: ficha_tecnica_produto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ficha_tecnica_produto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ficha_tecnica_produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ficha_tecnica_produto_id_seq OWNED BY public.ficha_tecnica_produto.id;


--
-- Name: filial_empresa; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.filial_empresa (
    id integer NOT NULL,
    nome character varying(120) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: filial_empresa_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.filial_empresa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: filial_empresa_unidade_federativa; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.filial_empresa_unidade_federativa (
    filial_empresa_id integer NOT NULL,
    unidade_federativa_id integer NOT NULL
);


--
-- Name: fornecedor; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.fornecedor (
    id integer NOT NULL,
    cnpj character varying(30) NOT NULL,
    razao_social character varying(155) NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    nome_vendedor character varying(45) DEFAULT 'Vendedor Teste'::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    nome_fantasia character varying(155) DEFAULT NULL::character varying,
    inscricao_estadual character varying(30) DEFAULT NULL::character varying,
    inscricao_municipal character varying(30) DEFAULT NULL::character varying,
    telefone character varying(25) DEFAULT NULL::character varying,
    observacao text
);


--
-- Name: fornecedor_documento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.fornecedor_documento (
    fornecedor_id integer NOT NULL,
    documento_id integer NOT NULL
);


--
-- Name: fornecedor_endereco; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.fornecedor_endereco (
    fornecedor_id integer NOT NULL,
    endereco_id integer NOT NULL
);


--
-- Name: fornecedor_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.fornecedor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: fornecedor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.fornecedor_id_seq OWNED BY public.fornecedor.id;


--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.fos_user_group (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    roles text NOT NULL
);


--
-- Name: COLUMN fos_user_group.roles; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN public.fos_user_group.roles IS '(DC2Type:array)';


--
-- Name: fos_user_group_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.fos_user_group_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: fos_user_user; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.fos_user_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_canonical character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean NOT NULL,
    expired boolean NOT NULL,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL,
    credentials_expired boolean NOT NULL,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    api_token character varying(255) DEFAULT NULL::character varying,
    user_token character varying(255) DEFAULT NULL::character varying,
    device_type character varying(255) DEFAULT NULL::character varying
);


--
-- Name: COLUMN fos_user_user.roles; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN public.fos_user_user.roles IS '(DC2Type:array)';


--
-- Name: fos_user_user_group; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.fos_user_user_group (
    user_id integer NOT NULL,
    group_id integer NOT NULL
);


--
-- Name: fos_user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.fos_user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: foto_execucao_os; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.foto_execucao_os (
    id integer NOT NULL,
    titulo character varying(150) DEFAULT NULL::character varying,
    path_file character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: foto_execucao_os_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.foto_execucao_os_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: foto_execucao_os_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.foto_execucao_os_id_seq OWNED BY public.foto_execucao_os.id;


--
-- Name: foto_os; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.foto_os (
    id integer NOT NULL,
    titulo character varying(150) DEFAULT NULL::character varying,
    path_file character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: foto_os_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.foto_os_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: foto_os_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.foto_os_id_seq OWNED BY public.foto_os.id;


--
-- Name: funcao; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.funcao (
    id integer NOT NULL,
    nome character varying(150) NOT NULL,
    descricao text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: funcao_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.funcao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: funcao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.funcao_id_seq OWNED BY public.funcao.id;


--
-- Name: homologacao_os; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.homologacao_os (
    id integer NOT NULL,
    os_id integer NOT NULL,
    valor numeric(10,2) NOT NULL,
    parcelas integer NOT NULL,
    observacoes text NOT NULL,
    codigo_erp character varying(45) DEFAULT NULL::character varying,
    is_pago boolean DEFAULT false,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: homologacao_os_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.homologacao_os_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: homologacao_os_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.homologacao_os_id_seq OWNED BY public.homologacao_os.id;


--
-- Name: marca_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.marca_equipamento (
    id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: marca_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.marca_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: marca_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.marca_equipamento_id_seq OWNED BY public.marca_equipamento.id;


--
-- Name: media__gallery; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.media__gallery (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    context character varying(64) NOT NULL,
    default_format character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


--
-- Name: media__gallery_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.media__gallery_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: media__gallery_media; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.media__gallery_media (
    id integer NOT NULL,
    gallery_id integer,
    media_id integer,
    "position" integer NOT NULL,
    enabled boolean NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


--
-- Name: media__gallery_media_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.media__gallery_media_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: media__media; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.media__media (
    id integer NOT NULL,
    category_id integer,
    name character varying(255) NOT NULL,
    description text,
    enabled boolean NOT NULL,
    provider_name character varying(255) NOT NULL,
    provider_status integer NOT NULL,
    provider_reference character varying(255) NOT NULL,
    provider_metadata text,
    width integer,
    height integer,
    length numeric(10,0) DEFAULT NULL::numeric,
    content_type character varying(255) DEFAULT NULL::character varying,
    content_size integer,
    copyright character varying(255) DEFAULT NULL::character varying,
    author_name character varying(255) DEFAULT NULL::character varying,
    context character varying(64) DEFAULT NULL::character varying,
    cdn_is_flushable boolean,
    cdn_flush_identifier character varying(64) DEFAULT NULL::character varying,
    cdn_flush_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    cdn_status integer,
    updated_at timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


--
-- Name: COLUMN media__media.provider_metadata; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN public.media__media.provider_metadata IS '(DC2Type:json)';


--
-- Name: media__media_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.media__media_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: migration_versions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migration_versions (
    version character varying(255) NOT NULL
);


--
-- Name: modelo_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.modelo_equipamento (
    id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: modelo_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.modelo_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: modelo_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.modelo_equipamento_id_seq OWNED BY public.modelo_equipamento.id;


--
-- Name: norma; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.norma (
    id integer NOT NULL,
    sigla character varying(150) NOT NULL,
    numero character varying(150) NOT NULL,
    observacao text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL
);


--
-- Name: norma_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.norma_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: norma_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.norma_id_seq OWNED BY public.norma.id;


--
-- Name: orcamento_produto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.orcamento_produto (
    id integer NOT NULL,
    colaborador_id integer,
    colaborador_id_enviou_orcamento integer,
    colaborador_id_autorizou_orcamento integer,
    data_prevista_entrega timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    data_entrega timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    estado character varying(155) NOT NULL,
    enviado_para_orcar_em timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    autorizado_em timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    data_cancelamento timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    observacoes text,
    created_at timestamp(0) without time zone NOT NULL,
    pathfoto character varying(255) DEFAULT NULL::character varying
);


--
-- Name: orcamento_produto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.orcamento_produto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: orcamento_produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.orcamento_produto_id_seq OWNED BY public.orcamento_produto.id;


--
-- Name: orcamento_produto_produto_solicitacao; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.orcamento_produto_produto_solicitacao (
    orcamento_produto_id integer NOT NULL,
    produto_solicitacao_id integer NOT NULL
);


--
-- Name: ordem_compra_produto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ordem_compra_produto (
    id integer NOT NULL,
    orcamento_id integer,
    colaborador_id integer,
    fornecedor_id integer,
    colaborador_id_autorizou_orcamento integer,
    estado character varying(25) NOT NULL,
    observacoes text,
    created_at timestamp(0) without time zone NOT NULL,
    autorizado_em timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    data_cancelamento timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: ordem_compra_produto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ordem_compra_produto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ordem_compra_produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ordem_compra_produto_id_seq OWNED BY public.ordem_compra_produto.id;


--
-- Name: ordem_compra_produto_produto_saida; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ordem_compra_produto_produto_saida (
    ordem_compra_produto_id integer NOT NULL,
    produto_saida_id integer NOT NULL
);


--
-- Name: ordem_servico; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ordem_servico (
    id integer NOT NULL,
    cliente_id integer NOT NULL,
    colaborador_solicitante_id integer NOT NULL,
    colaborador_avalista_id integer,
    colaborador_executor_id integer NOT NULL,
    nome_receptor character varying(45) DEFAULT NULL::character varying,
    rg_receptor character varying(45) DEFAULT NULL::character varying,
    relatorio_avaliacao text,
    dataagendada timestamp(0) without time zone NOT NULL,
    horaagendada time(0) without time zone NOT NULL,
    ocorrencia text NOT NULL,
    isencerrada boolean DEFAULT false,
    is_homologada boolean DEFAULT false,
    justificativa_encerramento text,
    observacao text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    endereco_id integer,
    solicitante character varying(255) DEFAULT NULL::character varying,
    os_original_id integer,
    is_pmoc boolean DEFAULT false,
    is_sync boolean DEFAULT false,
    receptorassinatura text,
    is_cancelada boolean DEFAULT false,
    engenheiro_id integer,
    norma_id integer,
    motivo_cancelamento text,
    data_abertura timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    data_encerramento timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    indice_relatorio text,
    resumo_relatorio text,
    pathfoto character varying(255) DEFAULT NULL::character varying
);


--
-- Name: ordem_servico_colaborador; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ordem_servico_colaborador (
    ordem_servico_id integer NOT NULL,
    colaborador_id integer NOT NULL
);


--
-- Name: ordem_servico_ficha_tecnica_produto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ordem_servico_ficha_tecnica_produto (
    ordem_servico_id integer NOT NULL,
    ficha_tecnica_produto_id integer NOT NULL
);


--
-- Name: ordem_servico_foto_os; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ordem_servico_foto_os (
    ordem_servico_id integer NOT NULL,
    foto_os_id integer NOT NULL
);


--
-- Name: ordem_servico_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ordem_servico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ordem_servico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ordem_servico_id_seq OWNED BY public.ordem_servico.id;


--
-- Name: posicao_tecnico; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.posicao_tecnico (
    id integer NOT NULL,
    tecnico_id integer NOT NULL,
    latitude character varying(255) NOT NULL,
    longitude character varying(255) NOT NULL,
    battery_level integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


--
-- Name: posicao_tecnico_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.posicao_tecnico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: posicao_tecnico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.posicao_tecnico_id_seq OWNED BY public.posicao_tecnico.id;


--
-- Name: produto_almoxarifado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produto_almoxarifado (
    id integer NOT NULL,
    fornecedor_id integer,
    status boolean DEFAULT false NOT NULL,
    titulo character varying(255) NOT NULL,
    unidade_medida character varying(10) DEFAULT NULL::character varying,
    departamento character varying(255) DEFAULT NULL::character varying,
    pathfoto character varying(255) DEFAULT NULL::character varying,
    codigo_fabricante character varying(100) NOT NULL,
    seccao character varying(10) NOT NULL,
    prateleira character varying(10) NOT NULL,
    divisao character varying(10) NOT NULL,
    caixa character varying(10) NOT NULL,
    quantidade_minima integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: produto_almoxarifado_documento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produto_almoxarifado_documento (
    produto_almoxarifado_id integer NOT NULL,
    documento_id integer NOT NULL
);


--
-- Name: produto_almoxarifado_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produto_almoxarifado_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: produto_estoque; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produto_estoque (
    id integer NOT NULL,
    produto_id integer,
    quantidade integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: produto_estoque_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produto_estoque_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: produto_estoque_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.produto_estoque_id_seq OWNED BY public.produto_estoque.id;


--
-- Name: produto_saida; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produto_saida (
    id integer NOT NULL,
    produto_id integer,
    quantidade numeric(10,2) DEFAULT 1::numeric NOT NULL,
    valor numeric(10,2) DEFAULT NULL::numeric
);


--
-- Name: produto_saida_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produto_saida_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: produto_saida_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.produto_saida_id_seq OWNED BY public.produto_saida.id;


--
-- Name: produto_solicitacao; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produto_solicitacao (
    id integer NOT NULL,
    produto_id integer,
    fornecedor_id integer,
    valor numeric(12,2) DEFAULT NULL::numeric,
    quantidade integer DEFAULT 1 NOT NULL
);


--
-- Name: produto_solicitacao_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produto_solicitacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: produto_solicitacao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.produto_solicitacao_id_seq OWNED BY public.produto_solicitacao.id;


--
-- Name: propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.propriedade_equipamento (
    id integer NOT NULL,
    titulo_propriedade_equipamento_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    is_etiqueta boolean DEFAULT false
);


--
-- Name: propriedade_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.propriedade_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: propriedade_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.propriedade_equipamento_id_seq OWNED BY public.propriedade_equipamento.id;


--
-- Name: propriedade_equipamento_valor_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.propriedade_equipamento_valor_propriedade_equipamento (
    propriedade_equipamento_id integer NOT NULL,
    valor_propriedade_equipamento_id integer NOT NULL
);


--
-- Name: relatorio_execucao_de_procedimento_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.relatorio_execucao_de_procedimento_equipamento (
    id integer NOT NULL,
    execucao_de_procedimento_id integer NOT NULL,
    relatorio_de_execucao text,
    propriedade_equipamento_com_valores_coletado text,
    created_at timestamp(0) without time zone NOT NULL,
    os_id integer
);


--
-- Name: relatorio_execucao_de_procedimento_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.relatorio_execucao_de_procedimento_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: relatorio_execucao_de_procedimento_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.relatorio_execucao_de_procedimento_equipamento_id_seq OWNED BY public.relatorio_execucao_de_procedimento_equipamento.id;


--
-- Name: relatorio_ordem_servico; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.relatorio_ordem_servico (
    id integer NOT NULL,
    agendamento_id integer NOT NULL,
    colaborador_id integer,
    nome_receptor character varying(45) DEFAULT NULL::character varying,
    rg_receptor character varying(15) DEFAULT NULL::character varying,
    relatorio_avaliacao text NOT NULL,
    isencerrada boolean DEFAULT false,
    is_homologada boolean DEFAULT false,
    justificativa_encerramento text,
    is_impedido boolean DEFAULT false,
    justificativa_empedimento text,
    path_file character varying(255) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: relatorio_ordem_servico_foto_os; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.relatorio_ordem_servico_foto_os (
    relatorio_ordem_servico_id integer NOT NULL,
    foto_os_id integer NOT NULL
);


--
-- Name: relatorio_ordem_servico_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.relatorio_ordem_servico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: relatorio_ordem_servico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.relatorio_ordem_servico_id_seq OWNED BY public.relatorio_ordem_servico.id;


--
-- Name: requisicao_produto; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.requisicao_produto (
    id integer NOT NULL,
    os_id integer NOT NULL,
    colaborador_id integer,
    estado character varying(25) NOT NULL,
    observacoes text,
    created_at timestamp(0) without time zone NOT NULL
);


--
-- Name: requisicao_produto_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.requisicao_produto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: requisicao_produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.requisicao_produto_id_seq OWNED BY public.requisicao_produto.id;


--
-- Name: requisicao_produto_produto_saida; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.requisicao_produto_produto_saida (
    requisicao_produto_id integer NOT NULL,
    produto_saida_id integer NOT NULL
);


--
-- Name: responsavel_cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.responsavel_cliente (
    id integer NOT NULL,
    cliente_id integer,
    nome character varying(150) NOT NULL,
    email character varying(150) NOT NULL,
    funcao character varying(150) NOT NULL,
    telefone character varying(20) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: responsavel_cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.responsavel_cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: responsavel_cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.responsavel_cliente_id_seq OWNED BY public.responsavel_cliente.id;


--
-- Name: revisions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.revisions (
    id integer NOT NULL,
    "timestamp" timestamp(0) without time zone NOT NULL,
    username character varying(255) NOT NULL
);


--
-- Name: revisions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.revisions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: revisions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.revisions_id_seq OWNED BY public.revisions.id;


--
-- Name: telefone; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.telefone (
    id integer NOT NULL,
    tipo_id integer,
    numero character varying(14) NOT NULL
);


--
-- Name: telefone_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.telefone_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: telefone_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.telefone_id_seq OWNED BY public.telefone.id;


--
-- Name: tempo_ocioso_tecnico; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tempo_ocioso_tecnico (
    id integer NOT NULL,
    tecnico_id integer NOT NULL,
    observacao text NOT NULL,
    tempo_gasto integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    data_hora_atividade timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: tempo_ocioso_tecnico_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tempo_ocioso_tecnico_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tempo_ocioso_tecnico_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tempo_ocioso_tecnico_id_seq OWNED BY public.tempo_ocioso_tecnico.id;


--
-- Name: tipo_documento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipo_documento (
    id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    observacoes text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: tipo_documento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipo_documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tipo_documento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipo_documento_id_seq OWNED BY public.tipo_documento.id;


--
-- Name: tipo_endereco; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipo_endereco (
    id integer NOT NULL,
    nome character varying(30) NOT NULL
);


--
-- Name: tipo_endereco_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipo_endereco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tipo_endereco_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipo_endereco_id_seq OWNED BY public.tipo_endereco.id;


--
-- Name: tipo_negocio; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipo_negocio (
    id integer NOT NULL,
    nome character varying(150) NOT NULL,
    descricao text,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: tipo_negocio_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipo_negocio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tipo_negocio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipo_negocio_id_seq OWNED BY public.tipo_negocio.id;


--
-- Name: tipo_telefone; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tipo_telefone (
    id integer NOT NULL,
    nome character varying(30) NOT NULL
);


--
-- Name: tipo_telefone_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tipo_telefone_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tipo_telefone_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tipo_telefone_id_seq OWNED BY public.tipo_telefone.id;


--
-- Name: titulo_agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.titulo_agendamento_manutencao_equipamento (
    id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: titulo_agendamento_manutencao_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.titulo_agendamento_manutencao_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: titulo_agendamento_manutencao_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.titulo_agendamento_manutencao_equipamento_id_seq OWNED BY public.titulo_agendamento_manutencao_equipamento.id;


--
-- Name: titulo_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.titulo_propriedade_equipamento (
    id integer NOT NULL,
    titulo character varying(150) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: titulo_propriedade_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.titulo_propriedade_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: titulo_propriedade_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.titulo_propriedade_equipamento_id_seq OWNED BY public.titulo_propriedade_equipamento.id;


--
-- Name: titulo_valor_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.titulo_valor_propriedade_equipamento (
    id integer NOT NULL,
    titulo character varying(150) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: titulo_valor_propriedade_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.titulo_valor_propriedade_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: titulo_valor_propriedade_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.titulo_valor_propriedade_equipamento_id_seq OWNED BY public.titulo_valor_propriedade_equipamento.id;


--
-- Name: unidade_federativa; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.unidade_federativa (
    id integer NOT NULL,
    sigla character varying(2) NOT NULL
);


--
-- Name: unidade_federativa_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.unidade_federativa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: usuario_cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.usuario_cliente (
    id integer NOT NULL,
    user_id integer,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: usuario_cliente_cliente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.usuario_cliente_cliente (
    usuario_cliente_id integer NOT NULL,
    cliente_id integer NOT NULL
);


--
-- Name: usuario_cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.usuario_cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: usuario_cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.usuario_cliente_id_seq OWNED BY public.usuario_cliente.id;


--
-- Name: valor_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.valor_propriedade_equipamento (
    id integer NOT NULL,
    titulo_valor_propriedade_equipamento_id integer NOT NULL,
    valor character varying(255) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: valor_propriedade_equipamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.valor_propriedade_equipamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: valor_propriedade_equipamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.valor_propriedade_equipamento_id_seq OWNED BY public.valor_propriedade_equipamento.id;


--
-- Name: acl_classes id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_classes ALTER COLUMN id SET DEFAULT nextval('public.acl_classes_id_seq'::regclass);


--
-- Name: acl_entries id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_entries ALTER COLUMN id SET DEFAULT nextval('public.acl_entries_id_seq'::regclass);


--
-- Name: acl_object_identities id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_object_identities ALTER COLUMN id SET DEFAULT nextval('public.acl_object_identities_id_seq'::regclass);


--
-- Name: acl_security_identities id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_security_identities ALTER COLUMN id SET DEFAULT nextval('public.acl_security_identities_id_seq'::regclass);


--
-- Name: agendamento_manutencao_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_manutencao_equipamento ALTER COLUMN id SET DEFAULT nextval('public.agendamento_manutencao_equipamento_id_seq'::regclass);


--
-- Name: agendamento_ordem_servico id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_ordem_servico ALTER COLUMN id SET DEFAULT nextval('public.agendamento_ordem_servico_id_seq'::regclass);


--
-- Name: bairro id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bairro ALTER COLUMN id SET DEFAULT nextval('public.bairro_id_seq'::regclass);


--
-- Name: cidade id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cidade ALTER COLUMN id SET DEFAULT nextval('public.cidade_id_seq'::regclass);


--
-- Name: cliente id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente ALTER COLUMN id SET DEFAULT nextval('public.cliente_id_seq'::regclass);


--
-- Name: cliente_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento ALTER COLUMN id SET DEFAULT nextval('public.cliente_equipamento_id_seq'::regclass);


--
-- Name: contato id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contato ALTER COLUMN id SET DEFAULT nextval('public.contato_id_seq'::regclass);


--
-- Name: documento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.documento ALTER COLUMN id SET DEFAULT nextval('public.documento_id_seq'::regclass);


--
-- Name: endereco id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco ALTER COLUMN id SET DEFAULT nextval('public.endereco_id_seq'::regclass);


--
-- Name: entrada_produto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto ALTER COLUMN id SET DEFAULT nextval('public.entrada_produto_id_seq'::regclass);


--
-- Name: equipamento_cliente id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente ALTER COLUMN id SET DEFAULT nextval('public.equipamento_cliente_id_seq'::regclass);


--
-- Name: execucao_de_procedimento_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento ALTER COLUMN id SET DEFAULT nextval('public.execucao_de_procedimento_equipamento_id_seq'::regclass);


--
-- Name: ferramenta_almoxarifado id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ferramenta_almoxarifado ALTER COLUMN id SET DEFAULT nextval('public.ferramenta_almoxarifado_id_seq'::regclass);


--
-- Name: ficha_tecnica_produto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ficha_tecnica_produto ALTER COLUMN id SET DEFAULT nextval('public.ficha_tecnica_produto_id_seq'::regclass);


--
-- Name: fornecedor id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor ALTER COLUMN id SET DEFAULT nextval('public.fornecedor_id_seq'::regclass);


--
-- Name: foto_execucao_os id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.foto_execucao_os ALTER COLUMN id SET DEFAULT nextval('public.foto_execucao_os_id_seq'::regclass);


--
-- Name: foto_os id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.foto_os ALTER COLUMN id SET DEFAULT nextval('public.foto_os_id_seq'::regclass);


--
-- Name: funcao id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcao ALTER COLUMN id SET DEFAULT nextval('public.funcao_id_seq'::regclass);


--
-- Name: homologacao_os id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.homologacao_os ALTER COLUMN id SET DEFAULT nextval('public.homologacao_os_id_seq'::regclass);


--
-- Name: marca_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.marca_equipamento ALTER COLUMN id SET DEFAULT nextval('public.marca_equipamento_id_seq'::regclass);


--
-- Name: modelo_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.modelo_equipamento ALTER COLUMN id SET DEFAULT nextval('public.modelo_equipamento_id_seq'::regclass);


--
-- Name: norma id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.norma ALTER COLUMN id SET DEFAULT nextval('public.norma_id_seq'::regclass);


--
-- Name: orcamento_produto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto ALTER COLUMN id SET DEFAULT nextval('public.orcamento_produto_id_seq'::regclass);


--
-- Name: ordem_compra_produto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto ALTER COLUMN id SET DEFAULT nextval('public.ordem_compra_produto_id_seq'::regclass);


--
-- Name: ordem_servico id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico ALTER COLUMN id SET DEFAULT nextval('public.ordem_servico_id_seq'::regclass);


--
-- Name: posicao_tecnico id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posicao_tecnico ALTER COLUMN id SET DEFAULT nextval('public.posicao_tecnico_id_seq'::regclass);


--
-- Name: produto_estoque id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_estoque ALTER COLUMN id SET DEFAULT nextval('public.produto_estoque_id_seq'::regclass);


--
-- Name: produto_saida id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_saida ALTER COLUMN id SET DEFAULT nextval('public.produto_saida_id_seq'::regclass);


--
-- Name: produto_solicitacao id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_solicitacao ALTER COLUMN id SET DEFAULT nextval('public.produto_solicitacao_id_seq'::regclass);


--
-- Name: propriedade_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.propriedade_equipamento ALTER COLUMN id SET DEFAULT nextval('public.propriedade_equipamento_id_seq'::regclass);


--
-- Name: relatorio_execucao_de_procedimento_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_execucao_de_procedimento_equipamento ALTER COLUMN id SET DEFAULT nextval('public.relatorio_execucao_de_procedimento_equipamento_id_seq'::regclass);


--
-- Name: relatorio_ordem_servico id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_ordem_servico ALTER COLUMN id SET DEFAULT nextval('public.relatorio_ordem_servico_id_seq'::regclass);


--
-- Name: requisicao_produto id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto ALTER COLUMN id SET DEFAULT nextval('public.requisicao_produto_id_seq'::regclass);


--
-- Name: responsavel_cliente id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.responsavel_cliente ALTER COLUMN id SET DEFAULT nextval('public.responsavel_cliente_id_seq'::regclass);


--
-- Name: revisions id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.revisions ALTER COLUMN id SET DEFAULT nextval('public.revisions_id_seq'::regclass);


--
-- Name: telefone id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.telefone ALTER COLUMN id SET DEFAULT nextval('public.telefone_id_seq'::regclass);


--
-- Name: tempo_ocioso_tecnico id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tempo_ocioso_tecnico ALTER COLUMN id SET DEFAULT nextval('public.tempo_ocioso_tecnico_id_seq'::regclass);


--
-- Name: tipo_documento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_documento ALTER COLUMN id SET DEFAULT nextval('public.tipo_documento_id_seq'::regclass);


--
-- Name: tipo_endereco id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_endereco ALTER COLUMN id SET DEFAULT nextval('public.tipo_endereco_id_seq'::regclass);


--
-- Name: tipo_negocio id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_negocio ALTER COLUMN id SET DEFAULT nextval('public.tipo_negocio_id_seq'::regclass);


--
-- Name: tipo_telefone id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_telefone ALTER COLUMN id SET DEFAULT nextval('public.tipo_telefone_id_seq'::regclass);


--
-- Name: titulo_agendamento_manutencao_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_agendamento_manutencao_equipamento ALTER COLUMN id SET DEFAULT nextval('public.titulo_agendamento_manutencao_equipamento_id_seq'::regclass);


--
-- Name: titulo_propriedade_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_propriedade_equipamento ALTER COLUMN id SET DEFAULT nextval('public.titulo_propriedade_equipamento_id_seq'::regclass);


--
-- Name: titulo_valor_propriedade_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_valor_propriedade_equipamento ALTER COLUMN id SET DEFAULT nextval('public.titulo_valor_propriedade_equipamento_id_seq'::regclass);


--
-- Name: usuario_cliente id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_cliente ALTER COLUMN id SET DEFAULT nextval('public.usuario_cliente_id_seq'::regclass);


--
-- Name: valor_propriedade_equipamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.valor_propriedade_equipamento ALTER COLUMN id SET DEFAULT nextval('public.valor_propriedade_equipamento_id_seq'::regclass);