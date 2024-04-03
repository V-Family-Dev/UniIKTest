<?php


function updateEmployee($conn, $emp_id, $first_name, $last_name, $nic, $employee_no, $phone_no, $whatsapp_no, $address,  $postal_code, $branch_id, $account_holder_name, $account_number, $reference_id)
{
    $query = $conn->prepare("UPDATE employee SET first_name = ?, last_name = ?, NIC = ?, phone_no = ?, whatsapp_no = ?, BankCode = ?, Address = ?, postcode = ?, AccountNum = ?, holderName = ?, reference_id = ? WHERE id = ?");

    if ($query === false) {
        return false;
    }

    $query->bind_param('sssssisssssi', $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branch_id, $address, $postal_code, $account_number, $account_holder_name, $reference_id, $emp_id);

    $query->execute();

    return $query->affected_rows;
}
