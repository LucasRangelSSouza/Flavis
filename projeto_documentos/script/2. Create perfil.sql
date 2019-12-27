--
-- Name: perfil; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.perfil (
    id integer NOT NULL,
    data_inicio timestamp(0) NOT NULL,
    data_termino timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    nome_perfil character varying(155) NOT NULL,
    logo_path_file character varying(255) DEFAULT NULL::character varying,
	banner_path_file character varying(255) DEFAULT NULL::character varying,
    email_manutencao character varying(255) DEFAULT NULL::character varying,
    email_agendamento character varying(255) DEFAULT NULL::character varying,
    email_solicitacao character varying(255) DEFAULT NULL::character varying,
    trial boolean DEFAULT false,
	driver character varying(255) DEFAULT NULL::character varying,
    server character varying(255) DEFAULT NULL::character varying,
    porta integer DEFAULT NULL::integer,
    dbname character varying(255) DEFAULT NULL::character varying,
    username character varying(255) DEFAULT NULL::character varying,
    password character varying(255) DEFAULT NULL::character varying,
    empresa_id integer NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


--
-- Name: perfil_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.perfil_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: perfil_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.perfil_id_seq OWNED BY public.perfil.id;


--
-- Name: perfil id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.perfil ALTER COLUMN id SET DEFAULT nextval('public.perfil_id_seq'::regclass);


--
-- Name: perfil perfil_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.perfil
    ADD CONSTRAINT perfil_pkey PRIMARY KEY (id);


--
-- Name: idx_perfil_nome_perfil; Type: INDEX; Schema: public; Owner: -
-- Retirado o UNIQUE por que se excluir o registro, ele irar permanecer no banco logicamente.

CREATE UNIQUE INDEX idx_perfil_nome_perfil
    ON public.perfil USING btree
    (nome_perfil)
    TABLESPACE pg_default;


--
-- Name: perfil idx_perfil_empresa; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_perfil_empresa ON public.perfil USING btree (empresa_id);


--
-- Data for Name: perfil; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.perfil (id, data_inicio, data_termino, nome_perfil, logo_path_file, banner_path_file, email_manutencao, email_agendamento, email_solicitacao, trial, driver, server, porta, dbname, username, password, empresa_id, created_at, updated_at, deleted_at) 
VALUES (1, '2019-06-19 08:30:36', '2029-06-19 08:30:36', 'flavis', '/bundles/app/img/logo_app.png', '/bundles/app/img/logo_app.png', 'manutencao@flavis.com.br', 'agendamento@flavis.com.br', 'solicitacao@flavis.com.br', true, 'pdo_pgsql', 'localhost', 5432, 'flavis_prod', 'postgres', 'admin', 1, '2019-06-19 08:30:36', NULL, NULL);

INSERT INTO public.perfil (id, data_inicio, data_termino, nome_perfil, logo_path_file, banner_path_file, email_manutencao, email_agendamento, email_solicitacao, trial, driver, server, porta, dbname, username, password, empresa_id, created_at, updated_at, deleted_at) 
VALUES (2, '2019-06-19 08:30:36', '2029-06-19 08:30:36', 'suporte', '/bundles/app/img/logo_app.png', '/bundles/app/img/logo_app.png', 'stisuporte@sistemafieg.org.br', 'stisuporte@sistemafieg.org.br', 'stisuporte@sistemafieg.org.br', true, 'pdo_pgsql', 'localhost', 5432, 'flavis_trial', 'postgres', 'admin', 1, '2019-06-19 08:30:36', NULL, NULL);

--
-- Name: perfil_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.perfil_id_seq', (select max(id) from public.perfil), true);


--
-- Name: perfil id; Type: DEFAULT; Schema: public; Owner: -
--

--acl_security_identities (id)
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_PERFIL_ADMIN', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_PERFIL_EDITOR', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_PERFIL_STAFF', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_PERFIL_GUEST', false);

--acl_classes (id)
INSERT INTO public.acl_classes (id, class_type)
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Admin\PerfilAdmin');

--acl_object_identities (id, null, class_id)
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), 'app.admin.perfil', true);

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
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Entity\Perfil');

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
-- Name: perfil fk_perfil_empresa; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.perfil
    ADD CONSTRAINT fk_perfil_empresa FOREIGN KEY (empresa_id) REFERENCES public.empresa(id);


--
-- Name: perfil fk_ambiente_nome_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ambiente
    ADD CONSTRAINT fk_ambiente_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);


--
-- Name: perfil fk_grupo_equipamento_nome_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.grupo_equipamento
    ADD CONSTRAINT fk_grupo_equipamento_nome_perfil FOREIGN KEY (nome_perfil) REFERENCES public.perfil(nome_perfil);