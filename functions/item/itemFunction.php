<?php
// require "../../DB/dbconfig.php";
//data add itemmaster
function itemDataInsert($conn, $itemCode, $itemName, $price, $level_1, $level_2, $level_3, $level_4, $level_5, $level_6, $item_status=1) {
    $sql = "INSERT INTO item_master (item_code, Item_name, price, level_1, level_2, level_3, level_4, level_5, level_6,item_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssdddddddi", $itemCode, $itemName, $price, $level_1, $level_2, $level_3, $level_4, $level_5, $level_6, $item_status);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {         
            $stmt->close();
            return false;
        }
    } else {
        return "Error preparing query: " . $conn->error;
    }
}


function getActiveItems($conn) {
    $query = "SELECT * FROM item_master WHERE item_status = 1"; // Your SQL query

    if ($result = $conn->query($query)) {
        $items = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            return $items;
        } else {
            // No items found
            return null; // or return an appropriate response
        }
    } else {
        // Query failed
        error_log("Query failed: " . $conn->error); // Log the error
        return false; // Indicate that an error occurred
    }
}


function deleteItemMaster($conn, $id) {
    $sql = "UPDATE item_master SET item_status = 0 WHERE Item_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->affected_rows > 0; // Check if any rows were updated
            $stmt->close();
            return $result;
        } else {
            $error = $stmt->error; // Capture error message
            $stmt->close();
            return "Error executing query: " . $error;
        }
    } else {
        return "Error preparing query: " . $conn->error;
    }
} 
// //view item master 
// function viewItemMaster($conn, $limit, $page)
// {
//     $sql = "SELECT * FROM `itemsmaster` LIMIT $limit OFFSET " . ($page - 1) * $limit;
//     $result = $conn->query($sql);
//     $itemdata = array();
//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             $itemdata[] = $row;
//         }
//     } else {
//         echo "0 results";
//     }
//     return $itemdata;
//     $conn->close();
// }




// // item page function

// function pagination($conn, $limit, $page)
// {
//     $sql = "SELECT COUNT(*) FROM `itemsmaster`";
//     $result = $conn->query($sql);
//     $row = $result->fetch_row();
//     $total_records = $row[0];
//     $total_pages = ceil($total_records / $limit);


//     $pageLink = "<div class='pagination'>";

//     // Link for the first page
//     if ($page > 1) {
//         if ($page != 1) {
//             $pageLink .= "<a href='item.php?page=" . ($page - 1) . "'>&laquo;</a>";
//         }
//     }

//     for ($i = 1; $i <= $total_pages; $i++) {
//         $activeClass = ($page == $i) ? 'active' : '';
//         $pageLink .= "<a class='$activeClass' href='item.php?page=" . $i . "'>" . $i . "</a>";
//     }

//     if ($page < $total_pages) {
//         $pageLink .= "<a href='item.php?page=" . ($page + 1) . "'>&raquo;</a>";
//     }

//     echo $pageLink . "</div>";
// }