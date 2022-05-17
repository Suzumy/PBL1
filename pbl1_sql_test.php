<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>test</title>
        <link rel="stylesheet" type="text/css" href="css">
    </head>
    <body>
        <?php



            //データベース接続
            class DbDate{
                protected $pdo;
                
                public function __construct()
                {
                    $dsn = 'mysql:host=localhost:3306;dbname=PBL1;charset=utf8';

                    $user = 'root';
                    $password = 'root';

                    try{                      
                        $this->pdo = new PDO($dsn, $user, $password);                     
                    } catch(Exception  $e){                     
                        echo 'Error:' . $e->getMessage( );                      
                        die( );                     
                    }
                }

                protected function query ( $sql,  $array_params ) {  // SELECT文実行用のメソッド
                    $stmt = $this->pdo->prepare( $sql );                      
                    $stmt->execute( $array_params );                      
                    return  $stmt;          // PDOステートメントオブジェクトを返すのでfetch( )、fetchAll( )で結果セットを取得           
                }                     
                                
                protected function exec ( $sql,  $array_params ) {  // INSERT、UPDATE、DELETE文実行用のメソッド
                    $stmt = $this->pdo->prepare( $sql );                      
                    return  $stmt->execute( $array_params );        // 成功：true、失敗：false
                }
            } 

            //ユーザー表示
            class User extends DbDate{
                public function authUser(){
                    $sql = "SELECT users.userName,article.title,article.explanation,article.articleimg1 FROM users,article WHERE users.userId=article.userId";
                    $stmt = $this->query($sql,[]);
                    return $stmt->fetch();
                }
            }

            $user = new User();
            $resurt = $user->authUser();

            echo $resurt[0];
            echo $resurt[1];
            echo $resurt[2];


            echo '<img src="'.$resurt[3].'" alt="リンゴ">';

            //var_dump('<img src="'.$picture.'" alt="リンゴ">');
        ?>
    </body>
</html>