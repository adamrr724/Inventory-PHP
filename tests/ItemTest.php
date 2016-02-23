<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Item.php";

    $server = 'mysql:host=localhost;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ItemTest extends PHPUnit_Framework_TestCase
    {

        function test_save()
        {
            //Arrange
            $name = "Barry Bonds Rookie Card";
            $description = "Mint Condition Rookie Card";
            $value_amount = 3000;
            $amount_type_id = 1;
            $collectable_type_id = 1;

            $test_item = new Item($name, $description, $value_amount, $amount_type_id, $collectable_type_id);

            //Act
            $test_item->save();

            //Assert
            $result = Item::getAll();
            $this->assertEquals($test_item, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Barry Bonds Rookie Card";
            $description = "Mint Condition Rookie Card";
            $value_amount = 3000;
            $amount_type_id = 1;
            $collectable_type_id = 1;

            $name2 = "Derek Jeter Action Figure";
            $description2 = "SuperHero Derek Jeter";
            $value_amount2 = 5000;
            $amount_type_id2 = 2;
            $collectable_type_id2 = 3;

            $test_item = new Item($name, $description, $value_amount, $amount_type_id, $collectable_type_id);
            $test_item->save();
            $test_item2 = new Item($name2, $description2, $value_amount2, $amount_type_id2, $collectable_type_id2);
            $test_item2->save();

            //Act
            $result = Item::getAll();

            //Assert
            $this->assertEquals([$test_item, $test_item2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Barry Bonds Rookie Card";
            $description = "Mint Condition Rookie Card";
            $value_amount = 3000;
            $amount_type_id = 1;
            $collectable_type_id = 1;
            $test_item = new Item($name, $description, $value_amount, $amount_type_id, $collectable_type_id);
            $test_item->save();

            //Act
            Item::deleteAll();

            //Assert
            $result = Item::getAll();
            $this->assertEquals([], $result);
        }

        protected function tearDown()
            {
                Item::deleteAll();
            }

        function test_getId()
        {
            //Arrange
            $name = "Barry Bonds Rookie Card";
            $description = "Mint Condition Rookie Card";
            $value_amount = 3000;
            $amount_type_id = 1;
            $collectable_type_id = 1;
            $id = 1;
            $test_Item = new Item($name, $description, $value_amount, $amount_type_id, $collectable_type_id, $id);

            //Act
            $result = $test_Item->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Barry Bonds Rookie Card";
            $description = "Mint Condition Rookie Card";
            $value_amount = 3000;
            $amount_type_id = 1;
            $collectable_type_id = 1;

            $name2 = "Derek Jeter Action Figure";
            $description2 = "SuperHero Derek Jeter";
            $value_amount2 = 5000;
            $amount_type_id2 = 2;
            $collectable_type_id2 = 3;

            $test_item = new Item($name, $description, $value_amount, $amount_type_id, $collectable_type_id);
            $test_item->save();
            $test_item2 = new Item($name2, $description2, $value_amount2, $amount_type_id2, $collectable_type_id2);
            $test_item2->save();

            //Act
            $id = $test_item->getId();
            $result = Item::find($id);

            //Assert
            $this->assertEquals($test_item, $result);
        }
    }
?>
