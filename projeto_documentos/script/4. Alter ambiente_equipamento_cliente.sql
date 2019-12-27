-- Column: public.ambiente_equipamento_cliente.created_at

-- ALTER TABLE public.ambiente_equipamento_cliente DROP COLUMN created_at;

ALTER TABLE public.ambiente_equipamento_cliente
    ADD COLUMN created_at timestamp(0) without time zone NOT NULL DEFAULT ('now'::text)::date;


--
--
-- Name: ambiente_equipamento_cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.ambiente_equipamento_cliente ADD updated_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;
ALTER TABLE public.ambiente_equipamento_cliente ADD deleted_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone;


--select * from acl_object_identities where class_type like '%Ambiente%';
--select * from acl_object_identities where object_identifier like '%ambiente%';
UPDATE public.acl_classes 
   SET class_type = 'AppBundle\Admin\AmbienteEquipamentoClienteAdmin' 
 WHERE class_type = 'AppBundle\Admin\AmbienteEquipamentoAdmin';

UPDATE public.acl_object_identities 
   SET object_identifier = 'app.admin.ambiente_equipamento_cliente'
 WHERE object_identifier = 'app.admin.ambiente_equipamento';

UPDATE public.acl_classes 
   SET class_type = 'AppBundle\Admin\AmbienteEquipamentoCliente' 
 WHERE class_type = 'AppBundle\Admin\AmbienteEquipamento' or id = 103;
