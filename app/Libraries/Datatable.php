<?php
namespace App\Libraries;
class Datatable 
{	
	protected $db;
	public function __construct()
	{
		$this->db = db_connect();
	}

	function LoadJson($SQL,$EXTRA_WHERE='',$GROUP_BY='')
	{
		if(!empty($EXTRA_WHERE))
		{
			$SQL.= " WHERE ( $EXTRA_WHERE )";
		}
		else
		{
			$SQL.= " WHERE (1)";
		}
		$query = $this->db->query($SQL);
		$total = count($query->getResult());
		//------------------------------------------------
		if(!empty($_GET['search']['value']))
		{
			$qry = array();
			foreach($_GET['columns'] as $cl)
			{
				if($cl['searchable']=='true')
				$qry[] =" ".$cl['name']." like '%".$_GET['search']['value']."%' ";
			}
			$SQL.= "AND ( ";
			$SQL.= implode("OR",$qry);
			$SQL.= " ) ";	
		}
        //------------------------------------------------
		if(!empty($GROUP_BY))
		{
			$SQL.= $GROUP_BY;
		}
	 	//------------------------------------------------
		$query = $this->db->query($SQL);
		$filtered = count($query->getResult());

		$SQL.= " ORDER BY ";
		$SQL.= $_GET['columns'][$_GET['order'][0]['column']]['name']." ";
		$SQL.= $_GET['order'][0]['dir'];
		$SQL.= " LIMIT ".$_GET['length']." OFFSET ".$_GET['start']." ";

		$query = $this->db->query($SQL);
		$data = $query->getResultArray();

		return array("recordsTotal"=>$total,"recordsFiltered"=>$filtered,'data' => $data);
	}	
}
?>