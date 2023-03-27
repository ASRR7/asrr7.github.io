# PAPELERÍA ONLINE
Escuela Nacional Preparatoria N° 6 "Antonio Caso"
Grupo: 516

Por Julio Alejandro Serrepe Ramírez como Proyecto de 1er año del [Estudio Técnico Especializado](http://www.ete.enp.unam.mx/) CM.
Grupo ETE: 61A
Profesora: Santa Isabel Martínez Sánchez
Enlace a carpeta [Drive](https://drive.google.com/drive/folders/1posFrGGc8lRdtRnf4R_pZ7Bo-FFI3CGj?usp=share_link)

## Desarrollo

Esta es un papelería online realizada en HTML 5, utilizando CSS 3, PHP 8.1, MySQL 5.2.0 y JavaScript vanilla.

Utilizando también iconos en formato SVG y formas de ola (waves), del mismo formato.
Se utilizó la libreria de php [Free PDF](http://www.fpdf.org/) para la generación de PDF.


## Usos para Usuario

#### Registro de Cuenta
Dirigiéndose a la página de usuario, se puede registrar un nuevo usuario por medio de su **correo electrónico**, añadiendo como parametro su **nombre** y **contraseña** que deberá ser reescrita por segunda vez para su **confirmación**.
La contraseña será **cifrada** para almacenarla de manera segura en la base de datos.

#### Inicio de Sesión
Si el usuario ya se registró con anterioridad, puede iniciar sesión, utilizando su **correo electrónico** y **contraseña**. Si los datos son correctos y coinciden en la base de datos se iniciará sesión al usuario.

#### Uso de Carrito
Desde la página principal puede visualizar los diferentes productos, cada uno de los cuales tendrá un **botón** para poder **agregarlos al carrito** de compras. Se pueden agregar productos sin haber iniciado sesión, pero **no** se podrán realizar **compras**.

Dentro de la página del carrito se desplegará una tabla a modo de previsualización de los productos. A traves de esta se puede ver una pequeña ***imagen***, ***nombre***, ***precio***, ***cantidad*** y el ***total*** de sus productos.
Asimismo por medio de botones se puede **añadir**, **restar** o **eliminar** por completo los productos de su carrito.

#### Compra
Si tiene la Sesión Iniciada podrá hacer uso del botón de compra, que se encontrará al final de la tabla de productos. Una vez presionado se desplegará una **pantalla de carga** y al finalizar el proceso se mandará un mensaje de **éxito**.

#### Ver Facturas
Una vez completada una compra se podrá hacer uso de la sección de Facturas, donde por medio de una tabla se hará un recuento de todas las compras realizadas, dando algunos datos iniciales como **fecha**, **hora** y el **total**. Además de contar con un botón para poder acceder a una vista con información más detallada en un **PDF**.

#### Ver proveedores
En la página de proveedores se encuentran datos de contacto: Nombre de la **Empresa**, **Correo Electrónico** y **Teléfono**.

## Usos para Administración
Accediendo a la página por medio de la dirección: admin/admin.php y utlizando como parametro GET **admin_id** con el valor: ***GRUPO61A***, puede acceder al menu de administración
```bash
URL: ../admin/admin.php?admin_id=GRUPO61A
```

A través de está página se tendrá acceso a un menu de opciones:

#### Creador Página de Productos
Con solo ingresar a la página comenzará el proceso de generación de páginas individuales de cada producto, mismas que se irán guardando en la carpeta ***productos***.

#### Subir Nuevo Producto
Por medio de esta página se puede agregar un nuevo producto. Se tendrá que tener lista la imagen. Se ingresarán los datos del producto:

* Nombre del producto: Siguiendo la nomenclatura:
```bash
Nombre: Producto Especificación/característica proveedor 
```
* Precio
* Stock disponible
* proveedor del producto
* Imagen del producto: Se sube la imagen correspondiente al producto. Se aceptan formatos: ***.png***, ***.jpg***, ***.jpeg*** y ***.webp***

#### Añadir Nuevo proveedor
Se tendrá acceso a una página para poder ingresar los datos de la nueva empresa proveedora:

* Nombre de la empresa
* Teléfono
* Correo

#### Editar productos existentes
Se tendrá acceso a una página con una tabla con todos los productos. Misma en la que se podrán editar por medio de inputs:

* Ruta de la imagen: Es recomendable ya tener lista la imagen del producto en la carpeta de ***img*** nombrada correctamente.
* Nombre
* Stock
* Precio
* Ruta HTML: Después de realizar el cambio se deberá volver a la página de ***Creador de Página de Productos*** para crear la vista con la nueva ruta.