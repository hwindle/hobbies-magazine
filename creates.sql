CREATE TABLE hobbies (
  id    SERIAL PRIMARY KEY,
  date  VARCHAR(10) NOT NULL,
  vol   NUMERIC(4),
  issue  NUMERIC(5),
  folder  VARCHAR(10)
);

CREATE TABLE contents (
  id SERIAL PRIMARY KEY,
  contents  VARCHAR(50),
  page      NUMERIC(3),
  category  VARCHAR(30),
  mag_id    INTEGER,
  FOREIGN KEY (mag_id) REFERENCES hobbies (id)
);

/* ALTER ROLE hazel WITH PASSWORD 'somepassword';

otherwise you can't login!
*/
