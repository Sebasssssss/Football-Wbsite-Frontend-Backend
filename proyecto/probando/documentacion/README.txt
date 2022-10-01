PROYECTO MANCHESTER UNITED
by Sebastian Rodriguez.

Hecho con: 
PHP 7.4.19
MySQL
HTML, CSS & JAVASCRIPT
Laragon
Framework Materialize based on Material Design


Este proyecto trata de una Pagina Deportiva, compuesta por 2 partes, una siendo el Frontend, que seria la parte donde 
el usuario normal interactua con la pagina. Este podra ver un inicio, una seccion de jugadores donde se veran todos
los jugadores del equipo, junto con la banca. Otra seccion de contacto, en la cual se podra mandar un mensaje a la administracion
de la pagina en caso de dudas, errores, consultas... Y otra de noticias donde se veran todas las noticias actualizadas al dia
del club.
En la parte de Backend, se podran agregar, editar y borrar todos los jugadores, noticias y administradores que sean necesesarios. Al
mismo tiempo recibiendo los mensajes que seran enviados desde el Frontend por parte de la seccion de contacto.



                                                                    INSTALACION CRON
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

En orden para que todo funcione correctamente a la hora de instalar la base de datos con el cron, dirigirse a la carpeta de backend desde la terminal:
"cd C:/laragon/www/proyecto/probando/backend". Luego verificar la ruta donde se tiene instalado php. En caso de ser con laragon sera la siguiente:
"C:/laragon/bin/php/php-7.4.19-Win32-vc15-x64/php". Copie esta ruta y dentro de la carpeta de backend en la terminal, pegarla, seguido de escribir:
"cron.php instalar". Todo junto quedaria "C:/laragon/bin/php/php-7.4.19-Win32-vc15-x64/php cron.php instalar", y simplemente darle al Enter.
Recordar que dentro de la carpeta de configuracion, en el archivo configuracion.php, tanto del backend como del frontend, se debera cambiar 
el nombre de la base de datos en ambos configuracion.php

Una vez instalado la base de datos correctamente, al momento de entrar al backend, se precisara de un usuario. Esto ya esta cubierto por el instalador,
ya que este instala un usuario predeterminado.

Usuario: admin
Clave: clave



                                                            PROBLEMAS CON IMAGENES EN EL FRONTEND
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

Luego de realiar la instalacion, en el caso de que en el Frontend las imagenes no carguen, es muy seguro que sea debido a las rutas utilizadas, las cuales deberan
ser cambiadas a las que se tengan en el ordenador que se instale el proyecto. Para hacer esto, se debera dirigir a la carpeta de vistas, dentro del
Frontend, y hacia los archivos "noticias_vistas.php" y "vistas_jugadores.php". Dentro de noticias vistas, ir hacia la linea 63, 84 y 109, y dentro de vistas jugadores, a la linea 61. Y 
simplemente agregarle el nombre de la carpeta donde se tenga el proyecto.
"http://localhost/Sebastián_Rodriguez_cur2140_EntregaFinal/proyecto/probando/backend/archivos/imagenes/" Esta sera la ruta predeterminada, si se tiene el proyecto
dentro de otra carpeta, quedaria por ejemplo:
"http://localhost/proyectos_cur2140/Sebastián_Rodriguez_cur2140_EntregaFinal/proyecto/probando/backend/archivos/imagenes/" De esta manera las imagenes cargaran 
debidamente.



                                                                    PROBLEMAS CON CONTACTO
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

En caso de que la seccion de contacto, no se cargue correctamente, es decir, este todo mal proporcionado e inutilizable, dirijase hacia la carpeta Frontend,
y de ahi al archivo "router.php". Dentro de este router, visualize la linea 16, y donde diga "contacto_vistas.php", simplemente agreguele un 2 delante de la palabra
contacto, de manera que quede "contacto2_vistas.php". Este cambio hara que la seccion contacto cargue un nuevo formulario hecho con Materialize.



                                                            PROBLEMAS DESCRIPCIONES EN NOTICIAS 
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

Es muy improbable que pase esto, pero solo por precaucion lo aclaro. Puede ocurrir que al estar agregando noticias para hacer pruebas, en la parte de descripcion se agregue
una descripcion totalemente uniforme sin espacios, como si todo fuera una palabra. Al realizar eso la tabla y la noticia en el Frontend se veran totalemente desproporcianadas.
Por lo que en todo caso de hacer pruebas, agregar parrafos que tengan sus debidos espacios, como lo son por ejemplo un texto Lorem.






Fecha de inicio del proyecto: 15/06/2022
Fecha de finalizacion: 11/09/2022
