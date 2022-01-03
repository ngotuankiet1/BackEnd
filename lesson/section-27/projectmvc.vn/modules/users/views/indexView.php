<?php
get_header();
?>
<html>
    <style>
         #content table th{
            border: 1px solid black;
            padding: 8px 15px;
        }
        #content table td{
            border: 1px solid black;
            padding: 8px 15px;
        }
    </style>
    <div id="content">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>fullname</th>
                    <th>email</th>
                    <th>earn</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($get_users)) {
                    $t = 0;
                    foreach ($get_users as $item) {
                        $t++;
                        ?>
                        <tr>
                            <td><?php echo $t; ?></td>
                            <td><?php echo $item['fullname']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo currency_format($item['earn'], '$'); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</html>
<?php
get_footer();
?>