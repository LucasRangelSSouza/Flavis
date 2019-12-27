-- Function: function_ambiente_equipamento_cliente_equipamento_cliente

-- DROP FUNCTION function_ambiente_equipamento_cliente_equipamento_cliente ON public.ambiente_equipamento_cliente;

/********************************************************************************************************
 Incluir - 25/06/2019 - Vinícius Augusto Marques - Gerar o LOG da tabela.
 Alterar - __/__/____ - Nome responsavel pela alteração - Alteração
********************************************************************************************************/
CREATE OR REPLACE FUNCTION public.function_ambiente_equipamento_cliente_equipamento_clien()
RETURNS trigger AS $BODY$
BEGIN
	-- Aqui temos um bloco IF que confirmará o tipo de operação.
	IF (TG_OP = 'INSERT') OR (TG_OP = 'UPDATE') THEN
		UPDATE public.equipamento_cliente 
		SET ambiente_id = NEW.ambiente_id
		WHERE id = NEW.equipamento_cliente_id;		
		RETURN NEW;
	-- Aqui temos um bloco IF que confirmará o tipo de operação DELETE
	ELSIF (TG_OP = 'DELETE') THEN
		UPDATE public.equipamento_cliente 
		SET ambiente_id = NULL
		WHERE id = OLD.equipamento_cliente_id;		
		RETURN OLD;
	END IF;
	
	RETURN NULL;
END;
$BODY$ LANGUAGE plpgsql;


-- Trigger: trigger_equipamento_cliente_log_todas_as_operacoes

-- DROP TRIGGER trigger_equipamento_cliente_log_todas_as_operacoes ON public.ambiente_equipamento_cliente;

CREATE TRIGGER trigger_function_ambiente_equipamento_cliente_equipamento_clien
	AFTER INSERT OR UPDATE OR DELETE 
	ON public.ambiente_equipamento_cliente
	FOR EACH ROW
	EXECUTE PROCEDURE public.function_ambiente_equipamento_cliente_equipamento_clien();
