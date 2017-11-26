<?php

require('ListNode.class.php');

class LinkedList
{
    protected $first = NULL;
    protected $current = NULL;
    protected $count = 0;

    // Constructor
    // Input: Array of values (Optional)
    public function __construct($values = array())
    {
        foreach ($values as $value) {
            $this->add($value);
        }
    }

    // Add a node at the beginning of the list
    public function add($value)
    {
        $newNode = new ListNode($value);

        if ( $this->first !== NULL ) {
            $newNode->next = $this->first;
        }

        $this->first = &$newNode;

        $this->count++;

        return TRUE;

    }

    // Add a node at the specified index
    public function addAtIndex($value, $index)
    {
        $newNode = new ListNode($value);

        if($index == 0){

        }elseif($this->sizeof()<$index){
            throw new Exception("Invalid Index");
        }
        else{

            $current = $this->first;
            $previous = $this->first;

            for($i=0;$i<$index;$i++)
            {
                $previous = $current;
                $current = $current->next;
            }

            $previous->next = $newNode;
            $newNode->next = $current;
            $this->count++;
        }
    }

    // Remove a node at the end of the list
    public function remove()
    {
        if ( $this->first !== NULL ) {
            if ( $this->first->next === NULL ) {
                $this->first = NULL;
            } else {
                $previous = NULL;
                $current = $this->first;

                while ( $current->next !== NULL ) {
                    $previous = $current;
                    $current = $current->next;
                }

                $previous->next = NULL;

                $this->count--;
            }

            return TRUE;
        }

        return FALSE;

    }

    // Remove a node at the specified index
    public function removeAtIndex($index)
    {
        if($this->sizeof()<$index){
            throw new Exception("Invalid Index");
        }
        $currentNode = $this->first;
        for($i = 0; $i < $index; $i++ ){
            if($i == $index-1){
                $reference = $currentNode->next;
                $currentNode->next = $reference->next;

                if($reference->next == NULL){
                    $this->current = $currentNode;

                }
                $this->count--;
            }
            $currentNode = $currentNode->next;
        }
    }

    // Return the value of the first node
    public function getNode()
    {
        return $this->getNodeAtIndex(0);

    }

    // Return the value of the node at the specified index
    public function getNodeAtIndex($index)
    {
        if($this->sizeof()<$index){
            throw new Exception("Invalid Index");
        }

        if ( $this->first !== NULL && $index <= $this->count ) {
            $current = $this->first;

            for ( $i = 0; $i < $index; $i++ ) {
                $current = $current->next;
            }

            return $current->value;
        }

        return FALSE;

    }


    // Return the number of nodes
    public function sizeOf()
    {
        return $this->count;
    }

    // Return the list as string
    public function toString()
    {
        $list = "";
        $node = $this->first;

        while ($node != null) {
            $list .= $node->toString();
            $node = $node->next;
        }

        return $list;
    }


}
