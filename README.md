# e-signature app

## Prerequisites

1. Docker must be installed.

## Install Steps

1. build the custom Docker server image.
1. Run docker compose.
1. Set File permissions.
1. Run database migration.
1. update the .env file


### STEP 1 (build the custom Docker server image)

Navagate to the root folder of the project. and run the Docker build cammand.
name the image mylamp. if you want to name it somthing diferant you must also change the name in the docker-compose.yml file.
```
docker build -t mylamp -f mylampDockerfile .
```
build the custom mysql server docker image
```
docker build -t mymysql -f myMysqlDockerfile .
```
### STEP 2 (Run docker compose)
run the docker compose camand to get the app up and rinning inside a container.
```
docker-compose up -d
```
### STEP 3 (Set File permissions)
make sure that you set the file permissions on the project. If you skip this step the signature images cant be saved into the folder.
```
sudo chmod 777 -R html/
```
### STEP 4 (Run database migration)
login to the mysql docker container
```
docker exec -it esigdatabase bash
```
login to mysql
```
mysql -ulamp_docker -ppassword
```
Run the migration to setup the database.
```
USE esignature; SOURCE /mysqlSetup/databaseBackup.sql; exit;
```
```
exit
```
### STEP 5 (update the .env file)
update all of the SMTP settings for sending emails.

The database variables you dont need to change.

```
cp html/esignature/sample.env html/esignature/.env
```
```
sudo nano html/esignature/.env
```
