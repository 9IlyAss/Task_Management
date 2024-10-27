<?php
Class DB{
    private $PDO;
    public function __construct() {
        try {
            $this->PDO = new PDO("mysql:host=localhost;dbname=task_Manager;charset=utf8", 'root', '');
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Optional: Set error mode to exception
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }
    public function Getconnecte():PDO{
        return $this->PDO;
    }
}
class Mission extends DB{
    private $Nom;
    private $dec;
    private $UserId;
    public function __construct($Nom, $dec, $UserId)
    {
        parent::__construct();
        $this->Nom = $Nom;
        $this->dec = $dec;
        $this->UserId = $UserId;
    }

    public function getNom(){
        return $this->Nom;
    }
    public function getDec(){
        return $this->dec;
    }
    public function getUserId(){
        return $this->UserId;
    }

    public function Read($id){
        $data = [];
        $sql = "SELECT id, Nom, `Desc` FROM Missions WHERE User_id=:id ORDER BY id DESC;";
        $stmt = $this->Getconnecte()->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[]= $row;
        }
        echo json_encode($data);
    }

    public function Create():void {
    $data = json_decode(file_get_contents('php://input'), true);

    $sql = "INSERT INTO Missions (Nom, `Desc`,User_id) VALUES (?, ?, ?);";
    $stmt = $this->Getconnecte()->prepare($sql);
    $stmt->execute([$data['Nom'],$data['Desc'], $data['UserId']]);

    http_response_code(201);
    echo json_encode(["message" => "Task created"]);
    
    }

    public function Update($id):void {

    $data = json_decode(file_get_contents('php://input'), true);

    $sql = "UPDATE Missions SET Nom=?, `Desc`=? WHERE id=? AND User_id=?;";
    $stmt =$this->Getconnecte()->prepare($sql);
    $stmt->execute([$data['Nom'],$data['Desc'],$id, $data['UserId']]);
    echo json_encode(["message" => "Task updated"]);

    }

    public function Delete($id):void {

        $sql = "DELETE FROM Missions WHERE id=? ;";
        $stmt = $this->Getconnecte()->prepare($sql);
        $stmt->execute([$id]);
        echo json_encode(["message" => "Task deleted"]);

    }




}

?>