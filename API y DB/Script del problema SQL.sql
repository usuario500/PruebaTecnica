CREATE DATABASE persona;
--"descomentar la siguiente linea"
--\c database persona;

--creación de la tabla e inserciones
Create table personas(
	id serial PRIMARY KEY,
    nombre VARCHAR (100) not null,
    edad INT not null
);

insert into personas (nombre, edad) values ('juan', 13);
insert into personas (nombre, edad) values ('Loid', 14);

--select * from personas p 


--creación y ejecucion de funcion
-- drop function insertar
Create or replace function insertar(nombre Varchar(100), edad int)
returns varchar as $$

begin 
	insert into personas (nombre, edad) values (nombre, edad);
	return 'Incerción completada';
end

$$ language plpgsql;

select insertar ('Cory', 31);



