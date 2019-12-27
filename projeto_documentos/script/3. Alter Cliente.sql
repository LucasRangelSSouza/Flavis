--
--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.cliente ADD user_id integer;
ALTER TABLE public.cliente ADD email character varying(255) COLLATE pg_catalog."default" DEFAULT NULL::character varying;
ALTER TABLE public.cliente ADD grupo_usuario_id integer;-- DEFAULT 4;
ALTER TABLE public.cliente ADD user_enabled boolean;-- DEFAULT true;


--
-- Name: idx_cliente_fos_user_user; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_cliente_fos_user_user ON public.cliente USING btree (user_id);


--
-- Name: idx_cliente_grupo_usuario; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_cliente_grupo_usuario ON public.cliente USING btree (grupo_usuario_id);


--
-- Name: cliente fk_cliente_fos_user_user; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- ALTER TABLE public.cliente DROP CONSTRAINT fk_cliente_fos_user_user;

ALTER TABLE public.cliente
    ADD CONSTRAINT fk_cliente_fos_user_user FOREIGN KEY (user_id)
    REFERENCES public.fos_user_user (id);


--
-- Name: cliente fk_cliente_fos_user_group; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- ALTER TABLE public.cliente DROP CONSTRAINT fk_cliente_fos_user_group;

ALTER TABLE public.cliente
    ADD CONSTRAINT fk_cliente_fos_user_group FOREIGN KEY (grupo_usuario_id)
    REFERENCES public.fos_user_group (id);