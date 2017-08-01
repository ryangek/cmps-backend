@echo off
set /p app_name="Enter APP+NAME : "
rem ######################################
rem ## Add addon "Postgresql" on Heroku ##
rem ######################################
heroku apps:create %app_name%
heroku addons:create heroku-postgresql:hobby-dev --app %app_name%
heroku git:remote --app $app_name%
rem ##################################################
rem ## Set "APP_KEY","APP_LOG","APP_ENV" to project ##
rem ##################################################
for /f "delims=" %i in ('php artisan --no-ansi key:generate --show') do set app_key=%i
heroku config:set APP_KEY=%app_key%
heroku config:set APP_LOG=errorlog
heroku config:set APP_ENV=development APP_DEBUG=true APP_LOG_LEVEL=debug
rem #################################
rem ## DO upload project to Heroku ##
rem #################################
git add .
git commit -am "%app_name%"
git push heroku master
