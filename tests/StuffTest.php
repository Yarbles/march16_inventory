<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stuff.php";

    $DB = new PDO('pgsql:host=localhost;dbname=inventory_test');

    class InventoryTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function test_save()
        {
        //Arrange
        $object = "baseball";
        $id = null;
        $test_Inventory = new Inventory($object, $id);

        //Act
        $test_Inventory->save();

        //Assert
        $result = Inventory::getAll();
        $this->assertEquals($test_Inventory, $result[0]);
        }


        function test_getAll()
        {
            //Arrange
            $object = "baseball";
            $object2 = "hockey puck";
            $id = null;
            $test_Inventory = new Inventory($object, $id);
            $test_Inventory->save();
            $test_Inventory2 = new Inventory($object, $id);
            $test_Inventory2->save();

            //Act
            $result = Inventory::getAll();

            //Assert
            $this->assertEquals([$test_Inventory, $test_Inventory2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $object = "baseball";
            $object2 = "hockey puck";
            $id = null;
            $test_Inventory = new Inventory($object, $id);
            $test_Inventory->save();
            $test_Inventory2 = new Inventory($object2, $id);
            $test_Inventory2->save();

            //Act
            Inventory::deleteAll();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals([], $result);

        }

    }

 ?>
