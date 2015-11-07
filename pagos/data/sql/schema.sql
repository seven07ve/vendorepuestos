CREATE TABLE admin (id INT AUTO_INCREMENT, nombre TEXT NOT NULL, usuario TEXT NOT NULL, contrasena TEXT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE banco (id INT AUTO_INCREMENT, nombre VARCHAR(255) NOT NULL, logo VARCHAR(100) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE categoria (id INT AUTO_INCREMENT, nombre VARCHAR(255) NOT NULL, presentacion VARCHAR(1) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE ciudad (id INT AUTO_INCREMENT, id_estado INT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE color (id INT AUTO_INCREMENT, nombre TEXT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE estado (id INT AUTO_INCREMENT, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE medio_envio (id INT AUTO_INCREMENT, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE medio_pago (id INT AUTO_INCREMENT, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE menu (id INT AUTO_INCREMENT, id_categoria INT NOT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, logo VARCHAR(100), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE noticias (id INT AUTO_INCREMENT, titulo VARCHAR(255) NOT NULL, sumario TEXT NOT NULL, texto TEXT NOT NULL, foto VARCHAR(100) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE paquete_usuario (id BIGINT AUTO_INCREMENT, id_paquete INT NOT NULL, id_usuario BIGINT NOT NULL, usuario_tienda VARCHAR(1) NOT NULL, fecha_activacion DATETIME NOT NULL, estado VARCHAR(1) NOT NULL, monto DECIMAL(10, 2) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE payment_order (id BIGINT AUTO_INCREMENT, element_id BIGINT NOT NULL, element_type VARCHAR(255) DEFAULT 'product' NOT NULL, system_action VARCHAR(255) DEFAULT 'new' NOT NULL, amount BIGINT NOT NULL, order_id VARCHAR(20) NOT NULL UNIQUE, order_status VARCHAR(255) DEFAULT 'unprocessed' NOT NULL, transaction_status VARCHAR(255) DEFAULT 'TNB' NOT NULL, response_code BIGINT, merchant_usn VARCHAR(12) NOT NULL UNIQUE, customer_id VARCHAR(20), customer_email VARCHAR(255) NOT NULL, card_number VARCHAR(20), nit VARCHAR(64), customer_receipt TEXT, merchant_receipt TEXT, authorizer_id VARCHAR(3), acquirer VARCHAR(50), authorization_number VARCHAR(6), esitef_usn VARCHAR(15), host_usn VARCHAR(15), message TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE producto_espejo (id INT AUTO_INCREMENT, titulo VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) NOT NULL, foto1 VARCHAR(100) NOT NULL, foto2 VARCHAR(100) NOT NULL, foto3 VARCHAR(100) NOT NULL, descripcion TEXT NOT NULL, id_estado INT NOT NULL, id_ciudad INT NOT NULL, condicion VARCHAR(16) NOT NULL, precio DECIMAL(10, 2) NOT NULL, vence DATE NOT NULL, id_categoria INT NOT NULL, id_menu INT NOT NULL, id_submenu INT NOT NULL, id_submenu2 INT NOT NULL, id_paquete_usuario INT NOT NULL, usuario_tienda VARCHAR(1) NOT NULL, id_usuario_tienda INT NOT NULL, fecha_publicacion DATETIME NOT NULL, visitas INT NOT NULL, ultima_visita DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL, oferta_dia VARCHAR(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX id_usuario_tienda_idx (id_usuario_tienda), INDEX id_estado_idx (id_estado), INDEX id_ciudad_idx (id_ciudad), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE producto_temporal (id INT AUTO_INCREMENT, titulo VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) NOT NULL, foto1 VARCHAR(100) NOT NULL, foto2 VARCHAR(100) NOT NULL, foto3 VARCHAR(100) NOT NULL, descripcion TEXT NOT NULL, id_estado INT NOT NULL, id_ciudad INT NOT NULL, condicion VARCHAR(16) NOT NULL, precio DECIMAL(10, 2) NOT NULL, vence DATE NOT NULL, id_categoria INT NOT NULL, id_menu INT NOT NULL, id_submenu INT NOT NULL, id_submenu2 INT NOT NULL, id_paquete_usuario INT NOT NULL, usuario_tienda VARCHAR(1) NOT NULL, id_usuario_tienda INT NOT NULL, fecha_publicacion DATETIME NOT NULL, visitas INT NOT NULL, ultima_visita DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL, oferta_dia VARCHAR(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, productos_id BIGINT NOT NULL, producto_id INT, INDEX producto_id_idx (producto_id), INDEX id_usuario_tienda_idx (id_usuario_tienda), INDEX id_estado_idx (id_estado), INDEX id_ciudad_idx (id_ciudad), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE productos (id INT AUTO_INCREMENT, titulo VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) NOT NULL, foto1 VARCHAR(100) NOT NULL, foto2 VARCHAR(100) NOT NULL, foto3 VARCHAR(100) NOT NULL, descripcion TEXT NOT NULL, id_estado INT NOT NULL, id_ciudad INT NOT NULL, condicion VARCHAR(16) NOT NULL, precio DECIMAL(10, 2) NOT NULL, vence DATE NOT NULL, id_categoria INT NOT NULL, id_menu INT NOT NULL, id_submenu INT NOT NULL, id_submenu2 INT NOT NULL, id_paquete_usuario INT NOT NULL, usuario_tienda VARCHAR(1) NOT NULL, id_usuario_tienda INT NOT NULL, fecha_publicacion DATETIME NOT NULL, visitas INT NOT NULL, ultima_visita DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL, oferta_dia VARCHAR(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX id_usuario_tienda_idx (id_usuario_tienda), INDEX id_estado_idx (id_estado), INDEX id_ciudad_idx (id_ciudad), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE productos_2401 (id INT AUTO_INCREMENT, titulo VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) NOT NULL, foto1 VARCHAR(100) NOT NULL, foto2 VARCHAR(100) NOT NULL, foto3 VARCHAR(100) NOT NULL, descripcion TEXT NOT NULL, id_estado INT NOT NULL, id_ciudad INT NOT NULL, condicion VARCHAR(16) NOT NULL, precio DECIMAL(10, 2) NOT NULL, vence DATE NOT NULL, id_categoria INT NOT NULL, id_menu INT NOT NULL, id_submenu INT NOT NULL, id_submenu2 INT NOT NULL, id_paquete_usuario INT NOT NULL, usuario_tienda VARCHAR(1) NOT NULL, id_usuario_tienda INT NOT NULL, fecha_publicacion DATETIME NOT NULL, visitas INT NOT NULL, oferta_dia VARCHAR(1) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE salutacion (id TINYINT AUTO_INCREMENT, texto VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE submenu (id INT AUTO_INCREMENT, id_categoria INT NOT NULL, id_menu INT NOT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE submenu2 (id INT AUTO_INCREMENT, id_categoria INT NOT NULL, id_menu INT NOT NULL, id_submenu INT NOT NULL, nombre VARCHAR(255) NOT NULL, orden INT NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tarifas (id INT AUTO_INCREMENT, nombre VARCHAR(255) NOT NULL, total_bs DECIMAL(10, 2) NOT NULL, cantidad_productos INT NOT NULL, habilitar VARCHAR(1) NOT NULL, duracion_dias INT NOT NULL, tipo VARCHAR(7) NOT NULL, condicion_desde INT, condicion_hasta INT, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tienda_virtual (id INT AUTO_INCREMENT, usuario VARCHAR(20) NOT NULL, clave VARCHAR(20) NOT NULL, rif VARCHAR(20) NOT NULL, nombre_oficial VARCHAR(255) NOT NULL, razon_social VARCHAR(255) NOT NULL, telefono1 VARCHAR(20) NOT NULL, telefono2 VARCHAR(20) NOT NULL, pin VARCHAR(10) NOT NULL, id_estado INT NOT NULL, id_ciudad INT NOT NULL, direccion VARCHAR(255) NOT NULL, latitud VARCHAR(25) NOT NULL, longitud VARCHAR(25) NOT NULL, logo VARCHAR(100) NOT NULL, foto1 VARCHAR(100) NOT NULL, foto2 VARCHAR(100) NOT NULL, foto3 VARCHAR(100) NOT NULL, pagina_web VARCHAR(255) NOT NULL, facebook TEXT, twitter VARCHAR(100), email VARCHAR(100) NOT NULL, descripcion TEXT NOT NULL, horario TEXT NOT NULL, datos_pago VARCHAR(100) NOT NULL, datos_envio VARCHAR(100) NOT NULL, datos_banco VARCHAR(100) NOT NULL, color_titulo VARCHAR(10) NOT NULL, color_fondo VARCHAR(10) NOT NULL, color_contenido VARCHAR(10) NOT NULL, persona_mantenimiento VARCHAR(100) NOT NULL, telefono_mantenimiento VARCHAR(100) NOT NULL, email_mantenimiento VARCHAR(100) NOT NULL, fecha_activacion DATETIME NOT NULL, activo VARCHAR(1) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE usuario (id INT AUTO_INCREMENT, telefono1 VARCHAR(50) NOT NULL, telefono2 VARCHAR(50) NOT NULL, pin VARCHAR(10) NOT NULL, cedula VARCHAR(15) NOT NULL, nombre VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, horario VARCHAR(255), id_estado INT NOT NULL, id_ciudad INT NOT NULL, datos_pago VARCHAR(100) NOT NULL, datos_envio VARCHAR(100) NOT NULL, datos_banco VARCHAR(100) NOT NULL, fecha_activacion DATETIME NOT NULL, certificado VARCHAR(1) NOT NULL, activo VARCHAR(1) NOT NULL, INDEX id_estado_idx (id_estado), INDEX id_ciudad_idx (id_ciudad), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE producto_espejo ADD CONSTRAINT producto_espejo_id_usuario_tienda_usuario_id FOREIGN KEY (id_usuario_tienda) REFERENCES usuario(id) ON DELETE CASCADE;
ALTER TABLE producto_espejo ADD CONSTRAINT producto_espejo_id_estado_estado_id FOREIGN KEY (id_estado) REFERENCES estado(id) ON DELETE CASCADE;
ALTER TABLE producto_espejo ADD CONSTRAINT producto_espejo_id_ciudad_ciudad_id FOREIGN KEY (id_ciudad) REFERENCES ciudad(id) ON DELETE CASCADE;
ALTER TABLE producto_temporal ADD CONSTRAINT producto_temporal_producto_id_productos_id FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE;
ALTER TABLE producto_temporal ADD CONSTRAINT producto_temporal_id_usuario_tienda_usuario_id FOREIGN KEY (id_usuario_tienda) REFERENCES usuario(id) ON DELETE CASCADE;
ALTER TABLE producto_temporal ADD CONSTRAINT producto_temporal_id_estado_estado_id FOREIGN KEY (id_estado) REFERENCES estado(id) ON DELETE CASCADE;
ALTER TABLE producto_temporal ADD CONSTRAINT producto_temporal_id_ciudad_ciudad_id FOREIGN KEY (id_ciudad) REFERENCES ciudad(id) ON DELETE CASCADE;
ALTER TABLE productos ADD CONSTRAINT productos_id_usuario_tienda_usuario_id FOREIGN KEY (id_usuario_tienda) REFERENCES usuario(id) ON DELETE CASCADE;
ALTER TABLE productos ADD CONSTRAINT productos_id_estado_estado_id FOREIGN KEY (id_estado) REFERENCES estado(id) ON DELETE CASCADE;
ALTER TABLE productos ADD CONSTRAINT productos_id_ciudad_ciudad_id FOREIGN KEY (id_ciudad) REFERENCES ciudad(id) ON DELETE CASCADE;
ALTER TABLE usuario ADD CONSTRAINT usuario_id_estado_estado_id FOREIGN KEY (id_estado) REFERENCES estado(id) ON DELETE CASCADE;
ALTER TABLE usuario ADD CONSTRAINT usuario_id_ciudad_ciudad_id FOREIGN KEY (id_ciudad) REFERENCES ciudad(id) ON DELETE CASCADE;