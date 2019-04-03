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

select * from amigos;
select * from usuario;
select * from publicacion;
delete from publicacion where idPublicacion=8 or idPublicacion=9;

/*insert into amigos (idAmigo1, idAmigo2) values (1,2);
insert into amigos (idAmigo1, idAmigo2) values (2,3);
select * from amigos
delete from amigos where idAmigos = 8;*/

select * from publicacion as p
inner join amigos as a on a.idAmigo1=p.idUsuario or a.idAmigo2=p.idUsuario/*Se obtiene si es del amigo 1 o amigo 2*/
where a.idAmigo1=2 or a.idAmigo2=2;/*el número va a ser el id del usuario que está loggeado*/


SELECT * FROM publicacion as p
 inner join amigos as a on a.idAmigo1=p.idUsuario or a.idAmigo2=p.idUsuario
 inner join usuario as u on p.idUsuario = u.idUsuario 
 where a.idAmigo1=1 or a.idAmigo2=1
 order by p.idPublicacion desc;
/*
delete from amigos where idAmigo2=1*/
select * from publicacion  as p
inner join amigos as a on a.idAmigo1=p.idUsuario or a.idAmigo2=p.idUsuario
where visibilidad=0;


-- Consulta correcta
 SELECT idPublicacion, idUsuarioPublicacion, titulo,
 visibilidad, descripcion, fecha, direccionImagen, idUsuario, nombreUsuario, apellidoUsuario
 FROM publicacion as p
 inner join amigos as a on a.idAmigo1=p.idUsuarioPublicacion or a.idAmigo2=p.idUsuarioPublicacion
 inner join usuario as u on p.idUsuarioPublicacion = u.idUsuario 
 where a.idAmigo1=1 or a.idAmigo2=1
 
 union
 
 select idPublicacion, idUsuarioPublicacion, titulo,
 visibilidad, descripcion, fecha, direccionImagen, idUsuario, nombreUsuario, apellidoUsuario
 from publicacion as p
  inner join usuario as u on p.idUsuarioPublicacion = u.idUsuario
 where visibilidad = 0 or idUsuarioPublicacion=1
 order by idPublicacion desc;
  
 -- Fin de consulta correcta.
 

select * from publicacion;
update publicacion set idUsuario=3 where idPublicacion=11;
/*update publicacion set visibilidad=0 where idPublicacion = 8 or idPublicacion = 11;*/
create table publicacion
(
	idPublicacion int primary key auto_increment,
    idUsuario int,
    titulo varchar(100),
    visibilidad int,-- Privada 1, publica 0.
    descripcion varchar(2048),
    fecha datetime,
    direccionImagen varchar(200),
    foreign key publicacionDeUsuario (idUsuario) references usuario(idUsuario)
);
alter table publicacion change idUsuario idUsuarioPublicacion int;
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