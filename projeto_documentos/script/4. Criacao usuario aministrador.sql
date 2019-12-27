--
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.fos_user_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, api_token, user_token, device_type, nome_perfil) VALUES ((select max(id) from public.fos_user_user) + 1, 'adminmaster', 'adminmaster', 'manutencao.go@flavis.com.br', 'manutencao.go@flavis.com.br', true, 'co02nisajw8wsoo4kgk4kw4g04cckwk', 'oGdgwRi3rV8Iqo2aQB5dbupLHt5MHqg2GUc5IAbq7npiUXg0VK1uJj6oM0QpD8Mp+I5cz8jPRElOTbgr34JKOA==', '2019-03-21 18:34:22', false, false, NULL, NULL, NULL, 'a:0:{}', false, NULL, '9FqHzr550jkI9GGjQiwIHvIkhFwcALESGkyk-bjjsPE', NULL, NULL, 'flavis');


--
-- Name: fos_user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.fos_user_user_id_seq', (select max(id) from public.fos_user_user), true);


--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.fos_user_user_group (user_id, group_id) VALUES ((select max(id) from public.fos_user_user), (select max(id) from public.fos_user_group));


--
-- Data for Name: colaborador; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador (id, funcao_id, user_id, tipo_colaborador, nome, email, sexo, data_nascimento, cpf, rg, estado_civil, data_admissao, data_recisao, formacao, nivel_escolaridade, banco_conta, banco_agencia, banco_nome, banco_ccorrente, horario_entrada, horario_saida, intervalo_almoco, status, created_at, updated_at, deleted_at, cra, pathfoto, grupo_usuario_id, artigo_crea, nome_perfil) VALUES ((select max(id) from public.colaborador) + 1, 5, (select max(id) from public.fos_user_user), 'F', 'Administrador Master', 'manutencao.go@flavis.com.br', 'M', '1981-02-16', '21455986852', '123456', 'CA', '2010-01-01', NULL, NULL, 'superior', '341', '2903', 'ITAU', '17505-3', '08:00:00', '19:00:00', NULL, 'AT', '2016-11-09 09:11:33', '2018-08-01 16:02:24', NULL, '123456', NULL, (select max(id) from public.fos_user_group), NULL, 'flavis');


--
-- Name: colaborador_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.colaborador_id_seq', (select max(id) from public.colaborador), true);



--
-- Data for Name: colaborador_documento; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_documento (colaborador_id, documento_id) VALUES ((select max(id) from public.colaborador), 3);


--
-- Data for Name: colaborador_endereco; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_endereco (colaborador_id, endereco_id) VALUES ((select max(id) from public.colaborador), 29);


--
-- Data for Name: colaborador_filial_empresa; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_filial_empresa (colaborador_id, filial_empresa_id) VALUES ((select max(id) from public.colaborador), 1);
INSERT INTO public.colaborador_filial_empresa (colaborador_id, filial_empresa_id) VALUES ((select max(id) from public.colaborador), 2);


--
-- Data for Name: colaborador_telefone; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.colaborador_telefone (colaborador_id, telefone_id) VALUES ((select max(id) from public.colaborador), 27);