<?php
class pagination
{
    var $page = 1; // Current Page
    var $perPage = 20; // Items on each page, defaulted to 10
    var $showFirstAndLast = false; // if you would like the first and last page options.
    var $implodeBy;
    var $queryURL;
    function generate($array, $perPage = 20) {
        // Assign the items per page variable
        if (!empty($perPage))
            $this->perPage = $perPage;
        // Assign the page variable
        if (!empty($_GET['pid'])) {
            $this->page = $_GET['pid']; // using the get method
        } else {
            $this->page = 1; // if we don't have a page number then assume we are on the first page
        }
        // Take the length of the array
        $this->length = count($array);
        // Get the number of pages
        $this->pages = ceil($this->length / $this->perPage);
        // Calculate the starting point 
        $this->start  = ceil(($this->page - 1) * $this->perPage);
        // Return the part of the array we have requested
        asort($array);
        
        return array_slice($array, $this->start, $this->perPage,true);
    }

    /*function links() {
        // Initiate the links array
        $plinks = array();
        $links = array();
        $slinks = array();
        // Concatenate the get variables to add to the page numbering string
        if (count($_GET)) {
            $this->queryURL = '';
            foreach ($_GET as $key => $value) {
                if ($key != 'pid') {
                    $this->queryURL .= '&amp;'.$key.'='.$value;
                }
            }
        }
        // If we have more then one pages
        if (($this->pages) > 1) {
            // Assign the 'next page' if we are not on the last page
            //if ($this->page < $this->pages) {
            if ($this->page < $this->pages) {
               $arrw = '<a href="?pid='.($this->page + 1).$this->queryURL.'"><i class="fa fa-angle-right" aria-hidden="true"></i></a>';
            } else {
                $arrw = '<a href="javascript:void(0);"><i class="fa fa-angle-right" aria-hidden="true"></i></a>';
            }
                $slinks[] = '<li>'.$arrw.'</li> ';
                if ($this->showFirstAndLast) {
                    $slinks[] = '<li><a href="?pid='.($this->pages).$this->queryURL.'"></a> </li>';
                }
            //}
            // // Assign all the page numbers & links to the array
            $totalpages = $this->pages + 1;
            $page = $this->page;
            
            // var_dump($this->page);
            // var_dump($totalpages);
            // for($i = $page; $i < min($page + 4, $totalpages); $i++) {
            //     if ($this->page == $i) {
            //         $links[] = ' <li><a class="disabled">'.$i.'</a></li> '; // If we are on the same page as the current item
            //     } else { 
            //         $links[] = ' <li><a  class="enable" href="?pid='.$i.$this->queryURL.'">'.$i.'</a> </li>'; // add the link to the array
            //     }
            // }
            
             for($i = $page; $i < $totalpages; $i++) {
                if ($this->page == $i) {
                    $links[] = ' <li><a class="disabled">'.$i.'</a></li> '; // If we are on the same page as the current item
                } else { 
                    $links[] = ' <li><a  class="enable" href="?pid='.$i.$this->queryURL.'">'.$i.'</a> </li>'; // add the link to the array
                }
            }
            
            // Assign the 'previous page' link into the array if we are not on the first page
            
            //if ($this->page != 1) {
            if ($this->page != 1) {
                $arrw = '<a href="?pid='.($this->page - 1).$this->queryURL.'"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';
            } else {
                $arrw = '<a  href="javascript:void(0);"><i class="fa fa-angle-left " aria-hidden="true"></i>';
            }
                if ($this->showFirstAndLast) {
                    $plinks[] = '<li class="next"><a  href="?pid=1'.$this->queryURL.'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>';
                }
                $plinks[] = '<li>'.$arrw.'</li>';
            //}       
            // Push the array into a string using any some glue
            return implode(' ', $plinks).implode($this->implodeBy, $links).implode(' ', $slinks);        
        }
        return;
    }*/
     function links()
    {
      // Initiate the links array
      $plinks = array();
      $links = array();
      $slinks = array();
      
      // Concatenate the get variables to add to the page numbering string
     if (count($_GET)) {
        $this->queryURL = '';
        foreach ($_GET as $key => $value) {
          if ($key != 'pid') {
            $this->queryURL .= '&amp;'.$key.'='.$value;
          }
        }
      }
     
      // If we have more then one pages
      if (($this->pages) > 1)
      {
        
  
        // Assign the 'next page' if we are not on the last page
        // if ($this->page < $this->pages) {
        //   $slinks[] = '<li><a href="?pid='.($this->page + 1).$this->queryURL.'"><i class="fa fa-chevron-right"></i></a></li> ';
        //   if ($this->showFirstAndLast) {
        //     $slinks[] = '<li><a href="?pid='.($this->pages).$this->queryURL.'"><i class="fa fa-chevron-left"></i></a> </li>';
        //   }
        // }
        $totalpages = $this->pages+1;
        $pager = $this->page;
        
        // Assign all the page numbers & links to the array
        for($i = 1; $i < $totalpages; $i++) {
                if ($pager == $i) {
                    $links[] = ' <li class="active"><a class="active">'.$i.'</a></li> '; // If we are on the same page as the current item
                } else { 
                    $links[] = ' <li><a href="?pid='.$i.$this->queryURL.'">'.$i.'</a> </li>'; // add the link to the array
                }
            }
        
        // Assign the 'previous page' link into the array if we are not on the first page
        if ($this->page != 1) {
          // if ($this->showFirstAndLast) {
          //   $plinks[] = '<li><a href="?pid=1'.$this->queryURL.'"><i class="fa fa-chevron-right"></i></a></li>';
          // }
          // $plinks[] = '<li><a href="?pid='.($this->page - 1).$this->queryURL.'"><i class="fa fa-chevron-left"></i></a></li>';
        }       
        // Push the array into a string using any some glue
        return implode(' ', $plinks).implode($this->implodeBy, $links).implode(' ', $slinks);        
      }
      return;
    }
}
?>