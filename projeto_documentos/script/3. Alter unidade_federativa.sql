--
--
-- Name: unidade_federativa; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.unidade_federativa ADD created_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;
ALTER TABLE public.unidade_federativa ADD updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;
ALTER TABLE public.unidade_federativa ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--
-- Name: unidade_federativa; Type: TABLE; Schema: public; Owner: -
--
UPDATE public.unidade_federativa SET created_at = CURRENT_DATE;


--
-- Name: unidade_federativa; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.unidade_federativa ALTER COLUMN created_at SET NOT NULL;
