<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dynamically Generate Years in PHP</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th colspan="3">Usages of generate_years() function</th>
            </tr>
            <tr>
                <?php
                echo '<td>';
                echo '<br/><br/>default - last 10 years';
                echo '<br/>generate_years();';
                echo '<br/>';
                echo generate_years();
                echo '</td>';

                echo '<td>';
                echo 'generate from starting year 1990 to current year';
                echo '<br/>generate_years(\'year\', 1990);';
                echo '<br/>';
                echo generate_years('year', 1990);
                echo '</td>';

                echo '<td>';
                echo 'generate from starting year 1990 to 2030';
                echo '<br/>generate_years(\'year\', 1990, 2030);';
                echo '<br/>';
                echo generate_years('year', 1990, 2030);
                echo '</td>';
                ?>
            </tr>
        </table>

        <?php

        /**
         * dynamically generate year dropdown
         * @param int $startYear start year
         * @param int $endYear end year
         * @param string $id id of the select-option
         * @return html
         */
        function generate_years($id = 'year', $startYear = '', $endYear = '') {
            $startYear = (strlen(trim($startYear)) ? $startYear : date('Y') - 10);
            $endYear = (strlen(trim($endYear)) ? $endYear : date('Y'));

            if (!holds_int($startYear) || !holds_int($endYear)) {
                return 'Year must be integer value!';
            }

            if ((strlen(trim($startYear)) < 4) || (strlen(trim($endYear)) < 4)) {
                return 'Year must be 4 digits in length!';
            }

            if (trim($startYear) > trim($endYear)) {
                return 'Start Year cannot be greater than End Year!';
            }

            //start the select tag
            $html = '<select id="' . $id . '" name="' . $id . '">"n"';
            $html .= '<option value="">-- Year --</option>"n"';
            //echo each year as an option    
            for ($i = $endYear; $i >= $startYear; $i--) {
                $html .= '<option value="' . $i . '">' . $i . '</option>"n"';
            }
            //close the select tag
            $html .= "</select>";

            return $html;
        }

        function holds_int($str) {
            return preg_match("/^[1-9][0-9]*$/", $str);
        }
        ?>
    </body>
</html>
