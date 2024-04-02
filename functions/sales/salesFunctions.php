<?php


// function pagination($conn, $limit, $page)
// {
//     $sql = "SELECT COUNT(*) FROM `salesorders`";
//     $result = $conn->query($sql);
//     $row = $result->fetch_row();
//     $total_records = $row[0];
//     $total_pages = ceil($total_records / $limit);

//     $pageLink = "<div class='pagination'>";

//     // Calculate start and end of the range of page links
//     $start = max(1, $page - 10);
//     $end = min($total_pages, $page + 5);

//     // Adjust the range if it doesn't show 10 pages
//     if ($end - $start < 9) {
//         // If at the beginning of the pagination
//         if ($start == 1) {
//             // Extend end to show 10 pages
//             $end = min(10, $total_pages);
//         }
//         // If at the end of the pagination
//         else if ($end == $total_pages) {
//             // Extend start to show 10 pages
//             $start = max(1, $end - 9);
//         }
//     }

//     // Previous page link
//     if ($page > 1) {
//         $pageLink .= "<a href='SalesOrder-Search.php?page=" . ($page - 1) . "'>&laquo;</a>";
//     }

//     // Generate page number links
//     for ($i = $start; $i <= $end; $i++) {
//         $activeClass = ($page == $i) ? 'active' : '';
//         $pageLink .= "<a class='$activeClass' href='SalesOrder-Search.php?page=" . $i . "'>" . $i . "</a>";
//     }

//     // Next page link
//     if ($page < $total_pages) {
//         $pageLink .= "<a href='SalesOrder-Search.php?page=" . ($page + 1) . "'>&raquo;</a>";
//     }

//     $pageLink .= "</div>";
//     echo $pageLink;
// }













// function get_dataorder($conn, $limit, $page)
// {
//     $data = array();
//     $getdata = $conn->prepare("SELECT `sonumber`, `SalesDate`, `DueDate`,`ContactName`, `ContactNo`,`EmpNo`, `Total`, `ItemQty`FROM `salesorders` LIMIT $limit OFFSET " . ($page - 1) * $limit);
//     $getdata->execute();
//     $result = $getdata->get_result();
//     while ($row = $result->fetch_assoc()) {
//         $data[] = ['sonumber' => $row['sonumber'], 'SalesDate' => $row['SalesDate'], 'DueDate' => $row['DueDate'], 'ContactName' => $row['ContactName'], 'ContactNo' => $row['ContactNo'], 'EmpNo' => $row['EmpNo'], 'Total' => $row['Total'], 'ItemQty' => $row['ItemQty']];
//     }
//     $getdata->close();
//     return $data;
// }







// function get_dataorders($conn)
// {
//     $data = array();
//     $getdata = $conn->prepare("SELECT `sonumber`, `SalesDate`, `DueDate`,`ContactName`, `ContactNo`,`EmpNo`, `Total`, `ItemQty`FROM `salesorders`");
//     $getdata->execute();
//     $result = $getdata->get_result();
//     while ($row = $result->fetch_assoc()) {
//         $data[] = ['sonumber' => $row['sonumber'], 'SalesDate' => $row['SalesDate'], 'DueDate' => $row['DueDate'], 'ContactName' => $row['ContactName'], 'ContactNo' => $row['ContactNo'], 'EmpNo' => $row['EmpNo'], 'Total' => $row['Total'], 'ItemQty' => $row['ItemQty']];
//     }
//     $getdata->close();
//     return $data;
// }









// //form validation and sanitization
// function sOrderADD($conn, $data1, $data2)
// {
//     //first get user data 
//     foreach ($data1 as $row) {
//         $empid = $row['empid'];
//         $contactPerson = $row['contactPerson'];
//         $contactNo = $row['contactNo'];
//         $city = $row['city'];
//         $address = $row['address'];
//         $salesDate = $row['salesDate'];
//         $dueDate = $row['dueDate'];

//         foreach ($data2 as $row) {
//             $itemcode = $row['itemCode'];
//             $quantity = $row['quantity'];
//             $price = $row['price'];
//             $total = $quantity * $price;
//             $adddatasalesorders = "INSERT INTO `salesorders` (`SalesDate`, `DueDate`, `ContactName`, `ContactNo`, `EmpNo`, `address`, `ItemQty`, `City`) VALUES (?,?,?,?,?,?,?,?)";
//             $stmt = $conn->prepare($adddatasalesorders);
//             $stmt->bind_param('ssssssss', $salesDate, $dueDate, $contactPerson, $contactNo, $empid, $address, $quantity, $city);
//             $stmt->execute();
//             if ($stmt) {
//                 $last_id = $conn->insert_id;
//                 $adddatasaleslines = "INSERT INTO `saleslines` (`ContactName`, `ContactNo`, `SalesDate`, `itemcode`, `unitprice`, `quantity`, `amount`, `salesorders_sonumber`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
//                 $stmt = $conn->prepare($adddatasaleslines);
//                 $stmt->bind_param('ssssdddi', $contactPerson, $contactNo, $salesDate, $itemcode, $price, $quantity, $total, $last_id);
//                 if ($stmt->execute()) {
//                     header("Location: ../sales/order.php");
//                 } else {
//                     echo "Error: " . $stmt->error;
//                 }
//             }
//             $stmt->close();
//         }
//     }
// }

// //trimdata
// function datamake($data)
// {

//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }






//get emp id with other data 
function getEmpId($conn)
{
    {
        $sql = "SELECT id,employee_no,first_name,last_name,phone_no,Address FROM employee where EmpStatus=1";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $empNumber = [];
            while ($row = $result->fetch_assoc()) {
                $empNumber[] = $row;
            }
        }
    
        return $empNumber;
    }
    
}

//get item data 
function getItemData($conn)
{
    {
        $sql = "SELECT Item_id,item_code,Item_name,price FROM item_master where item_status=1";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $empNumber = [];
            while ($row = $result->fetch_assoc()) {
                $empNumber[] = $row;
            }
        }
    
        return $empNumber;
    }
    
}

// //get item data

// function getItemData($conn)
// {
   
//     {
//         $sql = "SELECT * FROM item_master";
//         $result = $conn->query($sql);
    
//         if ($result->num_rows > 0) {
//             $empNumber = [];
//             while ($row = $result->fetch_assoc()) {
//                 $empNumber[] = $row;
//             }
//         }
    
//         return $empNumber;
//     }
    
// }




// //get getSalesData();


// function getSalesData($conn)
// {
//     $tbdata = array();
   
//     $getSalesData = $conn->prepare("SELECT i.ItemCode, i.ItemName, i.Price, s.quantity FROM itemsmaster AS i INNER JOIN saleslines AS s ON i.ItemCode = s.itemcode limit 10;");
//     $getSalesData->execute();
//     $result = $getSalesData->get_result();
//     while ($row = $result->fetch_assoc()) {
//         $tbdata[] = ['ItemCode' => $row['ItemCode'], 'ItemName' => $row['ItemName'], 'Price' => $row['Price'], 'Quantity' => $row['quantity']];
//     }
//     $getSalesData->close();

//     return $tbdata;
// }