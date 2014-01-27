<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
     <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<div class="nav">

     <a href="addBanks.php" class="list">Add Banks</a> 
     <a href="index.php" class="list">Home</a>
</div>
     <div class="container">

     	<form action="add-bank-exec.php" id="bankdetails" method="POST">
     		<table class="table">
                    <thead>
                         <th colspan="2">
                              Add Bank Details
                          </th>
                    </thead>     
     			<tr>
     				<td>
     					Bank
     				</td>
     				<td>
     					<select type="text" id="bankName" name="bankName" class="textfield">
                                   <option value="State Bank of India">State Bank of India</option>
                                   <option value="State Bank of Bikaner and Jaipur">State Bank of Bikaner and Jaipur</option>
                                   <option value="State Bank of Hyderabad">State Bank of Hyderabad</option>
                                   <option value="State Bank of Mysore">State Bank of Mysore</option>
                                   <option value="State Bank of Patiala">State Bank of Patiala</option>
                                   <option value="State Bank of Travancore">State Bank of Travancore</option>
                                   <option value="State Bank of Saurashtra">State Bank of Saurashtra</option>
                                   <option value="State Bank of Indore">State Bank of Indore</option>
                                   <option value="Allahabad Bank">Allahabad Bank</option>
                                   <option value="Andhra Bank">Andhra Bank</option>
                                   <option value="Bank of Baroda">Bank of Baroda</option>
                                   <option value="Bank of India">Bank of India</option>
                                   <option value="Bank of Maharashtra">Bank of Maharashtra</option>
                                   <option value="Bhartiya Mahila Bank">Bhartiya Mahila Bank</option>
                                   <option value="Canara Bank">Canara Bank</option>
                                   <option value="Central Bank of India">Central Bank of India</option>
                                   <option value="Corporation Bank">Corporation Bank</option>
                                   <option value="Dena Bank">Dena Bank</option>
                                   <option value="IDBI Bank">IDBI Bank</option>
                                   <option value="Indian Bank">Indian Bank</option>
                                   <option value="Indian Overseas Bank">Indian Overseas Bank</option>
                                   <option value="Oriental Bank of Commerce">Oriental Bank of Commerce</option>
                                   <option value="Punjab National Bank">Punjab National Bank</option>
                                   <option value="Punjab and Sind Bank">Punjab and Sindh Bank</option>
                                   <option value="Syndicate Bank">Syndicate Bank</option>
                                   <option value="UCO Bank">UCO Bank</option>
                                   <option value="Union Bank of India">Union Bank of India</option>
                                   <option value="United Bank of India">United Bank of India</option>
                                   <option value="Vijaya Bank">Vijaya Bank</option>
                              </select>
     				</td>
     			</tr>
     			<tr>
     				<td>
     					Abbreviation
     				</td>
     				<td>
     					<input type="text" id="abbr" name="abbr" class="textfield">
     				</td>
     			</tr>
     			<tr>
     				<td>
     					Location
     				</td>
     				<td>
     					<input id="location" name="location" type="text" class="textfield">
     				</td>
     			</tr>
     			<tr>
     				<td>
     					Latitude
     				</td>
     				<td>
     					<input type="text" id="lat" name="lat" class="textfield">
     				</td>
     			</tr>
     	
     			<tr>
     				<td>
     					Longitude
     				</td>
     				<td>
     					<input type="text" id="lng" name="lng" class="textfield">
     				</td>
     			</tr>
     			<tr>
     				<td>
     					District
     				</td>
     				<td>
     					<input type="text" id="district" name="district" class="textfield">
     				</td>
     			</tr>
     			<tr>
     				<td>
     					Opening Balance
     				</td>
     				<td>
     					<input type="text" id="opBalance" name="opBalance" class="textfield">
     				</td>
     			</tr>
     			<tr>
     				<td>
     					Closing Balance
     				</td>
     				<td>
     					<input type="text" id="clBalance" name="clBalance" class="textfield">
     				</td>
     			</tr> 
     		 	<tr>
     		 		<td colspan="2">	
     		 			<input type="submit" value="Save" class="btn" class="textfield">
     		 		</td>
     		 	</tr>
     		 </table>			
     	</form>
     </div>     
</body>
</html>