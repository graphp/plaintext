<?php

class LoaderEdgeList extends LoaderFile{
	
	private $debugMode = false;
	
	private $fileName;
	
	public function __construct($filename){
	    $this->fileName = $filename;
	}
	
	private function writeDebugMessage($messageString){
		if($this->debugMode){
			echo $messageString;
		}
	}
	
	public function getGraph(){
		
		$graph = new Graph();
		
		$file = file($this->fileName, FILE_IGNORE_NEW_LINES);
		$vertexCount = $file[0];
		$edgeCounter = 0;
		
		$this->writeDebugMessage('create '.$vertexCount.' vertices');
		
		$graph->createVertices($vertexCount);
		
		$this->writeDebugMessage('parse edges');
		
		unset($file[0]);
		foreach ($file as $zeile) {
			$edgeConnections = explode("\t", $zeile);
			
			$from = $graph->getVertex($edgeConnections[0]);
			$to = $graph->getVertex($edgeConnections[1]);
			
			$from->createEdge($to);								//TODO directed
		}
		
		return $graph;
		
	}	
}
