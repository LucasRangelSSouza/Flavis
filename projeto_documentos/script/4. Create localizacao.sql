--
-- Name: ambiente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.localizacao (
    id integer NOT NULL,
    titulo character varying(150) COLLATE pg_catalog."default" NOT NULL,
    sigla character varying(5) COLLATE pg_catalog."default" NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    nome_perfil character varying(150) COLLATE pg_catalog."default" NOT NULL
);


--
-- Name: localizacao_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.localizacao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: localizacao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.localizacao_id_seq OWNED BY public.localizacao.id;


--
-- Name: localizacao id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.localizacao ALTER COLUMN id SET DEFAULT nextval('public.localizacao_id_seq'::regclass);


--
-- Name: localizacao localizacao_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.localizacao
    ADD CONSTRAINT localizacao_pkey PRIMARY KEY (id);


--
-- Name: localizacao idx_localizacao_nome_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_localizacao_nome_perfil ON public.localizacao USING btree (nome_perfil);


--
-- Name: localizacao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.localizacao_id_seq', (select max(id) from public.localizacao), true);


--
-- Name: localizacao id; Type: DEFAULT; Schema: public; Owner: -
--

--acl_security_identities (id)
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_LOCALIZACAO_ADMIN', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_LOCALIZACAO_EDITOR', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_LOCALIZACAO_STAFF', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_LOCALIZACAO_GUEST', false);

--acl_classes (id)
INSERT INTO public.acl_classes (id, class_type)
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Admin\LocalizacaoAdmin');

--acl_object_identities (id, null, class_id)
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), 'app.admin.localizacao', true);

--acl_object_identity_ancestors (object_identity_id, object_identity_id)
INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
VALUES ((select max(id) from public.acl_object_identities), (select max(id) from public.acl_object_identities));

--acl_entries (id, class_id, null, security_identity_id)
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 3 from public.acl_security_identities), NULL, 0, 64, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 2 from public.acl_security_identities), NULL, 1, 32, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) - 1 from public.acl_security_identities), NULL, 2, 4, true, 'all', false, false);
INSERT INTO public.acl_entries (id, class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure) 
VALUES ((select max(id) from public.acl_entries) + 1, (select max(id) from public.acl_classes), NULL, (select max(id) from public.acl_security_identities), NULL, 3, 1, true, 'all', false, false);

--acl_classes (id)
INSERT INTO public.acl_classes (id, class_type) 
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Entity\Localizacao');

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
