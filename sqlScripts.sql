-- run script to create table in ghostDB.. (pgAdmin4)

CREATE TABLE courses (
  id SERIAL PRIMARY KEY,
  subject TEXT,
  title TEXT,
  instructor TEXT,
  email TEXT,
  location TEXT,
  meeting_start TEXT,
  meeting_end TEXT,
  weekdays TEXT,
  start_date TEXT,
  end_date TEXT
  max_capacity TEXT, 
  total_enrolled TEXT, 
  total_waitlisted TEXT
);



