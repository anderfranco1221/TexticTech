export class Usuario {
    id: number;
    nombre: string;
    apellido: string;
    email: string;
    password: string;
    fechaCreacion: Date;
    fechaActualizacion: Date;

    constructor(id: number, nombre: string, apellido: string, email: string, password: string, fechaCreacion: Date, fechaActualizacion: Date) {
        this.id = id;
        this.nombre = nombre;
        this.apellido = apellido;
        this.email = email;
        this.password = password;
        this.fechaCreacion = fechaCreacion;
        this.fechaActualizacion = fechaActualizacion;
    }
}