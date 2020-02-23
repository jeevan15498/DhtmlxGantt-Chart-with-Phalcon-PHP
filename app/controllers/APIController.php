<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class APIController extends \Phalcon\Mvc\Controller
{

    /**
     * Fetch Gantt Data
     */
    public function getAction()
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isGet()) {

            /**
             * Fetch Gantt Tasks
             */
            $sql1 = 'SELECT * FROM gantt_tasks';
            $result1 = $this->db->query($sql1);

            // https://docs.phalcon.io/3.4/en/db-layer#finding-rows
            $result1->setFetchMode(Phalcon\Db::FETCH_ASSOC);
            // print_r($result->fetchAll());exit;

            /**
             * Fetch Gantt Links
             */
            $sql2 = 'SELECT * FROM gantt_links';
            $result2 = $this->db->query($sql2);

            // https://docs.phalcon.io/3.4/en/db-layer#finding-rows
            $result2->setFetchMode(Phalcon\Db::FETCH_ASSOC);
            // print_r($result->fetchAll());exit;

            $output = [
                "data"=> [],
                "links"=> []
            ];

            while ($row1 = $result1->fetch()) {
                array_push($output["data"], $row1);
            }

            while ($row2 = $result2->fetch()) {
                array_push($output["links"], $row2);
            }


            $response->setStatusCode(200, 'OK');
            $response->setJsonContent($output);

        } else {
            $response->setStatusCode(405, 'Method Not Allowed');
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }
        $response->send();
    }

    /**
     * Insert Gantt Task
     */
    public function addTaskAction()
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isPost()) {
            // var_dump($request->getPost());exit;

            $sql = 'INSERT INTO `gantt_tasks`(text, start_date, duration, progress, parent) VALUES (?, ?, ?, ?, ?)';
            $success = $this->db->execute(
                $sql,
                [
                    // POST Data
                    $request->getPost('text'),
                    $request->getPost('start_date'),
                    $request->getPost('duration'),
                    $request->getPost('progress'),
                    $request->getPost('parent'),
                ]
            );
            // var_dump($success);exit;

            if ($success) {

                $returnData = [
                    "action"=>"inserted",
                    "tid"=> $this->db->lastInsertId()
                ];

                $response->setStatusCode(200, 'OK');
                $response->setJsonContent($returnData);

            } else {

                // Show Error
                exit;
            }

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Delete Gantt Task
     */
    public function deleteTaskAction($id)
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isDelete()) {

            $sql = 'DELETE FROM gantt_tasks WHERE id = ?';
            $success = $this->db->execute($sql, [$id]);

            if ($success) {

                $returnData = [
                    "action"=>"deleted"
                ];

                $response->setStatusCode(200, 'OK');
                $response->setJsonContent($returnData);

            } else {

                // Show Error
                exit;
            }

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Update Gantt Task
     */
    public function updateTaskAction($id)
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isPut()) {
            // var_dump($request->getPut());exit;

            $sql = "UPDATE gantt_tasks SET text = ?, start_date = ?, duration = ?, progress = ?, parent = ? WHERE id = ?";
            $success = $this->db->execute($sql, [
                // POST Data
                $request->getPut('text'),
                $request->getPut('start_date'),
                $request->getPut('duration'),
                $request->getPut('progress'),
                $request->getPut('parent'),
                $id
            ]);

            if ($success) {

                $returnData = [
                    "action"=>"updated"
                ];

                $response->setStatusCode(200, 'OK');
                $response->setJsonContent($returnData);

            } else {

                // Show Error
                exit;
            }

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Insert Gantt Link
     */
    public function addLinkAction()
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isPost()) {
            // var_dump($request->getPost());exit;

            $sql = 'INSERT INTO gantt_links(source, target, type) VALUES (?, ?, ?)';
            $success = $this->db->execute($sql,
                [
                    // POST Data
                    $request->getPost('source'),
                    $request->getPost('target'),
                    $request->getPost('type')
                ]
            );
            // var_dump($success);exit;

            if ($success) {

                $returnData = [
                    "action"=>"inserted",
                    "tid"=> $this->db->lastInsertId()
                ];

                $response->setStatusCode(200, 'OK');
                $response->setJsonContent($returnData);

            } else {

                // Show Error
                exit;
            }

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Update Gantt Link
     */
    public function updateLinkAction($id)
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isPut()) {
            // var_dump($request->getPut());exit;

            $sql = "UPDATE gantt_links SET source = ?, target = ?, type = ? WHERE id = ?";
            $success = $this->db->execute($sql, [
                // POST Data
                $request->getPut('source'),
                $request->getPut('target'),
                $request->getPut('type'),
                $id
            ]);

            if ($success) {

                $returnData = [
                    "action"=>"updated"
                ];

                $response->setStatusCode(200, 'OK');
                $response->setJsonContent($returnData);

            } else {

                // Show Error
                exit;
            }

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Delete Gantt Link
     */
    public function deleteLinkAction($id)
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isDelete()) {

            $sql = 'DELETE FROM gantt_links WHERE id = ?';
            $success = $this->db->execute($sql, [$id]);

            if ($success) {

                $returnData = [
                    "action"=>"deleted"
                ];

                $response->setStatusCode(200, 'OK');
                $response->setJsonContent($returnData);

            } else {

                // Show Error
                exit;
            }

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }
}

