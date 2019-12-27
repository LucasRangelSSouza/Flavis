--
--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ambiente ADD habilitado boolean DEFAULT false;
ALTER TABLE public.localizacao ADD habilitado boolean DEFAULT false;
ALTER TABLE public.grupo_equipamento ADD habilitado boolean DEFAULT false;
ALTER TABLE public.equipamento_cliente ADD inativado boolean DEFAULT false;
ALTER TABLE public.equipamento_cliente ADD justificativa text COLLATE pg_catalog."default";
