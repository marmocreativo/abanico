# Abanico
Hola, Este repositorio contiene el prototipo del sistema de Tienda Online Abanico siempre lo Mejor

# Sistema

Se esta utilizando como base el sistema Code Igniter en su versión 3.1.9, las funciones, manejo de controladores y utilizando el patron de desarrollo Modelo, Vista Controlador

# Estructura de carpetas

*SISTEMA*

Incluye el nucleo de Code Igniter, archivos requeridos para el funcionamiento del sistema es importante no modificar esta carpeta para facilitar la actualización en el futuro.


*ASSETS*

Contiene los archivos de Estilo del sistema, así como tipografías, Plugins, Java Scripts, entre otros, se subdivide en:

-Global | Incluye archivos que se usan dentro de todo el sitio
-Administradores | Incluirá archivos reservados para los administradores
-Tienda | Incluirá archivos utilizados en el sistema general de la tienda
-usuarios | Incluirá archivos reservados para los usuarios

*APLICACIÓN*

Contiena la lógica del programa, Rutas, Controladores, Vistas y Modelos del sistema
Carpetas relevantes en aplicación

  -Config | Incluye los archivos requeridos para la configuración del sistema
  
  -Config/database.php | Guarda la configuración para la conexión con la base de datos
  
  -Congig/routes.php | Controlador principal de las redirecciones del sistema, permite redireccionar a las diferentes secciones de la aplicación.
  
  -Controllers | Incluye todos los controladores de la aplicación, permite cargar Vistas y/o llamar a los modelos para leer o escribir información en la base de datos
  
  -views | Incluye las vistas (plantillas o esqueletos) de la aplicación, requieren que se les pase información mediante el Controlador para cargar la información desde la base de datos.
  
  -helpers | Incluirá distintas funciones de ayuda para la aplicación
  
  # Como Instalar
  
  Para instalar la aplicación y revisar su funcionamiento puedes:
  Usar un programa de repositorios como Github para "Llamar"(Pull) la versión mas actual del programa
  
  o descargarla desde este repositorio dando click en el boton Download
  
  Requieres un servidor local LINUX como XAMPP, WAMPP o MAMPP
  dejo un pequeño tutorial de como instalar XAMPP
  https://www.youtube.com/watch?v=nZyn-7S8ivc
  
  Despues debes crear una base de datos vacía en XAMPP, dejo un pequeño tutorial explicando como hacerlo
  https://www.youtube.com/watch?v=9zAVE-ImLbY
  
  Importar el archivo  base_de_datos.sql dentro de la base de datos que acabas de crear, este archivo incluye las tablas base, y algunos datos de configuración básica.
  dejo un pequeño tutorial de como hacerlo.
  https://www.youtube.com/watch?v=wC3hIqFpUNc
  
  Crear Usuario para la base de datos se debe crear un usuario con contraseña para manipular la base de datos.
  dejo un pequeño tutorial
  https://www.youtube.com/watch?v=oTmEhpfZwKc
  
  Finalmente se modifica el archivo Config/database.php con los datos de la base de datos que acaba de crear
  solo se requiere que modifique las siguientes variables con sus datos.
  
  'hostname' => 'localhost',
	'username' => 'abanico',
	'password' => 'abanico',
	'database' => 'abanico',
  
  Para terminar y visualizar la página en un servidor local copie todos los archivos extraidos de este repositorio en una carpeta dentro de la instalaciónde XAMPP, a menos que la hayan modificado la configuración basica de la instalación suele instalarse en el disco local.
  
  C://xampp/htdocs
  
  Dejo un video tutorial donde se muestra donde está esa carpeta
  https://youtu.be/K4KPZjwMzuE?t=389
