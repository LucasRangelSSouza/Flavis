-- Function: function_equipamento_cliente_ambiente_equipamento_cliente

-- DROP FUNCTION function_equipamento_cliente_ambiente_equipamento_cliente ON public.equipamento_cliente;

/********************************************************************************************************
 Incluir - 25/06/2019 - Vinícius Augusto Marques - Gerar o LOG da tabela.
 Alterar - __/__/____ - Nome responsavel pela alteração - Alteração
********************************************************************************************************/
CREATE OR REPLACE FUNCTION public.function_equipamento_cliente_ambiente_equipamento_cliente()
RETURNS trigger AS $BODY$
BEGIN
	-- Aqui temos um bloco IF que confirmará o tipo de operação.
	IF (TG_OP = 'INSERT') OR (TG_OP = 'UPDATE') THEN
		IF (SELECT ambiente_id 
			FROM public.ambiente_equipamento_cliente
			WHERE equipamento_cliente_id = NEW.id
			AND ambiente_id = NEW.ambiente_id) > 0 THEN
--			UPDATE public.ambiente_equipamento_cliente 
			
--			WHERE equipamento_cliente_id = NEW.id
--			AND ambiente_id = NEW.ambiente_id;
		ELSIF (SELECT ambiente_id 
				FROM public.ambiente_equipamento_cliente
				WHERE equipamento_cliente_id = NEW.id
				AND ambiente_id <> NEW.ambiente_id) > 0 THEN
			UPDATE public.ambiente_equipamento_cliente 
			SET ambiente_id = NEW.ambiente_id
			WHERE equipamento_cliente_id = NEW.id;
		ELSE
			INSERT INTO public.ambiente_equipamento_cliente 
					(ambiente_id, equipamento_cliente_id, created_at, updated_at, deleted_at)
			VALUES (NEW.ambiente_id, NEW.id, NEW.created_at, NEW.updated_at, NEW.deleted_at);
		END IF;
		
		RETURN NEW;
	-- Aqui temos um bloco IF que confirmará o tipo de operação DELETE
	ELSIF (TG_OP = 'DELETE') THEN
		DELETE FROM public.ambiente_equipamento_cliente 
		WHERE ambiente_id = OLD.ambiente_id
		AND equipamento_cliente_id = OLD.id;
		
		RETURN OLD;
	END IF;
	
	RETURN NULL;
END;
$BODY$ LANGUAGE plpgsql;


-- Trigger: trigger_equipamento_cliente_log_todas_as_operacoes

-- DROP TRIGGER trigger_equipamento_cliente_log_todas_as_operacoes ON public.ambiente_equipamento_cliente;

CREATE TRIGGER trigger_equipamento_cliente_ambiente_equipamento_cliente
	AFTER INSERT OR UPDATE OR DELETE 
	ON public.equipamento_cliente
	FOR EACH ROW
	EXECUTE PROCEDURE public.function_equipamento_cliente_ambiente_equipamento_cliente();
