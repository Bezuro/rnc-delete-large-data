# RNC-DELETE-LARGE-DATA

### Overview
This program implements a command-line interface (CLI) tool for deleting data from a specified table in the database. The code for the command is located in `app/Console/Commands/DeleteDataCommand.php`.

Usage
The command supports the following format:
```
php artisan delete:data tableName "YYYY-MM-DD HH:MI:SS"
```

- tableName: The name of the table from which data will be deleted.
- "YYYY-MM-DD HH:MI:SS": The date and time up to which records will be deleted. Only records created before this date and time will be removed.

### Customization
You can customize the behavior of the command by adjusting the `$batchSize` variable in the code located in `app/Console/Commands/DeleteDataCommand.php`. This variable determines the number of records deleted in a single batch operation. Changing this value may affect the performance and resource consumption of the command.

### Example
To delete records from the users table created before January 1, 2023, you can execute the following command:

```
php artisan delete:data users "2023-01-01 00:00:00"
```

#### Note
- Ensure that you have proper database backup procedures in place before executing this command, as data once deleted cannot be recovered.
