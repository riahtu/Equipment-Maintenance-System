
 <?php
  require_once('db_ems.php');
  $s_partname = "%".$_GET[partname]."%";
   $s_sparepartid = "%".$_GET[sparepartid]."%";
	$s_maker = "%".$_GET[maker]."%";
	$s_barcode = "%".$_GET[barcode]."%";
	   


 echo "<table>";
$result1 = mysql_query("SELECT * from m_sparepart where description like '$s_partname'
														and sparepartid like '$s_sparepartid'
                                                         and maker like '$s_maker'
														 and barcode like '$s_barcode'
														
														 order by maker,description
														 ");
if (!mysql_num_rows($result1) == 0 )
{

	while($row1 = mysql_fetch_array($result1))
    {
	
	echo "<tr><td>Desc $row1[description]</td></tr>";
	
	}
	
}
	echo "</table>";
	?>