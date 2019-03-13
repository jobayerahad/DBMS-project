# DBMS-project
Installation Process
- Simply download the whole project.
- Make a Database named "**blog**". Or adjust the configuration in *config/config.php* file. 
- Create three table's with these SQL below: \n
**posts Table SQL :**
```sql
CREATE TABLE `blog`.`posts` 
( `id` INT NOT NULL AUTO_INCREMENT , 
  `title` VARCHAR(100) NOT NULL , 
  `body` TEXT NOT NULL , 
  `image` VARCHAR(150) NOT NULL , 
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  `cat_id` INT NOT NULL , 
  `auth_id` INT NOT NULL , 
  PRIMARY KEY (`id`)) 
ENGINE = InnoDB;
```
**Category Table SQL :**
```sql
CREATE TABLE `blog`.`category` 
( `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(50) NOT NULL , 
  PRIMARY KEY (`id`)) 
ENGINE = InnoDB;
```
**Author Table SQL :**
```sql
CREATE TABLE `blog`.`category` 
( `id` INT NOT NULL AUTO_INCREMENT , 
  `name` VARCHAR(50) NOT NULL ,
  `bio` TEXT NOT NULL , 
  `email` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(150) NOT NULL ,
  `photo` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`id`)) 
ENGINE = InnoDB;
```
## That's All. 
###### Visit my website [Ahad's Blog](http://jobayer.me)
