# Descripción general del proyecto

La aplicación "comics y cuentos" permite a los usuarios leer y publicar obras en ella.

## Funcionalidad principal de la aplicación

La aplicación se centra en ofrecer al usuario leer las obras publicadas en la aplicación y publicar sus propias obras.

Los usuarios podrán realizar diferentes acciones en la aplicación:

* Los usuarios no registrados (guest) solo pueden leer las obras que tengan disponibles.

* Los usuarios registrados (user) tienen opciones adicionales:
    * Leer todas las obras disponibles (si el usuario es menor no tiene a acceso las obras para adultos).
    * Administrar su "biblioteca".
    * Solicitar permisos para publicar.

* Los usuarios que ya tienen permiso para publicar (author) tienen más opciones:
    * Gestión de sus obras.
    * Gestión de los capítulos de dichas obras.

* Los usuarios administradores (admin) pueden:
    * Gestionar usuarios (user y author).
    * Eliminar y editar obras.
    * Eliminar capítulos.

## Objetivos generales

* Objetivo principal: "Almacenar y dar acceso de las obras publicadas".
* Gestionar registro, logueo y deslogueo de usuarios.
* Gestión de los usuarios, obras y capítulos por parte de administradores.
* Gestionar la creación, modificación y borrado de obras.
* Gestionar la creación, modificado y borrado de capítulos.
* Gestionar el estado de la obra y capítulos para cada usuario.
* Uso del lector con sus diferentes vistas.

# Elemento de innovación

* Laravel Framework.
* Livewire Framework para el uso de alpinejs y tailwindcss
* Amazon S3 como servicio de almacenamiento.
* CKEditor para la creación y edición de obras cuyo contenido no son imágenes.
