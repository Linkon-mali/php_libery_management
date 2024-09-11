<?php
require_once './dbconn.php';
session_start();
$admin_email = $_SESSION['admin_email'];

$db_info = mysqli_query($conn, "SELECT books.book_name, books.book_publication_name, books.book_author_name, books.book_qty, books.book_available_qty, books.book_price, liberyan.name 
FROM books 
INNER JOIN liberyan ON liberyan.id = books.liberyan_id ");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Print all books</title>
    <link rel="stylesheet" href="./print book/style.css" media="all" />
    <style>
        .print_area {
            width: 820px;
            margin-bottom: 100px;
            box-sizing: border-box;
            page-break-after: always;
        }

        .page_info {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
    <?php
    $sl = 1;
    $page = 1;
    $pare_page = 15;
    $total = mysqli_num_rows($db_info);

    while ($row = mysqli_fetch_assoc($db_info)) {
        if ($sl % $pare_page == 1) {
            echo page_header($admin_email);
        }
    ?>

        <tr>
            <td class="service"><?= $sl ?></td>
            <td class="desc"><?= $row['book_name'] ?></td>
            <td class="unit"><?= $row['book_publication_name'] ?></td>
            <td class="qty"><?= $row['book_author_name'] ?></td>
            <td class="qty"><?= $row['book_qty'] ?></td>
            <td class="qty"><?= $row['book_price'] ?></td>
            <td class="total"><?= $row['name'] ?></td>
        </tr>

    <?php
        if ($sl % $pare_page == 0 || $total == $pare_page || $total == $sl) {
            echo page_footer($page++);
        }
        $sl++;
    }
    ?>
</body>

</html>

<?php
function page_header($admin_email)
{
    $data = ' <div class="print_area">
    <header class="clearfix">
        <div id="logo">
            <img src="./print book/logo.png">
        </div>
        <h1>Print All Books By Admin</h1>
        <div id="company" class="clearfix">
            <div>Company Name</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">' . $admin_email . '</a></div>
        </div>
        <div id="project">
            <div><span>PROJECT</span> Website development</div>
            <div><span>CLIENT</span> John Doe</div>
            <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
            <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
            <div><span>DATE</span> August 17, 2015</div>
            <div><span>DUE DATE</span> September 17, 2015</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">SL</th>
                    <th class="desc">BOOK NAME</th>
                    <th class="unit">PUBLICATION NAME</th>
                    <th class="qty">AUTHOR NAME</th>
                    <th class="qty">BOOK QUANTITY</th>
                    <th class="qty">BOOK PRICE</th>
                    <th class="total">LIBERYAN NAME</th>
                </tr>
            </thead>
            <tbody>';
    return $data;
}

function page_footer($page)
{
    $data = ' </tbody>
        </table>
        <div class="page_info">Page: ' . $page . '</div>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
        </div>';
    return $data;
}


?>