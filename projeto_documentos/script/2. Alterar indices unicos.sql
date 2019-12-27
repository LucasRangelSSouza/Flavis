--
-- PostgreSQL database dump
--

--
-- Name: tag_collection; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX tag_collection ON public.classification__collection USING btree (slug, context);
--DROP INDEX public.tag_collection;
--CREATE INDEX idx_classification__collection_slug
--    ON public.classification__collection USING btree
--    (slug, context)
--    TABLESPACE pg_default;


--
-- Name: tag_context; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX tag_context ON public.classification__tag USING btree (slug, context);
--DROP INDEX public.tag_context;
--CREATE INDEX idx_classification__tag_slug
--    ON public.classification__tag USING btree
--    (slug, context)
--    TABLESPACE pg_default;


--
-- Name: uniq_3ef6217e801b7d4b; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX uniq_3ef6217e801b7d4b ON public.norma USING btree (sigla);
DROP INDEX public.uniq_3ef6217e801b7d4b;
--CREATE UNIQUE INDEX idx_norma_sigla
--    ON public.norma USING btree
--    (sigla)
--    TABLESPACE pg_default;
--Um erro ocorreu durante a criação do item "Um erro ocorreu durante a criação do item". => Erro vindo do banco do campo da tabela
--Um erro ocorreu durante a criação do item "ABNT". => Erro vindo do sistema do arquivo de entidade

--
-- Name: uniq_3ef6217ef55ae19e; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX uniq_3ef6217ef55ae19e ON public.norma USING btree (numero);
DROP INDEX public.uniq_3ef6217ef55ae19e;
--CREATE UNIQUE INDEX idx_norma_numero
--    ON public.norma USING btree
--    (numero)
--    TABLESPACE pg_default;


--
-- Name: uniq_46c8b806ea000b103d9ab4a64def17bce4289bf4; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_46c8b806ea000b103d9ab4a64def17bce4289bf4 ON public.acl_entries USING btree (class_id, object_identity_id, field_name, ace_order);
--DROP INDEX public.uniq_46c8b806ea000b103d9ab4a64def17bce4289bf4;
--CREATE INDEX idx_acl_entries_class_id
--    ON public.acl_entries USING btree
--    (class_id, object_identity_id, field_name, ace_order)
--    TABLESPACE pg_default;


--
-- Name: uniq_583d1f3e5e237e06; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_583d1f3e5e237e06 ON public.fos_user_group USING btree (name);
--DROP INDEX public.uniq_583d1f3e5e237e06;
--CREATE INDEX idx_fos_user_group_name
--    ON public.fos_user_group USING btree
--    (name)
--    TABLESPACE pg_default;


--
-- Name: idx_tipo_documento_nome; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX idx_tipo_documento_nome
  --  ON public.tipo_documento USING btree
--(nome)
 --   TABLESPACE pg_default;


--
-- Name: idx_tipo_endereco_nome; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX idx_tipo_endereco_nome
  --  ON public.tipo_endereco USING btree
    --(nome)
   -- TABLESPACE pg_default;


--
-- Name: uniq_66d1c2d954bd530c; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_66d1c2d954bd530c ON public.tipo_negocio USING btree (nome);
DROP INDEX public.uniq_66d1c2d954bd530c;
--CREATE UNIQUE INDEX idx_tipo_negocio_nome
--    ON public.tipo_negocio USING btree
--    (nome)
--    TABLESPACE pg_default;


--
-- Name: uniq_688b5eb017713e5a; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX uniq_688b5eb017713e5a ON public.ficha_tecnica_produto USING btree (titulo);
DROP INDEX public.uniq_688b5eb017713e5a;
--CREATE INDEX idx_ficha_tecnica_produto_titulo
--    ON public.ficha_tecnica_produto USING btree
--    (titulo)
--    TABLESPACE pg_default;

--
-- Name: uniq_69dd750638a36066; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_69dd750638a36066 ON public.acl_classes USING btree (class_type);
--DROP INDEX public.uniq_69dd750638a36066;
--CREATE INDEX idx_acl_classes_class_type
--    ON public.acl_classes USING btree
--    (class_type)
--    TABLESPACE pg_default;


--
-- Name: uniq_6edef13d54bd530c; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_6edef13d54bd530c ON public.funcao USING btree (nome);
--DROP INDEX public.uniq_6edef13d54bd530c;
--CREATE INDEX idx_funcao_nome
--    ON public.funcao USING btree
--    (nome)
--    TABLESPACE pg_default;


--
-- Name: uniq_8835ee78772e836af85e0677; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_8835ee78772e836af85e0677 ON public.acl_security_identities USING btree (identifier, username);
--DROP INDEX public.uniq_8835ee78772e836af85e0677;
--CREATE INDEX idx_acl_security_identities_identifier
--    ON public.acl_security_identities USING btree
--    (identifier, username)
--    TABLESPACE pg_default;


--
-- Name: uniq_8d3a3162a76ed395; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_8d3a3162a76ed395 ON public.usuario_cliente USING btree (user_id);
DROP INDEX public.uniq_8d3a3162a76ed395;
--CREATE INDEX idx_usuario_cliente_user_id
--    ON public.usuario_cliente USING btree
--    (user_id)
--    TABLESPACE pg_default;


--
-- Name: uniq_9407e5494b12ad6ea000b10; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_9407e5494b12ad6ea000b10 ON public.acl_object_identities USING btree (object_identifier, class_id);
--DROP INDEX public.uniq_9407e5494b12ad6ea000b10;
--CREATE INDEX idx_acl_object_identities_object_identifier
--    ON public.acl_object_identities USING btree
--    (object_identifier)
--    TABLESPACE pg_default;


--
-- Name: uniq_a64a0d0e54bd530c; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX uniq_a64a0d0e54bd530c ON public.responsavel_cliente USING btree (nome);
--DROP INDEX public.uniq_a64a0d0e54bd530c;
--CREATE INDEX idx_responsavel_cliente_nome
--    ON public.responsavel_cliente USING btree
--    (nome)
--    TABLESPACE pg_default;

--
-- Name: uniq_c560d76192fc23a8; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_c560d76192fc23a8 ON public.fos_user_user USING btree (username_canonical);
DROP INDEX public.uniq_c560d76192fc23a8;
--CREATE INDEX idx_fos_user_user_username_canonical
--    ON public.fos_user_user USING btree
--    (username_canonical)
--    TABLESPACE pg_default;


--
-- Name: uniq_c560d761a0d96fbf; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_c560d761a0d96fbf ON public.fos_user_user USING btree (email_canonical);
DROP INDEX public.uniq_c560d761a0d96fbf;
--CREATE INDEX idx_fos_user_user_email_canonical
--    ON public.fos_user_user USING btree
--    (email_canonical)
--    TABLESPACE pg_default;


--
-- Name: uniq_d2f80bb33e3e11f0; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX uniq_d2f80bb33e3e11f0 ON public.colaborador USING btree (cpf);
DROP INDEX public.uniq_d2f80bb33e3e11f0;
--CREATE INDEX idx_colaborador_cpf
--    ON public.colaborador USING btree
--    (cpf)
--    TABLESPACE pg_default;


--
-- Name: uniq_d2f80bb3a76ed395; Type: INDEX; Schema: public; Owner: -
--

----CREATE UNIQUE INDEX uniq_d2f80bb3a76ed395 ON public.colaborador USING btree (user_id);
DROP INDEX public.uniq_d2f80bb3a76ed395;
--CREATE INDEX idx_colaborador_user
--    ON public.colaborador USING btree
--    (user_id)
--    TABLESPACE pg_default;


--
-- Name: uniq_f41c9b255a425330; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX uniq_f41c9b255a425330 ON public.cliente USING btree (cpf_cnpj);
DROP INDEX public.uniq_f41c9b255a425330;
--CREATE INDEX idx_cliente_cpf_cnpj
--    ON public.cliente USING btree
--    (cpf_cnpj)
--    TABLESPACE pg_default;
--Um erro ocorreu durante a criação do item "-".


--
-- Name: uniq_f7f7b9a854bd530c; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX uniq_f7f7b9a854bd530c ON public.tipo_telefone USING btree (nome);
--DROP INDEX public.uniq_f7f7b9a854bd530c;
--CREATE INDEX idx_tipo_telefone_nome
--    ON public.tipo_telefone USING btree
--    (nome)
--    TABLESPACE pg_default;

--
-- PostgreSQL database dump complete
--