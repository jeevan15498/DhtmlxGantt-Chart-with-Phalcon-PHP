# Setup dhtmlxGantt with Phalcon PHP

# Steps

* Install Phalcon PHP Framework
* Controllers
    ```html
    <!-- Home Page -->
    IndexController.php

    <!-- API -->
    APIController.php
    ```
* View file `app\views\index\index.phtml`
* Routes
    ```php
    // Gantt Task
    $router->add("/api/gantt/data", "API::get", ["GET"]); // GET Data task and links

    $router->add("/api/gantt/data/task", "API::addTask", ["POST"]); // INSERT NEW TASK
    $router->add("/api/gantt/data/task/{id}", "API::deleteTask", ["DELETE"]); // DELETE TASK WITH ID
    $router->add("/api/gantt/data/task/{id}", "API::updateTask", ["PUT"]); // UPDATE TASK WITH ID

    // Gantt link
    $router->add("/api/gantt/data/link", "API::addLink", ["POST"]); // INSERT NEW Link
    $router->add("/api/gantt/data/link/{id}", "API::updateLink", ["PUT"]); // UPDATE Link WITH ID
    $router->add("/api/gantt/data/link/{id}", "API::deleteLink", ["DELETE"]); // DELETE Link WITH ID
    ```
* Setup Database Connection `app\config\services.php`
   ```php
    // Database Connection
    $di->set('db', function() {
        $config = $this->getConfig();

        try {
            $db = new \Phalcon\Db\Adapter\Pdo\Mysql(
                array(
                    "host" => $config->database->host,
                    "username" => $config->database->username,
                    "password" => $config->database->password,
                    "dbname" => $config->database->dbname
                )
            );
        } catch (Exception $e) {
            die("<b>Error when initializing database connection:</b> " . $e->getMessage());
        }
        return $db;
    });
   ```
* Database Query
    ```sql
    CREATE TABLE `gantt_links` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `source` int(11) NOT NULL,
        `target` int(11) NOT NULL,
        `type` varchar(1) NOT NULL,
        PRIMARY KEY (`id`)
    );

    CREATE TABLE `gantt_tasks` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `text` varchar(255) NOT NULL,
        `start_date` datetime NOT NULL,
        `duration` int(11) NOT NULL,
        `progress` float NOT NULL,
        `parent` int(11) NOT NULL,
        PRIMARY KEY (`id`)
    );
    ```


