--
-- Name: empresa; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.empresa (
    id integer NOT NULL,
    cnpj character varying(30) NOT NULL,
    nome_fantasia character varying(155) DEFAULT NULL::character varying,
    razao_social character varying(155) NOT NULL,
    cnae character varying(10) DEFAULT NULL::character varying,
    email character varying(255) DEFAULT NULL::character varying,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
	pathfoto character varying(255) DEFAULT NULL::character varying
);


--
-- Name: empresa_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.empresa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: empresa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.empresa_id_seq OWNED BY public.empresa.id;


--
-- Name: empresa id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.empresa ALTER COLUMN id SET DEFAULT nextval('public.empresa_id_seq'::regclass);


--
-- Name: empresa empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.empresa
    ADD CONSTRAINT empresa_pkey PRIMARY KEY (id);


--
-- Name: idx_empresa_cnpj; Type: INDEX; Schema: public; Owner: -
--

--CREATE UNIQUE INDEX idx_empresa_cnpj --1º apresenta msg "Ops! Algo deu errado, verifique os campos" antes de validar na tela
CREATE INDEX idx_empresa_cnpj
    ON public.empresa USING btree
    (cnpj)
    TABLESPACE pg_default;


--
-- Name: idx_empresa_razao_social; Type: INDEX; Schema: public; Owner: -
-- Retirado o UNIQUE por que se excluir o registro, ele irar permanecer no banco logicamente.

--CREATE UNIQUE INDEX idx_empresa_razao_social
CREATE INDEX idx_empresa_razao_social
    ON public.empresa USING btree
    (razao_social)
    TABLESPACE pg_default;


--
-- Data for Name: empresa; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.empresa (id, cnpj, nome_fantasia, razao_social, cnae, email, created_at, updated_at, deleted_at) 
VALUES (1, '10625409000157', 'Empresa Flavis', 'Empresa Flavis', '4520-0/01', 'manutencao@flavis.com.br', '2019-06-19 08:30:36', NULL, NULL);


--
-- Name: empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.empresa_id_seq', (select max(id) from public.empresa), true);


--
-- Name: empresa id; Type: DEFAULT; Schema: public; Owner: -
--

--acl_security_identities (id)
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_EMPRESA_ADMIN', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_EMPRESA_EDITOR', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_EMPRESA_STAFF', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_EMPRESA_GUEST', false);

--acl_classes (id)
INSERT INTO public.acl_classes (id, class_type)
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Admin\EmpresaAdmin');

--acl_object_identities (id, null, class_id)
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), 'app.admin.empresa', true);

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
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Entity\Empresa');

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
