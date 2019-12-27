ALTER TABLE public.execucao_de_procedimento_equipamento ADD COLUMN os_pai integer;

ALTER TABLE public.execucao_de_procedimento_equipamento ADD COLUMN data_execucao timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;

ALTER TABLE public.execucao_de_procedimento_equipamento ADD COLUMN status character varying(50) COLLATE pg_catalog."default" DEFAULT ''::character varying;


--
-- Name: idx_ordem_servico_ordem_servico; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_execucao_de_procedimento_equipamento_ordem_servico ON public.execucao_de_procedimento_equipamento USING btree (os_pai);


--
-- Name: execucao_de_procedimento_equipamento fk_execucao_de_procedimento_equipamento_ordem_servico; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- 

ALTER TABLE public.execucao_de_procedimento_equipamento
    ADD CONSTRAINT fk_execucao_de_procedimento_equipamento_ordem_servico FOREIGN KEY (os_pai)
    REFERENCES public.ordem_servico (id);
