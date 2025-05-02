-- run script to create table in ghostDB.. (pgAdmin4)




CREATE TABLE courses (
  key SERIAL PRIMARY KEY,
  subject TEXT,
  id TEXT,
  title TEXT,
  courseDescription TEXT,
  units TEXT,
  instructor TEXT,
  email TEXT,
  location TEXT,
  coursePrereq TEXT,
  meeting_start TEXT,
  meeting_end TEXT,
  weekdays TEXT,
  start_date TEXT,
  end_date TEXT,
  max_capacity TEXT, 
  total_enrolled TEXT, 
  total_waitlisted TEXT
);



UPDATE courses
SET meeting_start = TO_CHAR(TO_TIMESTAMP(meeting_start, 'HH:MI:SS.USPM'), 'HH:MI AM'),
    meeting_end = TO_CHAR(TO_TIMESTAMP(meeting_end, 'HH:MI:SS.USPM'), 'HH:MI AM');


SELECT *
FROM courses
WHERE NOW()::time 



--debug notes--

--database not serving 
--brew services list
-- brew services start postgresql@14

--loading screen stuck 
--sudo lsof -i :3000
--sudo kill -9 $(sudo lsof -t -i:3000)


