--DROP TABLE public.ambiente_equipamento_cliente;

--
-- Name: ambiente_equipamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ambiente_equipamento_cliente (
    id integer NOT NULL,
    ambiente_id integer NOT NULL,
    equipamento_cliente_id integer NOT NULL
);


--
-- Name: ambiente_equipamento_cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ambiente_equipamento_cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ambiente_equipamento_cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ambiente_equipamento_cliente_id_seq OWNED BY public.ambiente_equipamento_cliente.id;


--
-- Name: ambiente_equipamento_cliente id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ambiente_equipamento_cliente ALTER COLUMN id SET DEFAULT nextval('public.ambiente_equipamento_cliente_id_seq'::regclass);


--
-- Name: ambiente_equipamento_cliente ambiente_equipamento_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ambiente_equipamento_cliente
    ADD CONSTRAINT ambiente_equipamento_cliente_pkey PRIMARY KEY (id);


--
-- Name: colaborador_filial_ambiente_equipamento_cliente colaborador_filial_ambiente_equipamento_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.ambiente_equipamento_cliente
--    ADD CONSTRAINT ambiente_equipamento_cliente_pkey PRIMARY KEY (equipamento_cliente_id, ambiente_id);


--
-- Name: idx_ambiente_equipamento_cliente_ambiente; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ambiente_equipamento_cliente_ambiente ON public.ambiente_equipamento_cliente USING btree (ambiente_id);


--
-- Name: idx_ambiente_equipamento_cliente_equipamento; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ambiente_equipamento_cliente_equipamento ON public.ambiente_equipamento_cliente USING btree (equipamento_cliente_id);


--
-- Name: ambiente_equipamento_cliente fk_ambiente_equipamento_cliente_ambiente; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ambiente_equipamento_cliente
    ADD CONSTRAINT fk_ambiente_equipamento_cliente_ambiente FOREIGN KEY (ambiente_id) REFERENCES public.ambiente(id) ON DELETE CASCADE;


--
-- Name: ambiente_equipamento_cliente fk_ambiente_equipamento_cliente_equipamento; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ambiente_equipamento_cliente
    ADD CONSTRAINT fk_ambiente_equipamento_cliente_equipamento FOREIGN KEY (equipamento_cliente_id) REFERENCES public.equipamento_cliente(id) ON DELETE CASCADE;
