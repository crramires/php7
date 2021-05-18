use php7;


create  table tb_usuarios(
    idusuario int not null auto_increment primary key,
    deslogin varchar(56) not null,
    dessenha varchar(256) not null
);

create procedure sp_usuarios_insert (
    pdeslogin varchar(56),
    pdessenha varchar(256)
)
begin

    insert into tb_usuarios (deslogin, dessenha) values (pdeslogin, pdessenha);
    select * from tb_usuarios where idusuario = last_insert_id();

end
