
	
-- Table: public.ordem_servico_log

-- DROP TABLE public.ordem_servico_log;

CREATE TABLE public.ordem_servico_log
(
    id_LOG integer NOT NULL,
	DATA_LOG timestamp(0) without time zone NOT NULL,
	OPERACAO_LOG character varying(15) COLLATE pg_catalog."default" NOT NULL,
	USER_LOG character varying(150) COLLATE pg_catalog."default" NOT NULL,
	HOST_LOG character varying(150) COLLATE pg_catalog."default" NOT NULL,
	APLICACAO_LOG character varying(150) COLLATE pg_catalog."default" DEFAULT NULL::character varying,
	OBSERVACAO_LOG character varying(500) COLLATE pg_catalog."default" DEFAULT NULL::character varying,
    id integer NOT NULL,
    cliente_id integer NOT NULL,
    colaborador_solicitante_id integer NOT NULL,
    colaborador_avalista_id integer,
    colaborador_executor_id integer NOT NULL,
    nome_receptor character varying(45) COLLATE pg_catalog."default" DEFAULT NULL::character varying,
    rg_receptor character varying(45) COLLATE pg_catalog."default" DEFAULT NULL::character varying,
    relatorio_avaliacao text COLLATE pg_catalog."default",
    dataagendada timestamp(0) without time zone NOT NULL,
    horaagendada time(0) without time zone NOT NULL,
    ocorrencia text COLLATE pg_catalog."default" NOT NULL,
    isencerrada boolean DEFAULT false,
    is_homologada boolean DEFAULT false,
    justificativa_encerramento text COLLATE pg_catalog."default",
    observacao text COLLATE pg_catalog."default",
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    endereco_id integer,
    solicitante character varying(255) COLLATE pg_catalog."default" DEFAULT NULL::character varying,
    os_original_id integer,
    is_pmoc boolean DEFAULT false,
    is_sync boolean DEFAULT false,
    receptorassinatura text COLLATE pg_catalog."default",
    is_cancelada boolean DEFAULT false,
    engenheiro_id integer,
    norma_id integer,
    motivo_cancelamento text COLLATE pg_catalog."default",
    data_abertura timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    data_encerramento timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    indice_relatorio text COLLATE pg_catalog."default",
    resumo_relatorio text COLLATE pg_catalog."default",
    pathfoto character varying(255) COLLATE pg_catalog."default" DEFAULT NULL::character varying,
    nome_perfil character varying(150) COLLATE pg_catalog."default" NOT NULL,
	status character varying(50),
	prioridade character varying(50)
);


--
-- Name: ordem_servico_log_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ordem_servico_log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ordem_servico_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ordem_servico_log_id_seq OWNED BY public.ordem_servico_log.id_log;


--
-- Name: ordem_servico_log id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_log ALTER COLUMN id_log SET DEFAULT nextval('public.ordem_servico_log_id_seq'::regclass);


--
-- Name: ordem_servico_log ordem_servico_log_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_log
    ADD CONSTRAINT ordem_servico_log_pkey PRIMARY KEY (id_LOG);

-- Index: idx_ordem_servico_endereco

-- DROP INDEX public.idx_ordem_servico_endereco;

CREATE INDEX idx_ordem_servico_log_endereco
    ON public.ordem_servico_log USING btree
    (endereco_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_os_original

-- DROP INDEX public.idx_ordem_servico_log_os_original;

CREATE INDEX idx_ordem_servico_log_os_original
    ON public.ordem_servico_log USING btree
    (os_original_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_engenheiro

-- DROP INDEX public.idx_ordem_servico_log_engenheiro;

CREATE INDEX idx_ordem_servico_log_engenheiro
    ON public.ordem_servico_log USING btree
    (engenheiro_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_executor

-- DROP INDEX public.idx_ordem_servico_log_executor;

CREATE INDEX idx_ordem_servico_log_executor
    ON public.ordem_servico_log USING btree
    (colaborador_executor_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_cliente

-- DROP INDEX public.idx_ordem_servico_log_cliente;

CREATE INDEX idx_ordem_servico_log_cliente
    ON public.ordem_servico_log USING btree
    (cliente_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_norma

-- DROP INDEX public.idx_ordem_servico_log_norma;

CREATE INDEX idx_ordem_servico_log_norma
    ON public.ordem_servico_log USING btree
    (norma_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_avalista

-- DROP INDEX public.idx_ordem_servico_log_avalista;

CREATE INDEX idx_ordem_servico_log_avalista
    ON public.ordem_servico_log USING btree
    (colaborador_avalista_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_solicitante

-- DROP INDEX public.idx_ordem_servico_log_solicitante;

CREATE INDEX idx_ordem_servico_log_solicitante
    ON public.ordem_servico_log USING btree
    (colaborador_solicitante_id)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_perfil

-- DROP INDEX public.idx_ordem_servico_log_perfil;

CREATE INDEX idx_ordem_servico_log_perfil
    ON public.ordem_servico_log USING btree
    (nome_perfil)
    TABLESPACE pg_default;

-- Index: idx_ordem_servico_log_DATA_LOG

-- DROP INDEX public.idx_ordem_servico_log_DATA_LOG;

CREATE INDEX idx_ordem_servico_log_DATA_LOG
    ON public.ordem_servico_log USING btree
    (DATA_LOG)
    TABLESPACE pg_default;


--
-- Name: acl_classes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.ordem_servico_log_id_seq', (select max(id_LOG) from public.ordem_servico_log), true);


-- Function: function_ordem_servico_log

-- DROP FUNCTION function_ordem_servico_log ON public.ordem_servico;

/********************************************************************************************************
 Incluir - 25/06/2019 - Vinícius Augusto Marques - Gerar o LOG da tabela.
 Alterar - __/__/____ - Nome responsavel pela alteração - Alteração
********************************************************************************************************/
CREATE OR REPLACE FUNCTION function_ordem_servico_log()
RETURNS trigger AS $BODY$
BEGIN
	-- Aqui temos um bloco IF que confirmará o tipo de operação.
	IF (TG_OP = 'INSERT') THEN
		INSERT INTO ordem_servico_log 
				(data_log, operacao_log, user_log, host_log, aplicacao_log, observacao_log, id, cliente_id, colaborador_solicitante_id, colaborador_avalista_id, colaborador_executor_id, nome_receptor, rg_receptor, relatorio_avaliacao, dataagendada, horaagendada, ocorrencia, isencerrada, is_homologada, justificativa_encerramento, observacao, created_at, updated_at, deleted_at, endereco_id, solicitante, os_original_id, is_pmoc, is_sync, receptorassinatura, is_cancelada, engenheiro_id, norma_id, motivo_cancelamento, data_abertura, data_encerramento, indice_relatorio, resumo_relatorio, pathfoto, status, prioridade, nome_perfil)
		VALUES (current_timestamp, TG_OP, current_user, inet_client_addr(), 'Flavis PHP', ' Operação de ' || TG_OP || '. A linha de código ' || NEW.id || 'foi inserido.',
				NEW.id, NEW.cliente_id, NEW.colaborador_solicitante_id, NEW.colaborador_avalista_id, NEW.colaborador_executor_id, NEW.nome_receptor, 
				NEW.rg_receptor, NEW.relatorio_avaliacao, NEW.dataagendada, NEW.horaagendada, NEW.ocorrencia, NEW.isencerrada, NEW.is_homologada, 
				NEW.justificativa_encerramento, NEW.observacao, NEW.created_at, NEW.updated_at, NEW.deleted_at, NEW.endereco_id, NEW.solicitante, 
				NEW.os_original_id, NEW.is_pmoc, NEW.is_sync, NEW.receptorassinatura, NEW.is_cancelada, NEW.engenheiro_id, NEW.norma_id, 
				NEW.motivo_cancelamento, NEW.data_abertura, NEW.data_encerramento, NEW.indice_relatorio, NEW.resumo_relatorio, NEW.pathfoto, 
				NEW.status, NEW.prioridade, NEW.nome_perfil);
		RETURN NEW;
	-- Aqui temos um bloco IF que confirmará o tipo de Operação UPDATE.
	ELSIF (TG_OP = 'UPDATE') AND (
		(NEW.isencerrada <> OLD.isencerrada) OR 
		(NEW.is_homologada <> OLD.is_homologada) OR 
		(NEW.is_cancelada <> OLD.is_cancelada) OR 
		(NEW.status <> OLD.status) OR 
		(NEW.prioridade <> OLD.prioridade)) THEN
		INSERT INTO ordem_servico_log 
				(data_log, operacao_log, user_log, host_log, aplicacao_log, observacao_log, id, cliente_id, colaborador_solicitante_id, colaborador_avalista_id, colaborador_executor_id, nome_receptor, rg_receptor, relatorio_avaliacao, dataagendada, horaagendada, ocorrencia, isencerrada, is_homologada, justificativa_encerramento, observacao, created_at, updated_at, deleted_at, endereco_id, solicitante, os_original_id, is_pmoc, is_sync, receptorassinatura, is_cancelada, engenheiro_id, norma_id, motivo_cancelamento, data_abertura, data_encerramento, indice_relatorio, resumo_relatorio, pathfoto, status, prioridade, nome_perfil)
		VALUES (current_timestamp, TG_OP, current_user, inet_client_addr(), 'Flavis PHP', 'Operação de ' || TG_OP || '. A linha de código ' || NEW.id || ' teve os valores atualizados ' || OLD || ' com ' || NEW.* || '.',
				NEW.id, NEW.cliente_id, NEW.colaborador_solicitante_id, NEW.colaborador_avalista_id, NEW.colaborador_executor_id, NEW.nome_receptor, 
				NEW.rg_receptor, NEW.relatorio_avaliacao, NEW.dataagendada, NEW.horaagendada, NEW.ocorrencia, NEW.isencerrada, NEW.is_homologada, 
				NEW.justificativa_encerramento, NEW.observacao, NEW.created_at, NEW.updated_at, NEW.deleted_at, NEW.endereco_id, NEW.solicitante, 
				NEW.os_original_id, NEW.is_pmoc, NEW.is_sync, NEW.receptorassinatura, NEW.is_cancelada, NEW.engenheiro_id, NEW.norma_id, 
				NEW.motivo_cancelamento, NEW.data_abertura, NEW.data_encerramento, NEW.indice_relatorio, NEW.resumo_relatorio, NEW.pathfoto, 
				NEW.status, NEW.prioridade, NEW.nome_perfil);
		RETURN NEW;
	-- Aqui temos um bloco IF que confirmará o tipo de Operação DELETE
	ELSIF (TG_OP = 'DELETE') THEN
		INSERT INTO ordem_servico_log 
				(data_log, operacao_log, user_log, host_log, aplicacao_log, observacao_log, id, cliente_id, colaborador_solicitante_id, colaborador_avalista_id, colaborador_executor_id, nome_receptor, rg_receptor, relatorio_avaliacao, dataagendada, horaagendada, ocorrencia, isencerrada, is_homologada, justificativa_encerramento, observacao, created_at, updated_at, deleted_at, endereco_id, solicitante, os_original_id, is_pmoc, is_sync, receptorassinatura, is_cancelada, engenheiro_id, norma_id, motivo_cancelamento, data_abertura, data_encerramento, indice_relatorio, resumo_relatorio, pathfoto, status, prioridade, nome_perfil)
		VALUES (current_timestamp, TG_OP, current_user, inet_client_addr(), 'Flavis PHP', 'Operação ' || TG_OP || '. A linha de código ' || OLD.codigo || ' foi exclusão.',
				OLD.id, OLD.cliente_id, OLD.colaborador_solicitante_id, OLD.colaborador_avalista_id, OLD.colaborador_executor_id, OLD.nome_receptor, 
				OLD.rg_receptor, OLD.relatorio_avaliacao, OLD.dataagendada, OLD.horaagendada, OLD.ocorrencia, OLD.isencerrada, OLD.is_homologada, 
				OLD.justificativa_encerramento, OLD.observacao, OLD.created_at, OLD.updated_at, OLD.deleted_at, OLD.endereco_id, OLD.solicitante, 
				OLD.os_original_id, OLD.is_pmoc, OLD.is_sync, OLD.receptorassinatura, OLD.is_cancelada, OLD.engenheiro_id, OLD.norma_id, 
				OLD.motivo_cancelamento, OLD.data_abertura, OLD.data_encerramento, OLD.indice_relatorio, OLD.resumo_relatorio, OLD.pathfoto, 
				OLD.status, OLD.prioridade, OLD.nome_perfil);
		RETURN OLD;
	END IF;
	
	RETURN NULL;
END;
$BODY$ LANGUAGE plpgsql;


-- Trigger: trigger_ordem_servico_log_todas_as_operacoes

-- DROP TRIGGER trigger_ordem_servico_log_todas_as_operacoes ON public.ordem_servico;

CREATE TRIGGER trigger_ordem_servico_log
	AFTER INSERT OR UPDATE OR DELETE 
	ON ordem_servico
	FOR EACH ROW
	EXECUTE PROCEDURE function_ordem_servico_log();


--INSERT INTO ordem_servico_log 
--	(data_log, operacao_log, user_log, host_log, aplicacao_log, observacao_log, id, cliente_id, colaborador_solicitante_id, colaborador_avalista_id, colaborador_executor_id, nome_receptor, rg_receptor, relatorio_avaliacao, dataagendada, horaagendada, ocorrencia, isencerrada, is_homologada, justificativa_encerramento, observacao, created_at, updated_at, deleted_at, endereco_id, solicitante, os_original_id, is_pmoc, is_sync, receptorassinatura, is_cancelada, engenheiro_id, norma_id, motivo_cancelamento, data_abertura, data_encerramento, indice_relatorio, resumo_relatorio, pathfoto, status, prioridade, nome_perfil)
--SELECT current_timestamp, 'INSERT', current_user, 'servidorPHP', 'Flavis', ' Operação de INSERT. A linha de código ' || id || 'foi inserido.',
--		id, cliente_id, colaborador_solicitante_id, colaborador_avalista_id, colaborador_executor_id, nome_receptor, 
--		rg_receptor, relatorio_avaliacao, dataagendada, horaagendada, ocorrencia, isencerrada, is_homologada, 
--		justificativa_encerramento, observacao, created_at, updated_at, deleted_at, endereco_id, solicitante, 
--		os_original_id, is_pmoc, is_sync, receptorassinatura, is_cancelada, engenheiro_id, norma_id, 
--		motivo_cancelamento, data_abertura, data_encerramento, indice_relatorio, resumo_relatorio, pathfoto, 
--		status, prioridade, nome_perfil
--  FROM ordem_servico;


--
-- Name: ordem_servico_log id; Type: DEFAULT; Schema: public; Owner: -
--

--acl_security_identities (id)
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_ORDEM_SERVICO_LOG_ADMIN', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_ORDEM_SERVICO_LOG_EDITOR', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_ORDEM_SERVICO_LOG_STAFF', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_ORDEM_SERVICO_LOG_GUEST', false);

--acl_classes (id)
INSERT INTO public.acl_classes (id, class_type)
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Admin\OrdemServicoLogAdmin');

--acl_object_identities (id, null, class_id)
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), 'app.admin.ordem_servico_log', true);

--acl_object_identity_ancestors (object_identity_id, object_identity_id)
INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
VALUES ((select max(id) from public.acl_object_identities), (select max(id) from public.acl_object_identities));

--acl_entries (id, class_id, null, security_identity_id)
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 3 from public.acl_security_identities), NULL, 0, 64, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 2 from public.acl_security_identities), NULL, 1, 8224, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 1 from public.acl_security_identities), NULL, 2, 4098, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) from public.acl_security_identities), NULL, 3, 4096, true, 'all', false, false);

--acl_classes (id)
INSERT INTO public.acl_classes (id, class_type) 
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Entity\OrdemServicoLog');

--acl_object_identities (id, null, class_id)
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), '1', true);
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), '2', true);
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), '3', true);
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), '4', true);
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), '5', true);

--acl_object_identity_ancestors (object_identity_id, object_identity_id)
INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
VALUES ((select max(id) - 4 from public.acl_object_identities), (select max(id) - 4 from public.acl_object_identities));
INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
VALUES ((select max(id) - 3 from public.acl_object_identities), (select max(id) - 3 from public.acl_object_identities));
INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
VALUES ((select max(id) - 2 from public.acl_object_identities), (select max(id) - 2 from public.acl_object_identities));
INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
VALUES ((select max(id) - 1 from public.acl_object_identities), (select max(id) - 1 from public.acl_object_identities));
INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
VALUES ((select max(id) from public.acl_object_identities), (select max(id) from public.acl_object_identities));

--acl_entries (id, class_id, object_identity_id, security_identity_id)
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 3 from public.acl_security_identities), NULL, 0, 64, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 2 from public.acl_security_identities), NULL, 1, 32, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 1 from public.acl_security_identities), NULL, 2, 4, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) from public.acl_security_identities), NULL, 3, 1, true, 'all', false, false);

INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), (select max(id) - 4 from public.acl_object_identities), 125, NULL, 0, 128, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), (select max(id) - 3 from public.acl_object_identities), 126, NULL, 0, 128, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), (select max(id) - 2 from public.acl_object_identities), 126, NULL, 0, 128, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), (select max(id) - 1 from public.acl_object_identities), 126, NULL, 0, 128, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), (select max(id) from public.acl_object_identities), 220, NULL, 0, 128, true, 'all', false, false);


--
-- Name: acl_classes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.acl_classes_id_seq', (select max(id) from public.acl_classes), true);


--
-- Name: acl_object_identities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.acl_object_identities_id_seq', (select max(id) from public.acl_object_identities), true);


--
-- Name: acl_security_identities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.acl_security_identities_id_seq', (select max(id) from public.acl_security_identities), true);


--
-- Name: acl_entries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.acl_entries_id_seq', (select max(id) from public.acl_entries), true);


--******************************************************************************************************


--
-- Name: perfil idx_ordem_servico_log_ordem_servico; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ordem_servico_log_ordem_servico ON public.ordem_servico_log USING btree (id);


--
-- Name: ordem_servico_log fk_ordem_servico_log_ordem_servico; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ordem_servico_log
    ADD CONSTRAINT fk_ordem_servico_log_ordem_servico FOREIGN KEY (id) REFERENCES public.ordem_servico(id);