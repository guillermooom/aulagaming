DROP DATABASE IF EXISTS gaming;
CREATE DATABASE gaming;

USE gaming;

DROP TABLE IF EXISTS usuarios;

create table usuarios (email varchar(50) not null, nombre varchar(20) not null, apellido varchar(20) not null,
 contra varchar(20)	, fecha_alta date not null, vetado date, pc_reservados int not null) ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table usuarios add constraint pk_usuarios primary key (email);

insert into usuarios (email , nombre , apellido , contra , fecha_alta , vetado, pc_reservados ) values
('paco@educamadrid.com','Paco','Gonzalez','admin','2023-05-08',NULL,'0'),
('manolo@educamadrid.com','Manolo','Lama','admin','2023-05-09',NULL,'0'),
('maria@educamadrid.com','María','Gonzalez','admin','2023-05-08',NULL,'0');


DROP TABLE IF EXISTS pc;

create table pc (id int, estado varchar(10)) ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table pc add constraint pk_pc primary key (id);

insert into pc (id, estado) values
('1', 'Correcto'),
('2', 'Correcto'),
('3', 'Correcto'),
('4', 'Correcto'),
('5', 'Correcto'),
('6', 'Correcto'),
('7', 'Correcto'),
('8', 'Correcto'),
('9', 'Correcto'),
('10', 'Correcto');


DROP TABLE IF EXISTS reservar;
create table reservar (email varchar(50) not null, id int not null, fecha_reserva date not null, turno varchar(10) not null, incidencia date)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table reservar add constraint pk_reservar primary key (email,id, fecha_reserva);
alter table reservar add constraint fk_reservar_email foreign key (email) references usuarios(email);
alter table reservar add constraint fk_reservar_id foreign key (id) references pc(id);

insert into reservar  (email , id , fecha_reserva , turno , incidencia ) values
('paco@educamadrid.com','2','2023-05-08','tarde',NULL),
('maria@educamadrid.com','4','2023-05-07','tarde',NULL),
('paco@educamadrid.com','5','2023-05-08','mañana',NULL),
('manolo@educamadrid.com','1','2023-05-07','mañana',NULL);

commit;	
