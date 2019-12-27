Requisitos de Servidor Web:
•	QuadCore 2.1+
•	Memoria RAM >= 4GB
•	HD >= 256GB
•	PHP 5.6
	o	JSON 
	
	o	ctype

	o	date.timezone configurado
	
	o	PHP-XML

	o	libxml 2.6.21+
	
	o	mbstring
	
	o	iconv
	
	o	POSIX (on *nix)
	
	o	Intl com ICU 4+
	
	o	GD (JPEG e PNG)
	
	o	openssl
	
	o	APC 3.0.17+ (ou outro opcode cache precisa ser instalado)

	o	php.ini (configurações recomendadas)
			short_open_tag = Off
		
			magic_quotes_gpc = Off
		
			register_globals = Off
		
			session.auto_start = Off
		
			memory_limit => 580M

			max_execution_time >= 1600

			post_max_size => 8M

•	Apache/NGINX com certificado SSL (HTTPS)

•	PostgreSQL 9.3+ com extensão unaccent

	o	CREATE EXTENSION unaccent;


Obs: Existe um script em app/check.php que pode ser usado para validar os requisitos do PHP no servidor.
