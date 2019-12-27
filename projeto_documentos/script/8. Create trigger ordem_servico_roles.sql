-- Function: function_ordem_servico_roles

-- DROP FUNCTION function_ordem_servico_roles ON public.equipamento_cliente;

/********************************************************************************************************
 Incluir - 25/06/2019 - Vinícius Augusto Marques - Gerar o LOG da tabela.
 Alterar - __/__/____ - Nome responsavel pela alteração - Alteração
********************************************************************************************************/
CREATE OR REPLACE FUNCTION public.function_ordem_servico_roles()
RETURNS trigger AS $BODY$
BEGIN
	-- Aqui temos um bloco IF que confirmará o tipo de operação.
	IF (TG_OP = 'INSERT') AND (NEW.is_pmoc = true) THEN
		IF (SELECT count(*) 
				FROM public.acl_object_identities
				WHERE class_id = 43
				AND object_identifier = cast(NEW.id as text)) = 0 THEN
				
			INSERT INTO public.acl_object_identities(parent_object_identity_id, class_id, object_identifier, entries_inheriting)
				VALUES (null, 43, NEW.id, true);
				
			INSERT INTO public.acl_entries(
				class_id, object_identity_id, security_identity_id, field_name, ace_order, mask, granting, granting_strategy, audit_success, audit_failure)
				VALUES (43, (select max(id) from acl_object_identities), 265, null, 0, 128, true, 'all', false, false);

			INSERT INTO public.acl_object_identity_ancestors (object_identity_id, ancestor_id) 
			VALUES ((select max(id) from public.acl_object_identities), (select max(id) from public.acl_object_identities));
		END IF;
		
		RETURN NEW;
	END IF;
	
	RETURN NULL;
END;
$BODY$ LANGUAGE plpgsql;


-- Trigger: trigger_ordem_servico_roles

-- DROP TRIGGER trigger_ordem_servico_roles ON public.ordem_servico;

CREATE TRIGGER trigger_ordem_servico_roles
	AFTER INSERT OR UPDATE OR DELETE 
	ON public.ordem_servico
	FOR EACH ROW
	EXECUTE PROCEDURE public.function_ordem_servico_roles();
