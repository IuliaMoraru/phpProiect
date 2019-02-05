<?php
namespace App\Controllers;

use App\Models\Event;
use App\Repository\EventRepository;

use Framework\Controller;

/**
 * Class LoginController
 */
class EventController extends Controller
{

    private $eventRepository;

    private $lastEventId;


    public function __construct($params){
        parent::__construct($params);
        $this->eventRepository = new EventRepository();
    }

    public function eventsPage(){
        $userId=$_SESSION['logged'];
        $events = $this->getEventsByUserId($userId);
        return $this->view("events/events.html",['events' => $events]);
    }

    public function addPage(){
        return $this->view("events/add.html");
    }

    public function editPage(){
        $_SESSION[eventId] =$this->params[0];
        $this->lastEventId= $this->params[0];
        if($this->lastEventId)
            $event = $this->eventRepository->getEventById($this->lastEventId);
        return $this->view("events/edit.html",['event' => $event]);
    }

    public function addEventAction(){
        $errros =[];

        if(isset($_POST['cancel-submit'])){
            return $this->view("events/events.html");
        }
        if(isset($_POST['add-submit'])) {
            $validAdd =true;

            if(!isset($_POST['description']) || $_POST['description'] == ''){
                $errors[] = "An event description must be introduced!";
                $validAdd =false;
            }

            if(!isset($_POST['type']) || $_POST['type']=='' ){
                $errors[] = "An event type must be introduced!";
                $validAdd =false;
            }

            if(!isset($_POST['hours']) || $_POST['hours'] == ''){
                $errors[] = "Hours must be introduced!";
                $validAdd =false;
            }

            if($validAdd){
                $event = new Event(null, $_POST['description'],$_POST['type'], $_POST['hours'],0, $_SESSION['logged']);
                $events[] = $this->doAdd($event);
                return $this->view("events/events.html", ['errors'=>['Add successfully!'],'events' => $events]);
            }

        }
        return $this->view("events/events.html", ['errors'=>['Edit failed!']]);
    }

    public function editEvent(){
        $errros =[];

        if(isset($_POST['cancel-submit'])){
            header("Location: /");
            return;
        }

        if(isset($_POST['edit-submit'])) {
            $validAdd =true;

            if(!isset($_POST['description']) || $_POST['description'] == ''){
                $errors[] = "An event description must be introduced!";
                $validAdd =false;
            }

            if(!isset($_POST['type']) || $_POST['type']=='' ){
                $errors[] = "An event type must be introduced!";
                $validAdd =false;
            }

            if(!isset($_POST['hours']) || $_POST['hours'] == ''){
                $errors[] =  "Hours must be introduced!";
                $validAdd =false;
            }

            if($validAdd){


                $event = new Event(null, $_POST['description'],$_POST['type'], $_POST['hours'],0, $_SESSION['logged']);
                $this->doEdit($event);
                return;
            }

        }
        return $this->view("events/events.html", ['errors'=>$errors]);
    }



    public function doAdd($event) {
        $this->eventRepository->create($event);
        header("Location: /");
    }

    public function doEdit($event) {
        $event->setId( $_SESSION[eventId]);

        $this->eventRepository->edit($event);

        header("Location: /");
    }
    public function deleteEvent() {
        $id = $this->params[0];
        $this->doDelete($id);
    }
    public function doDelete($event){
        $this->eventRepository->delete($event);
        header("Location: /");
    }

    public function getEventsByUserId(){
        return $this->eventRepository->getEventsByUserId();
    }
    public function logoutAction(){
        session_unset();
        header('Location: /');
    }
}
