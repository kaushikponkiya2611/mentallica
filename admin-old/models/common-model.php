<?php
class CommonModel
{
	public $qry = '';
	var $rows_per_page; //Number of records to display per page
	var $total_rows; //Total number of rows returned by the query
	var $links_per_page; //Number of pagination links to display per page
	var $sql; // holds the sql query
	var $page; // holds the current page value
	var $max_pages; // total number of pages 
	var $offset; // indicates the offset for the LIMIT clause in the query 
	var $current_link; // indicates the link to the current page

    ///// function for number pagination /////////////
	
	function paging_advancesearch($totalrecords,$noofrows_k,$noofpages){
	    $paging = "<table border='0' cellpadding='0' cellspacing='0' id='paging-table'>
			<tr>
			<td>
				<div id='page-info'>Page <strong>1</strong> / ".$noofpages."</div>";
          	 if($totalrecords > $noofrows_k){/* href='#'*/
			  $paging.="<a class='page-right' onclick='pagenext()'></a>
				<a class='page-far-right' onclick='pagelast(($noofpages-1)*$noofrows_k)'></a>";
               }
			$paging.="</td>
			<td>
      	    <select name='sel_noofrow' id='sel_noofrow' onchange='noofrow()' class='select_box_paging' > 
				<option value='20'>20</option>
				<option value='40'>40</option>
				<option value='60'>60</option>
			</select>
            <input type='hidden' name='hid_fieldname' id='hid_fieldname'    value=''  />
            <input type='hidden' name='totalrecords' id='totalrecords' value=".$noofpages." />
			<input type='hidden' name='hid_curr_page' id='hid_curr_page' value='0' />
            <input type='hidden' name='hid_prevnext' id='hid_prevnext' value='0' />
            <input type='hidden' name='hid_noofrow' id='hid_noofrow' value='10' />
			</td>
			</tr>
			</table>";
		return $paging;	
	}
	
	function paging($totalrecords,$noofrows_k,$noofpages){
	    $paging = "<table border='0' cellpadding='0' cellspacing='0' id='paging-table'>
			<tr>
			<td>
				<div id='page-info'>Page <strong>1</strong> / ".$noofpages."</div>";
          	 if($totalrecords > $noofrows_k){
			  $paging.="<a href='#' class='page-right' onclick='pagenext()'></a>
				<a href='#' class='page-far-right' onclick='pagelast(($noofpages-1)*$noofrows_k)'></a>";
               }
			$paging.="</td>
			<td>
      	    <select name='sel_noofrow' id='sel_noofrow' onchange='noofrow()' class='select_box_paging' > 
				<option value='20'>20</option>
				<option value='40'>40</option>
				<option value='60'>60</option>
			</select>
          
            <input type='hidden' name='totalrecords' id='totalrecords' value=".$noofpages." />
			<input type='hidden' name='hid_curr_page' id='hid_curr_page' value='0' />
            <input type='hidden' name='hid_prevnext' id='hid_prevnext' value='0' />
            <input type='hidden' name='hid_noofrow' id='hid_noofrow' value='10' />
			</td>
			</tr>
			</table>";
		return $paging;	
	}
	
	function numberPagination($sql,$rows_per_page,$links_per_page)
	{
		$this -> total_rows = @mysql_num_rows(mysql_query($sql)); // counting the total number of rows.
		$this -> rows_per_page = $rows_per_page;
		$this -> links_per_page = $links_per_page;
		$this -> sql = $sql;
		
		if (isset($_GET['updateId']) && $_GET['updateId'] != '')
		{
			$this -> current_link = "index.php?pid=".$_GET['pid']."&updateId=".$_GET['updateId'];
			//$this -> current_link = $_SESSION['ADMIN_DOMAIN_NAME'].$_GET['pid']."/".$_GET['updateId'];
		}
		
		else 
		{
			//$this -> current_link =$_SESSION['ADMIN_DOMAIN_NAME'].$_GET['pid'];
			 $this -> current_link = "index.php?pid=".$_GET['pid'];
		}
		
		
		/*if (strpos($this -> current_link,'&'))
		{
			$this -> current_link = substr($this -> current_link,0,strpos($this -> current_link,'&'));
		}*/
				
		if (!isset($_GET['page']) && $_GET['page'] == '') // initializing page
		{
			$this -> page = 1;	
		}
		else
		{
			$this -> page = $_GET['page'];
		}
		
		$this -> max_pages = ceil($this -> total_rows/$this -> rows_per_page); // counting the total no. of pages
		$this -> offset = $this -> rows_per_page * ($this -> page-1); // calculating the offset
		
	
		$query = $this -> sql." LIMIT {$this -> offset}, {$this -> rows_per_page}";
		
		 $result = @mysql_query($query);
		
		while($row = @mysql_fetch_assoc($result))
		{
			//strip slashes from info - the ones we added while sanitizing input
			foreach ($row as $key => $value)
				{			
					$row[$key] = stripslashes($value);
				}        	
			$result_row[] = $row;
		}
		
		return $result_row;
			
	}
	
	function renderNav() // function for displaying the links in pagination string
	{
		for ($i = 1; $i <= $this -> max_pages; $i += $this -> links_per_page)
        {
			if ($this -> page >= $i)
            {
                $start = $i;
            }
        }

		if($this -> max_pages > $this -> links_per_page)
        {
			$end = $start+$this -> links_per_page-1;
			if($end > $this -> max_pages)
                $end = $this -> max_pages+1;
		}
		else
        {
			$end = $this -> max_pages;
		}

		$links = '';

		for( $i=$start ; $i<=$end ; $i++)
		{
			if($i == $this -> page)
			{
				 $links .= "<a class='active'>$i</a>";
			}
			else
			{
                if ($i ==1)
                {
                    $links .= "<a title=\"Go to page ".$i."\" href=\"".$this -> current_link."\">".$i."</a>";
                }
                else
                {
                    $links .= "<a title=\"Go to page ".$i."\" href=\"".$this -> current_link."&page=".$i."\">".$i."</a>";
                }
                
			}
		}

		return $links;
	}
	
	function renderPrev() // function for displaying the left arrow button
	{
		if ($this -> page > 1) // checking whether the current page is not the first page
			{
				if ($this -> page != 2) // checking whether the previous page is the first page
				{
					$prev_page = $this->page - 1;
					return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-left-black.gif\" alt=\"arrow left\" class=\"cursor\" title=\"Go to previous page\" onclick=\"window.location='".$this -> current_link ."&page=".$prev_page."';\"/>";
				}
				else // if the previous page is first page , in the query string there should be no page attribute
				{
					return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-left-black.gif\" alt=\"arrow left\" class=\"cursor\" title=\"Go to previous page\" onclick=\"window.location='".$this -> current_link ."';\"/>";
				}
				
			}
		else
			return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-left-black.gif\" alt=\"arrow left\"/>";
	}
	
	function renderNext() // function for displaying the right arrow button
	{
		if ($this -> page == $this -> max_pages) // checking whether the current page is the last page
			return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-right-black.gif\" alt=\"arrow right\"/>";
		else
			{
				$next_page = $this -> page + 1;	
				return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-right-black.gif\" alt=\"arrow right\" class=\"cursor\" title=\"Go to next page\" onclick=\"window.location='".$this -> current_link."&page=".$next_page."';\"/>";
			}
	}
	
	function renderFullNav() // function for displaying the complete pagination string
	{
		return $this -> renderPrev()." ".$this -> renderNav()." ".$this -> renderNext();
	}


////////*********** This is new pagination ********************************////////////////

	function numberPagination1($sql,$rows_per_page,$links_per_page,$search_page=0)
	{
		$this -> total_rows = @mysql_num_rows(mysql_query($sql)); // counting the total number of rows.
		$this -> rows_per_page = $rows_per_page;
		$this -> links_per_page = $links_per_page;
		$this -> sql = $sql;
		
		if (isset($_GET['updateId']) && $_GET['updateId'] != '')
		{
			$this -> current_link = "index.php?pid=".$_GET['pid']."&updateId=".$_GET['updateId'];
			//$this -> current_link = $_SESSION['ADMIN_DOMAIN_NAME'].$_GET['pid']."/".$_GET['updateId'];
		}
		else
		{
			//$this -> current_link =$_SESSION['ADMIN_DOMAIN_NAME'].$_GET['pid'];
			 $this -> current_link = "index.php?pid=".$_GET['pid'];
		}
		
		
		/*if (strpos($this -> current_link,'&'))
		{
			$this -> current_link = substr($this -> current_link,0,strpos($this -> current_link,'&'));
		}*/
				
		if (!isset($_GET['spage']) && $_GET['spage'] == '') // initializing page
		{
			$this -> page = 1;	
		}
		else
		{
			$this -> page = $_GET['spage'];
		}
		
		$this -> max_pages = ceil($this -> total_rows/$this -> rows_per_page); // counting the total no. of pages
		$this -> offset = $this -> rows_per_page * ($this -> page-1); // calculating the offset
		
		if($search_page == 1)
		{
			$this -> offset = 0;
		}
	
		$query = $this -> sql." LIMIT {$this -> offset}, {$this -> rows_per_page}";
		
		$result = @mysql_query($query);
		
		while($row = @mysql_fetch_assoc($result))
		{
			//strip slashes from info - the ones we added while sanitizing input
			foreach ($row as $key => $value)
				{			
					$row[$key] = stripslashes($value);
				}        	
			$result_row[] = $row;
		}
		return $result_row;	
		
	}
	
	function renderNav1() // function for displaying the links in pagination string
	{
		for ($i = 1; $i <= $this -> max_pages; $i += $this -> links_per_page)
        {
			if ($this -> page >= $i)
            {
                $start = $i;
            }
        }

		if($this -> max_pages > $this -> links_per_page)
        {
			$end = $start+$this -> links_per_page-1;
			if($end > $this -> max_pages)
                $end = $this -> max_pages+1;
		}
		else
        {
			$end = $this -> max_pages;
		}

		$links = '';

		for( $i=$start ; $i<=$end ; $i++)
		{
			if($i == $this -> page)
			{
				 $links .= "<a class='active'>$i</a>";
			}
			else
			{
                if ($i ==1)
                {
                    $links .= "<a title=\"Go to page ".$i."\" href=\"".$this -> current_link."&spage=".$i."\">".$i."</a>";
                }
                else
                {
                    $links .= "<a title=\"Go to page ".$i."\" href=\"".$this -> current_link."&spage=".$i."\">".$i."</a>";
                }
                
			}
		}

		return $links;
	}
	
	function renderPrev1() // function for displaying the left arrow button
	{
		if ($this -> page > 1) // checking whether the current page is not the first page
			{
				if ($this -> page != 2) // checking whether the previous page is the first page
				{
					$prev_page = $this->page - 1;
					return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-left-black.gif\" alt=\"arrow left\" class=\"cursor\" title=\"Go to previous page\" onclick=\"window.location='".$this -> current_link ."&spage=".$prev_page."';\"/>";
				}
				else // if the previous page is first page , in the query string there should be no page attribute
				{
					return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-left-black.gif\" alt=\"arrow left\" class=\"cursor\" title=\"Go to previous page\" onclick=\"window.location='".$this -> current_link ."';\"/>";
				}
				
			}
		else
			return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-left-black.gif\" alt=\"arrow left\"/>";
	}
	
	function renderNext1() // function for displaying the right arrow button
	{
		if ($this -> page == $this -> max_pages) // checking whether the current page is the last page
			return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-right-black.gif\" alt=\"arrow right\"/>";
		else
			{
				$next_page = $this -> page + 1;	
				return "<img src=\"".$_SESSION['SITE_ADMIN']."images/arrow-right-black.gif\" alt=\"arrow right\" class=\"cursor\" title=\"Go to next page\" onclick=\"window.location='".$this -> current_link."&spage=".$next_page."';\"/>";
			}
	}
	
	function renderFullNav1() // function for displaying the complete pagination string
	{
		return $this -> renderPrev1()." ".$this -> renderNav1()." ".$this -> renderNext1();
	}

////* End of function new pagintion **********/




	///////******* FUNCTION DEFINITION FOR FETCHING MULTIPLE ROWS ******////////
	
	function fetchRows($qry) // query to be processed
	{
       $result = mysql_query($qry);//running query
        
       if ($num = @mysql_num_rows($result)) // if the result set contains atleast single row
		{
			while($row = mysql_fetch_assoc($result)) // traversing the result set
			{
				//strip slashes from info - the ones we added while sanitizing input
				foreach ($row as $key => $value)
				{			
					$row[$key] = stripslashes($value);
				}        	
				$search_result[] = $row; // storing each row in an array
			}
			return $search_result;	// finally returning the result set as an array
		}	
		else // no rows are selected 
			return 0;			
	}
	
	///////********* FUNCTION DEFINITION FOR FETCHING SINGLE ROW *******////////
	
	function fetchRow($qry) // query to be processed
	{
		$result = mysql_query($qry);//running query
		$row = @mysql_fetch_assoc($result); // fetching the result set
	   	return $row;	
	}
	
	/////******* FUNCTION DEFINITION FOR COUNTING THE NUMBER OF ROWS SELECTED ******////////
	
	function numRows($qry) // query to be processed
	{
		$result = mysql_query($qry); //running query
		$row = @mysql_num_rows($result); //counting the rows
	   	return $row;	
	}
	
	//////******* FUNCTION DEFINITION FOR BEGINING THE TRANSACTION *******////////	
	
	function begin()
	{
		mysql_query('BEGIN');
	}
	
	//////******** FUNCTION DEFINITION FOR COMITTING THE TRANSACTION ******///////
	
	function commit()
	{
		mysql_query('COMMIT');
	}
	
	////////******* FUNCTION DEFINITION FOR ROLLING BACK THE TRANSACTION *******////////
	
	function rollback()
	{
		mysql_query('ROLLBACK');
	}
	
	//////******* FUNCTION DEFINITION FOR PROCESSING A QUERY ******////////
	
	function runQuery($qry) // query to be processed
	{
		$result = mysql_query($qry); // processing the query
		
		if ($result) // if processing is successful
			return true;
		else
			return false;
	}
	
	//////******* FUNCTION DEFINITION FOR RETRIEVING THE INSERTED ID ******////////
	
	function getInsertedId($qry) // query to be processed
	{
		$result = mysql_query($qry); // processing the query
		
		if ($result) // if processing is successful
		{
			return $id = mysql_insert_id();
		}
		else // if processing is failed returning 0
		{
			return 0;
		}
	}
	
	///////******* FUNCTION DEFINITION FOR FETCHING MULTIPLE ROWS ******////////
	
	  function fetchFieldArray($qry,$fieldName) // query to be processed
	 {
       $result = mysql_query($qry);//running query
        $i=1;
    	while($row = mysql_fetch_assoc($result)) // traversing the result set
			{
				$arrayIds[$i] = $row[$fieldName];
				$i++;
			}
			return $arrayIds;
	 }
	 
}
?>