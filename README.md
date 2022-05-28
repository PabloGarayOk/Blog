## Bienvenido al repositorio de Pablo Garay.

#### Para crear la BBDD.

Para construir este BLOG con MVC primero debemos crear nuestra tabla &quot;contenido&quot; dentro de la BBDD &quot;ddbb_blog&quot;, con el comando que se encuntra en el archivo &quot;create data base.sql&quot;.

    CREATE TABLE ddbb_blog.contenido ( Id INT NOT NULL AUTO_INCREMENT , Titulo VARCHAR(30) NOT NULL , Fecha DATETIME NOT NULL , Comentario TEXT NOT NULL , Imagen VARCHAR(50) NOT NULL , PRIMARY KEY (Id)) ENGINE = InnoDB;

#### Para ver el CRUD online.

[Ver BLOG online](https://pablogaray.com.ar/portfolio/blog/)

[Visita mi sitio web](https://pablogaray.com.ar)

### Fin.