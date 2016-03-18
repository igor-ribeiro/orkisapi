# OrkisApp API

## Usuários
```
GET     /v1/users
POST    /v1/users first_name, last_name, email, password
GET     /v1/users/{username}
PUT     /v1/users/{username}
PATCH   /v1/users/{username}
DELETE  /v1/users/{username}
GET     /v1/users/{username}/nurseries
```

## Orquidários
```
GET     /v1/nurseries
POST    /v1/nurseries name, document
GET     /v1/nurseries/{document}
PUT     /v1/nurseries/{document}
PATCH   /v1/nurseries/{document}
DELETE  /v1/nurseries/{document}
```

## Orquídeas
@todo
