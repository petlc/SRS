
For /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c-%%a-%%b)

set backupdir=c:\xampp\htdocs\SRS_DB_BU\
set db=service_request

echo %backupdir%

c:\xampp\mysql\bin\mysqldump --user=root --databases %db% > %backupdir%%db%_%mydate%.sql