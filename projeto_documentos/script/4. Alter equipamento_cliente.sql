--
--
-- Name: equipamento_cliente; Type: TABLE; Schema: public; Owner: -
--

--ALTER TABLE public.equipamento_cliente ADD localizacao_id integer;
ALTER TABLE public.equipamento_cliente ADD ambiente_id integer;


--
-- Name: idx_equipamento_cliente_localizacao; Type: INDEX; Schema: public; Owner: -
--
--CREATE INDEX idx_equipamento_cliente_localizacao ON public.equipamento_cliente USING btree (localizacao_id);


--
-- Name: idx_equipamento_cliente_ambie1nte; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_equipamento_cliente_ambiente ON public.equipamento_cliente USING btree (ambiente_id);


--
-- Name: ambiente fk_ambiente_localizacao; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- 

--ALTER TABLE public.equipamento_cliente
--    ADD CONSTRAINT fk_equipamento_cliente_localizacao FOREIGN KEY (localizacao_id)
--    REFERENCES public.localizacao (id);


--
-- Name: ambiente fk_ambiente_colaborador; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- 

ALTER TABLE public.equipamento_cliente
    ADD CONSTRAINT fk_equipamento_cliente_ambiente FOREIGN KEY (ambiente_id)
    REFERENCES public.ambiente (id);
