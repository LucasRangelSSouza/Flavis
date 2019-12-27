--
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, api_token, user_token, device_type) VALUES (2, 'marconi@flavis.com.br', 'marconi@flavis.com.br', 'marconi@flavis.com.br', 'marconi@flavis.com.br', true, 'co02nisajw8wsoo4kgk4kw4g04cckwk', 'oGdgwRi3rV8Iqo2aQB5dbupLHt5MHqg2GUc5IAbq7npiUXg0VK1uJj6oM0QpD8Mp+I5cz8jPRElOTbgr34JKOA==', '2019-03-21 18:34:22', false, false, NULL, NULL, NULL, 'a:6:{i:0;s:10:"ROLE_ADMIN";i:1;s:17:"ROLE_SONATA_ADMIN";i:2;s:16:"ROLE_SUPER_ADMIN";i:3;s:22:"ROLE_ALLOWED_TO_SWITCH";i:4;s:24:"ROLE_GERENTE_OS_HOMOLOGA";i:5;s:15:"ROLE_GERENTE_OS";}', false, NULL, '9FqHzr550jkI9GGjQiwIHvIkhFwcALESGkyk-bjjsPE', NULL, NULL);


--
-- Name: fos_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.fos_user_user_id_seq', (select max(id) from public.fos_user_user), true);


--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.fos_user_user_group (user_id, group_id) VALUES (2, 2);


--
-- Data for Name: colaborador; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador (id, funcao_id, user_id, tipo_colaborador, nome, email, sexo, data_nascimento, cpf, rg, estado_civil, data_admissao, data_recisao, formacao, nivel_escolaridade, banco_conta, banco_agencia, banco_nome, banco_ccorrente, horario_entrada, horario_saida, intervalo_almoco, status, created_at, updated_at, deleted_at, cra, pathfoto, grupo_usuario_id, artigo_crea) VALUES (1, 5, 2, 'F', 'Marconi  de Lima de Flavis', 'marconi@flavis.com.br', 'M', '1981-02-16', '21455986852', '123456', 'CA', '2010-01-01', NULL, NULL, 'superior', '341', '2903', 'ITAU', '17505-3', '08:00:00', '19:00:00', NULL, 'AT', '2016-11-09 09:11:33', '2018-08-01 16:02:24', NULL, '123456', NULL, 2, NULL);


--
-- Name: colaborador_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.colaborador_id_seq', (select max(id) from public.colaborador), true);


--
-- Data for Name: documento; Type: TABLE DATA; Schema: public; Owner: -
-- 

INSERT INTO public.documento (id, tipo_documento_id, titulo, data_emissao, data_validade, path_file, observacoes, created_at, updated_at, deleted_at) VALUES (3, 1, 'HABILITAÇÃO', '1999-04-29 00:00:00', '2020-06-15 00:00:00', 'uploads/documentos-admin/6209a897f56ff855afc05cacc0c22de500902ef2.pdf', NULL, '2016-11-21 16:09:32', '2016-11-21 16:09:32', NULL);


--
-- Name: documento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.documento_id_seq', (select max(id) from public.documento), true);



--
-- Data for Name: colaborador_documento; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_documento (colaborador_id, documento_id) VALUES (1, 3);


--
-- Data for Name: endereco; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.endereco (id, tipo_id, bairro_id, logradouro, numero, cep, complemento, referencia, observacao, cliente_id, colaborador_id, latitude, longitude, zoom_mapa) VALUES (29, 5, 13, 'R. C 142', NULL, '74255190', 'qd 222 lt 1-3 ed viva america ap 601', NULL, NULL, NULL, 1, NULL, NULL, NULL);


--
-- Name: endereco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.endereco_id_seq', (select max(id) from public.endereco), true);


--
-- Data for Name: colaborador_endereco; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_endereco (colaborador_id, endereco_id) VALUES (1, 29);


--
-- Data for Name: colaborador_filial_empresa; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_filial_empresa (colaborador_id, filial_empresa_id) VALUES (1, 1);
INSERT INTO public.colaborador_filial_empresa (colaborador_id, filial_empresa_id) VALUES (1, 2);


--
-- Data for Name: telefone; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.telefone (id, tipo_id, numero) VALUES (27, 2, '998242-8568');


--
-- Name: telefone_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.telefone_id_seq', (select max(id) from public.telefone), true);


--
-- Data for Name: colaborador_telefone; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_telefone (colaborador_id, telefone_id) VALUES (1, 27);