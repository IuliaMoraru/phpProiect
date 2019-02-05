<?php

namespace App\Repository;

use Framework\Db;
use App\Models\Event;

class EventRepository{

    protected $db;

    function __construct(){
        $this->db = Db::getInstance();
    }

    public function create($event){
        try {

            $req = $this->db->prepare('INSERT INTO events(description, type, hours, status, user_id) VALUES(:description, :type, :hours, :status, :user_id)');
            $req->bindParam(':description', $event->getDescription());
            $req->bindParam(':type', $event->getType());
            $req->bindParam(':hours', $event->getHours());
            $req->bindParam(':status', $event->getStatus());
            $req->bindParam(':user_id', $_SESSION[logged]);

            $req->execute();
        } catch (PDOException $e) {
            echo "Event repository create method has failed." . $e;
        }
    }

    public function delete($eventId){

        try {

            $req = $this->db->prepare('UPDATE events set status = 1 WHERE id=:id');
            $req->bindParam(':id', $eventId);
            $req->execute();
        } catch (PDOException $e) {
            echo 'Delete failed' . $e;
        }
    }

    public function edit($event){

        try {
            echo 'shaweomda';
            $req = $this->db->prepare('UPDATE events set description= :description,
            type= :type, hours = :hours WHERE id=:id');
            $req->bindParam(':id', $event->getId());
            $req->bindParam(':description', $event->getDescription());
            $req->bindParam(':type', $event->getType());
            $req->bindParam(':hours', $event->getHours());
  
            $req->execute();
        } catch (PDOException $e) {
            echo 'Edit failed' . $e;
         }
    }

    public function getEventsByUserId(){

        $req = $this->db->prepare('SELECT * FROM events WHERE user_id = :user_id and status= 0');
        $req->execute(array('user_id' => $_SESSION[logged]));
        $resp = $req->fetchAll();
        $events =[];
        foreach($resp as $row){
            //push??
            $events[] = Event::getModel($row);
        }
        return $events;
    }

    public function getEventById($eventId){

        $id = intval($eventId);

        $req = $this->db->prepare('SELECT * FROM events WHERE id = :id');
        $req->execute(array('id' => $id));
        $res = $req->fetch();
    
        if($res)
            $event= Event::getModel($res);

        return $event;
    }
    

}