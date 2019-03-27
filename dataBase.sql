use sys;
/*drop database baseQA;*/
create database baseQA;
use baseQA;

create table usuario(
	idUsuario int primary key auto_increment,
    nombreUsuario varchar(50),
    apellidoUsuario varchar(100),
    direccionUsuario varchar(100),
    contrasennaUsuario varchar(256),
    fechaNacimiento date
);
insert into usuario (nombreUsuario, apellidoUsuario, direccionUsuario, contrasennaUsuario, fechaNacimiento)
 values ('Jose','Jimenez','jimenezjm28j','123','1996-11-28');

insert into usuario (nombreUsuario, apellidoUsuario, direccionUsuario, contrasennaUsuario, fechaNacimiento)
 values ('Luis','Aguilar','felipe','123','1996-11-28');
 
/*select * from usuario;*/
create table amigos
(
	idAmigos int primary key auto_increment,
	idAmigo1 int,
    idAmigo2 int,
    foreign key Amigo1 (idAmigo1) references usuario(idUsuario),
    foreign key Amigo2 (idAmigo2) references usuario(idUsuario)
);

/*insert into amigos (idAmigo1, idAmigo2) values (1,2);
select * from amigos
delete from amigos where idAmigos = 2;*/



create table publicacion
(
	idPublicacion int primary key auto_increment,
    idUsuario int,
    titulo varchar(100),
    visibilidad int,
    descripcion varchar(2048),
    fecha datetime,
    direccionImagen varchar(200),
    foreign key publicacionDeUsuario (idUsuario) references usuario(idUsuario)
);
/*delete from publicacion where idPublicacion = 2;*/
/*insert into publicacion (idUsuario,titulo,visibilidad,descripcion,fecha,direccionImagen) values
(1,'Primera publicacion',1,'Descripcion de la primera publicacion', sysdate(),'../publicaciones/images/publicacion1-1.jpeg');
select * from publicacion order by idPublicacion asc;
delete from publicacion where idPublicacion=3;
delete from publicacion where idPublicacion=7;
delete from publicacion where idPublicacion=6;
*/
create table likes
(
	idLike int primary key auto_increment,
    idPublicacion int,
    idUsuarioLike int,
    foreign key idPublicacionLike (idPublicacion) references publicacion(idPublicacion),
    foreign key idUsuarioDioLike (idUsuarioLike) references usuario(idUsuario)
);