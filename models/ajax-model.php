<?php
class AjaxModel
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
	
	function ajaxpaging_advancesearch($start,$result_numrec,$curr_page,$noofpages,$noofrows_k,$end){
		
	    $paging="<table border='0' cellpadding='0' cellspacing='0' id='paging-table'>
			<tr>
			<td>";
         	if($start != 0){/*href='#' */
				$paging.="<a class='page-far-left' onclick='pagefirst()'></a>
				          <a class='page-left' onclick='pageprev()'></a>";
             }
     		 $paging.="<div id='page-info'>Page <strong>".($curr_page+1)."</strong>&nbsp;/&nbsp;".$noofpages."</div>";
      		if($result_numrec == 0 ){
				if(($curr_page+1)!=$noofpages)
				{
					$paging.="<a class='page-right' onclick='pagenext()'></a>
					          <a class='page-far-right' onclick='pagelast(($noofpages-1)*$noofrows_k)'></a>";
                }
				}
				if($end == 20){
			    $sel5 = "selected=selected";
			  }else if($end == 40){
				  $sel10 = "selected=selected";
			  }else if($end == 60){
				  $sel15 = "selected=selected";
			  }
			$paging.="</td>
			<td>
      	    <select name='sel_noofrow' id='sel_noofrow' onchange='noofrow1()' class='select_box_paging' > 
                    <option value='20' ".$sel5.">20</option>
                    <option value='40' ".$sel10.">40</option>
                    <option value='60' ".$sel15.">60</option>
				</select>
            <input type='hidden' name='totalrecords' id='totalrecords' value=".$noofpages." />
			<input type='hidden' name='hid_curr_page' id='hid_curr_page' value=".$curr_page." />
            <input type='hidden' name='hid_prevnext' id='hid_prevnext' value=".$start." />
            <input type='hidden' name='hid_noofrow' id='hid_noofrow' value=".$end." />
  		</td>
			</tr>
			</table>";
		return 	$paging;
	
	}
	function ajaxpaging($start,$result_numrec,$curr_page,$noofpages,$noofrows_k,$end){
		
	    $paging="<table border='0' cellpadding='0' cellspacing='0' id='paging-table'>
			<tr>
			<td>";
         	if($start != 0){
				$paging.="<a href='#' class='page-far-left' onclick='pagefirst()'></a>
				          <a href='#' class='page-left' onclick='pageprev()'></a>";
             }
     		 $paging.="<div id='page-info'>Page <strong>".($curr_page+1)."</strong>&nbsp;/&nbsp;".$noofpages."</div>";
      		if($result_numrec == 0 ){
				if(($curr_page+1)!=$noofpages)
				{
					$paging.="<a href='#' class='page-right' onclick='pagenext()'></a>
					          <a href='#' class='page-far-right' onclick='pagelast(($noofpages-1)*$noofrows_k)'></a>";
                }
				}
			  if($end == 20){
			    $sel5 = "selected=selected";
			  }else if($end == 40){
				  $sel10 = "selected=selected";
			  }else if($end == 60){
				  $sel15 = "selected=selected";
			  }
			$paging.="</td>
			<td>
      	    <select name='sel_noofrow' id='sel_noofrow' onchange='noofrow1()' class='select_box_paging' > 
                    <option value='20' ".$sel5.">20</option>
                    <option value='40' ".$sel10.">40</option>
                    <option value='60' ".$sel15.">60</option>
				</select>
            <input type='hidden' name='totalrecords' id='totalrecords' value=".$noofpages." />
			<input type='hidden' name='hid_curr_page' id='hid_curr_page' value=".$curr_page." />
            <input type='hidden' name='hid_prevnext' id='hid_prevnext' value=".$start." />
            <input type='hidden' name='hid_noofrow' id='hid_noofrow' value=".$end." />
  		</td>
			</tr>
			</table>";
		return 	$paging;
	
	}
	function numberPagination($sql,$rows_per_page,$links_per_page,$currentPage)
	{
		$this -> total_rows = @mysql_num_rows(mysql_query($sql)); // counting the total number of rows.
		$this -> rows_per_page = $rows_per_page;
		$this -> links_per_page = $links_per_page;
		$this -> sql = $sql;
							
		$this -> page = $currentPage;
		
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
	
	// function for displaying the links in pagination string
	
	function renderNav() 
	{
		// calculate the starting positions.
		// dividing the pages into set of intervals (by a difference of requested links per page) and traversing.
		for ($i = 1; $i <= $this -> max_pages; $i += $this -> links_per_page)
        {
			// catch the interval where the current page equals.
			if ($this -> page >= $i)
            {
				// make it as the starting link.
                $start = $i;
            }
        }
	
		// calculate the ending position.
		// check that the maximum number of pages greater than links per page.
		if ($this -> max_pages > $this -> links_per_page)
        {
			$end = $start+$this -> links_per_page-1;
			// check whether the ending point exceeds maximum number of pages.
			if ($end > $this -> max_pages)
                $end = $this -> max_pages;
		}
		else // if the maximum number of pages equals or less than links per page assign the maximum as the ending point.
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
                $links .= "<a title=\"Go to page ".$i."\" class=\"cursor\" onclick=\"showPage(".$i.")\">".$i."</a>";
            }
		}

		return $links;
	}
	
	function renderPrev() // function for displaying the left arrow button
	{
		if ($this -> page > 1) // checking whether the current page is not the first page
		{
			$prev_page = $this->page - 1;
			return "<img src=\"teg-admin/images/arrow-left-black.gif\" alt=\"arrow left\" class=\"cursor\" title=\"Go to previous page\" onclick=\"showPage(".$prev_page.");\"/>";
		}
		else
			return "<img src=\"teg-admin/images/arrow-left-black.gif\" alt=\"arrow left\"/>";
	}
	
	function renderNext() // function for displaying the right arrow button
	{
		if ($this -> page == $this -> max_pages) // checking whether the current page is the last page
			return "<img src=\"teg-admin/images/arrow-right-black.gif\" alt=\"arrow right\"/>";
		else
			{
				$next_page = $this -> page + 1;	
				return "<img src=\"teg-admin/images/arrow-right-black.gif\" alt=\"arrow right\" class=\"cursor\" title=\"Go to next page\" onclick=\"showPage(".$next_page.");\"/>";
			}
	}
	
	function renderFullNav() // function for displaying the complete pagination string
	{
		return $this -> renderPrev()." ".$this -> renderNav()." ".$this -> renderNext();
	}

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
}
?>