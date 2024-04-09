<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <title>Ателе</title>
</head>
<body class="center">
<div class="imgBack">
<button class="button" onclick="window.location.href='index.php'">Главная</button>
<button class="button" onclick="window.location.href='addReview.php'">Корзина</button>
<button class="button" onclick="window.location.href='addReview.php'">Контакты</button>

<button class="button" onclick="window.location.href='profile.php'">Профиль</button>
</div>
<h2>Услуги</h2>

<form method="get" class="form">
    <a>
        <label for="column_sort">Сортировать по:</label>
    </a>
    <select id='column_sort' name="column_sort">
        <option value="id_service">Коду</option>
        <option value="comment">Доп.информации</option>
        <option value="type_name">Типу</option>
        <option value="kind">Виду</option>
    </select>
    <a>
    <label for="group_filter">Искать только:</label>
    </a>
    <?php


    $base_url_str = "window.location='index.php?group_filter='";
    $group_filter_value = isset($_GET['group_filter']) ? $_GET['group_filter'] : '';
    ?>
    <select id='group_filter' size="1" name="group_filter"
            onchange="window.location='index.php?group_filter='+this.value">
            <option value="none"><?php echo $group_filter_value; ?></option>
            <?php
            include 'connect.php';
            $sql_groups = "SELECT DISTINCT kind_name FROM kinds";
            $result_groups = $conn->query($sql_groups);
            $filter_str = $_GET['group_filter'];
            while ($row = $result_groups->fetch_assoc()) {
                if ($group_filter_value != $row['kind_name'])
                    echo '<option value="' . $row['kind_name'] . '" ' /*. $selected*/ . '>' . $row['kind_name'] . '</option>';
            }
            $isFiltered = $_GET['group_filter'] == "none" ? false : true;
            ?>
    </select>
    <input type="submit" class="button" value="Сбросить фильтры">
</form>

<?php
$sort_column = isset($_GET['column_sort']) ? $_GET['column_sort'] : "id_service";
$filter = isset($_GET['group_filter']) ? " WHERE kinds.kind_name = '" . $_GET['group_filter'] . "'" : "";
if (!$isFiltered)
    $filter = '';
$filter2 = isset($_GET['group_filter']) ? " WHERE kinds.kind_name = '" . $_GET['group_filter'] . "'" : "";
$service = "SELECT services.id_service, services.info, types.type_name, kinds.kind_name
            FROM services  
            JOIN types ON services.type = types.id_type
            JOIN kinds ON services.kind = kinds.id_kind
            $filter
            ORDER BY $sort_column";
$result = $conn->query($service);
?>

<div id="main">
    <?php
    $butService = "window.location=`service.php?id_service=";

    if ($result->num_rows > 0) {
        echo "<table class='table''>";
        echo "<tr><th>Код Услуги</th><th>Дополнительная информация</th><th>Тип услуги</th>
                <th>Вид услуги</th><th>Фото</th>";
        while ($row = $result->fetch_assoc()) {
            $butService_s = $butService . $row['id_service'] . "`";
            echo "<tr onclick='" . $butService_s . "'><td>".$row['id_service']."</td><td>".$row['info']."</td>
            <td>".$row['type_name']."</td><td>".$row['kind_name']."</td>
            <td><img src='https://s14.stc.all.kpcdn.net/woman/wp-content/uploads/2022/06/s-vysokoj-posadkoj-massimodutti.com_.jpeg'/></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Нет услуг";
    }

    ?>



</div>

<?php
$conn->close();
?>
</body>
</html>
