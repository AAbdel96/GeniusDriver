<?php

include_once 'PeopleDB.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PeopleAPI
 *
 * @author Genius
 */
class PeopleAPI {

    public function API() {
        header('Content-Type: application/JSON');
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'GET'://consulta
                $this->getPeoples();
                break;
            case 'POST'://inserta
                $this->savePeople();               
                break;
            case 'PUT'://actualiza
                $this->updatePeople();
                break;
            case 'DELETE'://elimina
                $this->deletePeople();
                break;
            default://metodo NO soportado
                echo 'METODO NO SOPORTADO';
                break;
        }
    }
    /**
     * Respuesta al cliente
     * @param int $code Codigo de respuesta HTTP
     * @param String $status indica el estado de la respuesta puede ser "success" o "error"
     * @param String $message Descripcion de lo ocurrido
     */
    function response($code = 200, $status = "", $message = "") {
        http_response_code($code);
        if (!empty($status) && !empty($message)) {
            $response = array("status" => $status, "message" => $message);
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
	
    /**
      2 * función que segun el valor de "action" e "id":
      3 *  - mostrara una array con todos los registros de personas
      4 *  - mostrara un solo registro
      5 *  - mostrara un array vacio
      6 */
    function getPeoples() {
        if ($_GET['action'] == 'peoples') {
            
            $email = $_GET['email'];
            $contrasena = $_GET['contrasena'];
            echo $email;
            
            
            $db = new PeopleDB();
            if (isset($_GET['email'])) {//muestra 1 solo registro si es que existiera ID                 
                $response = $db->getPeople($email,$contrasena);
                echo json_encode($response, JSON_PRETTY_PRINT);
                
            } else { //muestra todos los registros                   
                $response = $db->getPeoples();
                echo json_encode($response, JSON_PRETTY_PRINT);
                echo json_encode($response, JSON_PRETTY_PRINT);
               
            }
        } else {
            $this->response(400);
        }
    }
 
    /**
      2  * metodo para guardar un nuevo registro de persona en la base de datos
      3 */
    function savePeople() {
		
        if ($_GET['action'] == 'peoples') {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];

                
            $people = new PeopleDB();
            $ret = $people->insert($name, $email, $contrasena);
            
            
            //aqui controlamos si el correo electronico esta en uso.
            if(!$ret == '1')
            {
                $this->response(200, "Error", "Correo electronico en uso!");
            }
            else
            {
                $this->response(200, "success", "Usuario anadido Correctamente!");
            }

            //header('Location: '); Sirve par redirigir al usuario a otra pagina
        } else {
            $this->response(400);
        }
    }

    /**
     * Actualiza un recurso
     */
    function updatePeople() {
        if (isset($_GET['action']) && isset($_GET['id'])) {
            if ($_GET['action'] == 'peoples') {
                $obj = json_decode(file_get_contents('php://input'));
                $objArr = (array) $obj;
                if (empty($objArr)) {
                    $this->response(422, "error", "Nothing to add. Check json");
                } else if (isset($obj->name)) {
                    $db = new PeopleDB();
                    $db->update($_GET['id'], $obj->name);
                    $this->response(200, "success", "Record updated");
                } else {
                    $this->response(422, "error", "The property is not defined");
                }
                exit;
            }
        }
        $this->response(400);
    }

    /**
     * elimina persona
     */
    function deletePeople() {
        if (isset($_GET['action']) && isset($_GET['id'])) {
            if ($_GET['action'] == 'peoples') {
                $db = new PeopleDB();
                $db->delete($_GET['id']);
                $this->response(204);
                exit;
            }
        }
        $this->response(400);
    }

}

//end class
?>