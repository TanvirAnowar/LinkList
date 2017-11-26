<?php

require('ListNode.class.php');

class LinkedList // implements Iterator 
{			
	private $_firstNode = NULL;
	private $_current = NULL;
	private $_position = 0;
	public $_count = 0;
	
	// Constructor
	// Input: Array of values (Optional)
	public function __construct($values = array())
	{
	//	$this->_firstNode = null;
		
		
		foreach ($values as $value) {			
			$this->add($value);
		}	

	
		
	}
	
	// Add a node at the beginning of the list
	public function add($value)
	{
		$newNode = new ListNode($value);

				if ( $this->_firstNode !== NULL ) {
			$newNode->next = $this->_firstNode;
		}

		$this->_firstNode = &$newNode;

		$this->_count++;

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
      //  $link = new ListNode($NewItem);
        $current = $this->_firstNode;
        $previous = $this->_firstNode;

        for($i=0;$i<$index;$i++)
        {       
                $previous = $current;
                $current = $current->next;
        }

           $previous->next = $newNode;
           $newNode->next = $current; 
           $this->_count++;
    }
	}
	
	// Remove a node at the end of the list
	public function remove()
	{
		if ( $this->_firstNode !== NULL ) {
			if ( $this->_firstNode->next === NULL ) {
				$this->_firstNode = NULL;
			} else {
				$previous = NULL;
				$current = $this->_firstNode;

				while ( $current->next !== NULL ) {
					$previous = $current;
					$current = $current->next;
				}

				$previous->next = NULL;

				$this->_count--;
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
		 $currentNode = $this->_firstNode;
			for($i = 0; $i < $index; $i++ ){
			if($i == $index-1){
			$toBeRemovedReference = $currentNode->next;
			$currentNode->next = $toBeRemovedReference->next;

			if($toBeRemovedReference->next == NULL){ // If it is last node ,update instance
			// variable
			$this->_current = $currentNode;

			}
			$this->_count--;	
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
   		
		if ( $this->_firstNode !== NULL && $index <= $this->_count ) {
			$current = $this->_firstNode;

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
		return $this->_count;
	}
	
	// Return the list as string
	public function toString()
	{
		$list = "";
		$node = $this->_firstNode;
		
		while ($node != null) {
			$list .= $node->toString();
			$node = $node->next;
		}
		
		return $list;
	}

		/*
	 * Iterator Implementation
	 */
	public function rewind() {
		$this->_position = 0;
		$this->_current = $this->_firstNode;
	}

	public function current() {
		return $this->_current->data;
	}

	public function key() {
		return $this->_position;
	}

	public function next() {
		$this->_position++;
		$this->_current = $this->_current->next;
	}

	public function valid() {
		return $this->_current !== NULL;
	}
}