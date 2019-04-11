
<div class="content-wrapper">
    <div class="container-fluid">
<div class="row">
         <div class="container col-md-12" style="margin-top:10px;" >
  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php echo base_url("index.php/restaurent/add_restaurent"); ?>"><button class="btn btn-primary btn-xl">Add Restaurent</button></a>
  
  
  
  
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">  
        <thead>  
			<tr>
			    <th>Qr Code</th>
            	<th>Name</th>  
            	<th>Image</th>  
				<th>Address</th>
             	<th>Category</th>
             	<th>Type</th>
				<th>Operation</th>
           </tr>
		   </thead>  
        <tbody> 
		<?php  
		        $idArray = array();
                foreach($this->RestaurentModel->fetchtable() as $row)  
                {  
                    //name has to be same as in the database.  
					$id = $row->id;
					$idArray[] = $id;
                    echo "<tr>";
                    ?>
                    <td>
                        <canvas id="qrcode-canvas<?php echo $id; ?>" style="padding:1em; background-

                            color:#E8E8E8"></canvas>
                            					<svg id="qrcode-svg<?php echo $id; ?>" style="width:15em; height:25em; padding:1em; 
                            
                            background-color:#E8E8E8">
                            						<rect width="100%" height="100%" fill="#FFFFFF" stroke-
                            
                            width="0"></rect>
                            						<path d="" fill="#000000" stroke-width="0"></path>
                            					</svg>

                    </td>
                    <?php
                                echo "<td>$row->name</td> 
	                            <td><img src='".base_url("uploads/team/$row->image")."' height='100px' width='100px'/></td>  

								<td>$row->address</td> 
								<td>$row->category</td>
								<td>$row->type</td>";
							?>	
							
							 
							 
							 
                             <td><a href="<?php echo  site_url("menu/edit_menu_view"); ?>"><i class='fa fa-edit'></i></a> &nbsp;&nbsp;   <a href="<?php echo  site_url("restaurent/delete_restaurent/$id"); ?>"><i class='fa fa-trash'></i>  </a> <a href="<?php echo  site_url("menu/viewMenuList"); ?>"><i class='fa fa-edit'></i></a>  </td>
                           <?php     
                    echo "</tr>";  
                }  
            ?>  
		 </tbody>  
    </table>   
	</div>
	
	
	
	
	
	<table style="display:none">
			<tr>
				<td><strong>Error correction:</strong></td>
				<td>
					<input type="radio" name="errcorlvl" id="errcorlvl-low" 

onchange="redrawQrCode();" checked="checked"><label for="errcorlvl-low">Low</label>
					<input type="radio" name="errcorlvl" id="errcorlvl-medium" 

onchange="redrawQrCode();"><label for="errcorlvl-medium">Medium</label>
					<input type="radio" name="errcorlvl" id="errcorlvl-quartile" 

onchange="redrawQrCode();"><label for="errcorlvl-quartile">Quartile</label>
					<input type="radio" name="errcorlvl" id="errcorlvl-high" 

onchange="redrawQrCode();"><label for="errcorlvl-high">High</label>
				</td>
			</tr>
			<tr>
				<td>Output format:</td>
				<td>
					<input type="radio" name="output-format" id="output-format-bitmap" 

onchange="redrawQrCode();" checked="checked"><label for="output-format-bitmap">Bitmap</label>
					<input type="radio" name="output-format" id="output-format-vector" 

onchange="redrawQrCode();"><label for="output-format-vector">Vector</label>
				</td>
			</tr>
			<tr>
				<td>Border:</td>
				<td><input type="number" value="4" min="0" max="100" step="1" id="border-input" style="width:4em" oninput="redrawQrCode();"> modules</td>
			</tr>
			<tr id="scale-row">
				<td>Scale:</td>
				<td><input type="number" value="8" min="1" max="30" step="1" id="scale-input" 

style="width:4em" oninput="redrawQrCode();"> pixels per module</td>
			</tr>
			<tr>
				<td>Version range:</td>
				<td>Minimum = <input type="number" value="1" min="1" max="40" step="1" 

id="version-min-input" style="width:4em" oninput="handleVersionMinMax('min');">, maximum = <input 

type="number" value="40" min="1" max="40" step="1" id="version-max-input" style="width:4em" 

oninput="handleVersionMinMax('max');"></td>
			</tr>
			<tr>
				<td>Mask pattern:</td>
				<td><input type="number" value="-1" min="-1" max="7" step="1" id="mask-input" 

style="width:4em" oninput="redrawQrCode();"> (-1 for automatic, 0 to 7 for manual)</td>
			</tr>
			<tr>
				<td>Boost ECC:</td>
				<td><input type="checkbox" checked="checked" id="boost-ecc-input" 

onchange="redrawQrCode();"><label for="boost-ecc-input">Increase <abbr title="error-correcting 

code">ECC</abbr> level within same version</label></td>
			</tr>
			<tr>
				<td>Statistics:</td>
				<td id="statistics-output" style="white-space:pre"></td>
			</tr>
			<tr id="svg-xml-row">
				<td>SVG XML code:</td>
				<td>
					<textarea id="svg-xml-output" readonly="readonly" style="width:100%; 

max-width:50em; height:15em; font-family:monospace"></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<script type="application/javascript" src="<?php echo base_url("asset/js/qrcodegen.js"); ?>"></script>
<script type="application/javascript" src="<?php echo base_url("asset/js/qrcodegen-demo.js"); ?>"></script>

<?php
    foreach($idArray as $idA)
    {
        ?>
            <script>
                redrawQrCode("<?php echo $idA; ?>");
            </script>
        <?php
    }
?>
<script>
redrawQrCode("hi");
redrawQrCode("hello");
</script>