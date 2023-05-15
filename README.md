# Omar Zahit Rios Mercado

Prueba técnica para Coppel

## Usuario de prueba

user: test
password: test

## Seeders o fixtures
El sistema ya cuenta con ejemplos de usuarios y roles en el sistema que el usuario puede usar para registrar entregas y calcular los salarios mensuales

## Store procedures vs Subscribers

Con la finalidad de dejar toda la lógica versionada en el repositorio, no utilicé store proceduers y en el proyecto configuré los siguientes subcribers:

- Para los roles el sueldo base mensual se calcula cada vez que alguna entidad del modelo Rol se crea o se actualiza


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


