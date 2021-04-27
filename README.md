# projet-API-PHP-Slim

#Variable de entorno:

```
    DB_HOST=""
    DB_USER=""
    DB_PASS=""
    DB_NAME=""
    VI_ENCRYPT=""
    KEY_ENCRYPT=""
    METOD_ENCRYPT=""
    USER_DEFAULT=""
    PASSWORD_DEFAULT=""
```

Este proyecto permite meter en las variables de entorno un usuario por defecto que sera el unico que hara consultas
para configurar una autenticación, ignore USER_DEFAULT, PASSWORD_DEFAULT en el codigo y aplique su autenticación que prefiera.


usar generateApiKey enviando su usuario y contraseña puestas en USER_DEFAULT, PASSWORD_DEFAULT para que se le de un apiKey que le permitira consumir la API.