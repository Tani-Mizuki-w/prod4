create table dj_login(
  uid serial primary key,
  uname text not null,
  email text not null,
  password text not null) without oids;

  create table dj_post(
    id serial primary key,
    uname text not null,
    genre text,
    content text,
    post_time timestamp) without oids;
