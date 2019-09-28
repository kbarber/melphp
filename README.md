# Rock Paper Scissors

## Running the content

    $ docker run -d -v `pwd`:/app -p 8080:80 tutum/lamp
    1d1773a74eee

Remeber the ID, you'll need it later

## Creating the table

Get a shell on the container:

    docker exec -it 1d1773a74eee bash

Now create the database:

    $ mysql
    mysql> create database games;
    mysql> use games;

Now create the table:

    mysql> source /app/newtable.sql
