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
<body class="body">
<button class="button" onclick="window.location.href='index.php'">Главная</button>
<button class="button" onclick="window.location.href='addReview.php'">Оставить отзыв</button>
<button class="button" onclick="window.location.href='addReview.php'">Корзина</button>
<button class="button" onclick="window.location.href='addReview.php'">Акции</button>
<button class="button" onclick="window.location.href='addReview.php'">Ткани</button>
<button class="button" onclick="window.location.href='addReview.php'">Подарки</button>

<form method="get" class="form">
    <label for="column_sort">Сортировать по:</label>
    <select id='column_sort' name="column_sort">
        <option value="id_service">Коду</option>
        <option value="comment">Доп.информации</option>
        <option value="type_name">Типу</option>
        <option value="kind">Виду</option>
    </select>
    <label for="group_filter">Искать только:</label>
    <?php
    $base_url_str = "window.location='index.php?group_filter='";
    $group_filter_value = isset($_GET['group_filter']) ? $_GET['group_filter'] : '';
    ?>
    <select id='group_filter' size="1" name="group_filter"
            onchange="window.location='index.php?group_filter='+this.value">
            <option value="none"><?php echo $group_filter_value; ?></option>
            <?php
            include 'connect.php';
            $sql_groups = "SELECT DISTINCT kind FROM Kinds_service";
            $result_groups = $conn->query($sql_groups);
            $filter_str = $_GET['group_filter'];
            while ($row = $result_groups->fetch_assoc()) {
                if ($group_filter_value != $row['kind'])
                    echo '<option value="' . $row['kind'] . '" ' /*. $selected*/ . '>' . $row['kind'] . '</option>';
            }
            $isFiltered = $_GET['group_filter'] == "none" ? false : true;
            ?>
    </select>
    <input type="submit" class="button" value="Сбросить все сортировки и фильтры">
</form>

<?php
$sort_column = isset($_GET['column_sort']) ? $_GET['column_sort'] : "id_service";
$filter = isset($_GET['group_filter']) ? " WHERE Kinds_service.kind = '" . $_GET['group_filter'] . "'" : "";
if (!$isFiltered)
    $filter = '';
$filter2 = isset($_GET['group_filter']) ? " WHERE Kinds_service.kind = '" . $_GET['group_filter'] . "'" : "";
$service = "SELECT Service.id_service, Service.comment, Types_service.type_name, Kinds_service.kind
            FROM Service  
            JOIN Types_service ON Service.type = Types_service.id_type
            JOIN Kinds_service ON Service.id_kind = Kinds_service.id_kind
            $filter
            ORDER BY $sort_column";
$result = $conn->query($service);
?>

<div id="main">
    <h2>Услуги</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='table''>";
        echo "<tr><th>Код Услуги</th><th>Дополнительная информация</th><th>Тип услуги</th>
                <th>Вид услуги</th><th>Фото</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row['id_service']."</td><td>".$row['comment']."</td>
            <td>".$row['type_name']."</td><td>".$row['kind']."</td>
            <td><img src='https://s14.stc.all.kpcdn.net/woman/wp-content/uploads/2022/06/s-vysokoj-posadkoj-massimodutti.com_.jpeg'/></td>";
        }
        echo "</table>";
        echo $group_filter_value;
    } else {
        echo "Нет услуг";
    }

    ?>



</div>

<?php
$conn->close();
?>

<script>
    let update = () =>{
        var selectedValue = document.getElementById("group_filter").value;

        // Отправляем AJAX запрос на сервер для получения новых данных
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Обновляем содержимое контейнера с данными
                document.getElementById("table").innerHTML = xhr.responseText;
            }
        };

        xhr.open("GET", "новые_данные.php?value=" + selectedValue, true);
        xhr.send();
    }
</script>
</body>
</html>
