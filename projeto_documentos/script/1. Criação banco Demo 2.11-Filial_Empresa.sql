


--
-- Data for Name: filial_empresa; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.filial_empresa (id, nome, created_at, updated_at, deleted_at) VALUES (2, 'GOIÂNIA', '2017-02-22 12:56:11', '2017-02-22 12:56:11', NULL);
INSERT INTO public.filial_empresa (id, nome, created_at, updated_at, deleted_at) VALUES (1, 'CUIABÁ', '2017-02-22 12:54:20', '2017-02-22 12:54:20', NULL);
INSERT INTO public.filial_empresa (id, nome, created_at, updated_at, deleted_at) VALUES (7, 'BRASILIA', '2017-08-29 12:20:38', '2017-08-29 12:20:38', NULL);
INSERT INTO public.filial_empresa (id, nome, created_at, updated_at, deleted_at) VALUES (8, 'PALMAS', '2017-10-20 11:45:08', '2017-10-20 11:45:08', '2017-10-26 11:46:43');
INSERT INTO public.filial_empresa (id, nome, created_at, updated_at, deleted_at) VALUES (9, 'PORTO ALEGRE', '2017-10-20 18:28:51', '2017-10-20 18:28:51', '2017-10-26 11:46:43');
INSERT INTO public.filial_empresa (id, nome, created_at, updated_at, deleted_at) VALUES (10, 'ESPÍRITO SANTO', '2018-02-25 20:17:06', '2018-02-25 20:17:06', NULL);
INSERT INTO public.filial_empresa (id, nome, created_at, updated_at, deleted_at) VALUES (11, 'MINAS GERAIS', '2018-02-25 20:17:31', '2018-02-25 20:17:31', NULL);


--
-- Name: filial_empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.filial_empresa_id_seq', (select max(id) from public.filial_empresa), true);
