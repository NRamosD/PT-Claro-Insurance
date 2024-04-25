# PT-Claro-Insurance

Proyecto desarrollado con Laravel 11 y Angular 17 
## Detalles de Tecnologías Principales
Se hace uso de PHP 8.3, Composer 2.7, MySQL 8, Laravel 11 y Angular 17

## Explicación
El proyecto cuenta con dos carpetas principales, una pertenece al backend con laravel 11 y la otra al frontend con Angular 17. En la raíz del proyecto se encuentra un archivo .json que puede ser importado con ThunderClient para probar el funcionamiento de la API

## Instalación
### Frontend
- cd frontend
- npm i
- ng serve
### Backend
- cd backend
- composer install
- Crear archivo .env con los datos de su base de datos MySQL 
- php artisan migrate (en caso de que aparezca un mensaje escribir "yes")
- php artisan serve
- rutas de la api en http://localhost:8000/api/[nombredelatabla]

| Base de Datos | 
| :-:   | 
| ![Login](https://raw.githubusercontent.com/NRamosD/PT-Claro-Insurance/master/BD%20PT.png "Base de Datos") |

| Creación de Endpoints con Laravel 11 | Detalles de EndPoints |
| :-:   | :-: | 
| ![Login](https://raw.githubusercontent.com/NRamosD/PT-Claro-Insurance/master/endpointuser.png "Creación de Endpoints con Laravel 11") | ![Home](https://raw.githubusercontent.com/NRamosD/PT-Claro-Insurance/master/moreendp.png "Detalles de EndPoints") |

| Muestro Datos en Angular 17 | BD |
| :-:   | :-: | 
| ![Login](https://raw.githubusercontent.com/NRamosD/PT-Claro-Insurance/master/muestrodatos.png "Muestro Datos en Angular 17") | ![Home](https://raw.githubusercontent.com/NRamosD/PT-Claro-Insurance/master/BD%20PT.png "BD") |


