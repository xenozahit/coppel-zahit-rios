# Omar Zahit Rios Mercado

Prueba técnica para Coppel

## Usuario de prueba

user: test

password: test


## Mejoras al sistema

Se pueden registrar entregas por día, no es necesario registrar todas las entregas del mes. El sistema es capaz de agrupar las entregas realizadas por el trabajador y entregar el resultado del pago al trabajador

## Seeders o fixtures
El sistema ya cuenta con ejemplos de usuarios y roles en el sistema que el usuario puede usar para registrar entregas y calcular los salarios mensuales

Los fixtures son cargados en orden gracias a la interfaz DependentFixtureInterface

## Patrones de diseño utilizados

- MVC: Symfony ofrece una arquitectura basada en modelos, vistas y controladores, dejando así separada la lógica de negocio en el modelo, lo que ve el usuario en la vista y la respuesta al controlador

- Builder: en la mayoría de los CRUDS del bundle EasyAdmin de Symfony hay varias representaciones del patrón builder, por ejemplo (src/Controller/Admin/MonthlyPaymentCrudController.php)

- Observer: Con la finalidad de dejar toda la lógica versionada en el repositorio, no utilicé store procedures de base de datos, en su lugar, en el proyecto configuré un subscriber de Symfony, el cual utiliza un patrón observer, este se "despierta" cada vez que se registra un movimiento a un empleado.

- Inyección de dependencias: El modelo que se encarga de calcular los sueldos mensuales es llamado por el controlador src/Controller/MonthlyPaymentController.php el cual en su constructor utiliza la inyección de dependencias para acceder a funciones de otras clases como repositorios y servicios


## Descripción técnica del proyecto

**Lenguaje**: PHP 8.1

**Framework**: Symfony 6.2

**Bundles**:
- **Doctrine** -> ORM de la base de datos
- **Easy admin** -> creador de CRUDs 
- **Apache pack** -> router
- **Security bundle**
    - Protección contra ataques CSRF
    - Firewall para determinar que partes de la aplicación necesitan autenticación
    - Tipo de autenticación
    - Password hasher


