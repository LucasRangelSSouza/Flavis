--
-- Name: ambiente; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.ambiente (
    id integer NOT NULL,
    titulo character varying(150) COLLATE pg_catalog."default" NOT NULL,
    area numeric(12,2) DEFAULT NULL::numeric,
    ocupante_fixo integer,
    ocupante_flutuante integer,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    nome_perfil character varying(150) COLLATE pg_catalog."default" NOT NULL
);


--
-- Name: ambiente_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ambiente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ambiente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ambiente_id_seq OWNED BY public.ambiente.id;


--
-- Name: ambiente id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ambiente ALTER COLUMN id SET DEFAULT nextval('public.ambiente_id_seq'::regclass);


--
-- Name: ambiente ambiente_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.ambiente
    ADD CONSTRAINT ambiente_pkey PRIMARY KEY (id);


--
-- Name: ambiente idx_ambiente_nome_perfil; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX idx_ambiente_nome_perfil ON public.ambiente USING btree (nome_perfil);


--
-- Name: ambiente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.ambiente_id_seq', (select max(id) from public.ambiente), true);


--
-- Name: ambiente id; Type: DEFAULT; Schema: public; Owner: -
--

--acl_security_identities (id)
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_AMBIENTE_ADMIN', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_AMBIENTE_EDITOR', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_AMBIENTE_STAFF', false);
INSERT INTO public.acl_security_identities (id, identifier, username) 
VALUES ((select max(id) from public.acl_security_identities) + 1, 'ROLE_APP_ADMIN_AMBIENTE_GUEST', false);

--acl_classes (id)
INSERT INTO public.acl_classes (id, class_type)
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Admin\AmbienteAdmin');

--acl_object_identities (id, null, class_id)
INSERT INTO public.acl_object_identities (id, parent_object_identity_id, class_id, object_identifier, entries_inheriting) 
VALUES ((select max(id) from public.acl_object_identities) + 1, NULL, (select max(id) from public.acl_classes), 'app.admin.ambiente', true);

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
VALUES ((select max(id) from public.acl_classes) + 1, 'AppBundle\Entity\Ambiente');

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
