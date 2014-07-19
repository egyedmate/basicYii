CREATE TABLE users (
    id SERIAL,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL,
    activkey VARCHAR(128) NOT NULL DEFAULT '',
		create_at timestamp DEFAULT now() NOT NULL,
		lastvisit timestamp DEFAULT now() NOT NULL,
    superuser INTEGER NOT NULL DEFAULT 0,
    status INTEGER NOT NULL DEFAULT 0,
    CONSTRAINT users_pk PRIMARY KEY (id)
);

CREATE UNIQUE INDEX users_username ON users (username);

CREATE UNIQUE INDEX users_email ON users (email);

CREATE INDEX users_status ON users (status);

CREATE INDEX users_superuser ON users (superuser);

CREATE TABLE profiles (
    user_id SERIAL,
    lastname VARCHAR(50) NOT NULL DEFAULT '',
    firstname VARCHAR(50) NOT NULL DEFAULT '',
    CONSTRAINT profiles_pk PRIMARY KEY (user_id)
);

ALTER TABLE profiles
  ADD CONSTRAINT user_profile_id FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE;

CREATE TABLE profiles_fields (
    id SERIAL,
    varname VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    field_type VARCHAR(50) NOT NULL,
    field_size VARCHAR(15) NOT NULL DEFAULT '0',
    field_size_min VARCHAR(15) NOT NULL DEFAULT '0',
    required INTEGER NOT NULL DEFAULT 0,
    match VARCHAR(255) NOT NULL DEFAULT '',
    range VARCHAR(255) NOT NULL DEFAULT '',
    error_message VARCHAR(255) NOT NULL DEFAULT '',
    other_validator VARCHAR(5000) NOT NULL DEFAULT '',
    default2 VARCHAR(255) NOT NULL DEFAULT '',
    widget VARCHAR(255) NOT NULL DEFAULT '',
    widgetparams VARCHAR(5000) NOT NULL DEFAULT '',
    position INTEGER NOT NULL DEFAULT 0,
    visible INTEGER NOT NULL DEFAULT 0,
    CONSTRAINT profiles_fields_pk PRIMARY KEY (id)
);

CREATE INDEX profiles_fields_varname ON profiles_fields (varname, widget, visible);


INSERT INTO users(id,username,password,email,activkey,superuser,status) VALUES(1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','9a24eff8c15a6a141ece27eb6947da0f',1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac',0,1);

INSERT INTO profiles(user_id,lastname,firstname) VALUES(1,'Admin','Administrator'),(2,'Demo','Demo');

INSERT INTO profiles_fields(id,varname,title,field_type,field_size,field_size_min,required,match,range,error_message,other_validator,default,widget,widgetparams,position,visible) VALUES(1,'lastname','Last Name','VARCHAR',50,3,1,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',1,3),(2,'firstname','First Name','VARCHAR',50,3,1,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',0,3);

