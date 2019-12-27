--
-- Name: acl_classes acl_classes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_classes
    ADD CONSTRAINT acl_classes_pkey PRIMARY KEY (id);


--
-- Name: acl_entries acl_entries_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_entries
    ADD CONSTRAINT acl_entries_pkey PRIMARY KEY (id);


--
-- Name: acl_object_identities acl_object_identities_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_object_identities
    ADD CONSTRAINT acl_object_identities_pkey PRIMARY KEY (id);


--
-- Name: acl_object_identity_ancestors acl_object_identity_ancestors_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_object_identity_ancestors
    ADD CONSTRAINT acl_object_identity_ancestors_pkey PRIMARY KEY (object_identity_id, ancestor_id);


--
-- Name: acl_security_identities acl_security_identities_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_security_identities
    ADD CONSTRAINT acl_security_identities_pkey PRIMARY KEY (id);


--
-- Name: agendamento_manutencao_equipamento agendamento_manutencao_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_manutencao_equipamento
    ADD CONSTRAINT agendamento_manutencao_equipamento_pkey PRIMARY KEY (id);


--
-- Name: agendamento_ordem_servico agendamento_ordem_servico_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_ordem_servico
    ADD CONSTRAINT agendamento_ordem_servico_pkey PRIMARY KEY (id);


--
-- Name: bairro bairro_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bairro
    ADD CONSTRAINT bairro_pkey PRIMARY KEY (id);


--
-- Name: cidade cidade_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cidade
    ADD CONSTRAINT cidade_pkey PRIMARY KEY (id);


--
-- Name: classification__category classification__category_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__category
    ADD CONSTRAINT classification__category_pkey PRIMARY KEY (id);


--
-- Name: classification__collection classification__collection_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__collection
    ADD CONSTRAINT classification__collection_pkey PRIMARY KEY (id);


--
-- Name: classification__context classification__context_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__context
    ADD CONSTRAINT classification__context_pkey PRIMARY KEY (id);


--
-- Name: classification__tag classification__tag_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__tag
    ADD CONSTRAINT classification__tag_pkey PRIMARY KEY (id);


--
-- Name: cliente_documento cliente_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_documento
    ADD CONSTRAINT cliente_documento_pkey PRIMARY KEY (cliente_id, documento_id);


--
-- Name: cliente_endereco cliente_endereco_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_endereco
    ADD CONSTRAINT cliente_endereco_pkey PRIMARY KEY (cliente_id, endereco_id);


--
-- Name: cliente_equipamento_agendamento_manutencao_equipamento cliente_equipamento_agendamento_manutencao_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento_agendamento_manutencao_equipamento
    ADD CONSTRAINT cliente_equipamento_agendamento_manutencao_equipamento_pkey PRIMARY KEY (cliente_equipamento_id, agendamento_manutencao_equipamento_id);


--
-- Name: cliente_equipamento cliente_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento
    ADD CONSTRAINT cliente_equipamento_pkey PRIMARY KEY (id);


--
-- Name: cliente_equipamento_propriedade_equipamento cliente_equipamento_propriedade_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento_propriedade_equipamento
    ADD CONSTRAINT cliente_equipamento_propriedade_equipamento_pkey PRIMARY KEY (cliente_equipamento_id, propriedade_equipamento_id);


--
-- Name: cliente cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id);


--
-- Name: cliente_responsavel_cliente cliente_responsavel_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_responsavel_cliente
    ADD CONSTRAINT cliente_responsavel_cliente_pkey PRIMARY KEY (cliente_id, responsavel_cliente_id);


--
-- Name: cliente_telefone cliente_telefone_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_telefone
    ADD CONSTRAINT cliente_telefone_pkey PRIMARY KEY (cliente_id, telefone_id);


--
-- Name: colaborador_documento colaborador_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_documento
    ADD CONSTRAINT colaborador_documento_pkey PRIMARY KEY (colaborador_id, documento_id);


--
-- Name: colaborador_endereco colaborador_endereco_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_endereco
    ADD CONSTRAINT colaborador_endereco_pkey PRIMARY KEY (colaborador_id, endereco_id);


--
-- Name: colaborador_filial_empresa colaborador_filial_empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_filial_empresa
    ADD CONSTRAINT colaborador_filial_empresa_pkey PRIMARY KEY (colaborador_id, filial_empresa_id);


--
-- Name: colaborador colaborador_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador
    ADD CONSTRAINT colaborador_pkey PRIMARY KEY (id);


--
-- Name: colaborador_telefone colaborador_telefone_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_telefone
    ADD CONSTRAINT colaborador_telefone_pkey PRIMARY KEY (colaborador_id, telefone_id);


--
-- Name: contato contato_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contato
    ADD CONSTRAINT contato_pkey PRIMARY KEY (id);


--
-- Name: contato_telefone contato_telefone_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contato_telefone
    ADD CONSTRAINT contato_telefone_pkey PRIMARY KEY (contato_id, telefone_id);


--
-- Name: documento documento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.documento
    ADD CONSTRAINT documento_pkey PRIMARY KEY (id);


--
-- Name: endereco endereco_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT endereco_pkey PRIMARY KEY (id);


--
-- Name: entrada_produto entrada_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto
    ADD CONSTRAINT entrada_produto_pkey PRIMARY KEY (id);


--
-- Name: entrada_produto_produto_saida entrada_produto_produto_saida_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto_produto_saida
    ADD CONSTRAINT entrada_produto_produto_saida_pkey PRIMARY KEY (entrada_produto_id, produto_saida_id);


--
-- Name: equipamento_cliente_agendamento_manutencao_equipamento equipamento_cliente_agendamento_manutencao_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente_agendamento_manutencao_equipamento
    ADD CONSTRAINT equipamento_cliente_agendamento_manutencao_equipamento_pkey PRIMARY KEY (equipamento_cliente_id, agendamento_manutencao_equipamento_id);


--
-- Name: equipamento_cliente equipamento_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente
    ADD CONSTRAINT equipamento_cliente_pkey PRIMARY KEY (id);


--
-- Name: execucao_de_procedimento_equipamento_foto_execucao_os execucao_de_procedimento_equipamento_foto_execucao_os_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento_foto_execucao_os
    ADD CONSTRAINT execucao_de_procedimento_equipamento_foto_execucao_os_pkey PRIMARY KEY (execucao_de_procedimento_equipamento_id, foto_execucao_os_id);


--
-- Name: execucao_de_procedimento_equipamento execucao_de_procedimento_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento
    ADD CONSTRAINT execucao_de_procedimento_equipamento_pkey PRIMARY KEY (id);


--
-- Name: ferramenta_almoxarifado_documento ferramenta_almoxarifado_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ferramenta_almoxarifado_documento
    ADD CONSTRAINT ferramenta_almoxarifado_documento_pkey PRIMARY KEY (ferramenta_almoxarifado_id, documento_id);


--
-- Name: ferramenta_almoxarifado ferramenta_almoxarifado_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ferramenta_almoxarifado
    ADD CONSTRAINT ferramenta_almoxarifado_pkey PRIMARY KEY (id);


--
-- Name: ficha_tecnica_produto ficha_tecnica_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ficha_tecnica_produto
    ADD CONSTRAINT ficha_tecnica_produto_pkey PRIMARY KEY (id);


--
-- Name: filial_empresa filial_empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.filial_empresa
    ADD CONSTRAINT filial_empresa_pkey PRIMARY KEY (id);


--
-- Name: filial_empresa_unidade_federativa filial_empresa_unidade_federativa_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.filial_empresa_unidade_federativa
    ADD CONSTRAINT filial_empresa_unidade_federativa_pkey PRIMARY KEY (filial_empresa_id, unidade_federativa_id);


--
-- Name: fornecedor_documento fornecedor_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor_documento
    ADD CONSTRAINT fornecedor_documento_pkey PRIMARY KEY (fornecedor_id, documento_id);


--
-- Name: fornecedor_endereco fornecedor_endereco_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor_endereco
    ADD CONSTRAINT fornecedor_endereco_pkey PRIMARY KEY (fornecedor_id, endereco_id);


--
-- Name: fornecedor fornecedor_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor
    ADD CONSTRAINT fornecedor_pkey PRIMARY KEY (id);


--
-- Name: fos_user_group fos_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fos_user_group
    ADD CONSTRAINT fos_user_group_pkey PRIMARY KEY (id);


--
-- Name: fos_user_user_group fos_user_user_group_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fos_user_user_group
    ADD CONSTRAINT fos_user_user_group_pkey PRIMARY KEY (user_id, group_id);


--
-- Name: fos_user_user fos_user_user_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fos_user_user
    ADD CONSTRAINT fos_user_user_pkey PRIMARY KEY (id);


--
-- Name: foto_execucao_os foto_execucao_os_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.foto_execucao_os
    ADD CONSTRAINT foto_execucao_os_pkey PRIMARY KEY (id);


--
-- Name: foto_os foto_os_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.foto_os
    ADD CONSTRAINT foto_os_pkey PRIMARY KEY (id);


--
-- Name: funcao funcao_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcao
    ADD CONSTRAINT funcao_pkey PRIMARY KEY (id);


--
-- Name: homologacao_os homologacao_os_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.homologacao_os
    ADD CONSTRAINT homologacao_os_pkey PRIMARY KEY (id);


--
-- Name: marca_equipamento marca_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.marca_equipamento
    ADD CONSTRAINT marca_equipamento_pkey PRIMARY KEY (id);


--
-- Name: media__gallery_media media__gallery_media_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media__gallery_media
    ADD CONSTRAINT media__gallery_media_pkey PRIMARY KEY (id);


--
-- Name: media__gallery media__gallery_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media__gallery
    ADD CONSTRAINT media__gallery_pkey PRIMARY KEY (id);


--
-- Name: media__media media__media_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media__media
    ADD CONSTRAINT media__media_pkey PRIMARY KEY (id);


--
-- Name: migration_versions migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migration_versions
    ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);


--
-- Name: modelo_equipamento modelo_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.modelo_equipamento
    ADD CONSTRAINT modelo_equipamento_pkey PRIMARY KEY (id);


--
-- Name: norma norma_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.norma
    ADD CONSTRAINT norma_pkey PRIMARY KEY (id);


--
-- Name: orcamento_produto orcamento_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto
    ADD CONSTRAINT orcamento_produto_pkey PRIMARY KEY (id);


--
-- Name: orcamento_produto_produto_solicitacao orcamento_produto_produto_solicitacao_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto_produto_solicitacao
    ADD CONSTRAINT orcamento_produto_produto_solicitacao_pkey PRIMARY KEY (orcamento_produto_id, produto_solicitacao_id);


--
-- Name: ordem_compra_produto ordem_compra_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto
    ADD CONSTRAINT ordem_compra_produto_pkey PRIMARY KEY (id);


--
-- Name: ordem_compra_produto_produto_saida ordem_compra_produto_produto_saida_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto_produto_saida
    ADD CONSTRAINT ordem_compra_produto_produto_saida_pkey PRIMARY KEY (ordem_compra_produto_id, produto_saida_id);


--
-- Name: ordem_servico_colaborador ordem_servico_colaborador_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_colaborador
    ADD CONSTRAINT ordem_servico_colaborador_pkey PRIMARY KEY (ordem_servico_id, colaborador_id);


--
-- Name: ordem_servico_ficha_tecnica_produto ordem_servico_ficha_tecnica_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_ficha_tecnica_produto
    ADD CONSTRAINT ordem_servico_ficha_tecnica_produto_pkey PRIMARY KEY (ordem_servico_id, ficha_tecnica_produto_id);


--
-- Name: ordem_servico_foto_os ordem_servico_foto_os_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_foto_os
    ADD CONSTRAINT ordem_servico_foto_os_pkey PRIMARY KEY (ordem_servico_id, foto_os_id);


--
-- Name: ordem_servico ordem_servico_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT ordem_servico_pkey PRIMARY KEY (id);


--
-- Name: posicao_tecnico posicao_tecnico_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posicao_tecnico
    ADD CONSTRAINT posicao_tecnico_pkey PRIMARY KEY (id);


--
-- Name: produto_almoxarifado_documento produto_almoxarifado_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_almoxarifado_documento
    ADD CONSTRAINT produto_almoxarifado_documento_pkey PRIMARY KEY (produto_almoxarifado_id, documento_id);


--
-- Name: produto_almoxarifado produto_almoxarifado_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_almoxarifado
    ADD CONSTRAINT produto_almoxarifado_pkey PRIMARY KEY (id);


--
-- Name: produto_estoque produto_estoque_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_estoque
    ADD CONSTRAINT produto_estoque_pkey PRIMARY KEY (id);


--
-- Name: produto_saida produto_saida_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_saida
    ADD CONSTRAINT produto_saida_pkey PRIMARY KEY (id);


--
-- Name: produto_solicitacao produto_solicitacao_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_solicitacao
    ADD CONSTRAINT produto_solicitacao_pkey PRIMARY KEY (id);


--
-- Name: propriedade_equipamento propriedade_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.propriedade_equipamento
    ADD CONSTRAINT propriedade_equipamento_pkey PRIMARY KEY (id);


--
-- Name: propriedade_equipamento_valor_propriedade_equipamento propriedade_equipamento_valor_propriedade_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.propriedade_equipamento_valor_propriedade_equipamento
    ADD CONSTRAINT propriedade_equipamento_valor_propriedade_equipamento_pkey PRIMARY KEY (propriedade_equipamento_id, valor_propriedade_equipamento_id);


--
-- Name: relatorio_execucao_de_procedimento_equipamento relatorio_execucao_de_procedimento_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_execucao_de_procedimento_equipamento
    ADD CONSTRAINT relatorio_execucao_de_procedimento_equipamento_pkey PRIMARY KEY (id);


--
-- Name: relatorio_ordem_servico_foto_os relatorio_ordem_servico_foto_os_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_ordem_servico_foto_os
    ADD CONSTRAINT relatorio_ordem_servico_foto_os_pkey PRIMARY KEY (relatorio_ordem_servico_id, foto_os_id);


--
-- Name: relatorio_ordem_servico relatorio_ordem_servico_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_ordem_servico
    ADD CONSTRAINT relatorio_ordem_servico_pkey PRIMARY KEY (id);


--
-- Name: requisicao_produto requisicao_produto_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto
    ADD CONSTRAINT requisicao_produto_pkey PRIMARY KEY (id);


--
-- Name: requisicao_produto_produto_saida requisicao_produto_produto_saida_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto_produto_saida
    ADD CONSTRAINT requisicao_produto_produto_saida_pkey PRIMARY KEY (requisicao_produto_id, produto_saida_id);


--
-- Name: responsavel_cliente responsavel_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.responsavel_cliente
    ADD CONSTRAINT responsavel_cliente_pkey PRIMARY KEY (id);


--
-- Name: revisions revisions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.revisions
    ADD CONSTRAINT revisions_pkey PRIMARY KEY (id);


--
-- Name: telefone telefone_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.telefone
    ADD CONSTRAINT telefone_pkey PRIMARY KEY (id);


--
-- Name: tempo_ocioso_tecnico tempo_ocioso_tecnico_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tempo_ocioso_tecnico
    ADD CONSTRAINT tempo_ocioso_tecnico_pkey PRIMARY KEY (id);


--
-- Name: tipo_documento tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_documento
    ADD CONSTRAINT tipo_documento_pkey PRIMARY KEY (id);


--
-- Name: tipo_endereco tipo_endereco_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_endereco
    ADD CONSTRAINT tipo_endereco_pkey PRIMARY KEY (id);


--
-- Name: tipo_negocio tipo_negocio_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_negocio
    ADD CONSTRAINT tipo_negocio_pkey PRIMARY KEY (id);


--
-- Name: tipo_telefone tipo_telefone_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tipo_telefone
    ADD CONSTRAINT tipo_telefone_pkey PRIMARY KEY (id);


--
-- Name: titulo_agendamento_manutencao_equipamento titulo_agendamento_manutencao_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_agendamento_manutencao_equipamento
    ADD CONSTRAINT titulo_agendamento_manutencao_equipamento_pkey PRIMARY KEY (id);


--
-- Name: titulo_propriedade_equipamento titulo_propriedade_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_propriedade_equipamento
    ADD CONSTRAINT titulo_propriedade_equipamento_pkey PRIMARY KEY (id);


--
-- Name: titulo_valor_propriedade_equipamento titulo_valor_propriedade_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.titulo_valor_propriedade_equipamento
    ADD CONSTRAINT titulo_valor_propriedade_equipamento_pkey PRIMARY KEY (id);


--
-- Name: unidade_federativa unidade_federativa_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.unidade_federativa
    ADD CONSTRAINT unidade_federativa_pkey PRIMARY KEY (id);


--
-- Name: usuario_cliente_cliente usuario_cliente_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_cliente_cliente
    ADD CONSTRAINT usuario_cliente_cliente_pkey PRIMARY KEY (usuario_cliente_id, cliente_id);


--
-- Name: usuario_cliente usuario_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_cliente
    ADD CONSTRAINT usuario_cliente_pkey PRIMARY KEY (id);


--
-- Name: valor_propriedade_equipamento valor_propriedade_equipamento_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.valor_propriedade_equipamento
    ADD CONSTRAINT valor_propriedade_equipamento_pkey PRIMARY KEY (id);


--
-- Name: idx_175f78a33a7a70a1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_175f78a33a7a70a1 ON public.equipamento_cliente_agendamento_manutencao_equipamento USING btree (agendamento_manutencao_equipamento_id);


--
-- Name: idx_175f78a38a0a8e0d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_175f78a38a0a8e0d ON public.equipamento_cliente_agendamento_manutencao_equipamento USING btree (equipamento_cliente_id);


--
-- Name: idx_1c982489d3ebb69d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_1c982489d3ebb69d ON public.entrada_produto USING btree (fornecedor_id);


--
-- Name: idx_1c982489f1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_1c982489f1cb264e ON public.entrada_produto USING btree (colaborador_id);


--
-- Name: idx_2132e361a9276e6c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_2132e361a9276e6c ON public.telefone USING btree (tipo_id);


--
-- Name: idx_28188a9710f617d6; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_28188a9710f617d6 ON public.produto_almoxarifado_documento USING btree (produto_almoxarifado_id);


--
-- Name: idx_28188a9745c0cf75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_28188a9745c0cf75 ON public.produto_almoxarifado_documento USING btree (documento_id);


--
-- Name: idx_2b168f9592d095a9; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_2b168f9592d095a9 ON public.colaborador_telefone USING btree (telefone_id);


--
-- Name: idx_2b168f95f1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_2b168f95f1cb264e ON public.colaborador_telefone USING btree (colaborador_id);


--
-- Name: idx_2c93cedb1bb76823; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_2c93cedb1bb76823 ON public.fornecedor_endereco USING btree (endereco_id);


--
-- Name: idx_2c93cedbd3ebb69d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_2c93cedbd3ebb69d ON public.fornecedor_endereco USING btree (fornecedor_id);


--
-- Name: idx_303edadd45c0cf75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_303edadd45c0cf75 ON public.ferramenta_almoxarifado_documento USING btree (documento_id);


--
-- Name: idx_303edadd962f69cd; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_303edadd962f69cd ON public.ferramenta_almoxarifado_documento USING btree (ferramenta_almoxarifado_id);


--
-- Name: idx_32fc4e18a0dcccd0; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_32fc4e18a0dcccd0 ON public.requisicao_produto_produto_saida USING btree (produto_saida_id);


--
-- Name: idx_32fc4e18ba032ad6; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_32fc4e18ba032ad6 ON public.requisicao_produto_produto_saida USING btree (requisicao_produto_id);


--
-- Name: idx_351379fc105cfd56; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_351379fc105cfd56 ON public.produto_saida USING btree (produto_id);


--
-- Name: idx_40a8c1763a7a70a1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_40a8c1763a7a70a1 ON public.cliente_equipamento_agendamento_manutencao_equipamento USING btree (agendamento_manutencao_equipamento_id);


--
-- Name: idx_40a8c17666fb896d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_40a8c17666fb896d ON public.cliente_equipamento_agendamento_manutencao_equipamento USING btree (cliente_equipamento_id);


--
-- Name: idx_40dc7b8445c0cf75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_40dc7b8445c0cf75 ON public.fornecedor_documento USING btree (documento_id);


--
-- Name: idx_40dc7b84d3ebb69d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_40dc7b84d3ebb69d ON public.fornecedor_documento USING btree (fornecedor_id);


--
-- Name: idx_42d151901bb76823; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_42d151901bb76823 ON public.cliente_endereco USING btree (endereco_id);


--
-- Name: idx_42d15190de734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_42d15190de734e51 ON public.cliente_endereco USING btree (cliente_id);


--
-- Name: idx_43629b36727aca70; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_43629b36727aca70 ON public.classification__category USING btree (parent_id);


--
-- Name: idx_43629b36e25d857e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_43629b36e25d857e ON public.classification__category USING btree (context);


--
-- Name: idx_43629b36ea9fdd75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_43629b36ea9fdd75 ON public.classification__category USING btree (media_id);


--
-- Name: idx_451a39ddd3ebb69d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_451a39ddd3ebb69d ON public.produto_almoxarifado USING btree (fornecedor_id);


--
-- Name: idx_46c8b8063d9ab4a6; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_46c8b8063d9ab4a6 ON public.acl_entries USING btree (object_identity_id);


--
-- Name: idx_46c8b806df9183c9; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_46c8b806df9183c9 ON public.acl_entries USING btree (security_identity_id);


--
-- Name: idx_46c8b806ea000b10; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_46c8b806ea000b10 ON public.acl_entries USING btree (class_id);


--
-- Name: idx_46c8b806ea000b103d9ab4a6df9183c9; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_46c8b806ea000b103d9ab4a6df9183c9 ON public.acl_entries USING btree (class_id, object_identity_id, security_identity_id);


--
-- Name: idx_54d18fdc105cfd56; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_54d18fdc105cfd56 ON public.produto_solicitacao USING btree (produto_id);


--
-- Name: idx_54d18fdcd3ebb69d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_54d18fdcd3ebb69d ON public.produto_solicitacao USING btree (fornecedor_id);


--
-- Name: idx_56ab6dc54e4f0650; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_56ab6dc54e4f0650 ON public.valor_propriedade_equipamento USING btree (titulo_valor_propriedade_equipamento_id);


--
-- Name: idx_578edbda4f783e5f; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_578edbda4f783e5f ON public.cliente_responsavel_cliente USING btree (responsavel_cliente_id);


--
-- Name: idx_578edbdade734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_578edbdade734e51 ON public.cliente_responsavel_cliente USING btree (cliente_id);


--
-- Name: idx_5a394362841db1e7; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_5a394362841db1e7 ON public.tempo_ocioso_tecnico USING btree (tecnico_id);


--
-- Name: idx_5c6dd74e12469de2; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_5c6dd74e12469de2 ON public.media__media USING btree (category_id);


--
-- Name: idx_62035dc47abfa656; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_62035dc47abfa656 ON public.cliente_equipamento USING btree (foto_id);


--
-- Name: idx_62035dc4c20f76de; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_62035dc4c20f76de ON public.cliente_equipamento USING btree (equipamento_id);


--
-- Name: idx_62035dc4de734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_62035dc4de734e51 ON public.cliente_equipamento USING btree (cliente_id);


--
-- Name: idx_6518d086605d3676; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_6518d086605d3676 ON public.execucao_de_procedimento_equipamento_foto_execucao_os USING btree (execucao_de_procedimento_equipamento_id);


--
-- Name: idx_6518d086c4a59320; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_6518d086c4a59320 ON public.execucao_de_procedimento_equipamento_foto_execucao_os USING btree (foto_execucao_os_id);


--
-- Name: idx_688b5eb03dca04d1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_688b5eb03dca04d1 ON public.ficha_tecnica_produto USING btree (os_id);


--
-- Name: idx_688b5eb0c0a0fdfa; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_688b5eb0c0a0fdfa ON public.ficha_tecnica_produto USING btree (fabricante_id);


--
-- Name: idx_6ac4d3bde7c6a449; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_6ac4d3bde7c6a449 ON public.relatorio_ordem_servico_foto_os USING btree (relatorio_ordem_servico_id);


--
-- Name: idx_6ac4d3bdef7db8bc; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_6ac4d3bdef7db8bc ON public.relatorio_ordem_servico_foto_os USING btree (foto_os_id);


--
-- Name: idx_71d2c0074fb7c65a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_71d2c0074fb7c65a ON public.ordem_servico_ficha_tecnica_produto USING btree (ordem_servico_id);


--
-- Name: idx_71d2c007fd4d113a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_71d2c007fd4d113a ON public.ordem_servico_ficha_tecnica_produto USING btree (ficha_tecnica_produto_id);


--
-- Name: idx_7858de2637818941; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_7858de2637818941 ON public.relatorio_execucao_de_procedimento_equipamento USING btree (execucao_de_procedimento_id);


--
-- Name: idx_7858de263dca04d1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_7858de263dca04d1 ON public.relatorio_execucao_de_procedimento_equipamento USING btree (os_id);


--
-- Name: idx_7c0a30213dca04d1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_7c0a30213dca04d1 ON public.execucao_de_procedimento_equipamento USING btree (os_id);


--
-- Name: idx_7c0a30218a0a8e0d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_7c0a30218a0a8e0d ON public.execucao_de_procedimento_equipamento USING btree (equipamento_cliente_id);


--
-- Name: idx_7c0a3021ac76f9bf; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_7c0a3021ac76f9bf ON public.execucao_de_procedimento_equipamento USING btree (procedimento_pmoc_id);


--
-- Name: idx_80d4c5414e7af8f; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_80d4c5414e7af8f ON public.media__gallery_media USING btree (gallery_id);


--
-- Name: idx_80d4c541ea9fdd75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_80d4c541ea9fdd75 ON public.media__gallery_media USING btree (media_id);


--
-- Name: idx_81f332059586cc8; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_81f332059586cc8 ON public.bairro USING btree (cidade_id);


--
-- Name: idx_825de2993d9ab4a6; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_825de2993d9ab4a6 ON public.acl_object_identity_ancestors USING btree (object_identity_id);


--
-- Name: idx_825de299c671cea1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_825de299c671cea1 ON public.acl_object_identity_ancestors USING btree (ancestor_id);


--
-- Name: idx_844b57271bb76823; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b57271bb76823 ON public.ordem_servico USING btree (endereco_id);


--
-- Name: idx_844b5727392f5351; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b5727392f5351 ON public.ordem_servico USING btree (os_original_id);


--
-- Name: idx_844b57278b674866; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b57278b674866 ON public.ordem_servico USING btree (engenheiro_id);


--
-- Name: idx_844b5727cd3b12c7; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b5727cd3b12c7 ON public.ordem_servico USING btree (colaborador_executor_id);


--
-- Name: idx_844b5727de734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b5727de734e51 ON public.ordem_servico USING btree (cliente_id);


--
-- Name: idx_844b5727e06fc29e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b5727e06fc29e ON public.ordem_servico USING btree (norma_id);


--
-- Name: idx_844b5727f008ab6; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b5727f008ab6 ON public.ordem_servico USING btree (colaborador_avalista_id);


--
-- Name: idx_844b5727fc6e767b; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_844b5727fc6e767b ON public.ordem_servico USING btree (colaborador_solicitante_id);


--
-- Name: idx_8875d3d966fb896d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_8875d3d966fb896d ON public.cliente_equipamento_propriedade_equipamento USING btree (cliente_equipamento_id);


--
-- Name: idx_8875d3d9a8556ba3; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_8875d3d9a8556ba3 ON public.cliente_equipamento_propriedade_equipamento USING btree (propriedade_equipamento_id);


--
-- Name: idx_887d56ec3dca04d1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_887d56ec3dca04d1 ON public.homologacao_os USING btree (os_id);


--
-- Name: idx_9407e54977fa751a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_9407e54977fa751a ON public.acl_object_identities USING btree (parent_object_identity_id);


--
-- Name: idx_97ff63ab3f1521d5; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_97ff63ab3f1521d5 ON public.ordem_compra_produto_produto_saida USING btree (ordem_compra_produto_id);


--
-- Name: idx_97ff63aba0dcccd0; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_97ff63aba0dcccd0 ON public.ordem_compra_produto_produto_saida USING btree (produto_saida_id);


--
-- Name: idx_9b0364ff92d095a9; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_9b0364ff92d095a9 ON public.cliente_telefone USING btree (telefone_id);


--
-- Name: idx_9b0364ffde734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_9b0364ffde734e51 ON public.cliente_telefone USING btree (cliente_id);


--
-- Name: idx_a1bca10345c0cf75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a1bca10345c0cf75 ON public.cliente_documento USING btree (documento_id);


--
-- Name: idx_a1bca103de734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a1bca103de734e51 ON public.cliente_documento USING btree (cliente_id);


--
-- Name: idx_a20c8b4478ab74db; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a20c8b4478ab74db ON public.filial_empresa_unidade_federativa USING btree (filial_empresa_id);


--
-- Name: idx_a20c8b44c24b0e0a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a20c8b44c24b0e0a ON public.filial_empresa_unidade_federativa USING btree (unidade_federativa_id);


--
-- Name: idx_a406b56ae25d857e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a406b56ae25d857e ON public.classification__collection USING btree (context);


--
-- Name: idx_a406b56aea9fdd75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a406b56aea9fdd75 ON public.classification__collection USING btree (media_id);


--
-- Name: idx_a64a0d0ede734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a64a0d0ede734e51 ON public.responsavel_cliente USING btree (cliente_id);


--
-- Name: idx_a6de2587105cfd56; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a6de2587105cfd56 ON public.produto_estoque USING btree (produto_id);


--
-- Name: idx_a8183bb57abfa656; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a8183bb57abfa656 ON public.equipamento_cliente USING btree (foto_id);


--
-- Name: idx_a8183bb598a1b0b8; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a8183bb598a1b0b8 ON public.equipamento_cliente USING btree (marca_equipamento_id);


--
-- Name: idx_a8183bb5c04160f0; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a8183bb5c04160f0 ON public.equipamento_cliente USING btree (modelo_equipamento_id);


--
-- Name: idx_a9357bc3dca04d1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a9357bc3dca04d1 ON public.agendamento_ordem_servico USING btree (os_id);


--
-- Name: idx_a9357bcc680a87; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a9357bcc680a87 ON public.agendamento_ordem_servico USING btree (solicitante_id);


--
-- Name: idx_a9357bccd3b12c7; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a9357bccd3b12c7 ON public.agendamento_ordem_servico USING btree (colaborador_executor_id);


--
-- Name: idx_a9357bcf1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a9357bcf1cb264e ON public.agendamento_ordem_servico USING btree (colaborador_id);


--
-- Name: idx_a9eaafd87991ff3; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a9eaafd87991ff3 ON public.entrada_produto_produto_saida USING btree (entrada_produto_id);


--
-- Name: idx_a9eaafda0dcccd0; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_a9eaafda0dcccd0 ON public.entrada_produto_produto_saida USING btree (produto_saida_id);


--
-- Name: idx_aced428b8c2aa04c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_aced428b8c2aa04c ON public.orcamento_produto USING btree (colaborador_id_autorizou_orcamento);


--
-- Name: idx_aced428bf1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_aced428bf1cb264e ON public.orcamento_produto USING btree (colaborador_id);


--
-- Name: idx_aced428bf40b147f; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_aced428bf40b147f ON public.orcamento_produto USING btree (colaborador_id_enviou_orcamento);


--
-- Name: idx_b3c77447a76ed395; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b3c77447a76ed395 ON public.fos_user_user_group USING btree (user_id);


--
-- Name: idx_b3c77447fe54d947; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b3c77447fe54d947 ON public.fos_user_user_group USING btree (group_id);


--
-- Name: idx_b484ddde8c2aa04c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b484ddde8c2aa04c ON public.ordem_compra_produto USING btree (colaborador_id_autorizou_orcamento);


--
-- Name: idx_b484dddea01cf1ca; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b484dddea01cf1ca ON public.ordem_compra_produto USING btree (orcamento_id);


--
-- Name: idx_b484ddded3ebb69d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b484ddded3ebb69d ON public.ordem_compra_produto USING btree (fornecedor_id);


--
-- Name: idx_b484dddef1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b484dddef1cb264e ON public.ordem_compra_produto USING btree (colaborador_id);


--
-- Name: idx_b6b12ec7f6939175; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b6b12ec7f6939175 ON public.documento USING btree (tipo_documento_id);


--
-- Name: idx_b6c47983c427592f; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b6c47983c427592f ON public.relatorio_ordem_servico USING btree (agendamento_id);


--
-- Name: idx_b6c47983f1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_b6c47983f1cb264e ON public.relatorio_ordem_servico USING btree (colaborador_id);


--
-- Name: idx_c06e7175e592c6ed; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_c06e7175e592c6ed ON public.propriedade_equipamento USING btree (titulo_propriedade_equipamento_id);


--
-- Name: idx_c1785dd03dca04d1; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_c1785dd03dca04d1 ON public.requisicao_produto USING btree (os_id);


--
-- Name: idx_c1785dd0f1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_c1785dd0f1cb264e ON public.requisicao_produto USING btree (colaborador_id);


--
-- Name: idx_c28f36e18cdc7a94; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_c28f36e18cdc7a94 ON public.agendamento_manutencao_equipamento USING btree (titulo_agendamento_manutencao_equipamento_id);


--
-- Name: idx_c28f36e1c06e7175; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_c28f36e1c06e7175 ON public.agendamento_manutencao_equipamento USING btree (propriedade_equipamento);


--
-- Name: idx_c6b3cae45c0cf75; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_c6b3cae45c0cf75 ON public.colaborador_documento USING btree (documento_id);


--
-- Name: idx_c6b3caef1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_c6b3caef1cb264e ON public.colaborador_documento USING btree (colaborador_id);


--
-- Name: idx_ca57a1c7e25d857e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ca57a1c7e25d857e ON public.classification__tag USING btree (context);


--
-- Name: idx_d062c751841db1e7; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_d062c751841db1e7 ON public.posicao_tecnico USING btree (tecnico_id);


--
-- Name: idx_d2f80bb3263e9cb2; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_d2f80bb3263e9cb2 ON public.colaborador USING btree (funcao_id);


--
-- Name: idx_d2f80bb3dbd30545; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_d2f80bb3dbd30545 ON public.colaborador USING btree (grupo_usuario_id);


--
-- Name: idx_d64cb9c66072fe47; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_d64cb9c66072fe47 ON public.propriedade_equipamento_valor_propriedade_equipamento USING btree (valor_propriedade_equipamento_id);


--
-- Name: idx_d64cb9c6a8556ba3; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_d64cb9c6a8556ba3 ON public.propriedade_equipamento_valor_propriedade_equipamento USING btree (propriedade_equipamento_id);


--
-- Name: idx_e394d4a192d095a9; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_e394d4a192d095a9 ON public.contato_telefone USING btree (telefone_id);


--
-- Name: idx_e394d4a1b279be46; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_e394d4a1b279be46 ON public.contato_telefone USING btree (contato_id);


--
-- Name: idx_ec8aee894fb7c65a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ec8aee894fb7c65a ON public.ordem_servico_colaborador USING btree (ordem_servico_id);


--
-- Name: idx_ec8aee89f1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ec8aee89f1cb264e ON public.ordem_servico_colaborador USING btree (colaborador_id);


--
-- Name: idx_ef4635e14fb7c65a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ef4635e14fb7c65a ON public.ordem_servico_foto_os USING btree (ordem_servico_id);


--
-- Name: idx_ef4635e1ef7db8bc; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ef4635e1ef7db8bc ON public.ordem_servico_foto_os USING btree (foto_os_id);


--
-- Name: idx_f01923902d4304f3; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f01923902d4304f3 ON public.usuario_cliente_cliente USING btree (usuario_cliente_id);


--
-- Name: idx_f0192390de734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f0192390de734e51 ON public.usuario_cliente_cliente USING btree (cliente_id);


--
-- Name: idx_f2c4bafa1bb76823; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f2c4bafa1bb76823 ON public.colaborador_endereco USING btree (endereco_id);


--
-- Name: idx_f2c4bafaf1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f2c4bafaf1cb264e ON public.colaborador_endereco USING btree (colaborador_id);


--
-- Name: idx_f3aee7d897d582bf; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f3aee7d897d582bf ON public.orcamento_produto_produto_solicitacao USING btree (orcamento_produto_id);


--
-- Name: idx_f3aee7d8af1d6ff6; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f3aee7d8af1d6ff6 ON public.orcamento_produto_produto_solicitacao USING btree (produto_solicitacao_id);


--
-- Name: idx_f41c9b25299b2577; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f41c9b25299b2577 ON public.cliente USING btree (filial_id);


--
-- Name: idx_f41c9b255263402; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f41c9b255263402 ON public.cliente USING btree (facilities_id);


--
-- Name: idx_f41c9b25ec019c67; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f41c9b25ec019c67 ON public.cliente USING btree (tipo_negocio_id);


--
-- Name: idx_f7cae19c78ab74db; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f7cae19c78ab74db ON public.colaborador_filial_empresa USING btree (filial_empresa_id);


--
-- Name: idx_f7cae19cf1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f7cae19cf1cb264e ON public.colaborador_filial_empresa USING btree (colaborador_id);


--
-- Name: idx_f8e0d60ea9276e6c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f8e0d60ea9276e6c ON public.endereco USING btree (tipo_id);


--
-- Name: idx_f8e0d60ea94ef08d; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f8e0d60ea94ef08d ON public.endereco USING btree (bairro_id);


--
-- Name: idx_f8e0d60ede734e51; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f8e0d60ede734e51 ON public.endereco USING btree (cliente_id);


--
-- Name: idx_f8e0d60ef1cb264e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_f8e0d60ef1cb264e ON public.endereco USING btree (colaborador_id);


--
-- Name: tag_collection; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tag_collection ON public.classification__collection USING btree (slug, context);


--
-- Name: tag_context; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tag_context ON public.classification__tag USING btree (slug, context);


--
-- Name: uniq_3ef6217e801b7d4b; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_3ef6217e801b7d4b ON public.norma USING btree (sigla);


--
-- Name: uniq_3ef6217ef55ae19e; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_3ef6217ef55ae19e ON public.norma USING btree (numero);


--
-- Name: uniq_46c8b806ea000b103d9ab4a64def17bce4289bf4; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_46c8b806ea000b103d9ab4a64def17bce4289bf4 ON public.acl_entries USING btree (class_id, object_identity_id, field_name, ace_order);


--
-- Name: uniq_583d1f3e5e237e06; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_583d1f3e5e237e06 ON public.fos_user_group USING btree (name);


--
-- Name: uniq_66d1c2d954bd530c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_66d1c2d954bd530c ON public.tipo_negocio USING btree (nome);


--
-- Name: uniq_688b5eb017713e5a; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_688b5eb017713e5a ON public.ficha_tecnica_produto USING btree (titulo);


--
-- Name: uniq_69dd750638a36066; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_69dd750638a36066 ON public.acl_classes USING btree (class_type);


--
-- Name: uniq_6edef13d54bd530c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_6edef13d54bd530c ON public.funcao USING btree (nome);


--
-- Name: uniq_8835ee78772e836af85e0677; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_8835ee78772e836af85e0677 ON public.acl_security_identities USING btree (identifier, username);


--
-- Name: uniq_8d3a3162a76ed395; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_8d3a3162a76ed395 ON public.usuario_cliente USING btree (user_id);


--
-- Name: uniq_9407e5494b12ad6ea000b10; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_9407e5494b12ad6ea000b10 ON public.acl_object_identities USING btree (object_identifier, class_id);


--
-- Name: uniq_a64a0d0e54bd530c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_a64a0d0e54bd530c ON public.responsavel_cliente USING btree (nome);


--
-- Name: uniq_c560d76192fc23a8; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_c560d76192fc23a8 ON public.fos_user_user USING btree (username_canonical);


--
-- Name: uniq_c560d761a0d96fbf; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_c560d761a0d96fbf ON public.fos_user_user USING btree (email_canonical);


--
-- Name: uniq_d2f80bb33e3e11f0; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_d2f80bb33e3e11f0 ON public.colaborador USING btree (cpf);


--
-- Name: uniq_d2f80bb3a76ed395; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_d2f80bb3a76ed395 ON public.colaborador USING btree (user_id);


--
-- Name: uniq_f41c9b255a425330; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_f41c9b255a425330 ON public.cliente USING btree (cpf_cnpj);


--
-- Name: uniq_f7f7b9a854bd530c; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX uniq_f7f7b9a854bd530c ON public.tipo_telefone USING btree (nome);


--
-- Name: equipamento_cliente_agendamento_manutencao_equipamento fk_175f78a33a7a70a1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente_agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_175f78a33a7a70a1 FOREIGN KEY (agendamento_manutencao_equipamento_id) REFERENCES public.agendamento_manutencao_equipamento(id) ON DELETE CASCADE;


--
-- Name: equipamento_cliente_agendamento_manutencao_equipamento fk_175f78a38a0a8e0d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente_agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_175f78a38a0a8e0d FOREIGN KEY (equipamento_cliente_id) REFERENCES public.equipamento_cliente(id) ON DELETE CASCADE;


--
-- Name: entrada_produto fk_1c982489d3ebb69d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto
    ADD CONSTRAINT fk_1c982489d3ebb69d FOREIGN KEY (fornecedor_id) REFERENCES public.fornecedor(id);


--
-- Name: entrada_produto fk_1c982489f1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto
    ADD CONSTRAINT fk_1c982489f1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id);


--
-- Name: telefone fk_2132e361a9276e6c; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.telefone
    ADD CONSTRAINT fk_2132e361a9276e6c FOREIGN KEY (tipo_id) REFERENCES public.tipo_telefone(id);


--
-- Name: produto_almoxarifado_documento fk_28188a9710f617d6; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_almoxarifado_documento
    ADD CONSTRAINT fk_28188a9710f617d6 FOREIGN KEY (produto_almoxarifado_id) REFERENCES public.produto_almoxarifado(id) ON DELETE CASCADE;


--
-- Name: produto_almoxarifado_documento fk_28188a9745c0cf75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_almoxarifado_documento
    ADD CONSTRAINT fk_28188a9745c0cf75 FOREIGN KEY (documento_id) REFERENCES public.documento(id) ON DELETE CASCADE;


--
-- Name: colaborador_telefone fk_2b168f9592d095a9; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_telefone
    ADD CONSTRAINT fk_2b168f9592d095a9 FOREIGN KEY (telefone_id) REFERENCES public.telefone(id) ON DELETE CASCADE;


--
-- Name: colaborador_telefone fk_2b168f95f1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_telefone
    ADD CONSTRAINT fk_2b168f95f1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id) ON DELETE CASCADE;


--
-- Name: fornecedor_endereco fk_2c93cedb1bb76823; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor_endereco
    ADD CONSTRAINT fk_2c93cedb1bb76823 FOREIGN KEY (endereco_id) REFERENCES public.endereco(id) ON DELETE CASCADE;


--
-- Name: fornecedor_endereco fk_2c93cedbd3ebb69d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor_endereco
    ADD CONSTRAINT fk_2c93cedbd3ebb69d FOREIGN KEY (fornecedor_id) REFERENCES public.fornecedor(id) ON DELETE CASCADE;


--
-- Name: ferramenta_almoxarifado_documento fk_303edadd45c0cf75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ferramenta_almoxarifado_documento
    ADD CONSTRAINT fk_303edadd45c0cf75 FOREIGN KEY (documento_id) REFERENCES public.documento(id) ON DELETE CASCADE;


--
-- Name: ferramenta_almoxarifado_documento fk_303edadd962f69cd; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ferramenta_almoxarifado_documento
    ADD CONSTRAINT fk_303edadd962f69cd FOREIGN KEY (ferramenta_almoxarifado_id) REFERENCES public.ferramenta_almoxarifado(id) ON DELETE CASCADE;


--
-- Name: requisicao_produto_produto_saida fk_32fc4e18a0dcccd0; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto_produto_saida
    ADD CONSTRAINT fk_32fc4e18a0dcccd0 FOREIGN KEY (produto_saida_id) REFERENCES public.produto_saida(id) ON DELETE CASCADE;


--
-- Name: requisicao_produto_produto_saida fk_32fc4e18ba032ad6; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto_produto_saida
    ADD CONSTRAINT fk_32fc4e18ba032ad6 FOREIGN KEY (requisicao_produto_id) REFERENCES public.requisicao_produto(id) ON DELETE CASCADE;


--
-- Name: produto_saida fk_351379fc105cfd56; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_saida
    ADD CONSTRAINT fk_351379fc105cfd56 FOREIGN KEY (produto_id) REFERENCES public.produto_almoxarifado(id);


--
-- Name: cliente_equipamento_agendamento_manutencao_equipamento fk_40a8c1763a7a70a1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento_agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_40a8c1763a7a70a1 FOREIGN KEY (agendamento_manutencao_equipamento_id) REFERENCES public.agendamento_manutencao_equipamento(id) ON DELETE CASCADE;


--
-- Name: cliente_equipamento_agendamento_manutencao_equipamento fk_40a8c17666fb896d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento_agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_40a8c17666fb896d FOREIGN KEY (cliente_equipamento_id) REFERENCES public.cliente_equipamento(id) ON DELETE CASCADE;


--
-- Name: fornecedor_documento fk_40dc7b8445c0cf75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor_documento
    ADD CONSTRAINT fk_40dc7b8445c0cf75 FOREIGN KEY (documento_id) REFERENCES public.documento(id) ON DELETE CASCADE;


--
-- Name: fornecedor_documento fk_40dc7b84d3ebb69d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fornecedor_documento
    ADD CONSTRAINT fk_40dc7b84d3ebb69d FOREIGN KEY (fornecedor_id) REFERENCES public.fornecedor(id) ON DELETE CASCADE;


--
-- Name: cliente_endereco fk_42d151901bb76823; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_endereco
    ADD CONSTRAINT fk_42d151901bb76823 FOREIGN KEY (endereco_id) REFERENCES public.endereco(id) ON DELETE CASCADE;


--
-- Name: cliente_endereco fk_42d15190de734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_endereco
    ADD CONSTRAINT fk_42d15190de734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id) ON DELETE CASCADE;


--
-- Name: classification__category fk_43629b36727aca70; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__category
    ADD CONSTRAINT fk_43629b36727aca70 FOREIGN KEY (parent_id) REFERENCES public.classification__category(id) ON DELETE CASCADE;


--
-- Name: classification__category fk_43629b36e25d857e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__category
    ADD CONSTRAINT fk_43629b36e25d857e FOREIGN KEY (context) REFERENCES public.classification__context(id);


--
-- Name: classification__category fk_43629b36ea9fdd75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__category
    ADD CONSTRAINT fk_43629b36ea9fdd75 FOREIGN KEY (media_id) REFERENCES public.media__media(id) ON DELETE SET NULL;


--
-- Name: produto_almoxarifado fk_451a39ddd3ebb69d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_almoxarifado
    ADD CONSTRAINT fk_451a39ddd3ebb69d FOREIGN KEY (fornecedor_id) REFERENCES public.fornecedor(id);


--
-- Name: acl_entries fk_46c8b8063d9ab4a6; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_entries
    ADD CONSTRAINT fk_46c8b8063d9ab4a6 FOREIGN KEY (object_identity_id) REFERENCES public.acl_object_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: acl_entries fk_46c8b806df9183c9; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_entries
    ADD CONSTRAINT fk_46c8b806df9183c9 FOREIGN KEY (security_identity_id) REFERENCES public.acl_security_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: acl_entries fk_46c8b806ea000b10; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_entries
    ADD CONSTRAINT fk_46c8b806ea000b10 FOREIGN KEY (class_id) REFERENCES public.acl_classes(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: produto_solicitacao fk_54d18fdc105cfd56; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_solicitacao
    ADD CONSTRAINT fk_54d18fdc105cfd56 FOREIGN KEY (produto_id) REFERENCES public.produto_almoxarifado(id);


--
-- Name: produto_solicitacao fk_54d18fdcd3ebb69d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_solicitacao
    ADD CONSTRAINT fk_54d18fdcd3ebb69d FOREIGN KEY (fornecedor_id) REFERENCES public.fornecedor(id);


--
-- Name: valor_propriedade_equipamento fk_56ab6dc54e4f0650; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.valor_propriedade_equipamento
    ADD CONSTRAINT fk_56ab6dc54e4f0650 FOREIGN KEY (titulo_valor_propriedade_equipamento_id) REFERENCES public.titulo_valor_propriedade_equipamento(id);


--
-- Name: cliente_responsavel_cliente fk_578edbda4f783e5f; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_responsavel_cliente
    ADD CONSTRAINT fk_578edbda4f783e5f FOREIGN KEY (responsavel_cliente_id) REFERENCES public.responsavel_cliente(id) ON DELETE CASCADE;


--
-- Name: cliente_responsavel_cliente fk_578edbdade734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_responsavel_cliente
    ADD CONSTRAINT fk_578edbdade734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id) ON DELETE CASCADE;


--
-- Name: tempo_ocioso_tecnico fk_5a394362841db1e7; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tempo_ocioso_tecnico
    ADD CONSTRAINT fk_5a394362841db1e7 FOREIGN KEY (tecnico_id) REFERENCES public.colaborador(id);


--
-- Name: media__media fk_5c6dd74e12469de2; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media__media
    ADD CONSTRAINT fk_5c6dd74e12469de2 FOREIGN KEY (category_id) REFERENCES public.classification__category(id) ON DELETE SET NULL;


--
-- Name: cliente_equipamento fk_62035dc47abfa656; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento
    ADD CONSTRAINT fk_62035dc47abfa656 FOREIGN KEY (foto_id) REFERENCES public.media__media(id);


--
-- Name: cliente_equipamento fk_62035dc4c20f76de; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento
    ADD CONSTRAINT fk_62035dc4c20f76de FOREIGN KEY (equipamento_id) REFERENCES public.equipamento_cliente(id);


--
-- Name: cliente_equipamento fk_62035dc4de734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento
    ADD CONSTRAINT fk_62035dc4de734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id);


--
-- Name: execucao_de_procedimento_equipamento_foto_execucao_os fk_6518d086605d3676; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento_foto_execucao_os
    ADD CONSTRAINT fk_6518d086605d3676 FOREIGN KEY (execucao_de_procedimento_equipamento_id) REFERENCES public.execucao_de_procedimento_equipamento(id) ON DELETE CASCADE;


--
-- Name: execucao_de_procedimento_equipamento_foto_execucao_os fk_6518d086c4a59320; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento_foto_execucao_os
    ADD CONSTRAINT fk_6518d086c4a59320 FOREIGN KEY (foto_execucao_os_id) REFERENCES public.foto_execucao_os(id) ON DELETE CASCADE;


--
-- Name: ficha_tecnica_produto fk_688b5eb03dca04d1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ficha_tecnica_produto
    ADD CONSTRAINT fk_688b5eb03dca04d1 FOREIGN KEY (os_id) REFERENCES public.ordem_servico(id);


--
-- Name: ficha_tecnica_produto fk_688b5eb0c0a0fdfa; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ficha_tecnica_produto
    ADD CONSTRAINT fk_688b5eb0c0a0fdfa FOREIGN KEY (fabricante_id) REFERENCES public.fornecedor(id);


--
-- Name: relatorio_ordem_servico_foto_os fk_6ac4d3bde7c6a449; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_ordem_servico_foto_os
    ADD CONSTRAINT fk_6ac4d3bde7c6a449 FOREIGN KEY (relatorio_ordem_servico_id) REFERENCES public.relatorio_ordem_servico(id) ON DELETE CASCADE;


--
-- Name: relatorio_ordem_servico_foto_os fk_6ac4d3bdef7db8bc; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_ordem_servico_foto_os
    ADD CONSTRAINT fk_6ac4d3bdef7db8bc FOREIGN KEY (foto_os_id) REFERENCES public.foto_os(id) ON DELETE CASCADE;


--
-- Name: ordem_servico_ficha_tecnica_produto fk_71d2c0074fb7c65a; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_ficha_tecnica_produto
    ADD CONSTRAINT fk_71d2c0074fb7c65a FOREIGN KEY (ordem_servico_id) REFERENCES public.ordem_servico(id) ON DELETE CASCADE;


--
-- Name: ordem_servico_ficha_tecnica_produto fk_71d2c007fd4d113a; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_ficha_tecnica_produto
    ADD CONSTRAINT fk_71d2c007fd4d113a FOREIGN KEY (ficha_tecnica_produto_id) REFERENCES public.ficha_tecnica_produto(id) ON DELETE CASCADE;


--
-- Name: relatorio_execucao_de_procedimento_equipamento fk_7858de2637818941; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_execucao_de_procedimento_equipamento
    ADD CONSTRAINT fk_7858de2637818941 FOREIGN KEY (execucao_de_procedimento_id) REFERENCES public.execucao_de_procedimento_equipamento(id);


--
-- Name: relatorio_execucao_de_procedimento_equipamento fk_7858de263dca04d1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_execucao_de_procedimento_equipamento
    ADD CONSTRAINT fk_7858de263dca04d1 FOREIGN KEY (os_id) REFERENCES public.ordem_servico(id);


--
-- Name: execucao_de_procedimento_equipamento fk_7c0a30213dca04d1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento
    ADD CONSTRAINT fk_7c0a30213dca04d1 FOREIGN KEY (os_id) REFERENCES public.ordem_servico(id);


--
-- Name: execucao_de_procedimento_equipamento fk_7c0a30218a0a8e0d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento
    ADD CONSTRAINT fk_7c0a30218a0a8e0d FOREIGN KEY (equipamento_cliente_id) REFERENCES public.cliente_equipamento(id);


--
-- Name: execucao_de_procedimento_equipamento fk_7c0a3021ac76f9bf; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.execucao_de_procedimento_equipamento
    ADD CONSTRAINT fk_7c0a3021ac76f9bf FOREIGN KEY (procedimento_pmoc_id) REFERENCES public.agendamento_manutencao_equipamento(id);


--
-- Name: media__gallery_media fk_80d4c5414e7af8f; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media__gallery_media
    ADD CONSTRAINT fk_80d4c5414e7af8f FOREIGN KEY (gallery_id) REFERENCES public.media__gallery(id);


--
-- Name: media__gallery_media fk_80d4c541ea9fdd75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media__gallery_media
    ADD CONSTRAINT fk_80d4c541ea9fdd75 FOREIGN KEY (media_id) REFERENCES public.media__media(id);


--
-- Name: bairro fk_81f332059586cc8; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bairro
    ADD CONSTRAINT fk_81f332059586cc8 FOREIGN KEY (cidade_id) REFERENCES public.cidade(id);


--
-- Name: acl_object_identity_ancestors fk_825de2993d9ab4a6; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_object_identity_ancestors
    ADD CONSTRAINT fk_825de2993d9ab4a6 FOREIGN KEY (object_identity_id) REFERENCES public.acl_object_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: acl_object_identity_ancestors fk_825de299c671cea1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_object_identity_ancestors
    ADD CONSTRAINT fk_825de299c671cea1 FOREIGN KEY (ancestor_id) REFERENCES public.acl_object_identities(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ordem_servico fk_844b57271bb76823; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b57271bb76823 FOREIGN KEY (endereco_id) REFERENCES public.endereco(id);


--
-- Name: ordem_servico fk_844b5727392f5351; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b5727392f5351 FOREIGN KEY (os_original_id) REFERENCES public.ordem_servico(id);


--
-- Name: ordem_servico fk_844b57278b674866; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b57278b674866 FOREIGN KEY (engenheiro_id) REFERENCES public.colaborador(id);


--
-- Name: ordem_servico fk_844b5727cd3b12c7; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b5727cd3b12c7 FOREIGN KEY (colaborador_executor_id) REFERENCES public.colaborador(id);


--
-- Name: ordem_servico fk_844b5727de734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b5727de734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id);


--
-- Name: ordem_servico fk_844b5727e06fc29e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b5727e06fc29e FOREIGN KEY (norma_id) REFERENCES public.norma(id);


--
-- Name: ordem_servico fk_844b5727f008ab6; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b5727f008ab6 FOREIGN KEY (colaborador_avalista_id) REFERENCES public.colaborador(id);


--
-- Name: ordem_servico fk_844b5727fc6e767b; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico
    ADD CONSTRAINT fk_844b5727fc6e767b FOREIGN KEY (colaborador_solicitante_id) REFERENCES public.colaborador(id);


--
-- Name: cliente_equipamento_propriedade_equipamento fk_8875d3d966fb896d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento_propriedade_equipamento
    ADD CONSTRAINT fk_8875d3d966fb896d FOREIGN KEY (cliente_equipamento_id) REFERENCES public.cliente_equipamento(id) ON DELETE CASCADE;


--
-- Name: cliente_equipamento_propriedade_equipamento fk_8875d3d9a8556ba3; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_equipamento_propriedade_equipamento
    ADD CONSTRAINT fk_8875d3d9a8556ba3 FOREIGN KEY (propriedade_equipamento_id) REFERENCES public.propriedade_equipamento(id) ON DELETE CASCADE;


--
-- Name: homologacao_os fk_887d56ec3dca04d1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.homologacao_os
    ADD CONSTRAINT fk_887d56ec3dca04d1 FOREIGN KEY (os_id) REFERENCES public.ordem_servico(id);


--
-- Name: usuario_cliente fk_8d3a3162a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_cliente
    ADD CONSTRAINT fk_8d3a3162a76ed395 FOREIGN KEY (user_id) REFERENCES public.fos_user_user(id);


--
-- Name: acl_object_identities fk_9407e54977fa751a; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.acl_object_identities
    ADD CONSTRAINT fk_9407e54977fa751a FOREIGN KEY (parent_object_identity_id) REFERENCES public.acl_object_identities(id);


--
-- Name: ordem_compra_produto_produto_saida fk_97ff63ab3f1521d5; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto_produto_saida
    ADD CONSTRAINT fk_97ff63ab3f1521d5 FOREIGN KEY (ordem_compra_produto_id) REFERENCES public.ordem_compra_produto(id) ON DELETE CASCADE;


--
-- Name: ordem_compra_produto_produto_saida fk_97ff63aba0dcccd0; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto_produto_saida
    ADD CONSTRAINT fk_97ff63aba0dcccd0 FOREIGN KEY (produto_saida_id) REFERENCES public.produto_saida(id) ON DELETE CASCADE;


--
-- Name: cliente_telefone fk_9b0364ff92d095a9; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_telefone
    ADD CONSTRAINT fk_9b0364ff92d095a9 FOREIGN KEY (telefone_id) REFERENCES public.telefone(id) ON DELETE CASCADE;


--
-- Name: cliente_telefone fk_9b0364ffde734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_telefone
    ADD CONSTRAINT fk_9b0364ffde734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id) ON DELETE CASCADE;


--
-- Name: cliente_documento fk_a1bca10345c0cf75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_documento
    ADD CONSTRAINT fk_a1bca10345c0cf75 FOREIGN KEY (documento_id) REFERENCES public.documento(id) ON DELETE CASCADE;


--
-- Name: cliente_documento fk_a1bca103de734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente_documento
    ADD CONSTRAINT fk_a1bca103de734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id) ON DELETE CASCADE;


--
-- Name: filial_empresa_unidade_federativa fk_a20c8b4478ab74db; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.filial_empresa_unidade_federativa
    ADD CONSTRAINT fk_a20c8b4478ab74db FOREIGN KEY (filial_empresa_id) REFERENCES public.filial_empresa(id) ON DELETE CASCADE;


--
-- Name: filial_empresa_unidade_federativa fk_a20c8b44c24b0e0a; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.filial_empresa_unidade_federativa
    ADD CONSTRAINT fk_a20c8b44c24b0e0a FOREIGN KEY (unidade_federativa_id) REFERENCES public.unidade_federativa(id) ON DELETE CASCADE;


--
-- Name: classification__collection fk_a406b56ae25d857e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__collection
    ADD CONSTRAINT fk_a406b56ae25d857e FOREIGN KEY (context) REFERENCES public.classification__context(id);


--
-- Name: classification__collection fk_a406b56aea9fdd75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__collection
    ADD CONSTRAINT fk_a406b56aea9fdd75 FOREIGN KEY (media_id) REFERENCES public.media__media(id) ON DELETE SET NULL;


--
-- Name: responsavel_cliente fk_a64a0d0ede734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.responsavel_cliente
    ADD CONSTRAINT fk_a64a0d0ede734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id);


--
-- Name: produto_estoque fk_a6de2587105cfd56; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produto_estoque
    ADD CONSTRAINT fk_a6de2587105cfd56 FOREIGN KEY (produto_id) REFERENCES public.produto_almoxarifado(id);


--
-- Name: equipamento_cliente fk_a8183bb57abfa656; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente
    ADD CONSTRAINT fk_a8183bb57abfa656 FOREIGN KEY (foto_id) REFERENCES public.media__media(id);


--
-- Name: equipamento_cliente fk_a8183bb598a1b0b8; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente
    ADD CONSTRAINT fk_a8183bb598a1b0b8 FOREIGN KEY (marca_equipamento_id) REFERENCES public.marca_equipamento(id);


--
-- Name: equipamento_cliente fk_a8183bb5c04160f0; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipamento_cliente
    ADD CONSTRAINT fk_a8183bb5c04160f0 FOREIGN KEY (modelo_equipamento_id) REFERENCES public.modelo_equipamento(id);


--
-- Name: agendamento_ordem_servico fk_a9357bc3dca04d1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_ordem_servico
    ADD CONSTRAINT fk_a9357bc3dca04d1 FOREIGN KEY (os_id) REFERENCES public.ordem_servico(id);


--
-- Name: agendamento_ordem_servico fk_a9357bcc680a87; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_ordem_servico
    ADD CONSTRAINT fk_a9357bcc680a87 FOREIGN KEY (solicitante_id) REFERENCES public.responsavel_cliente(id);


--
-- Name: agendamento_ordem_servico fk_a9357bccd3b12c7; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_ordem_servico
    ADD CONSTRAINT fk_a9357bccd3b12c7 FOREIGN KEY (colaborador_executor_id) REFERENCES public.colaborador(id);


--
-- Name: agendamento_ordem_servico fk_a9357bcf1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_ordem_servico
    ADD CONSTRAINT fk_a9357bcf1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id);


--
-- Name: entrada_produto_produto_saida fk_a9eaafd87991ff3; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto_produto_saida
    ADD CONSTRAINT fk_a9eaafd87991ff3 FOREIGN KEY (entrada_produto_id) REFERENCES public.entrada_produto(id) ON DELETE CASCADE;


--
-- Name: entrada_produto_produto_saida fk_a9eaafda0dcccd0; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.entrada_produto_produto_saida
    ADD CONSTRAINT fk_a9eaafda0dcccd0 FOREIGN KEY (produto_saida_id) REFERENCES public.produto_saida(id) ON DELETE CASCADE;


--
-- Name: orcamento_produto fk_aced428b8c2aa04c; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto
    ADD CONSTRAINT fk_aced428b8c2aa04c FOREIGN KEY (colaborador_id_autorizou_orcamento) REFERENCES public.colaborador(id);


--
-- Name: orcamento_produto fk_aced428bf1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto
    ADD CONSTRAINT fk_aced428bf1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id);


--
-- Name: orcamento_produto fk_aced428bf40b147f; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto
    ADD CONSTRAINT fk_aced428bf40b147f FOREIGN KEY (colaborador_id_enviou_orcamento) REFERENCES public.colaborador(id);


--
-- Name: fos_user_user_group fk_b3c77447a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fos_user_user_group
    ADD CONSTRAINT fk_b3c77447a76ed395 FOREIGN KEY (user_id) REFERENCES public.fos_user_user(id) ON DELETE CASCADE;


--
-- Name: fos_user_user_group fk_b3c77447fe54d947; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fos_user_user_group
    ADD CONSTRAINT fk_b3c77447fe54d947 FOREIGN KEY (group_id) REFERENCES public.fos_user_group(id) ON DELETE CASCADE;


--
-- Name: ordem_compra_produto fk_b484ddde8c2aa04c; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto
    ADD CONSTRAINT fk_b484ddde8c2aa04c FOREIGN KEY (colaborador_id_autorizou_orcamento) REFERENCES public.colaborador(id);


--
-- Name: ordem_compra_produto fk_b484dddea01cf1ca; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto
    ADD CONSTRAINT fk_b484dddea01cf1ca FOREIGN KEY (orcamento_id) REFERENCES public.orcamento_produto(id);


--
-- Name: ordem_compra_produto fk_b484ddded3ebb69d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto
    ADD CONSTRAINT fk_b484ddded3ebb69d FOREIGN KEY (fornecedor_id) REFERENCES public.fornecedor(id);


--
-- Name: ordem_compra_produto fk_b484dddef1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_compra_produto
    ADD CONSTRAINT fk_b484dddef1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id);


--
-- Name: documento fk_b6b12ec7f6939175; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.documento
    ADD CONSTRAINT fk_b6b12ec7f6939175 FOREIGN KEY (tipo_documento_id) REFERENCES public.tipo_documento(id);


--
-- Name: relatorio_ordem_servico fk_b6c47983c427592f; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_ordem_servico
    ADD CONSTRAINT fk_b6c47983c427592f FOREIGN KEY (agendamento_id) REFERENCES public.agendamento_ordem_servico(id);


--
-- Name: relatorio_ordem_servico fk_b6c47983f1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.relatorio_ordem_servico
    ADD CONSTRAINT fk_b6c47983f1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id);


--
-- Name: propriedade_equipamento fk_c06e7175e592c6ed; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.propriedade_equipamento
    ADD CONSTRAINT fk_c06e7175e592c6ed FOREIGN KEY (titulo_propriedade_equipamento_id) REFERENCES public.titulo_propriedade_equipamento(id);


--
-- Name: requisicao_produto fk_c1785dd03dca04d1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto
    ADD CONSTRAINT fk_c1785dd03dca04d1 FOREIGN KEY (os_id) REFERENCES public.ordem_servico(id);


--
-- Name: requisicao_produto fk_c1785dd0f1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.requisicao_produto
    ADD CONSTRAINT fk_c1785dd0f1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id);


--
-- Name: agendamento_manutencao_equipamento fk_c28f36e18cdc7a94; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_c28f36e18cdc7a94 FOREIGN KEY (titulo_agendamento_manutencao_equipamento_id) REFERENCES public.titulo_agendamento_manutencao_equipamento(id);


--
-- Name: agendamento_manutencao_equipamento fk_c28f36e1c06e7175; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.agendamento_manutencao_equipamento
    ADD CONSTRAINT fk_c28f36e1c06e7175 FOREIGN KEY (propriedade_equipamento) REFERENCES public.propriedade_equipamento(id);


--
-- Name: colaborador_documento fk_c6b3cae45c0cf75; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_documento
    ADD CONSTRAINT fk_c6b3cae45c0cf75 FOREIGN KEY (documento_id) REFERENCES public.documento(id) ON DELETE CASCADE;


--
-- Name: colaborador_documento fk_c6b3caef1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_documento
    ADD CONSTRAINT fk_c6b3caef1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id) ON DELETE CASCADE;


--
-- Name: classification__tag fk_ca57a1c7e25d857e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.classification__tag
    ADD CONSTRAINT fk_ca57a1c7e25d857e FOREIGN KEY (context) REFERENCES public.classification__context(id);


--
-- Name: posicao_tecnico fk_d062c751841db1e7; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.posicao_tecnico
    ADD CONSTRAINT fk_d062c751841db1e7 FOREIGN KEY (tecnico_id) REFERENCES public.colaborador(id);


--
-- Name: colaborador fk_d2f80bb3263e9cb2; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador
    ADD CONSTRAINT fk_d2f80bb3263e9cb2 FOREIGN KEY (funcao_id) REFERENCES public.funcao(id);


--
-- Name: colaborador fk_d2f80bb3a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador
    ADD CONSTRAINT fk_d2f80bb3a76ed395 FOREIGN KEY (user_id) REFERENCES public.fos_user_user(id);


--
-- Name: colaborador fk_d2f80bb3dbd30545; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador
    ADD CONSTRAINT fk_d2f80bb3dbd30545 FOREIGN KEY (grupo_usuario_id) REFERENCES public.fos_user_group(id);


--
-- Name: propriedade_equipamento_valor_propriedade_equipamento fk_d64cb9c66072fe47; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.propriedade_equipamento_valor_propriedade_equipamento
    ADD CONSTRAINT fk_d64cb9c66072fe47 FOREIGN KEY (valor_propriedade_equipamento_id) REFERENCES public.valor_propriedade_equipamento(id) ON DELETE CASCADE;


--
-- Name: propriedade_equipamento_valor_propriedade_equipamento fk_d64cb9c6a8556ba3; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.propriedade_equipamento_valor_propriedade_equipamento
    ADD CONSTRAINT fk_d64cb9c6a8556ba3 FOREIGN KEY (propriedade_equipamento_id) REFERENCES public.propriedade_equipamento(id) ON DELETE CASCADE;


--
-- Name: contato_telefone fk_e394d4a192d095a9; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contato_telefone
    ADD CONSTRAINT fk_e394d4a192d095a9 FOREIGN KEY (telefone_id) REFERENCES public.telefone(id) ON DELETE CASCADE;


--
-- Name: contato_telefone fk_e394d4a1b279be46; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contato_telefone
    ADD CONSTRAINT fk_e394d4a1b279be46 FOREIGN KEY (contato_id) REFERENCES public.contato(id) ON DELETE CASCADE;


--
-- Name: ordem_servico_colaborador fk_ec8aee894fb7c65a; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_colaborador
    ADD CONSTRAINT fk_ec8aee894fb7c65a FOREIGN KEY (ordem_servico_id) REFERENCES public.ordem_servico(id) ON DELETE CASCADE;


--
-- Name: ordem_servico_colaborador fk_ec8aee89f1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_colaborador
    ADD CONSTRAINT fk_ec8aee89f1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id) ON DELETE CASCADE;


--
-- Name: ordem_servico_foto_os fk_ef4635e14fb7c65a; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_foto_os
    ADD CONSTRAINT fk_ef4635e14fb7c65a FOREIGN KEY (ordem_servico_id) REFERENCES public.ordem_servico(id) ON DELETE CASCADE;


--
-- Name: ordem_servico_foto_os fk_ef4635e1ef7db8bc; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_foto_os
    ADD CONSTRAINT fk_ef4635e1ef7db8bc FOREIGN KEY (foto_os_id) REFERENCES public.foto_os(id) ON DELETE CASCADE;


--
-- Name: usuario_cliente_cliente fk_f01923902d4304f3; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_cliente_cliente
    ADD CONSTRAINT fk_f01923902d4304f3 FOREIGN KEY (usuario_cliente_id) REFERENCES public.usuario_cliente(id) ON DELETE CASCADE;


--
-- Name: usuario_cliente_cliente fk_f0192390de734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_cliente_cliente
    ADD CONSTRAINT fk_f0192390de734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id) ON DELETE CASCADE;


--
-- Name: colaborador_endereco fk_f2c4bafa1bb76823; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_endereco
    ADD CONSTRAINT fk_f2c4bafa1bb76823 FOREIGN KEY (endereco_id) REFERENCES public.endereco(id) ON DELETE CASCADE;


--
-- Name: colaborador_endereco fk_f2c4bafaf1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_endereco
    ADD CONSTRAINT fk_f2c4bafaf1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id) ON DELETE CASCADE;


--
-- Name: orcamento_produto_produto_solicitacao fk_f3aee7d897d582bf; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto_produto_solicitacao
    ADD CONSTRAINT fk_f3aee7d897d582bf FOREIGN KEY (orcamento_produto_id) REFERENCES public.orcamento_produto(id) ON DELETE CASCADE;


--
-- Name: orcamento_produto_produto_solicitacao fk_f3aee7d8af1d6ff6; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orcamento_produto_produto_solicitacao
    ADD CONSTRAINT fk_f3aee7d8af1d6ff6 FOREIGN KEY (produto_solicitacao_id) REFERENCES public.produto_solicitacao(id) ON DELETE CASCADE;


--
-- Name: cliente fk_f41c9b25299b2577; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT fk_f41c9b25299b2577 FOREIGN KEY (filial_id) REFERENCES public.filial_empresa(id);


--
-- Name: cliente fk_f41c9b255263402; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT fk_f41c9b255263402 FOREIGN KEY (facilities_id) REFERENCES public.cliente(id);


--
-- Name: cliente fk_f41c9b25ec019c67; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT fk_f41c9b25ec019c67 FOREIGN KEY (tipo_negocio_id) REFERENCES public.tipo_negocio(id);


--
-- Name: colaborador_filial_empresa fk_f7cae19c78ab74db; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_filial_empresa
    ADD CONSTRAINT fk_f7cae19c78ab74db FOREIGN KEY (filial_empresa_id) REFERENCES public.filial_empresa(id) ON DELETE CASCADE;


--
-- Name: colaborador_filial_empresa fk_f7cae19cf1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colaborador_filial_empresa
    ADD CONSTRAINT fk_f7cae19cf1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id) ON DELETE CASCADE;


--
-- Name: endereco fk_f8e0d60ea9276e6c; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT fk_f8e0d60ea9276e6c FOREIGN KEY (tipo_id) REFERENCES public.tipo_endereco(id);


--
-- Name: endereco fk_f8e0d60ea94ef08d; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT fk_f8e0d60ea94ef08d FOREIGN KEY (bairro_id) REFERENCES public.bairro(id);


--
-- Name: endereco fk_f8e0d60ede734e51; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT fk_f8e0d60ede734e51 FOREIGN KEY (cliente_id) REFERENCES public.cliente(id);


--
-- Name: endereco fk_f8e0d60ef1cb264e; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.endereco
    ADD CONSTRAINT fk_f8e0d60ef1cb264e FOREIGN KEY (colaborador_id) REFERENCES public.colaborador(id);


--
-- PostgreSQL database dump complete
--