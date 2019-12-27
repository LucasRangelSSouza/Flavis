


--
-- Data for Name: tipo_negocio; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.tipo_negocio (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (1, 'Restaurante', 'Fast food', '2016-11-10 15:47:10', '2016-11-10 15:47:10', NULL);
INSERT INTO public.tipo_negocio (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (2, 'PREDIO', NULL, '2016-11-17 14:15:03', '2016-11-17 14:15:03', NULL);
INSERT INTO public.tipo_negocio (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (3, 'LOJA', NULL, '2016-11-17 14:27:33', '2016-11-17 14:27:33', NULL);
INSERT INTO public.tipo_negocio (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (4, 'HOTEL', 'REDE HOTELEIRA', '2017-05-03 17:09:24', '2017-05-03 17:09:24', NULL);
INSERT INTO public.tipo_negocio (id, nome, descricao, created_at, updated_at, deleted_at) VALUES (5, 'Rua', NULL, '2017-10-18 11:45:04', '2017-10-18 11:45:04', NULL);


--
-- Name: tipo_negocio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipo_negocio_id_seq', (select max(id) from public.tipo_negocio), true);
