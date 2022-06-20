# Authentication Server

# Table of Contents
- [Setup](#setup)
    - [XAMPP](#xampp)
- [API Endpoints](#api-endpoints)

## Setup
Open the "inc/config.php" file and fill in the Host Name, Username, Password, and Database Name.

### XAMPP
1) Download this repo and move the directory to the "xampp/htdocs" directory.

2) Change the repo directory name a desired name. 

3) Use the following url format to use the Rest API:
```
 {HostName}/{DesiredName}/index.php/{EndPoint}
```

## API Endpoints

These endpoints allow a user to read and modify the contents of the database.


### GET/POST
`{HostName}/{DesiredName}/index.php/login?username={username}&password={password} `
