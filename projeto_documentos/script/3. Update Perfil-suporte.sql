--
-- Data for Name: fos_user_user_group; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.fos_user_user_group (user_id, group_id) VALUES (1, (select id from public.fos_user_group where name = 'Suporte Técnico'));


--
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: -
--
 
UPDATE public.fos_user_user 
   SET username = 'suporte'
   , username_canonical = 'suporte'
   , email = 'viniciusam.senai@sistemafieg.org.br'
   , email_canonical = 'viniciusam.senai@sistemafieg.org.br' 
   , salt = (SELECT salt FROM public.fos_user_user WHERE id = 2)
   , password = (SELECT password FROM public.fos_user_user WHERE id = 2)
   , roles = (SELECT roles FROM public.fos_user_user WHERE id = 2)
   , api_token = (SELECT api_token FROM public.fos_user_user WHERE id = 2)
   , nome_perfil = 'suporte'
   WHERE id = 1;
 

UPDATE public.colaborador 
   SET grupo_usuario_id = (select id from public.fos_user_group where name = 'Suporte Técnico')
 WHERE id = 2;


--
-- Data for Name: perfil; Type: TABLE DATA; Schema: public; Owner: -
--
 
UPDATE public.perfil 
   SET user_id = 1
   , email = 'viniciusam.senai@sistemafieg.org.br'
   , grupo_usuario_id = (select id from public.fos_user_group where name = 'Suporte Técnico')
   , user_enabled = true
 WHERE id = 2;


----
---- Data for Name: colaborador; Type: TABLE DATA; Schema: public; Owner: -
----

INSERT INTO public.colaborador (id, funcao_id, user_id, tipo_colaborador, nome, email, sexo, data_nascimento, cpf, rg, estado_civil, data_admissao, data_recisao, formacao, nivel_escolaridade, banco_conta, banco_agencia, banco_nome, banco_ccorrente, horario_entrada, horario_saida, intervalo_almoco, status, created_at, updated_at, deleted_at, cra, pathfoto, grupo_usuario_id, artigo_crea, nome_perfil) VALUES ((select max(id) from public.colaborador) + 1, 5, 1, 'F', 'Suporte STI', 'viniciusam.senai@sistemafieg.org.br', 'M', '1981-02-16', '21455986852', '123456', 'CA', '2010-01-01', NULL, NULL, 'superior', '341', '2903', 'ITAU', '17505-3', '08:00:00', '19:00:00', NULL, 'AT', '2016-11-09 09:11:33', '2018-08-01 16:02:24', NULL, '123456', NULL, (select id from public.fos_user_group where name = 'Suporte Técnico'), NULL, 'suporte');


----
---- Data for Name: colaborador_documento; Type: TABLE DATA; Schema: public; Owner: -
----

INSERT INTO public.colaborador_documento (colaborador_id, documento_id) VALUES ((select max(id) from public.colaborador), 3);


----
---- Data for Name: endereco; Type: TABLE DATA; Schema: public; Owner: -
----

INSERT INTO public.endereco (id, tipo_id, bairro_id, logradouro, numero, cep, complemento, referencia, observacao, cliente_id, colaborador_id, latitude, longitude, zoom_mapa) VALUES ((select max(id) from public.endereco) + 1, 5, 13, 'R. C 142', NULL, '74255190', 'qd 222 lt 1-3 ed viva america ap 601', NULL, NULL, NULL, (select max(id) from public.colaborador), NULL, NULL, NULL);


--
-- Name: endereco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.endereco_id_seq', (select max(id) from public.endereco), true);


----
---- Data for Name: colaborador_endereco; Type: TABLE DATA; Schema: public; Owner: -
----

INSERT INTO public.colaborador_endereco (colaborador_id, endereco_id) VALUES ((select max(id) from public.colaborador), (select max(id) from public.endereco));


----
---- Data for Name: colaborador_filial_empresa; Type: TABLE DATA; Schema: public; Owner: -
----

INSERT INTO public.colaborador_filial_empresa (colaborador_id, filial_empresa_id) VALUES ((select max(id) from public.colaborador), 1);


----
---- Data for Name: telefone; Type: TABLE DATA; Schema: public; Owner: -
----

INSERT INTO public.telefone (id, tipo_id, numero, created_at, updated_at, deleted_at) VALUES ((select max(id) from public.telefone) + 1, 2, '3226-4561', '2019-08-09 09:11:33', '2019-08-01 16:02:24', NULL);


--
-- Name: telefone_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.telefone_id_seq', (select max(id) from public.telefone), true);


----
---- Data for Name: colaborador_telefone; Type: TABLE DATA; Schema: public; Owner: -
----

INSERT INTO public.colaborador_telefone (colaborador_id, telefone_id) VALUES ((select max(id) from public.colaborador), (select max(id) from public.telefone));
