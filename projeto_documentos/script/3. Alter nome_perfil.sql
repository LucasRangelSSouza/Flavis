

--
--
-- Name: bairro; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.bairro ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_bairro_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_bairro_nome_perfil ON public.bairro USING btree (nome_perfil);


--
-- Name: bairro fk_bairro_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bairro
    ADD CONSTRAINT fk_bairro_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: bairro fk_bairro_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.bairro SET nome_perfil = 'flavis';


--
-- Name: bairro; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.bairro ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: cidade; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.cidade ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_cidade_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_cidade_nome_perfil ON public.cidade USING btree (nome_perfil);


--
-- Name: cidade fk_cidade_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cidade
    ADD CONSTRAINT fk_cidade_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: cidade fk_cidade_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.cidade SET nome_perfil = 'flavis';


--
-- Name: cidade; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.cidade ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: funcao; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.funcao ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_funcao_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_funcao_nome_perfil ON public.funcao USING btree (nome_perfil);


--
-- Name: funcao fk_funcao_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcao
    ADD CONSTRAINT fk_funcao_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: funcao fk_funcao_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.funcao SET nome_perfil = 'flavis';


--
-- Name: funcao; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.funcao ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.propriedade_equipamento ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_propriedade_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_propriedade_equipamento_nome_perfil ON public.propriedade_equipamento USING btree (nome_perfil);


--
-- Name: propriedade_equipamento fk_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.propriedade_equipamento
    ADD CONSTRAINT fk_propriedade_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: propriedade_equipamento fk_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.propriedade_equipamento SET nome_perfil = 'flavis';


--
-- Name: propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.propriedade_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: titulo_agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.titulo_agendamento_manutencao_equipamento ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_titulo_agendamento_manutencao_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_titulo_agendamento_manutencao_equipamento_nome_perfil ON public.titulo_agendamento_manutencao_equipamento USING btree (nome_perfil);


--
-- Name: titulo_agendamento_manutencao_equipamento fk_titulo_agendamento_manutencao_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_titulo_agendamento_manutencao_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: titulo_agendamento_manutencao_equipamento fk_titulo_agendamento_manutencao_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.titulo_agendamento_manutencao_equipamento SET nome_perfil = 'flavis';


--
-- Name: titulo_agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.titulo_agendamento_manutencao_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: tipo_telefone; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.tipo_telefone ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_tipo_telefone_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_tipo_telefone_nome_perfil ON public.tipo_telefone USING btree (nome_perfil);


--
-- Name: tipo_telefone fk_tipo_telefone_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_telefone
    ADD CONSTRAINT fk_tipo_telefone_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: tipo_telefone fk_tipo_telefone_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.tipo_telefone SET nome_perfil = 'flavis';


--
-- Name: tipo_telefone; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.tipo_telefone ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: titulo_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.titulo_propriedade_equipamento ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_titulo_propriedade_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_titulo_propriedade_equipamento_nome_perfil ON public.titulo_propriedade_equipamento USING btree (nome_perfil);


--
-- Name: titulo_propriedade_equipamento fk_titulo_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_propriedade_equipamento
    ADD CONSTRAINT fk_titulo_propriedade_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: titulo_propriedade_equipamento fk_titulo_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.titulo_propriedade_equipamento SET nome_perfil = 'flavis';


--
-- Name: titulo_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.titulo_propriedade_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: titulo_valor_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.titulo_valor_propriedade_equipamento ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_titulo_valor_propriedade_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_titulo_valor_propriedade_equipamento_nome_perfil ON public.titulo_valor_propriedade_equipamento USING btree (nome_perfil);


--
-- Name: titulo_valor_propriedade_equipamento fk_titulo_valor_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_valor_propriedade_equipamento
    ADD CONSTRAINT fk_titulo_valor_propriedade_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: titulo_valor_propriedade_equipamento fk_titulo_valor_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.titulo_valor_propriedade_equipamento SET nome_perfil = 'flavis';


--
-- Name: titulo_valor_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.titulo_valor_propriedade_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************



--
--
-- Name: unidade_federativa; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.unidade_federativa ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_unidade_federativa_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_unidade_federativa_nome_perfil ON public.unidade_federativa USING btree (nome_perfil);


--
-- Name: unidade_federativa fk_unidade_federativa_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.unidade_federativa
    ADD CONSTRAINT fk_unidade_federativa_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: unidade_federativa fk_unidade_federativa_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.unidade_federativa SET nome_perfil = 'flavis';


--
-- Name: unidade_federativa; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.unidade_federativa ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************



--
--
-- Name: valor_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.valor_propriedade_equipamento ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_valor_propriedade_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_valor_propriedade_equipamento_nome_perfil ON public.valor_propriedade_equipamento USING btree (nome_perfil);


--
-- Name: valor_propriedade_equipamento fk_valor_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.valor_propriedade_equipamento
    ADD CONSTRAINT fk_valor_propriedade_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: valor_propriedade_equipamento fk_valor_propriedade_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.valor_propriedade_equipamento SET nome_perfil = 'flavis';


--
-- Name: valor_propriedade_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.valor_propriedade_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: tipo_negocio; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.tipo_negocio ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_tipo_negocio_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_tipo_negocio_nome_perfil ON public.tipo_negocio USING btree (nome_perfil);


--
-- Name: tipo_negocio fk_tipo_negocio_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_negocio
    ADD CONSTRAINT fk_tipo_negocio_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: tipo_negocio fk_tipo_negocio_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.tipo_negocio SET nome_perfil = 'flavis';


--
-- Name: tipo_negocio; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.tipo_negocio ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: tipo_endereco; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.tipo_endereco ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_tipo_endereco_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_tipo_endereco_nome_perfil ON public.tipo_endereco USING btree (nome_perfil);


--
-- Name: tipo_endereco fk_tipo_endereco_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_endereco
    ADD CONSTRAINT fk_tipo_endereco_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: tipo_endereco fk_tipo_endereco_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.tipo_endereco SET nome_perfil = 'flavis';


--
-- Name: tipo_negocio; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.tipo_endereco ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: tipo_documento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.tipo_documento ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_tipo_documento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_tipo_documento_nome_perfil ON public.tipo_documento USING btree (nome_perfil);


--
-- Name: tipo_documento fk_tipo_documento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_documento
    ADD CONSTRAINT fk_tipo_documento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: tipo_documento fk_tipo_documento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.tipo_documento SET nome_perfil = 'flavis';


--
-- Name: tipo_documento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.tipo_documento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: homologacao_os; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.homologacao_os ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_homologacao_os_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_homologacao_os_nome_perfil ON public.homologacao_os USING btree (nome_perfil);


--
-- Name: homologacao_os fk_homologacao_os_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.homologacao_os
    ADD CONSTRAINT fk_homologacao_os_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: homologacao_os fk_homologacao_os_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.homologacao_os SET nome_perfil = 'flavis';


--
-- Name: homologacao_os; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.homologacao_os ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: filial_empresa; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.filial_empresa ADD nome_perfil character varying(155) NULL;


--
-- Name: idx_filial_empresa_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_filial_empresa_nome_perfil ON public.filial_empresa USING btree (nome_perfil);


--
-- Name: filial_empresa fk_filial_empresa_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.filial_empresa
    ADD CONSTRAINT fk_filial_empresa_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: filial_empresa fk_filial_empresa_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.filial_empresa SET nome_perfil = 'flavis';


--
-- Name: filial_empresa; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.filial_empresa ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: colaborador; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.colaborador ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_colaborador_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_colaborador_nome_perfil ON public.colaborador USING btree (nome_perfil);


--
-- Name: colaborador fk_colaborador_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador
    ADD CONSTRAINT fk_colaborador_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: colaborador fk_colaborador_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.colaborador SET nome_perfil = 'flavis';


--
-- Name: colaborador; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.colaborador ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: fornecedor; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.fornecedor ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_fornecedor_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_fornecedor_nome_perfil ON public.fornecedor USING btree (nome_perfil);


--
-- Name: fornecedor fk_fornecedor_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor
    ADD CONSTRAINT fk_fornecedor_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: fornecedor fk_fornecedor_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.fornecedor SET nome_perfil = 'flavis';


--
-- Name: fornecedor; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.fornecedor ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.cliente ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_cliente_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_cliente_nome_perfil ON public.cliente USING btree (nome_perfil);


--
-- Name: cliente fk_cliente_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT fk_cliente_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: cliente fk_cliente_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.cliente SET nome_perfil = 'flavis';


--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.cliente ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: responsavel_cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.responsavel_cliente ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_responsavel_cliente_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_responsavel_cliente_nome_perfil ON public.responsavel_cliente USING btree (nome_perfil);


--
-- Name: responsavel_cliente fk_responsavel_cliente_nome_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.responsavel_cliente
    ADD CONSTRAINT fk_responsavel_cliente_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: responsavel_cliente fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.responsavel_cliente SET nome_perfil = 'flavis';


--
-- Name: responsavel_cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.responsavel_cliente ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: cliente_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.cliente_equipamento ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_cliente_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_cliente_equipamento_nome_perfil ON public.cliente_equipamento USING btree (nome_perfil);


--
-- Name: cliente_equipamento fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento
    ADD CONSTRAINT fk_cliente_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: cliente_equipamento fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.cliente_equipamento SET nome_perfil = 'flavis';


--
-- Name: cliente_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.cliente_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: equipamento_cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.equipamento_cliente ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_equipamento_cliente_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_equipamento_cliente_nome_perfil ON public.equipamento_cliente USING btree (nome_perfil);


--
-- Name: equipamento_cliente fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente
    ADD CONSTRAINT fk_equipamento_cliente_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: equipamento_cliente fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.equipamento_cliente SET nome_perfil = 'flavis';


--
-- Name: equipamento_cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.equipamento_cliente ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: marca_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.marca_equipamento ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_marca_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_marca_equipamento_nome_perfil ON public.marca_equipamento USING btree (nome_perfil);


--
-- Name: marca_equipamento fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.marca_equipamento
    ADD CONSTRAINT fk_marca_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: marca_equipamento fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.marca_equipamento SET nome_perfil = 'flavis';


--
-- Name: marca_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.marca_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: modelo_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.modelo_equipamento ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_modelo_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_modelo_equipamento_nome_perfil ON public.modelo_equipamento USING btree (nome_perfil);


--
-- Name: modelo_equipamento fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.modelo_equipamento
    ADD CONSTRAINT fk_modelo_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: modelo_equipamento fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.modelo_equipamento SET nome_perfil = 'flavis';


--
-- Name: modelo_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.modelo_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: usuario_cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.usuario_cliente ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_usuario_cliente_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_usuario_cliente_nome_perfil ON public.usuario_cliente USING btree (nome_perfil);


--
-- Name: usuario_cliente fk_usuario_cliente_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_cliente
    ADD CONSTRAINT fk_usuario_cliente_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: usuario_cliente fk_usuario_cliente_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.usuario_cliente SET nome_perfil = 'flavis';


--
-- Name: usuario_cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.usuario_cliente ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: usuario_cliente_cliente; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.usuario_cliente_cliente ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_usuario_cliente_cliente_perfil; Type: INDEX; Schema: public; Owner: -
--

---CREATE INDEX idx_usuario_cliente_cliente_nome_perfil ON public.usuario_cliente_cliente USING btree (nome_perfil);


--
-- Name: usuario_cliente_cliente fk_usuario_cliente_cliente_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.usuario_cliente_cliente
--    ADD CONSTRAINT fk_usuario_cliente_cliente_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: usuario_cliente_cliente fk_usuario_cliente_cliente_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.usuario_cliente_cliente SET nome_perfil = 'flavis';


--
-- Name: usuario_cliente_cliente; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.usuario_cliente_cliente ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: produto_estoque; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.produto_estoque ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_produto_estoque_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_produto_estoque_nome_perfil ON public.produto_estoque USING btree (nome_perfil);


--
-- Name: produto_estoque fk_produto_estoque_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_estoque
    ADD CONSTRAINT fk_produto_estoque_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: produto_estoque fk_produto_estoque_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.produto_estoque SET nome_perfil = 'flavis';


--
-- Name: produto_estoque; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.produto_estoque ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: produto_almoxarifado; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.produto_almoxarifado ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_produto_almoxarifado_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_produto_almoxarifado_nome_perfil ON public.produto_almoxarifado USING btree (nome_perfil);


--
-- Name: produto_almoxarifado fk_produto_almoxarifado_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_almoxarifado
    ADD CONSTRAINT fk_produto_almoxarifado_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: produto_almoxarifado fk_produto_almoxarifado_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.produto_almoxarifado SET nome_perfil = 'flavis';


--
-- Name: produto_almoxarifado; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.produto_almoxarifado ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: ferramenta_almoxarifado; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ferramenta_almoxarifado ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_ferramenta_almoxarifado_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ferramenta_almoxarifado_nome_perfil ON public.ferramenta_almoxarifado USING btree (nome_perfil);


--
-- Name: ferramenta_almoxarifado fk_ferramenta_almoxarifado_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ferramenta_almoxarifado
    ADD CONSTRAINT fk_ferramenta_almoxarifado_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: ferramenta_almoxarifado fk_ferramenta_almoxarifado_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.ferramenta_almoxarifado SET nome_perfil = 'flavis';


--
-- Name: ferramenta_almoxarifado; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ferramenta_almoxarifado ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************

	
--******************************************************************************************************


--
--
-- Name: entrada_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.entrada_produto ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_entrada_produto_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_entrada_produto_nome_perfil ON public.entrada_produto USING btree (nome_perfil);


--
-- Name: entrada_produto fk_entrada_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto
    ADD CONSTRAINT fk_entrada_produto_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: entrada_produto fk_entrada_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.entrada_produto SET nome_perfil = 'flavis';


--
-- Name: entrada_produto; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.entrada_produto ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: requisicao_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.requisicao_produto ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_requisicao_produto_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_requisicao_produto_nome_perfil ON public.requisicao_produto USING btree (nome_perfil);


--
-- Name: requisicao_produto fk_requisicao_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto
    ADD CONSTRAINT fk_requisicao_produto_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: requisicao_produto fk_requisicao_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.requisicao_produto SET nome_perfil = 'flavis';


--
-- Name: requisicao_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.requisicao_produto ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: orcamento_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.orcamento_produto ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_orcamento_produto_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_orcamento_produto_nome_perfil ON public.orcamento_produto USING btree (nome_perfil);


--
-- Name: orcamento_produto fk_orcamento_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto
    ADD CONSTRAINT fk_orcamento_produto_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: orcamento_produto fk_orcamento_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.orcamento_produto SET nome_perfil = 'flavis';


--
-- Name: orcamento_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.orcamento_produto ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: orcamento_produto_produto_solicitacao; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.orcamento_produto_produto_solicitacao ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_orcamento_produto_produto_solicitacao_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_orcamento_produto_produto_solicitacao_nome_perfil ON public.orcamento_produto_produto_solicitacao USING btree (nome_perfil);


--
-- Name: orcamento_produto_produto_solicitacao fk_orcamento_produto_produto_solicitacao_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.orcamento_produto_produto_solicitacao
--    ADD CONSTRAINT fk_orcamento_produto_produto_solicitacao_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: orcamento_produto_produto_solicitacao fk_orcamento_produto_produto_solicitacao_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.orcamento_produto_produto_solicitacao SET nome_perfil = 'flavis';


--
-- Name: orcamento_produto_produto_solicitacao; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.orcamento_produto_produto_solicitacao ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: ordem_compra_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ordem_compra_produto ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_ordem_compra_produto_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ordem_compra_produto_nome_perfil ON public.ordem_compra_produto USING btree (nome_perfil);


--
-- Name: ordem_compra_produto fk_ordem_compra_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto
    ADD CONSTRAINT fk_ordem_compra_produto_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: ordem_compra_produto fk_ordem_compra_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.ordem_compra_produto SET nome_perfil = 'flavis';


--
-- Name: ordem_compra_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ordem_compra_produto ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: ordem_compra_produto_produto_saida; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.ordem_compra_produto_produto_saida ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_ordem_compra_produto_produto_saida_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_ordem_compra_produto_produto_saida_nome_perfil ON public.ordem_compra_produto_produto_saida USING btree (nome_perfil);


--
-- Name: ordem_compra_produto_produto_saida fk_ordem_compra_produto_produto_saida_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.ordem_compra_produto_produto_saida
--    ADD CONSTRAINT fk_ordem_compra_produto_produto_saida_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: ordem_compra_produto_produto_saida fk_ordem_compra_produto_produto_saida_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.ordem_compra_produto_produto_saida SET nome_perfil = 'flavis';


--
-- Name: ordem_compra_produto_produto_saida; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.ordem_compra_produto_produto_saida ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: ordem_servico; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ordem_servico ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_ordem_servico_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ordem_servico_nome_perfil ON public.ordem_servico USING btree (nome_perfil);


--
-- Name: ordem_servico fk_ordem_servico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_ordem_servico_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: ordem_servico fk_ordem_servico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.ordem_servico SET nome_perfil = 'flavis';


--
-- Name: ordem_servico; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ordem_servico ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: foto_os; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.foto_os ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_foto_os_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_foto_os_nome_perfil ON public.foto_os USING btree (nome_perfil);


--
-- Name: foto_os fk_foto_os_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.foto_os
    ADD CONSTRAINT fk_foto_os_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: foto_os fk_foto_os_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.foto_os SET nome_perfil = 'flavis';


--
-- Name: foto_os; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.foto_os ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: relatorio_execucao_de_procedimento_equipamento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.relatorio_execucao_de_procedimento_equipamento ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_relatorio_execucao_de_procedimento_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_relatorio_execucao_de_procedimento_equipamento_nome_perfil ON public.relatorio_execucao_de_procedimento_equipamento USING btree (nome_perfil);


--
-- Name: relatorio_execucao_de_procedimento_equipamento fk_relatorio_execucao_de_procedimento_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.relatorio_execucao_de_procedimento_equipamento
--    ADD CONSTRAINT fk_relatorio_execucao_de_procedimento_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: relatorio_execucao_de_procedimento_equipamento fk_relatorio_execucao_de_procedimento_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.relatorio_execucao_de_procedimento_equipamento SET nome_perfil = 'flavis';


--
-- Name: relatorio_execucao_de_procedimento_equipamento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.relatorio_execucao_de_procedimento_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: relatorio_ordem_servico; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.relatorio_ordem_servico ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_relatorio_ordem_servico_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_relatorio_ordem_servico_nome_perfil ON public.relatorio_ordem_servico USING btree (nome_perfil);


--
-- Name: relatorio_ordem_servico fk_relatorio_ordem_servico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.relatorio_ordem_servico
--    ADD CONSTRAINT fk_relatorio_ordem_servico_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: relatorio_ordem_servico fk_relatorio_ordem_servico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.relatorio_ordem_servico SET nome_perfil = 'flavis';


--
-- Name: relatorio_ordem_servico; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.relatorio_ordem_servico ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: relatorio_ordem_servico_foto_os; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.relatorio_ordem_servico_foto_os ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_relatorio_ordem_servico_foto_os_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_relatorio_ordem_servico_foto_os_nome_perfil ON public.relatorio_ordem_servico_foto_os USING btree (nome_perfil);


--
-- Name: relatorio_ordem_servico_foto_os fk_relatorio_ordem_servico_foto_os_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.relatorio_ordem_servico_foto_os
--    ADD CONSTRAINT fk_relatorio_ordem_servico_foto_os_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: relatorio_ordem_servico_foto_os fk_relatorio_ordem_servico_foto_os_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.relatorio_ordem_servico_foto_os SET nome_perfil = 'flavis';


--
-- Name: relatorio_ordem_servico_foto_os; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.relatorio_ordem_servico_foto_os ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: norma; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.norma ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_norma_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_norma_nome_perfil ON public.norma USING btree (nome_perfil);


--
-- Name: norma fk_norma_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.norma
    ADD CONSTRAINT fk_norma_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: norma fk_norma_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.norma SET nome_perfil = 'flavis';


--
-- Name: norma; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.norma ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: ficha_tecnica_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ficha_tecnica_produto ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_ficha_tecnica_produto_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ficha_tecnica_produto_nome_perfil ON public.ficha_tecnica_produto USING btree (nome_perfil);


--
-- Name: ficha_tecnica_produto fk_ficha_tecnica_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ficha_tecnica_produto
    ADD CONSTRAINT fk_ficha_tecnica_produto_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: ficha_tecnica_produto fk_ficha_tecnica_produto_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.ficha_tecnica_produto SET nome_perfil = 'flavis';


--
-- Name: ficha_tecnica_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ficha_tecnica_produto ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: fos_user_user; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.fos_user_user ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_fos_user_user_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_fos_user_user_nome_perfil ON public.fos_user_user USING btree (nome_perfil);


--
-- Name: fos_user_user fk_fos_user_user_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.fos_user_user
--    ADD CONSTRAINT fk_fos_user_user_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: fos_user_user fk_fos_user_user_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.fos_user_user SET nome_perfil = 'flavis';


--
-- Name: fos_user_user; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.fos_user_user ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.fos_user_group ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_fos_user_group_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_fos_user_group_nome_perfil ON public.fos_user_group USING btree (nome_perfil);


--
-- Name: fos_user_group fk_fos_user_group_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.fos_user_group
--    ADD CONSTRAINT fk_fos_user_group_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: fos_user_group fk_fos_user_group_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.fos_user_group SET nome_perfil = 'flavis';


--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.fos_user_group ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: agendamento_ordem_servico; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.agendamento_ordem_servico ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_agendamento_ordem_servico_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_agendamento_ordem_servico_nome_perfil ON public.agendamento_ordem_servico USING btree (nome_perfil);


--
-- Name: agendamento_ordem_servico fk_agendamento_ordem_servico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_ordem_servico
    ADD CONSTRAINT fk_agendamento_ordem_servico_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: agendamento_ordem_servico fk_agendamento_ordem_servico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.agendamento_ordem_servico SET nome_perfil = 'flavis';


--
-- Name: agendamento_ordem_servico; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.agendamento_ordem_servico ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.agendamento_manutencao_equipamento ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_agendamento_manutencao_equipamento_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_agendamento_manutencao_equipamento_nome_perfil ON public.agendamento_manutencao_equipamento USING btree (nome_perfil);


--
-- Name: agendamento_manutencao_equipamento fk_agendamento_manutencao_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_agendamento_manutencao_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: agendamento_manutencao_equipamento fk_agendamento_manutencao_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.agendamento_manutencao_equipamento SET nome_perfil = 'flavis';


--
-- Name: agendamento_manutencao_equipamento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.agendamento_manutencao_equipamento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: contato; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.contato ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_contato_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_contato_nome_perfil ON public.contato USING btree (nome_perfil);


--
-- Name: contato fk_contato_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.contato
--    ADD CONSTRAINT fk_contato_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: contato fk_contato_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.contato SET nome_perfil = 'flavis';


--
-- Name: contato; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.contato ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: documento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.documento ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_documento_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_documento_nome_perfil ON public.documento USING btree (nome_perfil);


--
-- Name: documento fk_documento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.documento
--    ADD CONSTRAINT fk_documento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: documento fk_documento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.documento SET nome_perfil = 'flavis';


--
-- Name: documento; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.documento ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: endereco; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.endereco ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_endereco_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_endereco_nome_perfil ON public.endereco USING btree (nome_perfil);


--
-- Name: endereco fk_endereco_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.endereco
--    ADD CONSTRAINT fk_endereco_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: endereco fk_endereco_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.endereco SET nome_perfil = 'flavis';


--
-- Name: endereco; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.endereco ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: telefone; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.telefone ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_telefone_perfil; Type: INDEX; Schema: public; Owner: -
--

--CREATE INDEX idx_telefone_nome_perfil ON public.telefone USING btree (nome_perfil);


--
-- Name: telefone fk_telefone_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

--ALTER TABLE ONLY public.telefone
--    ADD CONSTRAINT fk_telefone_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: telefone fk_telefone_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
--UPDATE public.telefone SET nome_perfil = 'flavis';


--
-- Name: telefone; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.telefone ALTER COLUMN nome_perfil SET NOT NULL;

	
--******************************************************************************************************


--USADO NA HORA DE LOGAR
--
-- Name: posicao_tecnico; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.posicao_tecnico ADD nome_perfil character varying(150) NULL;


--
-- Name: idx_posicao_tecnico_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_posicao_tecnico_nome_perfil ON public.posicao_tecnico USING btree (nome_perfil);


--
-- Name: posicao_tecnico fk_posicao_tecnico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posicao_tecnico
    ADD CONSTRAINT fk_posicao_tecnico_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: posicao_tecnico fk_posicao_tecnico_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.posicao_tecnico SET nome_perfil = 'flavis';


--
-- Name: posicao_tecnico; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.posicao_tecnico ALTER COLUMN nome_perfil SET NOT NULL;