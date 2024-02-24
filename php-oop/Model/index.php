<?php

    // call all dependency
    include("./Model/Profile.php"); 


    // request data
    $start      = $_GET['start'] ?? date('Y-m-d');
    $end        = $_GET['end'] ?? date('Y-m-d');
    $type       = $_GET['type'] ?? '';
    $perpage    = $_GET['perpage'] ?? 10;
    $start_date = $start;
    $end_date   = $end;

    $model = new Profile();
    $query = $model->select(['profile.phone_number','profile.profile_created_date','record.phone_number','record.date_time','record.agent'])
    ->join('record', 'profile.phone_number = record.phone_number')
    ->where('record.date_time','>=',$start_date , 'AND' ,'record.date_time','<=' ,$end_date);

    if ($type=='Agent') {
       $query->and('record.agent','NOT LIKE','%PSYCHOLOGIST%')
       ->and('record.agent','NOT LIKE','%Dr.%'); 
    }

    if ($type=='Psychologist') {
       $query->and('record.agent','LIKE','%PSYCHOLOGIST%');
    }

    if ($type=='Doctor') {
       $query->and('record.agent','LIKE','%Dr.%');
    }

    $result =  $query->paginate($perpage);
    
    /*
        profile_created_by !='' AND (name !='n/A' AND name !='n/a' AND 
        name !='na' AND  name NOT LIKE '%rank%' AND  name !='' AND
        name NOT LIKE '%ssful%' AND  name NOT LIKE '%call%'  AND 
        name NOT LIKE '%lent%'   AND  name NOT LIKE '%n?a%'   AND 
        name NOT LIKE '%busy%'  AND  name NOT LIKE '%/a%' ) AND
        phone_number NOT LIKE '00%'
    */
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script> -->
</head>
<style>
    option:hover { cursor: pointer; }
</style>
<body>

<div class="container m-auto mt-[30px]">

    <div class="m-auto ">

        <div class="relative p-5 overflow-x-auto shadow-md sm:rounded-lg">
            <form action="" class="" method="get">
                <div class="flex mt-5 pb-4 bg-white dark:bg-gray-900">
                    <div class="relative">
                        <select id="perpage" name="perpage" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option <?php if($perpage==10){  ?> selected <?php } ?> value="10">perPage 10</option>
                            <option <?php if($perpage==50){  ?> selected <?php } ?> value="50">perPage 50</option>
                            <option <?php if($perpage==100){  ?> selected <?php } ?> value="100">perPage 100</option>
                            <option <?php if($perpage==200){  ?> selected <?php } ?> value="200">perPage 200</option>
                            <option <?php if($perpage==500){  ?> selected <?php } ?> value="500">perPage 500</option>
                        </select>
                    </div>

                    <div class="relative ml-5">
                        <select id="type" name="type" class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" dissabled selected >Choose a type</option>
                            <option <?php if($type==""){            ?> selected <?php } ?> value="">ALL DATA</option>
                            <option <?php if($type=="Success"){     ?> selected <?php } ?> value="Success">Successfull call</option>
                            <option <?php if($type=="Unsuccess"){   ?> selected <?php } ?> value="Unsuccess">Un-Successfull call</option>
                            <option <?php if($type=="Doctor"){      ?> selected <?php } ?> value="Doctor">Doctor Report</option>
                            <option <?php if($type=="Psychologist"){?> selected <?php } ?> value="Psychologist">Psychologist Report</option>
                            <option <?php if($type=="Agent"){       ?> selected <?php } ?> value="Agent">Agent Report</option>
                            <option <?php if($type=="profile"){     ?> selected <?php } ?> value="profile">Consumer Profile</option>
                        </select>
 
                    </div>

                    <div class="relative ml-5">
                        <div date-rangepicker class="flex items-center">
                            <div class="relative">
                                <!-- <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div> -->
                                <input name="start" type="date" value="<?php echo $start?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                                <!-- <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div> -->
                                <input name="end" type="date" value="<?php  echo $end?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="absolute right-0 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Filter</button>
                </div>
            </form>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Agent </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                        profile_created_date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result['data'] as $key => $value) { ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $value['agent'] ?>
                        </th>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            Laptop
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $value['profile_created_date'] ?? '' ?>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if($result['total_count'] > 0){?>
            <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing 
                <span class="font-semibold text-gray-900 dark:text-white"><?= $result['current_page'] ?>-<?= $result['total_pages'] ?></span> of <span class="font-semibold text-gray-900 dark:text-white"><?= $result['total_count'] ?></span></span>
                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    <li>
                        <a href="?page=<?= $result['current_page']-1 == 0 ? 1 : $result['current_page']-1 ?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                    <li>
                        <a href="?page=1" class="flex items-center justify-center px-3 h-8 leading-tight  <?php echo  $result['current_page']==1 ? 'bg-cyan-500 hover:bg-cyan-600 text-white' : 'bg-white text-gray-500 '; ?>  border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                    </li>
                    <?php 
                        $current_page = $result['current_page']==1 ? 2 : $result['current_page'] ; $last_page= $current_page+5;
                        for ($current_page; $current_page < $last_page; $current_page++) { 
                    ?>
                    <li>
                        <a href="?page=<?= $current_page ?>" class="flex items-center justify-center px-3 h-8 leading-tight <?php echo $result['current_page']==$current_page ? 'bg-cyan-500 hover:bg-cyan-600 text-white' : 'bg-white text-gray-500 '; ?>   border border-gray-300    dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $current_page ?> </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="?page=<?= $result['current_page']+1 ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                    </li>
                </ul>
            </nav>
            <?php } ?> 
        </div>

    </div>

</div>



</body>
</html>