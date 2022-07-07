<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dynamically Generate Months in PHP</title>
    </head>
    <body>
        <?php
        echo 'Usage Example<br/><br/>';
        echo 'echo generate_months();<br/><br/>';
        echo generate_months();

        /**
         * dynamically generate months dropdown
         * @param string $id id of the select-option
         * @return html
         */
        function generate_months($id = 'month') {
            //start the select tag
            $html = '<select id="' . $id . '" name="' . $id . '">"n"';
            $html .= '<option value="">-- Month --</option>"n"';
            //echo each month as an option    
            for ($i = 1; $i <= 12; $i++) {
                $timestamp = mktime(0, 0, 0, $i);
                $label = date("F", $timestamp);
                $html .= '<option value="' . $i . '">' . $label . '</option>"n"';
            }
            //close the select tag
            $html .= "</select>";

            return $html;
        }
        ?>
    </body>
</html>
