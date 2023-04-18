DROP DATABASE IF EXISTS gaming;
CREATE DATABASE gaming;

USE gaming;

DROP TABLE IF EXISTS usuarios;

create table usuarios (usuario varchar(9) not null, nombre varchar(50) not null, apellido varchar(50) not null,
 curso varchar(50), fecha_alta date not null, ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table usuarios add constraint pk_usuarios primary key (dni);

insert into usarios (usuarios , nombre , apellido , curso , fecha_alta ) values
('Paco777','Paco','Gonzalez','2DAW','2023-05-08'),
('Manolito','Manolo','Lama','1DAM','2023-05-09'),
('Mariaaa','María','Gonzalez','2DAW','2023-05-08')


DROP TABLE IF EXISTS pc;

create table pc (id varchar(7), disponible varchar(1)) ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table pc add constraint pk_epatines primary key (matricula);

insert into pc (id, disponible ) values
('1', 'S'),
('2', 'S');


DROP TABLE IF EXISTS reservar;
create table reservar (usuario varchar(9) not null, id varchar(7) not null, fecha_reserva timestamp)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table reservar add constraint pk_reservar primary key (usuario,id, fecha_reserva);
alter table reservar add constraint fk_reservar_usuario foreign key (usuario) references usuarios(usuario);
alter table reservar add constraint fk_reservar_id foreign key (id) references pc(id);

insert into reservar  (usuario , id , fecha_reserva ) values
('Paco777','2','2023-05-08 13:00:00');

commit;	