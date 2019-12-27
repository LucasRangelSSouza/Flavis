


--
-- Data for Name: tipo_telefone; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.tipo_telefone (id, nome) VALUES (1, 'Fixo');
INSERT INTO public.tipo_telefone (id, nome) VALUES (2, 'CELULAR');
INSERT INTO public.tipo_telefone (id, nome) VALUES (3, 'Financeiro');


--
-- Name: tipo_telefone_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tipo_telefone_id_seq', (select max(id) from public.tipo_telefone), true);
