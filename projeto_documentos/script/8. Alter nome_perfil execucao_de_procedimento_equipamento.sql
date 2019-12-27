
--
--
-- Name: execucao_de_procedimento_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.execucao_de_procedimento_equipamento ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_execucao_de_procedimento_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_execucao_de_procedimento_equipamento_nome_perfil ON public.execucao_de_procedimento_equipamento USING btree (nome_perfil);


--
-- Name: execucao_de_procedimento_equipamento fk_execucao_de_procedimento_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento
    ADD CONSTRAINT fk_execucao_de_procedimento_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: execucao_de_procedimento_equipamento fk_execucao_de_procedimento_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.execucao_de_procedimento_equipamento SET nome_perfil = 'flavis';


--
-- Name: execucao_de_procedimento_equipamento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.execucao_de_procedimento_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************