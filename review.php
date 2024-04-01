<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Ателе</title>
</head>
<body>
<button class="button" onclick="window.location.href='index.php'">Главная</button>
<button class="button" onclick="window.location.href='изменение.php'">Изменение</button>
<button class="button" onclick="window.location.href='addReview.php'">Добавление</button>
<button class="button" onclick="window.location.href='фильтр.php'">Фильтр</button>


<form method="get">
    <label for="column_sort">Сортировать по:</label>
    <select name="column_sort">
        <option value="id_service">Коду</option>
        <option value="message">Доп.информации</option>
        <option value="type">Типу</option>
        <option value="id_kind">Виду</option>
    </select>
    <input type="submit" class="button" value="Применить сортировку">
</form>

<?php
$sort_column = isset($_GET['column_sort']) ? $_GET['column_sort'] : "id_service";
$service = "SELECT * FROM Service ORDER BY $sort_column";
$result = $conn->query($service);
?>

<?php
$sql_alb = "SELECT Review.id_review, Review.message, Review.user
                FROM Review
                LEFT JOIN users ON users.id_user = Review.user";
$res_alb = $conn->query($sql_alb);

if ($res_alb->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Пользователь</th><th>Отзыв</th></tr>";
    while ($row = $res_alb->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_review'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "<td>" . $row['user'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 музыкантов";
}
?>

<!-- Вкладка "Главная" -->


<?php
$conn->close();
?>
</body>
</html>
