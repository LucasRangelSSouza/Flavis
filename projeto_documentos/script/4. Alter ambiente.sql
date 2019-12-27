--
--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ambiente ADD localizacao_id integer;
ALTER TABLE public.ambiente ADD sigla character varying(5) COLLATE pg_catalog."default" DEFAULT NULL::character varying;
ALTER TABLE public.ambiente ADD colaborador_id integer;
ALTER TABLE public.ambiente ADD observacao text NULL;


--
-- Name: idx_ambiente_fos_user_user; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_ambiente_fos_user_user ON public.ambiente USING btree (localizacao_id);


--
-- Name: idx_ambiente_grupo_usuario; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_ambiente_grupo_usuario ON public.ambiente USING btree (colaborador_id);


--
-- Name: ambiente fk_ambiente_localizacao; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- 

ALTER TABLE public.ambiente
    ADD CONSTRAINT fk_ambiente_localizacao FOREIGN KEY (localizacao_id)
    REFERENCES public.localizacao (id);


--
-- Name: ambiente fk_ambiente_colaborador; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- 

ALTER TABLE public.ambiente
    ADD CONSTRAINT fk_ambiente_colaborador FOREIGN KEY (colaborador_id)
    REFERENCES public.colaborador (id);