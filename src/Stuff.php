<?php

    class Inventory
    {

        private $object;
        private $id;

        function __construct($object, $id = null)
        {
            $this->object = $object;
            $this->id = $id;
        }

        function setObject($new_object)
        {
            $this->object = (string) $new_object;
        }

        function getObject()
        {
            return $this->object;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stuff (object) VALUES ('{$this->getObject()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_stuff = $GLOBALS['DB']->query("SELECT * FROM stuff;");
            $stuff = array();
            foreach($returned_stuff as $stuff) {
                $object = $stuff['object'];
                $id = $stuff['id'];
                $new_object = new Inventory($object, $id);
                array_push($stuff, $new_object);
            }
            return $stuff;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stuff *;");
        }

    }

 ?>
