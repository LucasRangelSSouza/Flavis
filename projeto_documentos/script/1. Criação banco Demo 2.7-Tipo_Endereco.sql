


--
-- Data for Name: tipo_endereco; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.tipo_endereco (id, nome) VALUES (1, 'Restaurante de Rua');
INSERT INTO public.tipo_endereco (id, nome) VALUES (2, 'SHOPPING');
INSERT INTO public.tipo_endereco (id, nome) VALUES (3, 'LOJA DE RUA');
INSERT INTO public.tipo_endereco (id, nome) VALUES (4, 'ESCOLA');
INSERT INTO public.tipo_endereco (id, nome) VALUES (5, 'CONDOMINIO');
INSERT INTO public.tipo_endereco (id, nome) VALUES (6, 'RESIDENCIA');
INSERT INTO public.tipo_endereco (id, nome) VALUES (7, 'HOTEL');
INSERT INTO public.tipo_endereco (id, nome) VALUES (8, 'HOTEL');
INSERT INTO public.tipo_endereco (id, nome) VALUES (9, 'EMPRESA');
INSERT INTO public.tipo_endereco (id, nome) VALUES (10, 'HOSPITAL');
INSERT INTO public.tipo_endereco (id, nome) VALUES (11, 'GALERIA');
INSERT INTO public.tipo_endereco (id, nome) VALUES (12, 'Casa');


--
-- Name: tipo_endereco_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipo_endereco_id_seq', (select max(id) from public.tipo_endereco), true);
