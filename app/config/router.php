<?php

$router = $di->getRouter();

// Define your routes here

// Gantt Task
$router->add("/api/gantt/data", "API::get", ["GET"]); // GET Data task and links

$router->add("/api/gantt/data/task", "API::addTask", ["POST"]); // INSERT NEW TASK
$router->add("/api/gantt/data/task/{id}", "API::deleteTask", ["DELETE"]); // DELETE TASK WITH ID
$router->add("/api/gantt/data/task/{id}", "API::updateTask", ["PUT"]); // UPDATE TASK WITH ID

// Gantt link
$router->add("/api/gantt/data/link", "API::addLink", ["POST"]); // INSERT NEW Link
$router->add("/api/gantt/data/link/{id}", "API::updateLink", ["PUT"]); // UPDATE Link WITH ID
$router->add("/api/gantt/data/link/{id}", "API::deleteLink", ["DELETE"]); // DELETE Link WITH ID


$router->handle();
