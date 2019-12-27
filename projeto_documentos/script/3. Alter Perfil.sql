--
--
-- Name: cliente; Type: TABLE; Schema: public; Owner: -
--
ALTER TABLE public.perfil ADD user_id integer;
ALTER TABLE public.perfil ADD email character varying(255) COLLATE pg_catalog."default" DEFAULT NULL::character varying;
ALTER TABLE public.perfil ADD grupo_usuario_id integer;-- DEFAULT 1;
ALTER TABLE public.perfil ADD user_enabled boolean;-- DEFAULT true;


--
-- Name: idx_perfil_fos_user_user; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_perfil_fos_user_user ON public.perfil USING btree (user_id);


--
-- Name: idx_perfil_grupo_usuario; Type: INDEX; Schema: public; Owner: -
--
CREATE INDEX idx_perfil_grupo_usuario ON public.perfil USING btree (grupo_usuario_id);


--
-- Name: perfil fk_perfil_fos_user_user; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- ALTER TABLE public.perfil DROP CONSTRAINT fk_perfil_fos_user_user;

ALTER TABLE public.perfil
    ADD CONSTRAINT fk_perfil_fos_user_user FOREIGN KEY (user_id)
    REFERENCES public.fos_user_user (id);


--
-- Name: perfil fk_perfil_fos_user_group; Type: FK CONSTRAINT; Schema: public; Owner: -
--
-- ALTER TABLE public.perfil DROP CONSTRAINT fk_perfil_fos_user_group;

ALTER TABLE public.perfil
    ADD CONSTRAINT fk_perfil_fos_user_group FOREIGN KEY (grupo_usuario_id)
    REFERENCES public.fos_user_group (id);
