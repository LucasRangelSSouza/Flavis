


--
-- Data for Name: unidade_federativa; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.unidade_federativa (id, sigla) VALUES (1, 'MT');
INSERT INTO public.unidade_federativa (id, sigla) VALUES (2, 'MS');
INSERT INTO public.unidade_federativa (id, sigla) VALUES (3, 'TO');
INSERT INTO public.unidade_federativa (id, sigla) VALUES (4, 'GO');
INSERT INTO public.unidade_federativa (id, sigla) VALUES (5, 'DF');
INSERT INTO public.unidade_federativa (id, sigla) VALUES (6, 'ES');
INSERT INTO public.unidade_federativa (id, sigla) VALUES (7, 'MG');

INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'AC');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'AL');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'AP');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'AM');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'BA');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'CE');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'MA');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'PA');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'PB');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'PR');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'PE');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'PI');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'RJ');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'RN');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'RS');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'RO');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'RR');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'SC');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'SP');
INSERT INTO public.unidade_federativa (id, sigla) VALUES ((select max(id) from public.unidade_federativa) + 1, 'SE');


--
-- Name: unidade_federativa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.unidade_federativa_id_seq', (select max(id) from public.unidade_federativa), true);
