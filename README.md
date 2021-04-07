## rustest

rustest will

1. Deploy the Laravel framework (minimum version 8)
2. Make entities (tables): User, Department, Position
	A user can be in several departments, but still have only one position (use connections)
3. Implement CRUD
4. The user must be able to upload photos
5. Display data in the table view, you can use ready-made css frameworks, such as Bootstrap, Uikit, TailWind
6. Make the permissions for Admin, Manager, User.
	Admin - has all the rights
	Manager-can change data, add data, but cannot delete records
	User - can only view data
7. Date output format DD.MM.YYYY
8. The progress of work is displayed by commits in the GIT.
9. To demonstrate the result of the work, use one of the popular repositories GitHub, BitBucket, or others.

Users ------
Admin User - admin@gmail.com
Admin Pass = 12345678

Manager User - manager@gmail.com
Manager Pass = 12345678

User User - user@gmail.com
User Pass = 12345678

**** sql file is provided ****

## Development setup
At first clone the repository from github
Run the below command - 

To update composer:
```
composer update
```

To install node:
```
npm install or npm update
```
Then create a database to local server and update databse name username and password to .env file
To generate entity to the database:
```
php artisan migrate
```


