# Usa una imagen base de PHP con Apache
FROM php:apache
# Copia el los archivos php al directorio de trabajo del contenedor

COPY index.php /var/www/html/
COPY registro.php /var/www/html/
COPY conexion.php /var/www/html/
COPY login.php /var/www/html/
COPY menu.php /var/www/html/
COPY registrobd.php /var/www/html/
COPY guardar_respuestas.php /var/www/html/


# Instalar extensiones PDO MySQL
RUN docker-php-ext-install pdo_mysql
# Instalar extensiones PHP necesarias (MySQLi en este caso)

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli



# Expone el puerto 80
EXPOSE 80
