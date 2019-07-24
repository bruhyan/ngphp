# NgPhp
by Bryan Koh (bruhyan)

## Description
NgPhp is a web application that supports file upload and download using Angular as frontend ans PHP as backend. The database does not store files as BLOB but stores route directory to storage folder of uploaded file.


php file serving note:

1) the backend code (phpbackend) were developed and served using xampp and were not tested on other
deployment platforms, additional information such as server url may have to be added if not using
xampp.

2) the backend code has configurations that may not be suitable for production, please be aware. 
For example, the connect.php has headers that allow CORS for all domains.

development deployment:
1) cd to angular front end (ngphp) and run command: ng serve
2) place backend code (phpbackend) into xampp htdocs folder to serve (make sure apache and mysql is running)
