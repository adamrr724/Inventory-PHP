<?php
    class Item
    {
        private $id;
        private $name;
        private $description;
        private $value_amount;
        private $amount_type_id;
        private $collectable_type_id;


        function __construct($name, $description, $value_amount, $amount_type_id, $collectable_type_id, $id = null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->value_amount = $value_amount;
            $this->amount_type_id = $amount_type_id;
            $this->collectable_type_id = $collectable_type_id;

        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getDescription()
        {
            return $this->description;
        }

        function getValueAmount()
        {
            return $this->value_amount;
        }

        function getAmountTypeId()
        {
            return $this->amount_type_id;
        }

        function getCollectableTypeId()
        {
            return $this->collectable_type_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO inventory (name, description, value_amount, amount_type_id, collectable_type_id) VALUES ('{$this->getName()}', '{$this->getDescription()}', '{$this->getValueAmount()}', '{$this->getAmountTypeId()}', '{$this->getCollectableTypeId()}');");

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM inventory;");
            $inventory = array();
            foreach($returned_items as $item) {
                $name = $item['name'];
                $description = $item['description'];
                $value_amount = $item['value_amount'];
                $amount_type_id = $item['amount_type_id'];
                $collectable_type_id = $item['collectable_type_id'];
                $id = $item['id'];
                $new_item = new Item($name, $description, $value_amount, $amount_type_id, $collectable_type_id, $id);
                array_push($inventory, $new_item);
            }
            return $inventory;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM inventory;");
        }

        static function find($search_id)
        {
            $found_item = null;
            $items = Item::getAll();
            foreach($items as $item) {
                $item_id = $item->getId();
                if ($item_id == $search_id) {
                    $found_item = $item;
                }
            }
            return $found_item;
        }
    }
?>
