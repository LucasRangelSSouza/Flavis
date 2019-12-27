--INSERT INTO public.grupo_equipamento(id, titulo, created_at, updated_at, deleted_at, nome_perfil) VALUES (1, 'GRUPO', CURRENT_DATE, null, mull, 'flavis');
	
--
--
-- Name: equipamento_cliente; Type: TABLE; Schema: public; Owner: -
--

ALTER TABLE public.equipamento_cliente ADD capacidade integer NULL;
ALTER TABLE public.equipamento_cliente ADD unidade_medida character varying(10) COLLATE pg_catalog."default" DEFAULT NULL::character varying;
ALTER TABLE public.equipamento_cliente ADD serie character varying(20) COLLATE pg_catalog."default" DEFAULT NULL::character varying;
ALTER TABLE public.equipamento_cliente ADD data_aquisicao timestamp(0) without time zone NULL;
ALTER TABLE public.equipamento_cliente ADD grupo_equipamento_id integer NULL;


--
-- Name: equipamento_cliente idx_grupo_equipamento_grupo; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_grupo_equipamento_grupo ON public.equipamento_cliente USING btree (grupo_equipamento_id);


--
-- Name: equipamento_cliente fk_grupo_equipamento_grupo; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente
    ADD CONSTRAINT fk_grupo_equipamento_grupo FOREIGN KEY (grupo_equipamento_id) REFERENCES public.grupo_equipamento(id);


--
-- Name: bairro fk_bairro_equipamento_cliente; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.equipamento_cliente SET grupo_equipamento_id = 1;


--
-- Name: bairro; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.equipamento_cliente ALTER COLUMN grupo_equipamento_id SET NOT NULL;