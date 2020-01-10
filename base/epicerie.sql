/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  09/01/2020 07:09:27                      */
/*==============================================================*/


drop table if exists MOUVEMENTS;

drop table if exists PRODUITS;

/*==============================================================*/
/* Table : MOUVEMENTS                                           */
/*==============================================================*/
create table MOUVEMENTS
(
   ID_MOUVEMENTS        int not null auto_increment,
   ID_PRODUITS          int not null,
   QUANTITE             decimal not null,
   TYPE                 int not null,
   DATE                 date not null,
   primary key (ID_MOUVEMENTS)
);

INSERT INTO `MOUVEMENTS` (`ID_PRODUITS`, `QUANTITE`, `TYPE`,`DATE`) VALUES 
(1, 5, 1,'2020-01-09'),
(2, 5, 1,'2020-01-09');

/*==============================================================*/
/* Table : PRODUITS                                             */
/*==============================================================*/
create table PRODUITS
(
   ID_PRODUITS          int not null auto_increment,
   NOM                  varchar(50) not null,
   STOCK                decimal not null,
   IMAGE                text not null,
   primary key (ID_PRODUITS)
);

INSERT INTO `PRODUITS` (`NOM`, `STOCK`, `IMAGE`) VALUES 
('BANANE', 5, ''),
('ORANGE', 5, ''),
('LETCHIS', 0, ''),
('FRAISE', 0, ''),
('PECHE', 0, '');

alter table MOUVEMENTS add constraint FK_ASSOCIATION_1 foreign key (ID_PRODUITS)
      references PRODUITS (ID_PRODUITS) on delete restrict on update restrict;

