<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05/02/2019
 * Time: 13:30
 */

namespace App\Models;


class Event
{
    private $id;
    private $description;
    private $type;
    private $hours;
    private $status;

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }

    function __construct($id,$description,$type, $hours, $status){
        $this->id =$id;
        $this->description = $description;
        $this->type =$type;
        $this->hours=$hours;
        $this->status=$status;
    }

    public static function getModel(array $res){
        return new Event($res['id'] ,$res['description'] ,$res['type'], $res['hours'], $res['status']);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}