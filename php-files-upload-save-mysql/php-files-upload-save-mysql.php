<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Files Save into MySQL Database using PHP</title>
        <style type="text/css">
            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }
            #body{
                margin: 0 15px 0 15px;
            }
            #container{
                margin: 10px;
                width: 600px;
                padding: 10px;
                border: 1px solid #D0D0D0;
                -webkit-box-shadow: 0 0 8px #D0D0D0;
            }
            .error {
                color: #E13300;
            }
            .info {
                color: gold;
            }
            .success {
                color: darkgreen;
            }
        </style>
        <!--<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>-->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
            if ($_FILES['upload_file1']['size'] <= 0) {
                echo 'Hey, Please choose at least one file';
            } else {
                foreach ($_FILES as $key => $value) {
                    if (0 < $value['error']) {
                        echo 'Error during file upload ' . $value['error'];
                    } else if (!empty($value['name'])) {
						$dbConn = mysqli_connect('localhost', 'root', 'root', 'roytuts') or die('MySQL connect failed. ' . mysqli_connect_error());
						
						$sql = "insert into files_data(name, type, size, content, saved_date) values('".$value['name']."', '".$value['type']."', '".filesize_formatted($value['size'])."', '".mysqli_escape_string($dbConn, file_get_contents($value['tmp_name']))."', '".date('Y-m-d H:i:s')."')";
						
						$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
						
						if($result) {
							echo 'File successfully saved to database';
						}
                    }
                }
            }
        }
		
		function filesize_formatted($size) {
			$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
			$power = $size > 0 ? floor(log($size, 1024)) : 0;
			
			return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
		}
        ?>
        <div id="container">
            <form name="upload_form" enctype="multipart/form-data" action="php-files-upload-save-mysql.php" method="POST">
                <fieldset>
                    <legend>Files Save into MySQL database using PHP</legend>
                    <section>
                        <label>Browse a file</label>
                        <label>
                            <input type="file" name="upload_file1" id="upload_file1" readonly="true"/>
                        </label>
                        <div id="moreFileUpload"></div>
                        <div style="clear:both;"></div>
                        <div id="moreFileUploadLink" style="display:none;margin-left: 10px;">
                            <a href="javascript:void(0);" id="attachMore">Attach another file</a>
                        </div>
                    </section>
                </fieldset>
                <div>&nbsp;</div>
                <footer>
                    <input type="submit" name="upload" value="Upload"/>
                </footer>
            </form>
        </div>        
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        $("input[id^='upload_file']").each(function () {
            var id = parseInt(this.id.replace("upload_file", ""));
            $("#upload_file" + id).change(function () {
                if ($("#upload_file" + id).val() !== "") {
                    $("#moreFileUploadLink").show();
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var upload_number = 2;
        $('#attachMore').click(function () {
            //add more file
            var moreUploadTag = '';
            
			moreUploadTag += '<div class="element"><label for="upload_file"' + upload_number + '>Upload File ' + upload_number + '</label>';
            moreUploadTag += '&nbsp;<input type="file" id="upload_file' + upload_number + '" name="upload_file' + upload_number + '"/>';
            moreUploadTag += '&nbsp;<a href="javascript:void" style="cursor:pointer;" onclick="deletefileLink(' + upload_number + ')">Delete ' + upload_number + '</a></div>';
			
            $('<dl id="delete_file' + upload_number + '">' + moreUploadTag + '</dl>').fadeIn('slow').appendTo('#moreFileUpload');
            
			upload_number++;
        });
    });
</script>

<script type="text/javascript">
    function deletefileLink(eleId) {
        if (confirm("Are you really want to delete ?")) {
            var ele = document.getElementById("delete_file" + eleId);
            ele.parentNode.removeChild(ele);
        }
    }
</script>