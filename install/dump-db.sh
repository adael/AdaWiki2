#!/bin/bash

mysqldump --opt -u root wiki > db-dump.sql
mysqldump --opt -u root --no-data wiki > db-schema.sql


