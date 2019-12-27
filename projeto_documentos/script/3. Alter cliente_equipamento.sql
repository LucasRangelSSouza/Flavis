--
--
-- Name: cliente_equipamento; Type: TABLE; Schema: public; Owner: -
--


ALTER TABLE public.cliente_equipamento ADD prioridade character varying(50);
ALTER TABLE public.cliente_equipamento ADD tempo_os integer NULL;
ALTER TABLE public.cliente_equipamento ADD unidade_tempo character varying(10) COLLATE pg_catalog."default" DEFAULT NULL::character varying;


