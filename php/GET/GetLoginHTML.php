<?php
    include_once(dirname(__FILE__) . "\..\DBCredentials.php");
    include_once(dirname(__FILE__) . "\..\SQLProxy.php");

    class GetLoginHTML {

        private DBData $dbData;
        private SQLCommands $sqlCommands;

        /****
         * GetLoginHTML constructor.
         * @param $dbData
         ****/
        function __construct(DBdata $dbData) {
            $this->dbData = $dbData;
            $this->sqlCommands = new SQLProxy(null, $dbData);
        }

        /****
         * @param $name - username
         * @return bool
         ****/
        function ifLoggedIn(string $name): bool {
            if (isset($_SESSION[$name])) return true;
            return false;
        }

        /****
         * @param string $email
         * @param string $pwd
         * @return string
         ****/
        function login(string $email,string $pwd): string {
            $arr = ["email" => $email];
            $sql = "SELECT EMAIL FROM Users WHERE EMAIL = :email";
            if(!$this->sqlCommands->columnExist($sql, $arr)) {
                return "Brak użytkownika o podanym adresie email";
            }
            $arr = [
                'email' => $email,
                'password' => $pwd
            ];
            $sql = "SELECT EMAIL FROM Users WHERE EMAIL = :email AND PASSWORD = :password";
            if(!$this->sqlCommands->columnExist($sql, $arr)) {
                return "Błędne hasło";
            }
            $_SESSION['name'] = $_POST['email'];
            $_SESSION['time'] = time();
            $arr = null;
            return "";
        }

        function logout() {
            echo 'Zostałeś wylogowany';
            session_destroy();
            header( "Location: http://localhost/php-project/Main.php" );
        }

        function goToMainSite() {
            header( "Location: http://localhost/php-project/Main.php" );
        }

        function isAdmin(): bool {
            if (!$this->ifLoggedIn("name")) return false;
            $arr = ["email" => $_SESSION["name"]];
            $sql = "SELECT user_id FROM ADMIN WHERE user_id IN (SELECT ID FROM USERS WHERE email = :email)";
            return $this->sqlCommands->columnExist($sql, $arr);
        }

        /****
         * @param $sql - a sql query
         * @param $params - params for a sql query
         * @return string - return table
         */
        function showDBTable($sql, $params, $html = ""): string {
            $arr = $this->sqlCommands->returnTable($sql, $params);
            $str = "<table>";
            try {
                foreach ($arr as $col) {
                    $str = $str . "<tr>";
                    foreach ($col as $i) {
                        $str = $str . "<th>" . $i . "</th>";
                    }
                    $str = $str . $html . "</tr>";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return $str . "</table>";
        }

        function uploadFile($id) {
            $target_dir = "../Items/" . $id . "/";
            mkdir(dirname(__FILE__)."/../../Items/" . $id);
            print_r($_FILES);
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["picture"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

// Check if file already exists
            if (file_exists($target_file)) {
                echo "Plik istnieje.";
                $uploadOk = 0;
            }

// Check file size
            if ($_FILES["picture"]["size"] > 500000) {
                echo "Plik jest za duży.";
                $uploadOk = 0;
            }

// Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Tylko JPG, JPEG, PNG & GIF są dozwolone.";
                $uploadOk = 0;
            }

// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                    echo "Przedmiot został dodany.";
                } else {
                    echo "Nastąpił problem.";
                }
            }
        }

        function showDBSelect($sql, $params, $value, $key, $multiselect=null): string {
            $arr = $this->sqlCommands->returnTable($sql, $params);
            $str = "";
            if (isset($multiselect)) {
                $str = "<select name='subcategoryid[]' multiple='multiple'>";
            } else {
                $str = "<select name='subcategoryid'>";
            }
            foreach ($arr as $col) {
                $str = $str . "<option value='$col[$value]'>$col[$key]</option>";
            }
            $str = $str . "</select>";
            return $str;
        }
    }