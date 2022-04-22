<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="Assets/css/main.css" />
  <link rel="stylesheet" type="text/css" href="Assets/css/form.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"/>
  <title>Blog</title>
</head>

<body>
  <div class="main">
    <section class="formulario">
      <h2 class="formulario__title">Nueva entrada</h2>
      <form action="controller/transacciones.php" method="post" enctype="multipart/form-data" name="form1">
        <table>
          <tr>
            <td>
              Título:
              <label for="campo_titulo"></label>
            </td>
            <td>
              <input type="text" name="campo_titulo" id="campo_titulo">
            </td>
          </tr>
          <tr>
            <td>
              Comentarios:
              <label for="area_comentarios"></label>
            </td>
            <td>
              <textarea name="area_comentarios" id="area_comentarios" rows="20" cols="50"></textarea>
            </td>
          </tr>
          <input type="hidden" name="MAX_TAM" value="2097152">
          <tr>
            <td colspan="2">Seleccione una imagen con tamaño inferior a 2 MB:</td>
          </tr>
          <tr>
            <td colspan="2"><input type="file" name="imagen" id="imagen"></td>
          </tr>
          <tr>
            <td colspan="2" align="center">  
              <input class="formulario__bot__enviar" type="submit" name="btn_enviar" id="btn_enviar" value="Publicar entrada">
            </td>
          </tr>
          <tr>
            <td class="formulario__bot__ir-al-blog" colspan="2"><a href="index.php">Ir al blog</a></td>
          </tr>
        </table>
      </form>
      <p>&nbsp;</p>
    </section>
  </div>
</body>
</html>