<?php
class EventsModel extends AbstractModel
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'events';
		$this->tableEventTypes = 'event_types';
		$this->tableEventCssClasses = 'event_css_classes';
		$this->verifiedTableField = 'id';
		$this->primaryKey = 'id';
	}

	function SetMapping()
	{
		$this->mapping = array(
		    'title'=>'textTitle',
            'file'=>'txtFile',
            'url_key'=>'txtUrlKey',
            'description'=>'txtDescription',
            'short_description'=>'txtShortDescription',
            'status'=>'chkStatus',
            'event_type_id'=>'txtEventTypeId',
            'event_css_class_id'=>'txtEventCssClassId',
            'event_start_unix_milliseconds'=>'txtEventDateStartInMilliseconds',
            'event_end_unix_milliseconds'=>'txtEventDateEndInMilliseconds');
	}

	function GetSqlCondition(&$dataSearch)
	{
		if ($dataSearch == null) return '';

		$cond = 'WHERE 1';
		if (isset($dataSearch->search) && $dataSearch->search != '') {
			$cond .= " AND name LIKE '%{$dataSearch->search}%'";
		}

        if (isset($dataSearch->eventType) && $dataSearch->eventType != '') {
            $cond .= " AND et.name LIKE '%{$dataSearch->eventType}%'";
        }

        if (isset($dataSearch->from) && $dataSearch->from != '') {
            $cond .= " AND e.event_start_unix_milliseconds >= '{$dataSearch->from}'";
        }

        if (isset($dataSearch->to) && $dataSearch->to != '') {
            $cond .= " AND e.event_start_unix_milliseconds <= '{$dataSearch->to}'";
        }

		return $cond;
	}

	function GetRecordsList($dataSearch, $orderBy)
	{
		$cond = $this->GetSqlCondition($dataSearch);
        //echo'<pre>';print_r($dataSearch);die();
		$sql = "SELECT e.*, et.name as event_type, ec.name as event_css_class 
                FROM {$this->table} e 
                LEFT JOIN $this->tableEventTypes et ON e.event_type_id=et.id 
                LEFT JOIN $this->tableEventCssClasses ec ON e.event_css_class_id = ec.id 
                {$cond}";

        $sql .= ($orderBy != null) ? ' ORDER BY '.$orderBy : ' ORDER BY e.event_start_unix_milliseconds';
        //echo'<pre>';print_r($sql);die();

		return $this->dbo->GetRows($sql);
	}

	function GetRecordsListCount($dataSearch)
	{
		$cond = $this->GetSqlCondition($dataSearch);
		$sql = "SELECT COUNT(*) FROM {$this->table}	{$cond}";
		return $this->dbo->GetFieldValue($sql);
	}

	function GetRecordsForDropdown($dataSearch = null)
	{
		$cond = $this->GetSqlCondition($dataSearch);
		$orderBy = ' ORDER BY name';
		$sql = "SELECT * FROM {$this->table}	{$cond} {$orderBy}";

		return $this->dbo->GetRows($sql);
	}

	function GetRecordsIds($dataSearch = null)
	{
		$cond = $this->GetSqlCondition($dataSearch);
		$orderBy = ' ORDER BY id';
		$sql = "SELECT id FROM {$this->table} {$cond} {$orderBy}";

		return $this->dbo->GetRows($sql);
	}

	function GetEventsByIds($eventsIds)
	{
		$sql = "SELECT * FROM {$this->table} e WHERE  e.id IN ({$eventsIds})";
		return $this->dbo->GetRows($sql);
	}

    function GetEventById($eventId)
    {
        $sql = "SELECT id FROM {$this->table} e WHERE e.id = {$eventId}";

        return $this->dbo->GetFirstRow($sql);
    }


    function GetEventsTypes($dataSearch=null)
    {
        $cond = $this->GetSqlCondition($dataSearch);
        $sql = "SELECT * FROM {$this->tableEventTypes} et {$cond}";
        return $this->dbo->GetRows($sql);
    }

    function GetEventsCssClassesByIds($eventsCssClassesIds)
	{
		$sql = "SELECT * FROM {$this->tableEventCssClasses} ec WHERE  ec.id IN ({$eventsCssClassesIds})";
		return $this->dbo->GetRows($sql);
	}


}
?>