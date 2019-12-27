--
--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.fos_user_group ADD created_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;
--ALTER TABLE public.fos_user_group ADD updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;
--ALTER TABLE public.fos_user_group ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
-- Name: fos_user_group: public; Owner: -
--
--UPDATE public.fos_user_group SET created_at = now(), updated_at = now() WHERE created_at IS NULL;


--
-- Name: fos_user_group; Type: TABLE; Schema: public; Owner: -
--
--ALTER TABLE public.fos_user_group ALTER COLUMN created_at SET NOT NULL;
--ALTER TABLE public.fos_user_group ALTER COLUMN updated_at SET NOT NULL;

	
--******************************************************************************************************


--
--
-- Name: telefone; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.telefone ADD created_at timestamp(0) without time zone DEFAULT NULL;
ALTER TABLE public.telefone ADD updated_at timestamp(0) without time zone DEFAULT NULL;


--
-- Name: cliente_equipamento fk_cliente_equipamento_perfil; Type: FK CONSTRAINT; Schema: public; Owner: -
--
UPDATE public.telefone SET created_at = Now(), updated_at = Now();


--
--
-- Name: telefone; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.telefone ALTER COLUMN created_at SET NOT NULL;
ALTER TABLE public.telefone ALTER COLUMN updated_at SET NOT NULL;
ALTER TABLE public.telefone ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: classification__category; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.classification__category ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: classification__collection; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.classification__collection ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: classification__context; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.classification__context ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: classification__context; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.classification__tag ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: media__media; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.media__media ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: media__gallery_media; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.media__gallery_media ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: ficha_tecnica_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ficha_tecnica_produto ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: requisicao_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.requisicao_produto ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: ordem_compra_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ordem_compra_produto ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: orcamento_produto; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.orcamento_produto ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
--
-- Name: norma; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.norma ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;