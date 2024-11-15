# Página Web de envió de correos/mensajes (WiP)
La idea de esta página es de diseñar un sistema de envio de mensajes entre usuarios registrados, incluyendo envió de imágenes, vídeos y archivos de audio. Este es un trabajo para la cátedra de Paradigmas y Lenguajes de Programación 3 y para la cátedra de Bases de Datos de la carrera de Ingeniería en Sistemas de Información de la Universidad de la Cuenca del Plata.

## Acceso a la página web
La página actualmente solo es accesible de manera local.

## Primer Commit
En el primer commit se subió la página con las funcionalidades más básicas, se creo la base de datos con MySQL y se conecto a la página web con el uso de PHP. Las únicas páginas disponibles son el index con un login, una página para registrarse y una página para iniciar sesión en la página. Todavía no se incluyo el uso de css ya que la idea era subir las funciones más básicas de registro de usuarios y de inicio de sesión. 

## Segundo Commit
Principalmente se añadieron las funciones básicas para enviar mensajes y que se guarden en la base de datos solamente si existe el correo del destinatario. Aparte de eso de añadio una verificación de correo electrónico al registro para verificar que el formato sea adecuado.

## Tercer Commit
Unicamente se añadio una página para ver los mensajes que le fueron enviados a cada usuario, además de eso se hizo la redirección del login para el inbox del usuario.

## Cuarto Commit
Se aplicaron estilos simples con CSS, además se agregaron todas las páginas necesarias para el funcionamiento básico completo de la página, incluyendo verificaciones de inicio de sesión y creación dinámica de las páginas web. También se agregaron sitios de administración solo disponibles para usuarios con la condición de administradores, junto con la modifición en las tablas de las bases de datos. La intención del sitio de administración es la de modificar el estado de los usuarios y de modificar la información pública del sitio.

## Quinto Commit
Se arreglaron fallos de redirección y problemas de mala aplicación de CSS para realizar la entrega final para el integrador.
