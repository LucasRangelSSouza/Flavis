ALTER TABLE public.ordem_servico ADD COLUMN os_original_pai integer;


--
-- Name: idx_ordem_servico_ordem_servico; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_ordem_servico_ordem_servico ON public.ordem_servico USING btree (os_original_pai);


--
-- Name: ordem_servico fk_ordem_servico_ordem_servico; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- 

ALTER TABLE public.ordem_servico
    ADD CONSTRAINT fk_ordem_servico_ordem_servico FOREIGN KEY (os_original_pai)
    REFERENCES public.ordem_servico (id);