<?php
$trainee=array(
    array(
        'id'=>1,
        'name'=>'Sajal'
    ),
    array(
        'id'=>2,
        'name'=>'Neeraj'
    ),
    array(
        'id'=>3,
        'name'=>'Lavish'
    )
    );

function performCrud($crud){
    global $trainee;
    switch ($crud['operation']) {
        case 'create':
            if (empty($crud['data'])) {
                return "Please Enter valid data";
            }
            array_push($trainee, $crud['data']);
            return $trainee;
        case 'edit':
            if (!$crud['id'] || empty($crud['data'])) {
                return "Please Enter ID and valid data";
            } else {
                $key=array_search($crud['id'], array_column($trainee,'id'));
                if ($key) {
                    $trainee[$key]['name']=$crud['data']['name'];
                    return $trainee;
                }
                else {
                    return "Trainee with id: ".$crud['id']." does not exist";
                }
            }
        case 'delete':
            if (!$crud['id']) {
                return "Please Enter ID";
            } else {
                $key=array_search($crud['id'], array_column($trainee,'id'));
                if ($key) {
                    unset($trainee[$key]);
                    return $trainee;
                }
                else {
                    return "Trainee with id: ".$crud['id']." does not exist";
                }
            }
        default:
            return "Invalid Action";
    }

/*
    if ($action == 'create') {
        if ($crud == '') {
            return "Please Enter valid data";
        }
        array_push($trainee, $crud);
        return $trainee;
    } elseif ($action=='edit') {
        if ($id==0 || $crud=='') {
            return "Please Enter ID and valid data";
        } else {
            foreach ($trainee as $key => $value) {
                if ($value['id']==$id) {
                    $value['name']=$crud;
                    return $value;
                }
            }
        }
    } elseif ($action=='delete') {
        if ($id==0) {
            return "Please Enter ID";
        } else {
            foreach ($trainee as $key => $value) {
                if ($value['id']==$id) {
                    unset($trainee[$key]);
                    return $trainee;
                }
            }
        }
    } else {
        return "Invalid Action";
    }*/
}

$new = array(
    'id' => 6,
    'name' => 'Param'
);

$new = 'Gaurav';

$crud = [
    'operation' => 'create',
    // 'id' => 3,
    'data' => [
        'id' => 6,
        'name' => 'Param'
    ]
    ];
echo "<pre>";
print_r(performCrud($crud));
echo "</pre>";