create database bdstandds;
use bdstandds;

create table clientes(
  idcli int auto_increment primary key,
  nome varchar(120) not null,
  datanasc datetime default current_timestamp(),
  categoria enum('alfa','bravo','charlie'),
  tutor int,
  constraint fk_clientes_clientes foreign key(tutor)
              references clientes(idcli)
);

insert into clientes (nome,datanasc,categoria)
values('Tio Patinhas','1963-05-10','alfa'),
('Pato Donald','1973-06-10','bravo'),
('Peninha','1988-05-22','bravo'),
('Margarida','1986-06-10','charlie');

alter table clientes  add idade decimal(10,2) 
  generated always as((datediff('2025-07-11',datanasc)/365.25))stored;

update clientes set tutor=1; 
update clientes set tutor =(
   case idcli 
    when 1 then NULL
    when  2 then 1
    when  3 then 2
    else 3
   end 
);

create table carros (
 idcar int auto_increment primary key,
 modelo varchar(120) not null,
 phora decimal(10,2) check(phora between 0 and 500)
);

insert into carros (modelo,phora)
values ('Fiat 600',23.50),
       ('Ford Fiesta',43.50),
       ('Ferrari F40',120.50);

create table alugueres(
   idal int auto_increment primary key,
   idcli int ,
   constraint fk_alugueres_cliente foreign key(idcli) references clientes(idcli),
   idcar int,
   constraint fk_alugueres_caros foreign key(idcar)references carros(idcar),
   inicio datetime default current_timestamp(),
   fim datetime, 
   tempo decimal(10,2) generated always as ((to_seconds(fim)-to_seconds(inicio))/3600)virtual,
   custo decimal(10,2)
); 

insert into alugueres(idcli, idcar, inicio, fim)
select   c.idcli , ca.idcar, current_time(), 
   date_add(current_timestamp(), interval (rand()*1440) minute)  from clientes c, carros ca;  

update  alugueres  a  join carros ca  ON  a.idcar = ca.idcar 
     set a.custo = ca.phora * a.tempo;  

DELIMITER //
create procedure sp_dois(IN pidcli int , out total decimal(10,2))
begin
   select sum(custo) into total from alugueres where idcli =pidcli group by idcli;
end //
DELIMITER ;