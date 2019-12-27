


--
-- Data for Name: tipo_documento; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (1, 'HABILITAÇÃO', NULL, '2016-11-21 15:37:05', '2016-11-21 15:37:05', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (4, 'CONTRATO', NULL, '2016-11-21 15:47:40', '2016-11-21 15:47:40', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (5, 'RG', NULL, '2016-11-21 16:15:38', '2016-11-21 16:15:38', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (2, 'CONTRATO', NULL, '2016-11-21 15:46:21', '2016-11-21 15:46:21', '2016-11-22 14:51:14');
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (3, 'CONTRATO', NULL, '2016-11-21 15:47:06', '2016-11-21 15:47:06', '2016-11-22 14:51:14');
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (6, 'teste', NULL, '2016-11-22 14:51:53', '2016-11-22 14:51:53', '2016-11-22 14:52:14');
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (7, 'CARTÃO SINTEGRA', NULL, '2016-11-22 17:29:07', '2016-11-22 17:29:07', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (8, 'CPF', NULL, '2016-11-29 17:02:34', '2016-11-29 17:02:34', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (9, 'RESERVISTA', NULL, '2016-11-29 17:02:47', '2016-11-29 17:02:47', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (10, 'COMPROVANTE DE ENDEREÇO', NULL, '2016-11-29 17:03:06', '2016-11-29 17:03:06', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (11, 'Contrato de Trabalho', NULL, '2017-06-20 19:37:18', '2017-06-20 19:37:18', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (12, 'ART - Manutenção', 'ART - Documento de responsabilidade técnica  referente as manutenções de exaustão.', '2017-07-07 13:19:09', '2017-07-07 13:19:09', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (13, 'CNPJ', NULL, '2018-03-08 10:43:47', '2018-03-08 10:43:47', NULL);
INSERT INTO public.tipo_documento (id, titulo, observacoes, created_at, updated_at, deleted_at) VALUES (14, 'PEDIDO DE VENDA', NULL, '2018-03-08 10:47:47', '2018-03-08 10:47:47', NULL);


--
-- Name: tipo_documento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipo_documento_id_seq', (select max(id) from public.tipo_documento), true);
