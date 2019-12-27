--
-- Data for Name: fos_user_group; Type: TABLE DATA; Schema: public; Owner: -
--

--INSERT INTO public.fos_user_user_group (user_id, group_id) VALUES (2, (select id from fos_user_group where name = 'Gerente Flavis'));
UPDATE public.fos_user_user_group 
   SET group_id = 1
 WHERE user_id = 2;


--
-- Data for Name: fos_user_user; Type: TABLE DATA; Schema: public; Owner: -
--

UPDATE public.fos_user_user 
   SET roles = 'a:0:{}';
 --WHERE user_id <> 2;
 

UPDATE public.colaborador 
   SET grupo_usuario_id = 1
 WHERE id = 1;


--
-- Data for Name: perfil; Type: TABLE DATA; Schema: public; Owner: -
--
 
UPDATE public.perfil 
   SET user_id = 2--marconi
   , email = 'marconi@flavis.com.br'
   , grupo_usuario_id = 1
   , user_enabled = true
 WHERE id = 1;--flavis
