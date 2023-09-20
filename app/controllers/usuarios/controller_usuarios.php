<?php 

/* Acciones */

if(isset($_GET['a'])){

    $action = $_GET['a'];

    if($action == 'delete' && isset($_GET['id'])){

        $id = $_GET['id'];

        if($id != 1){

            $sql_delete = "DELETE FROM usuarios WHERE id='$id'";

        if($conn->query($sql_delete)){

            print "<script>
        
            Swal.fire(
            'Eliminado!',
            'Eliminado Correctamente',
            'success'
            )

            </script>";
                
        }else{

            print "<script>
        
            Swal.fire(
            'Error!',
            'Ocurrio un error.',
            'error'
            )

            </script>";
        
        }

        }

        print '<script>
            setTimeout(() => {
                window.history.replaceState(null, null, window.location.pathname);
            }, 0);
        </script>';
        
    }

    if($action == 'update' && isset($_GET['id'])){

        $id = $_GET['id'];

        $consulta_usuario = "SELECT id, `nombre`, `email`, `pass`, `documento`, `tipo_usuario`  FROM `usuarios` WHERE id = '$id'";

        foreach ($conn->query($consulta_usuario) as $row) {

            $id = $row['id'];

            $nombre = $row['nombre'];
            $email = $row['email'];
            $password = $row['pass'];
            $documento = $row['documento'];
            $tipo_usuario = $row['tipo_usuario'];

        ?>

        <script>

        Swal.fire({
        title: 'Actualizar Usuario',
        html:
        '<form action="#" method="POST" class="text-left m-3"> <div> <div class="form-group"> <label for="">Nombres</label><input type="text" name="nombre" value="<?php echo $nombre ?>" class="form-control" placeholder="Escriba aqui el nombre del usuario" required> </div> <div class="form-group"> <label for="">Correo</label> <input type="email" name="e-mail" value="<?php echo $email ?>" class="form-control" placeholder="Escriba aqui el correo del usuario" required> </div> <div class="form-group"> <label for="">Número de documento</label> <input type="number" name="documento" value="<?php echo $documento ?>" class="form-control" placeholder="Escriba aqui el documento del usuario" required> </div> <div class="form-group"> <label for="">Contraseña</label> <input type="text" name="password" id="inputPassword" class="form-control" value="<?php echo $password ?>" placeholder="Escriba aqui la contraseña del usuario" required></div><input type="hidden" name="id" value="<?php echo $id ?>"> <input type="submit" name="btnActualizar" class="btn btn-outline-secondary btn-lg btn-block mt-4"> </form>',

        showConfirmButton: false, // Oculta el boton confirm
        allowOutsideClick: false, // Impide el clic fuera de la alerta
        showCancelButton: false, // Muestra el botón de cancelar
        showCloseButton: true, //Muestra la equis "X"
        allowEscapeKey: false,   // Impide cerrar con la tecla Esc
        allowEnterKey: false,     // Impide cerrar con la tecla Enter

        })

        </script>

        <?php 

        }
        
    }

    if($action == 'register'){

        ?>

        <script>

        Swal.fire({
        title: 'Registrar Usuario',
        html:
        '<form action="#" method="POST" class="text-left m-3"><div><div class="form-group"> <label for="">Nombres</label> <input type="text" name="nombre" id="" class="form-control" placeholder="Escriba aqui el nombre del usuario" required> </div> <div class="form-group"> <label for="">Correo</label> <input type="email" name="e-mail" id="" class="form-control" placeholder="Escriba aqui el correo del usuario" required> </div> <div class="form-group"> <label for="">Número de documento</label> <input type="number" name="documento" id="" class="form-control" placeholder="Escriba aqui el documento del usuario" required> </div> <div class="form-group"> <label for="">Contraseña (puede ser el mismo documento)</label> <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Escriba aqui la contraseña del usuario" required></div><div class="form-group"> <label for="">Repita la contraseña</label> <input type="password" name="password2" id="inputPassword" class="form-control" placeholder="Repetir contraseña" required></div></div> <input type="submit" name="btnRegistrar" class="btn btn-outline-secondary btn-lg btn-block mt-4"> </form>',

        showConfirmButton: false, // Oculta el boton confirm
        allowOutsideClick: false, // Impide el clic fuera de la alerta
        showCancelButton: false, // Muestra el botón de cancelar
        showCloseButton: true, //Muestra la equis "X"
        allowEscapeKey: false,   // Impide cerrar con la tecla Esc
        allowEnterKey: false,     // Impide cerrar con la tecla Enter

        })

        </script>

        <?php 

    }

}

/* Enviar formulario de registro */

if(isset($_POST['btnRegistrar'])){

    try {
        
        $nombre = $_POST['nombre'];
        $email = $_POST['e-mail'];
        $documento = $_POST['documento'];
        $p1 = $_POST['password'];
        $p2 = $_POST['password2'];
        
        if($p1 == $p2){

            $password = $p1;

            $insert_usuario = "INSERT INTO `usuarios`(`nombre`, `email`, `documento`, `pass`, `tipo_usuario`, fecha_creacion, fecha_actualizacion) VALUES (:nombre, :email, :documento, :contrasenia, 2, now(), now())";

            $stmt = $conn->prepare($insert_usuario);

            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':documento', $documento, PDO::PARAM_STR);
            $stmt->bindParam(':contrasenia', $password, PDO::PARAM_STR);

            if($stmt->execute()){
                print "<script>
        
            Swal.fire(
            'Registrado!',
            'Registrado Correctamente',
            'success'
            )
        
            </script>";
            }
            

        }else{

            print "<script>
        
                Swal.fire(
                'Error!',
                'Las contraseñas no coinciden.',
                'error'
            )
        
            </script>";

        }

    } catch (PDOException $e) {

        print "<script>
        
                Swal.fire(
                'Error!',
                'Ocurrio un error.',
                'error'
            )
        
            </script>";
    }

    print '<script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
    </script>';


}

/* Actualizar formulario de editar */

if(isset($_POST['btnActualizar'])){

    try {

        $id = $_POST['id'];
        
        $nombre = $_POST['nombre'];
        $email = $_POST['e-mail'];
        $documento = $_POST['documento'];
        $password = $_POST['password'];

        $update_usuario = "UPDATE `usuarios` set nombre = :nombre, email = :email, documento = :documento, pass = :contrasenia, fecha_actualizacion = now() WHERE id = '$id'";

        $stmt = $conn->prepare($update_usuario);

        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':documento', $documento, PDO::PARAM_STR);
        $stmt->bindParam(':contrasenia', $password, PDO::PARAM_STR);

        if($stmt->execute()){
            print "<script>
        
            Swal.fire(
            'Actualizado!',
            'Actualizado Correctamente.',
            'success'
        )
    
        </script>";
        }

    } catch (PDOException $e) {

        print "<script>
        
                Swal.fire(
                'Error!',
                'Ocurrio un error.',
                'error'
            )
        
            </script>";
    }

    print '<script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
    </script>';
    
}


/* Desplegar Información */

    try{

        $Select_users = "SELECT `id`, `nombre`, `email`, `documento`, `tipo_usuario`, `token`, `fecha_creacion`, `fecha_actualizacion` FROM `usuarios` WHERE 1;";
            
            foreach($conn->query($Select_users) as $row){

                $id = $row['id'];
                $nombre = $row['nombre'];
                $email = $row['email'];
                $documento = $row['documento'];
                $tipo_usuario = $row['tipo_usuario'];
                $token = $row['token'];
                $fecha_creacion = $row['fecha_creacion'];
                $fecha_actualizacion = $row['fecha_actualizacion'];

                print '<tr>
                <td>' . $id . '</td>
                <td>' . $nombre . '</td>
                <td>' . $email . '</td>
                <td>' . $documento . '</td>
                <td>' . $tipo_usuario . '</td>
                <td>' . $token . '</td>
                <td>' . $fecha_creacion . '</td>
                <td>' . $fecha_actualizacion . '</td>
                <td><a onclick="confirmacion(event)" href="usuarios.php?a=delete&id=' . $id . '" class="btn btn-outline-danger mx-1"><i class="bi bi-trash3-fill"></i>Eliminar</a><a href="usuarios.php?a=update&id=' . $id . '" class="btn btn-primary mx-1"><i class="bi bi-pencil-square"></i>Editar</a></td>
                </tr>';

            }


    }catch (Exception $e){
        die("El error de Conexión es: ". $e->getMessage());
    }

?>