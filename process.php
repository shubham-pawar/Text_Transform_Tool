<?php
if($_SERVER['REQUEST_METHOD']==='POST'){
    $inputText=$_POST['inputText'];
    $operation=$_POST['operation'];
    $substring=isset($_POST['substring']) ? $_POST['substring'] :'';

    switch($operation){
        case 'uppercase':
            $result=strtoupper(string: $inputText);
            break;

        case 'lowercase':
            $result=strtolower(string: $inputText);
            break;

        case 'reverse': 
            $result=strrev(string: $inputText);
            break;
        
        case 'charCount': 
            $result=strlen(string: $inputText);
            break;
        
        case 'explode':
            $words=explode(separator: ' ', string: $inputText);
            $result=implode(separator: ',', array: $words);
            break;

        case 'wordCount':
            $result=str_word_count(string: $inputText, format: 0);
            break;
        
        case 'removeSpaces':
            $result=str_replace(search: ' ',replace: '', subject: $inputText);
            break;

        case 'shuffle':
            $result=str_shuffle(string: $inputText);
            break;
        
        case 'findPosition':
            $position=strpos(strtolower($inputText), strtolower($substring));
            $result = ($position !== false) ? "Found at position: $position" : "Not found";
            break;

        case 'wordWrap':
            $result=wordwrap(string: $inputText,width: 10,break: "<br>");
            break;

        case 'substr':
            if(isset($_POST['start']) && is_numeric($_POST['start'])){
                $start=intval($_POST['start']);
                if(isset($_POST['length']) && is_numeric($_POST['length']) && $_POST['length']>0){
                    $length=intval($_POST['length']);
                    $result=substr($inputText, $start, $length);
            }else{
                $result=substr($inputText, $start);
            }
        }else{
            $result="Start position is not provided or invalid for substr operation";
        }
        break;

        default:
            $result= "Invalid Operation";
        }            
    }else{
        header("Location:index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Transformation Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Text Transformation Result</h1>

        <p><b>Original Text:</b> <?php echo $inputText ?> </p>
        <p><b>Operation Performed:</b> <?php echo $operation ?> </p>
        <p><b>Result:</b> <?php echo $result ?> </p>
        <?php 
            if($operation== 'findPosition'){
                echo "<p>Substring '$substring' ";
                if(strpos($result, 'Found') !== false){
                    echo "found at position: $position</p>";
                } else {
                    echo "not found</p>";
                }
            }
        ?>
        <p class="backButton"><a href="index.php">Back to Text Transformation Tool</a></p>
    </div>
</body>
</html>
