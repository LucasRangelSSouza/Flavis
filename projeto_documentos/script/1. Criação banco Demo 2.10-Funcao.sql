


--
-- Data for Name: funcao; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.funcao (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (1, 'Diretor', NULL, '2016-11-09 09:10:50', '2016-11-09 09:10:50', NULL);
INSERT INTO public.funcao (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (2, 'Financeiro', 'Responsável pela área financeira para emissão de notas, cobrança, pagamentos, RH...', '2016-11-10 15:31:38', '2016-11-10 15:31:38', NULL);
INSERT INTO public.funcao (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (3, 'Gestor  Operacional', 'Responsável pela área de serviços.', '2016-11-10 15:39:09', '2016-11-10 15:39:09', NULL);
INSERT INTO public.funcao (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (4, 'Técnico', 'Área técnica de campo.', '2016-11-10 15:43:55', '2016-11-10 15:43:55', NULL);
INSERT INTO public.funcao (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (5, 'Engenheiro', NULL, '2018-03-08 11:51:15', '2018-03-08 11:51:15', NULL);


--
-- Name: funcao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.funcao_id_seq', (select max(id) from public.funcao), true);
