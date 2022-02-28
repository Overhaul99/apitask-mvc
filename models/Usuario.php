<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado', 'permiso', 'area'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->permiso = $args['permiso'] ?? 0;
        $this->area = $args['area'] ?? 1;
    }

    //Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del usuario es obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no valido';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña no puede ir vacía';
        }

        return self::$alertas;
    }

    //Validación para cuentas nuevas
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del usuario es obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email del usuario es obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña no puede ir vacía';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las Contraseñas son diferentes';
        }
        return self::$alertas;
    }

    //Valida un Email
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no valido';
        }

        return self::$alertas;
    }

    //Validar la Contraseña
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña no puede ir vacía';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function validar_perfil() : array{
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) { 
            self::$alertas['error'][] = 'La Contraseña Actual es Obligatoria';
        }
        if(!$this->password_nuevo) { 
            self::$alertas['error'][] = 'La Contraseña Nueva es Obligatoria';
        }
        if(strlen($this->password_nuevo) < 6) { 
            self::$alertas['error'][] = 'La Contraseña Nueva debe contener al menos de 6 Caracteres';
        }

        return self::$alertas;
    }

    //Comprobar el password
    public function comprobar_password() : bool{
        return password_verify($this->password_actual, $this->password);
    }

    //Hashea el password
    public function hashPassword() : void{
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //Generar un Token
    public function crearToken() : void{
        $this->token = uniqid();
    }

}