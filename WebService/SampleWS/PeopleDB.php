<?php
/** 
 * @web http://www.jc-mouse.net/
 * @author jc mouse
 */
class PeopleDB {
    
    protected $mysqli;
    const LOCALHOST = '127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'dbtest';
    
    
    
    /**
     * Constructor de clase
     */
    public function __construct() {           
        try{
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
            
            
            
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }     
    } 
    
    /**
     * obtiene un solo registro dado su ID
     * @param int $id identificador unico de registro
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getPeople($email,$contrasena){      
        $stmt = $this->mysqli->prepare("SELECT * FROM people WHERE email = ? AND contrasena  = ?");
        $stmt->bind_param('ss',$email,$contrasena);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function comprobar_contrasena($email,$contrasena_vieja){
        
        $stmt = $this->mysqli->prepare("SELECT * FROM people WHERE email = ? AND contrasena  = ?");
        $stmt->bind_param('ss',$email,$contrasena_vieja);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;
    }
    
     public function recuperar_usuarios(){      
        $stmt = $this->mysqli->prepare("SELECT * FROM people");
        
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function recuperar_todas_fotos($email){      
        $stmt = $this->mysqli->prepare("SELECT * FROM imagenes where email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function recuperar_coches(){      
        $stmt = $this->mysqli->prepare("SELECT * FROM cars");
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function recuperar_imagenes(){      
        $stmt = $this->mysqli->prepare("SELECT * FROM imagenes");
        
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function recuperar_simulaciones(){      
        $stmt = $this->mysqli->prepare("SELECT * FROM simulaciones");
        
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    public function login_web($email,$contrasena){      
        $stmt = $this->mysqli->prepare("SELECT * FROM people WHERE email = ? AND contrasena  = ?");
        $stmt->bind_param('ss',$email,$contrasena);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function recuperar_contrasena($email){      
        $stmt = $this->mysqli->prepare("SELECT contrasena FROM people WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function getPeople_by_email($email){      
        $stmt = $this->mysqli->prepare("SELECT email,contrasena,name FROM people WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function getname_byemail($email){      
        $stmt = $this->mysqli->prepare("SELECT name FROM people WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    public function get_all_by_email($email){      
        $stmt = $this->mysqli->prepare("SELECT * FROM people WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function get_modelos(){      
        $stmt = $this->mysqli->prepare("SELECT Modelo FROM cars");
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }

    public function getPeople_by_email_web($email){      
        $stmt = $this->mysqli->prepare("SELECT email,contrasena,name,Matricula FROM people WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function getdatos_coche($modelo){      
        $stmt = $this->mysqli->prepare("SELECT Matricula,Marca,Matricula,Vel_max,Cap_bateria,Precio FROM cars WHERE Modelo = ?");
        $stmt->bind_param('s',$modelo);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function comprobar_matricula($correo){      
        $stmt = $this->mysqli->prepare("SELECT Matricula FROM people WHERE email = ?");
        $stmt->bind_param('s',$correo);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function devolver_modelo($matricula){      
        $stmt = $this->mysqli->prepare("SELECT Modelo FROM cars WHERE Matricula = ?");
        $stmt->bind_param('s',$matricula);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    
    public function devolver_pass($email){      
        $stmt = $this->mysqli->prepare("SELECT contrasena FROM people WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();        
        $peoples = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $peoples;              
    }
    /**
     * obtiene todos los registros de la tabla "people"
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getPeoples(){        
        $result = $this->mysqli->query('SELECT * FROM people');          
        $peoples = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $peoples; 
    }
    
    
    
     public function getregistros(){        
        $result = $this->mysqli->query('SELECT * FROM registro_semana');          
        $peoples = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $peoples; 
    }
    
    public function getimagenes_subidas(){        
        $result = $this->mysqli->query('SELECT * FROM imagenes_semana');          
        $peoples = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $peoples; 
    }
    
    public function getmodelos_semana(){        
        $result = $this->mysqli->query('SELECT * FROM modelo_semana');          
        $peoples = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $peoples; 
    }
    
    
    public function getCars(){        
        $result = $this->mysqli->query('SELECT * FROM cars');          
        $peoples = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $peoples; 
    }
    /**
     * añade un nuevo registro en la tabla persona
     * @param String $name nombre completo de persona
     * @return bool TRUE|FALSE 
     */
    
    
    public function insert($name='',$apellidos='',$email='',$contrasena='',$provincia='',$codigo_postal='',$pais='',$telefono=''){
        
        
        $stmt = $this->mysqli->prepare("INSERT INTO people(name, apellidos, email, contrasena, provincia, codigo_postal, pais, telefono) VALUES (?,?,?,?,?,?,?,?); ");
        $stmt->bind_param('ssssssss', $name,$apellidos,$email,$contrasena,$provincia,$codigo_postal,$pais,$telefono);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
     public function insert_android($name='',$email='',$contrasena=''){
        
        
        $stmt = $this->mysqli->prepare("INSERT INTO people(name,email,contrasena) VALUES (?,?,?); ");
        $stmt->bind_param('sss', $name,$email,$contrasena);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
     public function insert_simulacion($nombre_carpeta,$nombre_imagen){
        
        
        $stmt = $this->mysqli->prepare("INSERT INTO simulaciones(imagen,nombre_usuario) VALUES (?,?); ");
        $stmt->bind_param('ss', $nombre_imagen,$nombre_carpeta);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    public function insert_car_web($Matricula,$Modelo,$Vel_max,$Cap_bateria){
        
        
        $stmt = $this->mysqli->prepare("INSERT INTO cars(Modelo,Matricula,Vel_max,Cap_bateria) VALUES (?,?,?,?); ");
        $stmt->bind_param('ssss', $Modelo,$Matricula,$Vel_max,$Cap_bateria);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
    public function insert_people_web($name='',$email='',$contrasena='',$imagen='',$Matricula=''){
        
        
        
        $stmt = $this->mysqli->prepare("INSERT INTO people(name,email,contrasena,imagen,Matricula) VALUES (?,?,?,?,?); ");
        $stmt->bind_param('sssss', $name,$email,$contrasena,$imagen,$Matricula);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    
    public  function insert_image($name='', $email = ''){
        
        
        $stmt = $this->mysqli->prepare("INSERT INTO imagenes(nombre,email) VALUES (?,?); ");
        $stmt->bind_param('ss', $name,$email);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
       
    }
   
    /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function delete_user($email='') {
        $stmt = $this->mysqli->prepare("DELETE FROM people WHERE email = ? ; ");
        $stmt->bind_param('s', $email);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    public function delete_car($matricula   ='') {
        $stmt = $this->mysqli->prepare("DELETE FROM cars WHERE Matricula = ? ; ");
        $stmt->bind_param('s', $matricula);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    public function delete_image($id   ='') {
        $stmt = $this->mysqli->prepare("DELETE FROM imagenes WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    public function eliminar_simulacione() {
        $stmt = $this->mysqli->prepare("DELETE FROM simulaciones;");
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    public function borrar_mapa($nombre) {
        $stmt = $this->mysqli->prepare("DELETE FROM imagenes WHERE nombre = ? ; ");
        $stmt->bind_param('s', $nombre);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    
    /**
     * Actualiza registro dado su ID
     * @param int $id Description
     */
    public function update_name($email, $newName) {
        
            $stmt = $this->mysqli->prepare("UPDATE people SET name=? WHERE email = ? ; ");
            $stmt->bind_param('ss', $newName,$email);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function update_map($nombre, $nuevo_nombre) {
        
            $stmt = $this->mysqli->prepare("UPDATE imagenes SET nombre=? WHERE nombre = ? ; ");
            $stmt->bind_param('ss', $nuevo_nombre,$nombre);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
     public function cambiar_datos_persona_web($name,$apellidos,$email,$contrasena,$provincia,$codigo_postal,$pais,$telefono, $email_corriente) {
        
            $stmt = $this->mysqli->prepare("UPDATE people SET name=?,apellidos=?,email=?,contrasena=?,provincia=?,codigo_postal=?,pais=?,telefono=?  WHERE email = ? ; ");
            $stmt->bind_param('sssssssss', $name,$apellidos,$email,$contrasena,$provincia,$codigo_postal,$pais,$telefono,$email_corriente);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function sumar_registro($dia) {
        
            $stmt = $this->mysqli->prepare("UPDATE registro_semana SET numero=numero+1 WHERE dia = ? ; ");
            $stmt->bind_param('s', $dia);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function sumar_imagen($dia) {
        
            $stmt = $this->mysqli->prepare("UPDATE imagenes_semana SET numero=numero+1 WHERE dia = ? ; ");
            $stmt->bind_param('s', $dia);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function sumar_modelo($modelo) {
        
            $stmt = $this->mysqli->prepare("UPDATE modelo_semana SET numero=numero+1 WHERE modelo = ? ; ");
            $stmt->bind_param('s', $modelo);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function update_web($email='', $name='',$contrasena='',$image='',$matricula='') {
        
            $stmt = $this->mysqli->prepare("UPDATE people SET name=?,contrasena=?,imagen=?,Matricula=? WHERE email = ? ; ");
            $stmt->bind_param('sssss', $name,$contrasena,$image,$matricula,$email);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function update_web_car($Modelo='',$Matricula='',$Vel_max='',$Cap_bateria='') {
        
            $stmt = $this->mysqli->prepare("UPDATE cars SET Modelo=?,Vel_max=?,Cap_bateria=? WHERE Matricula = ? ; ");
            $stmt->bind_param('ssss', $Modelo,$Vel_max,$Cap_bateria,$Matricula);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function update_email ($email, $newemail) {
        
            $stmt = $this->mysqli->prepare("UPDATE people SET email=? WHERE email = ? ; ");
            $stmt->bind_param('ss', $newemail,$email);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    public function update_matricula ($matricula, $email    ) {
        
            $stmt = $this->mysqli->prepare("UPDATE people SET Matricula=? WHERE email = ? ; ");
            $stmt->bind_param('ss', $matricula,$email);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;    
        
    }
    
    public function update_pass ($email, $newpass) {
        
            $stmt = $this->mysqli->prepare("UPDATE people SET contrasena=? WHERE email = ? ; ");
            $stmt->bind_param('ss', $newpass,$email);
            $r = $stmt->execute(); 
            $stmt->close();
            return $r;     
    }
    

    /**
     * verifica si un ID existe
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function checkID($id){
        $stmt = $this->mysqli->prepare("SELECT * FROM people WHERE ID=?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->store_result();    
            if ($stmt->num_rows == 1){                
                return true;
            }
        }        
        return false;
    }   
}
?>