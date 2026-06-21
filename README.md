# Proyecto Laravel - Gestión de Academia

Este es un proyecto desarrollado con Laravel 10 (PHP 8.1+).Sistema de gestión basado en roles (RBAC). Destaca la implementación de autenticación customizada, middlewares variadic para control de acceso granular, validaciones complejas en formularios y automatización de base de datos con Factories y Seeders.
## Arquitectura y Estructura del Proyecto

### 1. Modelos y Migraciones
Se han diseñado e implementado las siguientes tablas en la base de datos usando migraciones de Laravel:
*   **Usuarios (`users`)**: Sistema de autenticación adaptado. Campos: `login` (único), `nombre`, `apellidos`, `dni` (único), `password`, `rol` (enum: 'admin', 'profesor').
*   **Alumnos (`alumnos`)**: Gestión del alumnado. Campos: `nombre`, `apellidos`, `email` (único), `nivel` (enum: 'basico', 'intermedio', 'avanzado'), `es_becado` (boolean).
*   **Clases (`clases`)** y **Pagos (`pagos`)**: Migraciones preparadas para extender las funcionalidades de la plataforma.

### 2. Autenticación y Autorización
*   **Login Customizado**: Se implementó un controlador personalizado (`LoginControllerForm`) para manejar el inicio y cierre de sesión de los usuarios de la plataforma.
*   **Middleware Personalizado (`CheckRole`)**: Se ha creado un middleware robusto que verifica los roles del usuario logueado. Usa el operador `...` (variadic) para admitir múltiples roles por ruta, protegiendo las secciones de la aplicación de manera eficiente.

### 3. Enrutamiento (Routing)
Se estructuraron las rutas (`routes/web.php`) de manera segura utilizando grupos y middlewares:
*   **Rutas Públicas (Guest)**: `GET /` y `POST /login` para el acceso al sistema.
*   **Rutas Privadas (Auth)**:
    *   Cierre de sesión seguro.
    *   **Grupo 'admin,profesor'**: Acceso de lectura al listado de alumnos (`alumnos.index`).
    *   **Grupo 'admin'**: Acceso total mediante `Route::resource` al controlador de alumnos (crear, editar, eliminar), exceptuando el index para evitar duplicidad de URIs.

### 4. Controladores (Controllers)
*   **`AlumnoController`**: Controlador de tipo resource. Funcionalidades incluidas:
    *   Listado con **Paginación** (5 elementos por página).
    *   **Validaciones Robustas (`Request validate`)**: Inclusión de reglas como `Rule::in` para validación de campos Enum (niveles), validaciones `unique` dinámicas para el email que ignoran el ID actual en el método `update`, y manejo lógico de checkboxes para campos booleanos (`es_becado`).
    *   Manejo completo del CRUD (Create, Read, Update, Delete) enfocado en seguridad y optimización.

### 5. Vistas (Views)
Utilizando el motor de plantillas **Blade**, se desarrollaron:
*   **Layout base (`layout.blade.php`)**: Estructura de diseño reutilizable.
*   **Vistas de Auth**: Formulario de inicio de sesión (`login.blade.php`).
*   **Vistas de Alumnos**:
    *   `index.blade.php`: Listado de alumnos con botones de acción condicionados por el rol del usuario (solo el administrador ve los botones de crear, editar y eliminar).
    *   `create.blade.php` / `edit.blade.php`: Formularios con manejo de errores de validación y persistencia de datos antiguos (`old()`) para mejorar la Experiencia de Usuario (UX).

### 6. Bases de datos (Seeders & Factories)
Se implementó un entorno de prueba realista automatizado (`DatabaseSeeder.php`):
*   **Creación manual de Administrador Root**: Usuario fijo `admin/admin` para garantizar siempre el acceso al sistema.
*   **Generación de Profesores**: Generación masiva automatizada de cuentas de profesor.
*   **`AlumnoFactory`**: Implementación del patrón Factory (`Alumno::factory(15)->create()`) utilizando FakerPHP para popular la base de datos con decenas de registros realistas de manera instantánea, fundamental para realizar pruebas de paginación e interfaz de usuario.

## Tecnologías y Herramientas Destacadas
*   **Framework:** Laravel 10.10
*   **Lenguaje:** PHP 8.1+
*   **Base de datos:** Soportada por el ORM Eloquent y Query Builder de Laravel.
*   **Frontend:** Blade Templating, CSS/JS a través de Vite (`vite.config.js`).

## Cómo levantar este proyecto
1. Instalar dependencias de PHP: `composer install`
2. Instalar dependencias de Node (opcional si usas Vite): `npm install`
3. Copiar archivo de entorno: `cp .env.example .env`
4. Generar App Key de cifrado: `php artisan key:generate`
5. Ejecutar migraciones y seeders para generar la BD: `php artisan migrate --seed`
6. Levantar servidor local: `php artisan serve` y `npm run dev` (para compilar assets).
